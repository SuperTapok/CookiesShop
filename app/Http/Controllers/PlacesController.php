<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;

class PlacesController extends Controller
{
    public $name = [
        'plural' => 'местами',
        'singular' => 'место'
    ];

    public function index () {
        $places = Place::all();

        foreach ($places as $place) {
            $place['name'] = $place['address']; 
            unset( $place['address'] );
        }

        $routes = [
            'route_delete' => 'delete_place',
            'route_edit' => 'edit_place',
            'route_add' => 'add_place'
        ];

        return view('simple_managing_form', ['elements' => $places->toArray(), 'name' => $this->name, 'routes' => $routes]);
    }

    public function add_place () {
        $routes = [
            'route_add' => 'add_place_api'
        ];

        return view('simple_adding_form', ['name' => $this->name, 'routes' => $routes]);
    }

    public function add_place_api (Request $request) {
        $input = $request->all();

        $place = new Place();

        $place->address =  $input['name'];

        $place->save();

        return redirect()->back();

    }

    public function edit_place ($id) {
        $place = Place::find($id);

        $routes = [
            'route_edit' => 'edit_place_api'
        ];

        return view('simple_editing_form', ['id' => $place->id, 'data' => $place->address, 
                                            'name' => $this->name, 'routes' => $routes]);
    }

    public function edit_place_api (Request $request) {
        $input = $request->all();

        $place = Place::find($input['id']);

        $place->address =  $input['name'];

        $place->save();

        return redirect()->back();

    }

    public function delete_place ($id) {
        $place = Place::find($id);
        
        $place->delete();

        return $this->successResponse([
            'message' => "Место удалено."
        ]);
    }
}
