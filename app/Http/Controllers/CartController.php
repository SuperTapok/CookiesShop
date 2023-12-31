<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class CartController extends Controller
{
    private function group_products($products): array {
        $grouped_products = [];

        foreach($products as $product) {
            if (isset($grouped_products[$product->id])) {
                $grouped_products[$product->id]['count'] += 1;
                $grouped_products[$product->id]['cost'] += $product->cost;
            }
            else{
                $grouped_products[$product->id] = [ 'id' => $product->id, 
                                                    'name' => $product->name, 
                                                    'cost_per_one' => $product->cost, 
                                                    'count' => 1,
                                                    'cost' => $product->cost,
                                                    'images' => $product->images];
            }
        }

        return $grouped_products;
    }

    public function index () {
        $order = Order::query()->where('employee_id', request()->user()->employee_id)->where('paid_at', null)->get()->first();

        if ($order){
            $products = $order->products;
            $products = $this->group_products($products);
        }
        else{
            $products = [];
        }

        return view('cart', ['products' => $products, 'order' => $order]);
        
    }

    public function add_product ($employee_id, $product_id){
        $order = Order::query()->where('employee_id', $employee_id)->where('paid_at', null)->get();

        if (count($order) > 1) {
            return $this->failureResponse([
                'message' => "Ошибка добавления"
            ]);
        }
        else if (count($order) == 1){
            $order = $order->first();
        }
        else{
            $order = new Order;
            $order->employee_id = $employee_id;
            $order->save();
            $order->refresh();

        }
        $order->products()->attach([$product_id]);
        $order->sum += Product::find($product_id)->cost;
        $order->save();

        return $this->successResponse([
            'message' => "Товар добавлен в корзину!"
        ]);
    }

    public function delete_product ($order_id, $product_id){
        
        $order = Order::where('id', $order_id)->get();
        $order = $order->first();
        
        DB::table('order_product')->where('order_id', $order_id)
                                  ->where('product_id', $product_id)
                                  ->take(1)
                                  ->delete();

        $order->sum -= Product::find($product_id)->cost;
        $order->save();

        return $this->successResponse([
            'message' => "Товар успешно удалён из корзины!"
        ]);
    }

    public function pay ($employee_id, $order_id) {
        $order = Order::where('id', $order_id)->get()->first();

        $products = $order->products;
        $grouped_products = $this->group_products($products);

        $employee = Employee::where('id', $employee_id)->get()->first();
        
        foreach($grouped_products as $product) {
            $product_model = Product::where('id', $product['id'])->get()->first();
            if ($product['count'] > $product_model->count) {
                return $this->successResponse([
                    'message' => "Ошибка оплаты. Количество покупаемых товаров больше количество товаров на складе."
                ]);
            }
            else{
                $product_model->count -= $product['count'];
                $product_model->save();
            }
        }
        if ($order->sum > $employee->cookies_num) {
            return $this->successResponse([
                'message' => "Ошибка оплаты. Недостаточно пряней на счету."
            ]);
        }
        else {
            $order->paid_at = date("Y-m-d H:i:s");
            $employee->cookies_num -= $order->sum;
            $employee->save();
            $order->receipt_code = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 6);

            $order->save();
                        
            return $this->successResponse([
                'message' => "Заказ успешно оплачен!",
                'order_id' => $order->id,
            ]);
        }
    }

    public function getOrderPdf(Request $request) 
    {
        $order = Order::find($request->get('order_id'));

        $products = $order->products;
        $grouped_products = $this->group_products($products);

        return PDF::loadView('receipt_templates/receipt', ['order' => $order, 'products' => $grouped_products])->stream();
    }
}
