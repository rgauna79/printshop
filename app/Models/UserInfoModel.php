<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfoModel extends Model
{
    use HasFactory;

    protected $table = 'users_info';


    static public function getUserInfo($id)
    {
        return self::where('user_id', $id)->first();
    }
}
