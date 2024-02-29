<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartModel extends Model
{
    use HasFactory;

    public static function getCart()
    {
        return Cart::getContent();
    }


    
}
