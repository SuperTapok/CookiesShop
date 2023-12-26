@extends('layouts/layout')

@section('navbar')
<div class="row py-3">
    <div class="col-1">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Товары
              </button>
            <ul class="dropdown-menu">
                @foreach ($categories as $category)
                    <li><a class="dropdown-item" href="{{ route('category', ['category_name' => $category->name]) }}">{{ $category->name }}</a></li>
                @endforeach
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('category') }}">Товары</a></li>
            </ul>
        </div>
    </div>
    <div class="col-1" >
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Курсы
              </button>
            <ul class="dropdown-menu">
                @foreach ($themes as $theme)
                    <li><a class="dropdown-item" href="{{ route('theme', ['theme_name' => $theme->name]) }}">{{ $theme->name }}</a></li>
                @endforeach
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('theme') }}">Курсы</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('body')

@include('templates.modal_alert')

@include('templates.modal_confirm')

<div class="row py-4">
    <h1>{{ $product->name }}</h1>
    <div class="col-6 offset-1">
        @if ($product->images->count() == 0)
            <div style="height: 450px" class="d-flex align-items-center">
                <img src="/storage/images/system/Нет изображения.png" style="object-fit: contain; height:80%; width:100%" class="card-img-top">
            </div>    
        @elseif ($product->images->count() == 1)
            <div style="height: 450px;" class="d-flex align-items-center">
                <img src="{{ $product->images->first()->url }}" style="object-fit: contain; height:80%; width:100%" class="card-img-top">
            </div>          
        @else
            <div id="carousel{{ $product->id }}" class="carousel slide" data-bs-theme="dark" style="height:450px;">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carousel{{ $product['id'] }}" data-bs-slide-to="0"
                            class="active" aria-current="true"></button>
                    @for ($i = 1; $i < $product['images']->count(); $i++)
                        <button type="button" data-bs-target="#carousel{{ $product['id'] }}" data-bs-slide-to="{{ $i }}"></button>
                    @endfor
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset($product['images'][0]->url) }}" style="object-fit: contain; height:420px; width:100%">
                    </div>
                    @for ($i = 1; $i < $product['images']->count(); $i++)
                        <div class="carousel-item">
                            <img src="{{ asset($product['images'][$i]->url) }}" style="object-fit: contain; height:420px; width:100%">
                        </div>
                    @endfor
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $product->id }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Предыдущий</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $product->id }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Следующий</span>
                </button>
            </div>
        @endif
    </div>
    <div class="col-4">
        <div class="vstack gap-3">
            @if (request()->user()->user_type->name == 'Admin' or 
                request()->user()->user_type->name == 'Moderator')
                    <div class="btn-group" role="group">
                        <a href="{{ route('edit_product', ['product_id' => $product->id]) }}" class="btn btn-primary">Изменить</a> 
                        <button type="button" class="del_product_btn btn btn-danger" 
                                            data-product="{{ $product->id }}"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#confirmModal">Удалить</button>
                        <button type="button" class="changeVisibility btn btn-secondary" id="changeVisibility" data-product="{{ $product->id }}">
                            <img src="/storage/images/system/show.png" alt="CookiesShop" width="25" height="25" class="d-inline-block align-text-top">
                        </button>
                    </div>
            @endif
            <div class="card p-3 {!! !$product->is_available ? "text-light\" style=\"background-color: rgb(96, 96, 96);" : "" !!}">
                <h1>{{ $product->cost }} пр.</h1>
                <h2>{{ $product->count }} шт.</h2>
                <p>{{ $product->description }}</p>
                @if ($product->typeable_type == 'App\Models\Item')
                    <p><b>Категория</b> - <a class="link-{{ !$product->is_available ? "light" : "primary" }}" href="{{ route('category', ['category_name' => $product->typeable->category->name]) }}">
                        {{ $product->typeable->category->name }}</a></p>
                    
                    <p><b>Где можно посмотреть?</b> - {{ $product->typeable->place->address }}</p>   
                @else
                    <p><a class="link-{{ !$product->is_available ? "light" : "primary" }}" href="{{ $product->typeable->url }}">Ссылка на курс</a></p>
                    <p><b>Дата начала</b> - {{ date('d.m.Y', strtotime($product->typeable->start_date)) }}</p>
                    <p><b>Дата окончания</b> - {{ date('d.m.Y', strtotime($product->typeable->end_date)) }}</p>
                    <p><b>Компания-поставщик</b> - {{ $product->typeable->provider->name }}</p>
                    <p><b>Темы курса:</b></p>
                    <ul>
                        @foreach ($product->typeable->themes as $theme)
                            <li><a class="link-primary" href="{{ route('theme', ['theme_name' => $theme->name]) }}">{{ $theme->name }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="text-center">
                <button class="add_to_cart_btn btn btn-primary" style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);" 
                        data-employee="{{ request()->user()->employee_id }}" 
                        data-bs-toggle="modal" 
                        data-bs-target="#alertModal"    
                        data-product="{{ $product->id }}">Добавить в корзину</button>
            </div>            
        </div>
    </div>
</div>
</div>
<script src="{{asset('js/product/catalog.js')}} "></script>
<script src="{{asset('js/product/delete.js')}} "></script>
@endsection
