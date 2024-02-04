<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_image';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    public function getImageUrl()
    {
        if(!empty($this->image_name) && file_exists('upload/product/'.$this->image_name))
        {
            return url('upload/product/'.$this->image_name);
        }
        else
        {
            return "";
        }
    }

}
