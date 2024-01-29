<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'product';


    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function checkSlug($slug)
    {
        return self::where('slug', '=', $slug)->count();
    }
}
