<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;

class ProvidersController extends Controller
{
    public $name = [
        'plural' => 'поставщиками',
        'singular' => 'поставщика'
    ];

    public function index () {
        $providers = Provider::all();

        $routes = [
            'route_delete' => 'delete_provider',
            'route_edit' => 'edit_provider',
            'route_add' => 'add_provider'
        ];

        return view('simple_managing_form', ['elements' => $providers->toArray(), 'name' => $this->name, 'routes' => $routes]);
    }

    public function add_provider () {
        $routes = [
            'route_add' => 'add_provider_api'
        ];

        return view('simple_adding_form', ['name' => $this->name, 'routes' => $routes]);
    }

    public function add_provider_api (Request $request) {
        $input = $request->all();

        $provider = new Provider();

        $provider->name =  $input['name'];

        $provider->save();

        return redirect()->back();

    }

    public function edit_provider ($id) {
        $provider = Provider::find($id);

        $routes = [
            'route_edit' => 'edit_provider_api'
        ];

        return view('simple_editing_form', ['id' => $provider->id, 'data' => $provider->name, 
        'name' => $this->name, 'routes' => $routes]);
    }

    public function edit_provider_api (Request $request) {
        $input = $request->all();

        $provider = Provider::find($input['id']);

        $provider->name =  $input['name'];

        $provider->save();

        return redirect()->back();

    }

    public function delete_provider ($id) {
        $provider = Provider::find($id);
        
        $provider->delete();

        return $this->successResponse([
            'message' => "Поставщик удалён."
        ]);
    }
}
