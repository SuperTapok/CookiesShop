<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Item;
use App\Models\Product;
use App\Models\Theme;
use App\Models\Provider;
use App\Models\Place;
use App\Models\Image;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    private function get_available_categories() {
        return Category::whereHas("items", function($query) {
            $query->whereHas("product", function($query) {
                $query->where('is_available', true);
            });
        })->get();
    }
    
    private function get_available_themes() {
        return Theme::whereHas("courses", function($query) {
            $query->whereHas("product", function($query) {
                $query->where('is_available', true);
            });
        })->get();
    }

    public function get_favourite_list($user) {
        $rows = DB::table('favourite')->where('employee_id', $user->employee_id)
                                      ->get();

        $favourites = [];
        foreach ($rows as $favourite) {
            array_push($favourites, $favourite->product_id);
        }
        return $favourites;
    }

    public function index(Request $request) {
        $products = Product::all();

        return view('catalog', ['products' => $products, 'categories' => $this->get_available_categories(), 
        'themes' => $this->get_available_themes(), 'favourite_list' => $this->get_favourite_list($request->user())]);
    }

    public function category ($category_name='basic') {
        if ($category_name == 'basic') {
            $products = Product::hasMorph('typeable', Item::class);
        } 
        else{
            $products = Product::whereHasMorph(
                'typeable', Item::class,
                function (Builder $query) use ($category_name){
                    $query->whereRelation('category', 'name', $category_name);
                }
            );
        }

        $products = $products->get();

        return view('catalog', ['products' => $products, 'categories' => $this->get_available_categories(), 
        'themes' => $this->get_available_themes()]);
    }

    public function theme ($theme_name='basic') {
        if ($theme_name == 'basic') {
            $products = Product::hasMorph('typeable', Course::class);
        } 
        else{
            $products = Product::whereHasMorph('typeable', Course::class,
                function (Builder $query) use ($theme_name) {
                    $query->whereRelation('themes', 'name', $theme_name);
                }
            );
        }
        
        $products = $products->get();

        return view('catalog', ['products' => $products, 'categories' => $this->get_available_categories(), 
        'themes' => $this->get_available_themes()]);
    }

    public function detail ($product_id) {
        $product = Product::find($product_id);

        return view('detail', ['product' => $product, 'categories' => $this->get_available_categories(), 
        'themes' => $this->get_available_themes()]);
    }

    public function hide_product ($product_id) {
        $product = Product::find($product_id);
        $product->is_available = !$product->is_available;
        $product->save();

        return $this->successResponse([
            'message' => "Видимость товара изменена"
        ]);
    }
    
    public function delete_product ($product_id) {
        $product = Product::find($product_id);
        $product->delete();

        return $this->successResponse([
            'message' => "Товар удалён."
        ]);
    }

    public function add_product () {
        $providers = Provider::all();
        $themes = Theme::all();
        $places = Place::all();
        $categories = Category::all();
        $images = Image::all();

        return view('add_product', ['providers' => $providers, 'themes'=> $themes, 'places' => $places, 
        'categories' => $categories, 'images' => $images]);
    }

    public function add_product_api (Request $request) {
        $input = $request->all();
        
        $product = new Product();
        $product->name = $input['name'];
        $product->cost = $input['cost'];
        $product->count = $input['count'];
        $product->description = $input['description'];

        if (isset($input['is_available'])) {
            $product->is_available = $input['is_available'] == 'on' ? true : false;
        }
        else{
            $product->is_available = false;
        }

        if (!isset($input['type'])) {
            $course = new Course();
            $course->url = $input['url'];
            $course->start_date = $input['start_date'];
            $course->end_date = $input['end_date'];
            
            $course->provider()->associate(Provider::find($input['provider']));

            $themes_keys = array_filter(array_keys($input), function ($value){
                return str_contains($value, 'theme_');
            });
            
            foreach($themes_keys as $theme) {
                if ($input[$theme] == 'on'){
                    $course->themes()->attach(Theme::find((int)explode("_", $theme)[1]));
                }                
            }

            $course->save();
            $course->refresh();

            $product->typeable()->associate($course);            

        }
        else {
            $item = new Item();
            $item->place()->associate(Place::find($input['place']));
            $item->category()->associate(Category::find($input['category']));

            $item->save();
            $item->refresh();

            $product->typeable()->associate($item);
        } 

        $product->save();
        $product->refresh();

        if (isset($input['image_select'])){
            $product->images()->sync($input['image_select']);
        }
        if (isset($input['images'])){
            foreach ($input['images'] as $image) {
                $imageModel = new Image();
                $imageModel->url = Storage::url($image->store('public/images'));
                $imageModel->save();
                $imageModel->refresh();
                $product->images()->attach($imageModel);
            }
        }

        return $this->successResponse([
            'message' => "Товар успешно добавлен!"
        ]);
    }


    public function edit_product ($id) {
        $product = Product::find($id);

        $providers = Provider::all();
        $themes = Theme::all();
        $places = Place::all();
        $categories = Category::all();
        $images = Image::all();

        return view('edit_product', ['product' => $product,'providers' => $providers, 
        'themes'=> $themes, 'places' => $places, 
        'categories' => $categories, 'images' => $images]);
    }

    public function edit_product_api (Request $request) {
        $input = $request->all();
        
        $product = Product::find($input['id']);
        $product->name = $input['name'];
        $product->cost = $input['cost'];
        $product->count = $input['count'];
        $product->description = $input['description'];
        if (isset($input['is_available'])) {
            $product->is_available = $input['is_available'] == 'on' ? true : false;
        }
        else{
            $product->is_available = false;
        }

        if ($product->typeable_type == 'App\Models\Course') {
            $course = Course::find($product->typeable_id);
            $course->url = $input['url'];
            $course->start_date = $input['start_date'];
            $course->end_date = $input['end_date'];
            
            $course->provider()->associate(Provider::find($input['provider']));

            $themes_keys = array_filter(array_keys($input), function ($value){
                return str_contains($value, 'theme_');
            });
            
            foreach($themes_keys as $theme) {
                if ($input[$theme] == 'on'){
                    $course->themes()->attach(Theme::find((int)explode("_", $theme)[1]));
                }                
            }

            $course->save();
            $course->refresh();          

        }
        else if ($product->typeable_type == 'App\Models\Item'){
            $item = Item::find($product->typeable_id);
            $item->place()->associate(Place::find($input['place']));
            $item->category()->associate(Category::find($input['category']));

            $item->save();
            $item->refresh();
        } 

        $product->save();
        $product->refresh();

        if (isset($input['image_select'])){
            $product->images()->sync($input['image_select']);
        }
        else {
            $product->images()->delete();
        }
        if (isset($input['images'])){
            foreach ($input['images'] as $image) {
                $imageModel = new Image();
                $imageModel->url = Storage::url($image->store('public/images'));
                $imageModel->save();
                $imageModel->refresh();
                $product->images()->attach($imageModel);
            }
        }

        return $this->successResponse([
            'message' => "Товар успешно изменён!"
        ]);
    }

    public function add_to_favourite_api($employee_id, $product_id) {
        DB::table('favourite')->insert(['employee_id' => $employee_id, 'product_id' => $product_id]);

        return  $this->successResponse([
            'message' => "Товар добавлен в избранное"
        ]);
    }

    public function delete_from_favourite_api($employee_id, $product_id) {
        DB::table('favourite')->where('product_id', $product_id)
                              ->where('employee_id', $employee_id)
                              ->take(1)
                              ->delete();

        return  $this->successResponse([
            'message' => "Товар удалён из избранного"
        ]);
    }
}
