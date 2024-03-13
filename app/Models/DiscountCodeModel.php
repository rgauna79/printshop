<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCodeModel extends Model
{
    use HasFactory;

    protected $table = 'discount_code';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        return self::select('discount_code.*')
                    ->where('discount_code.is_deleted', '=', 0)
                    ->orderBy('discount_code.id', 'asc')
                    ->paginate(20);
    }
}
