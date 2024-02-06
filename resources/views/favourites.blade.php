@extends('layouts/layout')

@section('body')

@include('templates.modal_alert')

@include('templates.modal_confirm')

<div class="row gy-4 py-4">
    @foreach ($products as $product)
        @if ($product->is_available)
            <div class="col-3">
                <div class="card">

                    @if ($product->images->count() == 0)
                        <div style="height: 225px" class="d-flex align-items-center">
                            <img src="/storage/images/system/Нет изображения.png" class="card-img-top" style="object-fit: contain; height:80%; width:100%">
                        </div>
                    @elseif ($product->images->count() == 1)
                        <div style="height: 225px" class="d-flex align-items-center">
                            <img src="{{ $product->images->first()->url }}" class="card-img-top" style="object-fit: contain; height:80%; width:100%">
                        </div>
                    @else
                        <div id="carousel{{ $product->id }}" class="carousel slide carousel-fade" data-bs-theme="dark">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carousel{{ $product['id'] }}" data-bs-slide-to="0"
                                        class="active" aria-current="true"></button>
                                @for ($i = 1; $i < $product['images']->count(); $i++)
                                    <button type="button" data-bs-target="#carousel{{ $product['id'] }}" data-bs-slide-to="{{ $i }}"></button>
                                @endfor
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active" style="height: 225px">
                                    <img src="{{ asset($product['images'][0]->url) }}" style="object-fit: contain; height:80%; width:100%">
                                </div>
                                @for ($i = 1; $i < $product['images']->count(); $i++)
                                    <div class="carousel-item" style="height: 225px">
                                        <img src="{{ asset($product['images'][$i]->url) }}" style="object-fit: contain; height:80%; width:100%">
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
                    <div class="card-body">
                        <ul class="list-group list-group-flush" style="text-align: right; padding:0px; margin:0px -10px 0px 0px">
                            <li class="list-group-item" style="padding:0px; ">
                                <button type="button" class="deleteFromFavourite btn" id="deleteFromFavourite{{ $product->id }}" data-product="{{ $product->id }}" data-employee="{{ request()->user()->employee_id }}" style="padding:5px; ">
                                    <img src="/storage/images/system/yellow star.png" alt="favourite" width="20" height="20" class="d-inline-block align-text-top">
                                </button>    
                            </li>
                        </ul>
                        <h5 class="card-title text-truncate">
                            <a href="{{ route('detail', ['product_id' => $product->id]) }}">{{ $product->name }}</a>
                        </h5>
                        <p class="card-text text-truncate">{{ $product->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><h5>{{ $product->cost }} пр.</h5></li>
                        <li class="list-group-item">{{ $product->count }} шт.</li>
                        @if (request()->user()->user_type->name == 'Admin' or 
                            request()->user()->user_type->name == 'Moderator')
                            <li class="list-group-item text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('edit_product', ['product_id' => $product->id]) }}" class="btn btn-primary">Изменить</a> 
                                    <button type="button" class="del_product_btn btn btn-danger" 
                                            data-product="{{ $product->id }}"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#confirmModal">Удалить</button>
                                    <button type="button" class="changeVisibility btn btn-secondary" id="changeVisibility{{ $product->id }}" data-product="{{ $product->id }}">
                                        <img src="/storage/images/system/show.png" alt="CookiesShop" width="25" height="25" class="d-inline-block align-text-top">
                                    </button>
                                </div>
                            </li>
                        @endif
                    </ul>
                    <div class="card-footer text-center">
                        <button class="add_to_cart_btn btn btn-primary" style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);"
                            data-employee="{{ request()->user()->employee_id }}"
                            data-bs-toggle="modal" 
                            data-bs-target="#alertModal" 
                            data-product="{{ $product->id }}" >Добавить в корзину</button>
                    </div>
                </div>
            </div>
        @elseif(request()->user()->user_type->name == 'Admin' or request()->user()->user_type->name == 'Moderator')
            <div class="col-3">
                <div class="card text-light" style="background-color: rgb(96, 96, 96);">
                    @if ($product->images->count() == 0)
                        <div style="height: 225px" class="d-flex align-items-center">
                            <img src="/storage/images/system/Нет изображения.png" class="card-img-top" style="object-fit: contain; height:80%; width:100%">
                        </div>                    
                    @elseif ($product->images->count() == 1)
                        <div style="height: 225px" class="d-flex align-items-center">
                            <img src="{{ $product->images->first()->url }}" class="card-img-top" style="object-fit: contain; height:80%; width:100%">
                        </div>                    
                    @else
                        <div id="carousel{{ $product->id }}" class="carousel slide carousel-fade" data-bs-theme="dark">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carousel{{ $product['id'] }}" data-bs-slide-to="0"
                                        class="active" aria-current="true"></button>
                                @for ($i = 1; $i < $product['images']->count(); $i++)
                                    <button type="button" data-bs-target="#carousel{{ $product['id'] }}" data-bs-slide-to="{{ $i }}"></button>
                                @endfor
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active" style="height: 225px">
                                    <img src="{{ asset($product['images'][0]->url) }}" style="object-fit: contain; height:80%; width:100%">
                                </div>
                                @for ($i = 1; $i < $product['images']->count(); $i++)
                                    <div class="carousel-item" style="height: 225px">
                                        <img src="{{ asset($product['images'][$i]->url) }}" style="object-fit: contain; height:80%; width:100%">
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
                    <div class="card-body text-light">
                        <ul class="list-group list-group-flush" style="text-align: right; padding:0px; margin:0px -10px 0px 0px">
                            <li class="list-group-item" style="padding:0px; background-color: rgb(96, 96, 96);">
                                <button type="button" class="deleteFromFavourite btn" id="deleteFromFavourite{{ $product->id }}" data-product="{{ $product->id }}" data-employee="{{ request()->user()->employee_id }}" style="padding:5px; ">
                                    <img src="/storage/images/system/yellow star.png" alt="favourite" width="20" height="20" class="d-inline-block align-text-top">
                                </button>    
                            </li>
                        </ul>
                        <h5 class="card-title text-light text-truncate">
                            <a class="link-light" href="{{ route('detail', ['product_id' => $product->id]) }}">{{ $product->name }}</a>
                        </h5>
                        <p class="card-text text-truncate">{{ $product->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush text-light" >
                        <li class="list-group-item text-light" style="background-color: rgb(96, 96, 96);"><h5>{{ $product->cost }} пр.</h5></li>
                        <li class="list-group-item text-light" style="background-color: rgb(96, 96, 96);">{{ $product->count }} шт.</li>
                        <li class="list-group-item text-center" style="background-color: rgb(96, 96, 96);">
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
                        </li>
                    </ul>
                    <div class="card-footer text-center">
                        <button class="add_to_cart_btn btn btn-primary" style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);"
                            data-employee="{{ request()->user()->employee_id }}"
                            data-bs-toggle="modal" 
                            data-bs-target="#alertModal" 
                            data-product="{{ $product->id }}" >Добавить в корзину</button>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
</div>
<script src="{{asset('js/product/catalog.js')}} "></script>
<script src="{{asset('js/product/delete.js')}} "></script>
@endsection
