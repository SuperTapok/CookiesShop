<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Order;

class OrdersController extends Controller
{
    public function index (){
        $employees = Employee::has('orders')->get();

        $orders = Order::where('paid_at', '!=', null)->get();
        
        return view('orders', ['employees' => $employees, 'orders' => $orders]);
    }

    public function get_orders_by_employee ($employee_id) {
        $orders = Order::where('paid_at', '!=', null)->where('employee_id', $employee_id)->get();

        return $this->successResponse([
            'data' => $orders
        ]);
    }

    public function get_orders_by_code ($receipt_code) {
        $orders = Order::where('receipt_code', 'LIKE', '%'.$receipt_code.'%')->get();

        return $this->successResponse([
            'data' => $orders
        ]);
    }

    public function give_order ($order_id) {
        $order = Order::where('id', $order_id)->get()->first();
        $order->given_at = date("Y-m-d H:i:s");
        $order->save();


        return $this->successResponse([
            'message' => "Заказ выдан."
        ]);
    }
}
