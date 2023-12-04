<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Employee;
use App\Models\Order;
use Illuminate\Contracts\Database\Eloquent\Builder;

class TransactionsController extends Controller
{
    public function index()
    {
        $orders = Order::where('employee_id', request()->user()->employee_id)->where('paid_at', '!=', null)->get();

        $employee = Employee::where('id', request()->user()->employee_id)->get()->first();
        
        $transactions = [];
        $i = 0;
        foreach ($employee->activities as $activity) {
            $transactions[$i] = [
                "type" => "revenue",
                "date" => $activity->pivot->given_at,
                "sum" => $activity->cookies,
                "info" => $activity->name
            ];
            $i++;
        }

        foreach($orders as $order){
            $transactions[$i] = [
                "type" => "order",
                "date" => $order->paid_at,
                "sum" => $order->sum,
                "info" => $order->receipt_url
            ];
            $i++;
        }

        $date = array_column($transactions, 'date');

        array_multisort($date, SORT_ASC, $transactions);

        return view('transactions', ["transactions" => $transactions]);
    }
}
