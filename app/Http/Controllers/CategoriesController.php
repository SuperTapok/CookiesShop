<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public $name = [
        'plural' => 'категориями',
        'singular' => 'категорию'
    ];

    public function index () {
        $categories = Category::all();

        $routes = [
            'route_delete' => 'delete_category',
            'route_edit' => 'edit_category',
            'route_add' => 'add_category'
        ];

        return view('simple_managing_form', ['elements' => $categories->toArray(), 'name' => $this->name, 'routes' => $routes]);
    }

    public function add_category () {
        $routes = [
            'route_add' => 'add_category_api'
        ];

        return view('simple_adding_form', ['name' => $this->name, 'routes' => $routes]);
    }

    public function add_category_api (Request $request) {
        $input = $request->all();

        $category = new Category();

        $category->name =  $input['name'];

        $category->save();

        return redirect()->back();

    }

    public function edit_category ($id) {
        $category = Category::find($id);

        $routes = [
            'route_edit' => 'edit_category_api'
        ];

        return view('simple_editing_form', ['id' => $category->id, 'data' => $category->name, 
                                            'name' => $this->name, 'routes' => $routes]);
    }

    public function edit_category_api (Request $request) {
        $input = $request->all();

        $category = Category::find($input['id']);

        $category->name =  $input['name'];

        $category->save();

        return redirect()->back();

    }

    public function delete_category ($id) {
        $category = Category::find($id);
        
        $category->delete();

        return $this->successResponse([
            'message' => "Категория удалена."
        ]);
    }
}
