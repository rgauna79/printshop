<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\ColorModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\SubCategoryModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = "Dashboard";
        $data['getRecordUser'] = User::getAdmin();
        $data['getRecordProduct'] = ProductModel::getRecord();
        $data['getCategory'] = CategoryModel::getRecord();
        $data['getSubCategory'] = SubCategoryModel::getRecord();
        $data['getBrand'] = BrandModel::getRecord();
        $data['getColor'] = ColorModel::getRecord();
        $data['getOrder'] = OrderModel::getRecord();
        $data['getTodaySales'] = OrderModel::getTodaySales();
        $data['getTodayOrders'] = OrderModel::getTodayOrders();
        $data['getCustomer'] = User::getCustomer();
        $data['getLatestOrder'] = OrderModel::getLatestOrders();

        return view('admin.dashboard', $data);
    }
}
