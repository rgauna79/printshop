<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getRecord()
    {
        return self::select('orders.*', 'users.name as user_name', 'shipping_charge.name as shipping_name')
                    ->join('users', 'users.id', '=', 'orders.user_id')
                    ->leftJoin('shipping_charge', 'shipping_charge.id', '=', 'orders.shipping_id')
                    ->where('orders.is_deleted', '=', 0)
                    ->orderBy('orders.id','desc')
                    ->paginate(50);
    }
}
