<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getSingleUser($userId, $orderId)
    {
        return self::where('user_id', '=', $userId)
                    ->where('id', '=', $orderId)
                    ->first();
    }

    static public function getRecordUser($userId)
    {
        return OrderModel::select('orders.*', 'users.name as user_name', 'shipping_charge.name as shipping_name')
                    ->leftJoin('users', 'users.id', '=', 'orders.user_id')
                    ->leftJoin('shipping_charge', 'shipping_charge.id', '=', 'orders.shipping_id')
                    ->where('orders.user_id', '=', $userId)
                    ->where('orders.is_deleted', '=', 0)
                    ->where('orders.is_completed', '=', 1)
                    ->orderBy('orders.id','desc')
                    ->paginate(20);

    }
    static public function getRecord()
    {
        $return =OrderModel::select('orders.*', 'users.name as user_name', 'shipping_charge.name as shipping_name')
                    ->leftJoin('users', 'users.id', '=', 'orders.user_id')
                    ->leftJoin('shipping_charge', 'shipping_charge.id', '=', 'orders.shipping_id');
        
        if(!empty(Request::get('order_id')))
        {
            $return = $return->where('orders.id', '=', Request::get('order_id'));
        }
        if(!empty(Request::get('company_name')))
        {
            $return = $return->where('orders.company_name', 'like', '%'.Request::get('company_name').'%');
        }
        if(!empty(Request::get('first_name')))
        {
            $return = $return->where('orders.first_name', 'like', '%'.Request::get('first_name').'%');
        }
        if(!empty(Request::get('last_name')))
        {
            $return = $return->where('orders.last_name', 'like', '%'.Request::get('last_name').'%');
        }
        if(!empty(Request::get('email')))
        {
            $return = $return->where('orders.email', 'like', '%'.Request::get('email').'%');
        }
        if(!empty(Request::get('phone')))
        {
            $return = $return->where('orders.phone', 'like', '%'.Request::get('phone').'%');
        }
        if(!empty(Request::get('city')))
        {
            $return = $return->where('orders.city', 'like', '%'.Request::get('city').'%');
        }
        if(!empty(Request::get('state')))
        {
            $return = $return->where('orders.state', 'like', '%'.Request::get('state').'%');
        }
        if(!empty(Request::get('country')))
        {
            $return = $return->where('orders.country', 'like', '%'.Request::get('country').'%');
        }
        if(!empty(Request::get('zip_code')))
        {
            $return = $return->where('orders.zip_code', 'like', '%'.Request::get('zip_code').'%');
        }
        if(!empty(Request::get('from_date')) && !empty(Request::get('to_date')))
        {
            $return = $return->whereRaw("DATE(orders.created_at) BETWEEN ? AND ?", [Request::get('from_date'), Request::get('to_date')]);

        }

        $return = $return->where('orders.is_deleted', '=', 0)
                    ->where('orders.is_completed', '=', 1)
                    ->orderBy('orders.id','desc')
                    ->paginate(30);

        return $return;
    }

    static public function getTotalOrderMonth($start_date, $end_date)
    {
        return self::select('id')
                    ->where('is_completed', '=', 1)
                    ->where('is_deleted', '=', 0)
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->count();
    }

    static public function getTotalSalesMonth($start_date, $end_date)
    {
        return self::select('id')
                    ->where('is_completed', '=', 1)
                    ->where('is_deleted', '=', 0)
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->sum('total_amount');
    }

    static public function getTotalOrders()
    {
        return self::where('is_completed', '=', 1)
                ->where('is_deleted', '=', 0)
                ->count();
    }

    static public function getLatestOrders()
    {
        return self::where('is_completed', '=', 1)
                    ->where('is_deleted', '=', 0)
                    ->orderBy('id', 'desc')
                    ->take(5)
                    ->get();
    }

    static public function getTodaySales()
    {
        return self::whereDate('created_at', date('Y-m-d'))->sum('total_amount');

    }

    static public function getStartYear()
    {
        $minDate = self::min('created_at');
        $start_year = date('Y', strtotime($minDate));
        return $start_year;
    }

    static public function getTodayOrders()
    {
        return self::whereDate('created_at', date('Y-m-d'))->count();

    }
    public function getShipping()
    {
        return $this->belongsTo(ShippingChargeModel::class, 'shipping_id');
    }

    public function getItem()
    {
        return $this->hasMany(OrderDetailModel::class, 'order_id');
    }

    //User Orders


    static public function getTotalUserOrder($userId)
    {
        return self::select('id')
                    ->where('user_id', '=', $userId)
                    ->where('is_completed', '=', 1)
                    ->where('is_deleted', '=', 0)
                    ->count();
    }

    static public function getTotalUserSales($userId)
    {
        return self::select('id')
                    ->where('user_id', '=', $userId)
                    ->where('is_completed', '=', 1)
                    ->where('is_deleted', '=', 0)
                    ->sum('total_amount');
    }

    static public function getTodayUserOrder($userId)
    {
        return self::whereDate('created_at', date('Y-m-d'))
                    ->where('user_id', '=', $userId)
                    ->where('is_completed', '=', 1)
                    ->where('is_deleted', '=', 0)
                    ->count();  
    }

    static public function getInProgressUserOrder($userId)
    {
        return self::where('user_id', '=', $userId)
                    ->where('is_completed', '=', 1)
                    ->where('is_deleted', '=', 0)
                    ->where('status', '=', 1)
                    ->count();
    }

    static public function getPendingUserOrder($userId)
    {
        return self::where('user_id', '=', $userId)
                    ->where('is_completed', '=', 1)
                    ->where('is_deleted', '=', 0)
                    ->where('status', '=', 0)
                    ->count();
    }
}
