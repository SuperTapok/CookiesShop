@extends('layouts/layout')
@section('body')

@include('templates.modal_alert')

<div class="row py-4">
    <div class="col offset-1">
        <h2>Добавление товара</h2>
    </div>
</div>
<div class="row py-4">
    <div class="col-6 offset-3">
        <form id="form" class="card p-3 bg-light" enctype="multipart/form-data">
            @csrf
        
            <div class="mb-3 row">
                <label for="name" class="col col-form-label">Название</label>
                <div class="col">
                    <input type="text" name="name" id="name" placeholder="Название..."
                    class="form-control" required/>
                </div>
            </div>
        
            <div class="mb-3 row">
                <label for="cost" class="col col-form-label">Цена</label>
                <div class="col">
                    <input type="number" name="cost" id="cost" class="form-control" required/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="count" class="col col-form-label">Количество на складе</label>
                <div class="col">
                    <input type="number" name="count" id="count" class="form-control" required/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="description" class="col col-form-label">Описание</label>
                <div class="col">
                    <textarea id="description" name="description" 
                    class="form-control" placeholder="Описание..." required></textarea>
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_available" id="is_available" checked>
                <label class="form-check-label" for="is_available">Показывать на сайте?</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="type" role="switch" id="type" 
                data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-controls="collapseExample">
                <label class="form-check-label" for="type">Курс/Предмет</label>
            </div>
            <div class="collapse show" id="collapseExample">
                <div class="mb-3 row">
                    <label for="url" class="col col-form-label">Ссылка на курс</label>
                    <div class="col">
                        <input type="url" name="url" id="url" class="form-control"/>
                    </div>
                </div>
        
                <div class="mb-3 row">
                    <label for="start_date" class="col col-form-label">Дата начала</label>
                    <div class="col">
                        <input type="date" name="start_date" id="start_date" class="form-control"/>
                    </div>
                </div>
        
                <div class="mb-3 row">
                    <label for="end_date" class="col col-form-label">Дата окончания</label>
                    <div class="col">
                        <input type="date" name="end_date" id="end_date" class="form-control"/>
                    </div>
                </div>
        
                <div class="mb-3 row">
                    <label for="provider" class="col col-form-label">Поставщик курса</label>
                    <div class="col">
                    <select name="provider" id="provider" class="form-control">                
                        @foreach ($providers as $provider)
                            <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <a href="{{ route('manage_providers') }}">Управлять поставщиками</a>
                </div>
        
                <div class="mb-3 row">
                    <label for="themes[]" class="col col-form-label">Темы курса</label>
                    <div class="col">
                        <select name="themes[]" id="themes" class="form-control" multiple>
                        @foreach ($themes as $theme)
                            <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <a href="{{ route('manage_themes') }}">Управлять темами</a>
                </div>
            </div>
            <div class="collapse" id="collapseExample">
                <div class="mb-3 row">
                    <label for="place" class="col col-form-label">Место расположения предмета</label>
                    <div class="col">
                        <select name="place" id="place" class="form-control">                
                            @foreach ($places as $place)
                                <option value="{{ $place->id }}">{{ $place->address }}</option>
                            @endforeach
                        </select>
                    </div>
                    <a href="{{ route('manage_places') }}">Управлять местами</a>
                </div>
                
                <div class="mb-3 row">
                    <label for="category" class="col col-form-label">Категория предмета </label>
                    <div class="col">
                        <select name="category" id="category" class="form-control">                
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option> 
                            @endforeach
                        </select>
                    </div>
                    <a href="{{ route('manage_categories') }}">Управлять категориями</a>
                </div>  
            </div>
        
            <div class="mb-3 row">
                <label for="image_select" class="col col-form-label">Выбрать изображения</label>
                <div class="col">
                    <select name="image_select[]" id="image_select" style="width:300px; height:300px" multiple>
                        @foreach ($images as $image)
                            <option data-url="{{ asset($image->url) }}" value="{{ $image->id }}">{{ $image->id }}</option>
                        @endforeach
                    </select>
                </div>
                <script>
                    $(document).ready(function(){
                        $("#image_select").select2({
                            width: '300px',
                            height: '300px',
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
                    data-bs-target="#alertModal"
                    style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);">Добавить товар</button>
            </div>
        </form>
    </div>
</div>
</div>
<script src="{{asset('js/add_product.js')}} "></script>
@endsection