<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class FavouritesController extends Controller
{
    public function index(Request $request){
        $products = Product::whereHas('employees', function($q) use ($request){
            $q->where('employee_id', $request->user()->employee_id);
        })->get();

        return view('favourites', ['products' => $products]);
    }
}
