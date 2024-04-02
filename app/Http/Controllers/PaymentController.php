<?php

namespace App\Http\Controllers;

use App\Models\DiscountCodeModel;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use App\Models\ShippingChargeModel;
use App\Models\UserInfoModel;

class PaymentController extends Controller
{
    public function apply_discount_code(Request $request)
    {
        $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);
        if (!empty($getDiscount)) {
            $total = Cart::getSubTotal();
            if ($getDiscount->type == 'Percent') {
                $discount_amount = ($total * $getDiscount->percent_amount) / 100;
                $payable_total = $total - $discount_amount;
            } else {
                $discount_amount = $getDiscount->percent_amount;
                $payable_total = $total - $discount_amount;
            }

            $json['status'] = true;
            $json['message'] = 'success';
            $json['discount_amount'] = number_format($discount_amount, 2);
            $json['payable_total'] = $payable_total;
        } else {
            $json['discount_amount'] = '0.00';
            $json['payable_total'] = Cart::getSubTotal();
            $json['status'] = false;
            $json['message'] = 'Invalid discount code';
        }

        echo json_encode($json);
    }

    public function cart(Request $request)
    {
        $data['meta_title'] =  'Cart';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('payment.cart', $data);
    }
    public function add_to_cart(Request $request)
    {
        $getProduct = ProductModel::getSingle($request->product_id);
        $total = $getProduct->price;

        if (!empty($request->size_id)) {
            $size_id = $request->size_id;
            $getSize = ProductSizeModel::getSingle($size_id);
            if (!empty($getSize->price)) {
                $total = $getSize->price;
            }
        } else {
            $size_id = 0;
        }

        $color_id = !empty($request->color_id) ? $request->color_id : 0;

        $cartKey = $getProduct->id . '_' . $size_id . '_' . $color_id;

        // Check if theres a user logged in and set session
        if (auth()->check()) {
            Cart::session(auth()->user()->id);
        }

        $existingItem = Cart::get($cartKey);

        if ($existingItem) {
            // If the item with the same attributes exists, update its quantity
            Cart::update($cartKey, [
                'quantity' => $request->qty,
            ]);
        } else {
            // If no item with the same attributes exists, add a new item to the cart
            Cart::add([
                'id' => $cartKey,
                'name' => 'Product',
                'price' => $total,
                'quantity' => $request->qty,
                'attributes' => [
                    'size_id' => $size_id,
                    'color_id' => $color_id
                ]
            ]);
        }

        return redirect()->back()->with('success', 'Product Added To Cart');
    }

    public function cart_delete($id)
    {
        // Check if theres a user logged in and set session
        if (auth()->check()) {
            Cart::session(auth()->user()->id);
        }

        Cart::remove($id);
        return redirect()->back();
    }

    public function cart_update(Request $request)
    {
        // Check if theres a user logged in and set session
        if (auth()->check()) {
            Cart::session(auth()->user()->id);
        }

        foreach ($request->cart as $cart) {
            Cart::update($cart['id'], array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $cart['qty']
                ),
            ));
        }

        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        $data['meta_title'] =  'Checkout';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['getShipping'] = ShippingChargeModel::getRecordActive();

        // get user info
        $userInfo = UserInfoModel::getUserInfo(auth()->user()->id);
        if (!empty($userInfo)) {
            $data['getUserInfo'] = $userInfo;
            $data['getUser'] = auth()->user();
        } 

        return view('payment.checkout', $data);
    }

    public function place_order(Request $request)
    {
        // Check if theres a user logged in and set session
        if (auth()->check()) {
            Cart::session(auth()->user()->id);
            $userId = auth()->user()->id;
        } else {
            $userId = '';
        }

        $getShipping = ShippingChargeModel::getSingle($request->shipping);
        $total = Cart::getSubTotal();
        $discount_amount = 0;
        $discount_code = '';

        if (!empty($request->discount_code)) {
            $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);
            if (!empty($getDiscount)) {
                $discount_code = $request->discount_code;
                if ($getDiscount->type == 'Percent') {
                    $discount_amount = ($total * $getDiscount->percent_amount) / 100;
                    $total = $total - $discount_amount;
                } else {
                    $discount_amount = $getDiscount->percent_amount;
                    $total = $total - $discount_amount;
                }
            }
        }

        $shippingPrice = !empty($getShipping->price) ? $getShipping->price : 0;

        $total = $total + $shippingPrice;

        $order = new OrderModel();
        $order->user_id = $userId;
        $order->first_name = trim($request->first_name);
        $order->last_name = trim($request->last_name);
        $order->company_name = trim($request->company_name);
        $order->address_1 = trim($request->address_1);
        $order->address_2 = trim($request->address_2);
        $order->city = trim($request->city);
        $order->state = trim($request->state);
        $order->country = trim($request->country);
        $order->zip_code = trim($request->zip_code);
        $order->phone = trim($request->phone);
        $order->email = trim($request->email);
        $order->note = trim($request->email);
        $order->discount_code = trim($discount_code);
        $order->discount_amount = $discount_amount;
        $order->shipping_id = trim($request->shipping);
        $order->shipping_amount = trim($shippingPrice);
        $order->total_amount = trim($total);
        $order->payment = trim($request->payment);
        $order->save();

        foreach (Cart::getContent() as $key => $cart) {
            $order_item = new OrderDetailModel();
            $order_item->order_id = $order->id;
            $order_item->product_id = explode('_', $cart->id)[0];
            $order_item->product_price = $cart->price;
            if ($cart->attributes->size_id != 0) {
                $order_item->product_size_id = $cart->attributes->size_id;
            }
            if ($cart->attributes->color_id != 0) {
                $order_item->product_color_id = $cart->attributes->color_id;
            }
            $order_item->quantity = $cart->quantity;
            $order_item->total = $cart->price * $cart->quantity;
            $order_item->save();
        }

        Cart::clear();
        return redirect()->back()->with('success', "Order successfully placed");
    }
}
