@extends('layouts/layout')
@section('body')

@include('templates.modal_alert')

<div class="row py-3">
    <div class="col offset-1">
        <h2>Редактирование товара</h2>
    </div>
</div>
<div class="row py-4">
    <div class="col-6 offset-3">
        <form class="card p-3 bg-light" id="form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">

            <div class="mb-3 row">
                <label for="name" class="col col-form-label">Название</label>
                <div class="col">
                    <input type="text" name="name" id="name" placeholder="Название..."
                    class="form-control" value="{{ $product->name }}" required/>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="cost" class="col col-form-label">Цена</label>
                <div class="col">
                    <input type="number" name="cost" id="cost" class="form-control" value="{{ $product->cost }}" required/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="count" class="col col-form-label">Количество на складе</label>
                <div class="col">
                    <input type="number" name="count" id="count" class="form-control" value="{{ $product->count }}" required/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="description" class="col col-form-label">Описание</label>
                <div class="col">
                    <textarea id="description" name="description" 
                    class="form-control" placeholder="Описание...">{{ $product->description }}</textarea>
                </div>
            </div>
            <div class="form-check">
                @if ($product->is_available)
                <input class="form-check-input" name="is_available" type="checkbox" id="is_available" checked>
                @else
                <input class="form-check-input" name="is_available" type="checkbox" id="is_available">
                @endif
                <label class="form-check-label" for="is_available">
                    Показывать на сайте?
                </label>
            </div>
            @if ($product->typeable_type == 'App\Models\Course')
                <div class="mb-3 row">
                    <label for="url" class="col col-form-label">Ссылка на курс</label>
                    <div class="col">
                        <input type="url" name="url" id="url" class="form-control" value="{{ $product->typeable->url }}" required/>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="start_date" class="col col-form-label">Дата начала</label>
                    <div class="col">
                        <input type="date" name="start_date" id="start_date" class="form-control" 
                        value="{{ $product->typeable->start_date }}" required/>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="end_date" class="col col-form-label">Дата окончания</label>
                    <div class="col">
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $product->typeable->end_date }}" required/>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="provider" class="col col-form-label">Поставщик курса</label>
                    <div class="col">
                    <select name="provider" id="provider" class="form-control" required>                
                        @foreach ($providers as $provider)
                            @if ($product->typeable->provider == $provider)
                                <option value="{{ $provider->id }}" selected>{{ $provider->name }}</option>
                            @else
                                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>
                    <a href="{{ route('manage_providers') }}">Управлять поставщиками</a>
                </div>

                <div class="mb-3 row">
                    <label for="themes[]" class="col col-form-label">Темы курса</label>
                    <div class="col">
                        <select name="themes[]" id="themes" class="form-control" required multiple>
                        @foreach ($themes as $theme)
                            @if ($product->typeable->themes()->get()->first(function($item) use ($theme) {
                                    return $item->id == $theme->id;})
                                != null)
                                <option value="{{ $theme->id }}" selected>{{ $theme->name }}</option>
                            @else
                                <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                    <a href="{{ route('manage_themes') }}">Управлять темами</a>
                </div>
            @elseif($product->typeable_type == 'App\Models\Item')
                <div class="mb-3 row">
                    <label for="place" class="col col-form-label">Место расположения предмета</label>
                    <div class="col">
                        <select name="place" id="place" class="form-control" required>                
                            @foreach ($places as $place)
                                @if ($product->typeable->place == $place)
                                    <option value="{{ $place->id }}" selected>{{ $place->address }}</option>
                                @else
                                    <option value="{{ $place->id }}">{{ $place->address }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <a href="{{ route('manage_places') }}">Управлять местами</a>
                </div>
                
                <div class="mb-3 row">
                    <label for="category" class="col col-form-label">Категория предмета </label>
                    <div class="col">
                        <select name="category" id="category" class="form-control" required>                
                            @foreach ($categories as $category)
                                @if ($product->typeable->category == $category)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                                
                            @endforeach
                        </select>
                    </div>
                    <a href="{{ route('manage_categories') }}">Управлять категориями</a>
                </div>
            @endif        

            <div class="mb-3 row">
                <label for="image_select" class="col col-form-label">Выбрать изображения</label>
                <div class="col">
                    <select name="image_select[]" id="image_select" style="width:300px; height:300px" multiple>
                        @foreach ($images as $image)
                            @if ($product->images()->get()->first(function($item) use ($image) {
                                    return $item->id == $image->id;})
                                != null)
                                <option data-url="{{ asset($image->url) }}" value="{{ $image->id }}" selected>{{ $image->id }}</option>
                            @else
                                <option data-url="{{ asset($image->url) }}" value="{{ $image->id }}">{{ $image->id }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <script>
                    $(document).ready(function(){
                        $("#image_select").select2({
                            templateResult: function (url) {
                                var $span = $("<span><img src='" + $(url.element).attr("data-url") + "' style='width:100px'/></span>");
                                return $span;
                            },
                            templateSelection: function (url) {
                                var $span = $("<span><img src='" + $(url.element).attr("data-url") + "' style='width:100px'/></span>");
                                return $span;
                            }                    
                        });
                    });
                    
                </script>
                
            </div>
            <div class="mb-3">
                <label for="images[]" class="col col-form-label">Загрузить новые изображения</label>
                <div class="col">
                    <input type="file" name="images[]" class="form-control" multiple/>
                </div>
            </div>
            <div class="text-center">
                <button  type="submit" class="btn btn-primary"
                id="addProduct"
                data-bs-toggle="modal"
                data-bs-target="#alertModal" style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);">Изменить товар</button>
            </div>
        </form>
    </div>
</div>
</div>
<script src="{{asset('js/product/edit.js')}} "></script>
@endsection