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
    public function dashboard(Request $request)
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
        $data['getTotalOrders'] = OrderModel::getTotalOrders();

        if(!empty($request->year))
        {
            $year = $request->year;
        }
        else
        {
            $year = date('Y');
        }

        
        $start_year = OrderModel::getStartYear();

        $getTotalCustomerMonth = '';
        $getTotalOrderMonth = '';
        $getTotalSalesMonth = '';
        $totalAmount = 0;


        for($month = 1; $month <= 12; $month++)
        {
            $startDate = new \DateTime($year . '-' . $month . '-01');
            $endDate = new \DateTime($year . '-' . $month . '-01');
            $endDate->modify('last day of this month');

            $start_date = $startDate->format('Y-m-d');
            $end_date = $endDate->format('Y-m-d');

            $customer = User::getTotalCustomerMonth($start_date, $end_date);
            $getTotalCustomerMonth .= $customer . ',';

            $order = OrderModel::getTotalOrderMonth($start_date, $end_date);
            $getTotalOrderMonth .= $order . ',';

            $sales = OrderModel::getTotalSalesMonth($start_date, $end_date);
            $getTotalSalesMonth .= $sales . ',';

            $totalAmount += $sales;
        }

        $data['getTotalCustomerMonth'] = rtrim($getTotalCustomerMonth, ',');
        $data['getTotalOrderMonth'] = rtrim($getTotalOrderMonth, ',');
        $data['getTotalSalesMonth'] = rtrim($getTotalSalesMonth, ',');
        $data['totalAmount'] = $totalAmount;
        $data['year'] = $year;
        $data['start_year'] = $start_year;

        return view('admin.dashboard', $data);
    }
}
