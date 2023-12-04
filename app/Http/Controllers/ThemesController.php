<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;

class ThemesController extends Controller
{
    public $name = [
        'plural' => 'темами',
        'singular' => 'тему'
    ];

    public function index () {
        $themes = Theme::all();

        $routes = [
            'route_delete' => 'delete_theme',
            'route_edit' => 'edit_theme',
            'route_add' => 'add_theme'
        ];

        return view('simple_managing_form', ['elements' => $themes->toArray(), 'name' => $this->name, 'routes' => $routes]);
    }

    public function add_theme () {
        $routes = [
            'route_add' => 'add_theme_api'
        ];

        return view('simple_adding_form', ['name' => $this->name, 'routes' => $routes]);
    }

    public function add_theme_api (Request $request) {
        $input = $request->all();

        $theme = new Theme();

        $theme->name =  $input['name'];

        $theme->save();

        return redirect()->back();

    }

    public function edit_theme ($id) {
        $theme = Theme::find($id);

        $routes = [
            'route_edit' => 'edit_theme_api'
        ];

        return view('simple_editing_form', ['id' => $theme->id, 'data' => $theme->name, 
                                            'name' => $this->name, 'routes' => $routes]);
    }

    public function edit_theme_api (Request $request) {
        $input = $request->all();

        $theme = Theme::find($input['id']);

        $theme->name =  $input['name'];

        $theme->save();

        return redirect()->back();

    }

    public function delete_theme ($id) {
        $theme = Theme::find($id);
        
        $theme->delete();

        return $this->successResponse([
            'message' => "Тема удалена."
        ]);
    }
}
