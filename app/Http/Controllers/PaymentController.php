<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;

class PaymentController extends Controller
{
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

        if(!empty($request->size_id)) {
            $size_id = $request->size_id;
            $getSize = ProductSizeModel::getSingle($size_id);
            if(!empty($getSize->price))
            {
                $total = $getSize->price;
            }
        }
        else
        {
            $size_id = 0;
        }

        $color_id = !empty($request->color_id) ? $request->color_id : 0;

        $cartKey = $getProduct->id . '_' . $size_id . '_' . $color_id;

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
        Cart::remove($id);
        return redirect()->back();
    }

    public function cart_update(Request $request)
    {
        foreach ($request->cart as $cart)
        {
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
       
        return view('payment.checkout', $data);
    }
}
