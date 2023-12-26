@extends('layouts/layout')
@section('body')

@include('templates.modal_alert')

@include('templates.modal_confirm')

    @if ($products)
        <div class="row py-4">
            <div class="col-7 offset-1">
                @foreach ($products as $product)
                <div class="card mb-3">
                    <div class="row g-0">
                    <div class="col-md-4">
                        @if ($product['images']->count() == 0)
                            <img src="/storage/images/system/Нет изображения.png" class="card-img-top">
                        @elseif ($product['images']->count() == 1)
                            <img src="{{ $product['images']->first()->url }}" class="card-img-top">
                        @else
                            <div id="carousel{{ $product['id'] }}" class="carousel slide" data-bs-theme="dark">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carousel{{ $product['id'] }}" data-bs-slide-to="0"
                                            class="active" aria-current="true"></button>
                                    @for ($i = 1; $i < $product['images']->count(); $i++)
                                        <button type="button" data-bs-target="#carousel{{ $product['id'] }}" data-bs-slide-to="{{ $i }}"></button>
                                    @endfor
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset($product['images'][0]->url) }}" class="d-block w-100">
                                    </div>
                                    @for ($i = 1; $i < $product['images']->count(); $i++)
                                        <div class="carousel-item">
                                            <img src="{{ asset($product['images'][$i]->url) }}" class="d-block w-100">
                                        </div>
                                    @endfor
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $product['id'] }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Предыдущий</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $product['id'] }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Следующий</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('detail', ['product_id' => $product['id']]) }}">{{ $product['name'] }}</a></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h5>{{ $product['cost'] }} пр.</h5></li>
                            <li class="list-group-item">{{ $product['count'] }} шт.</li>
                        </ul>
                        <div class="card-footer">
                            <button class="del_from_cart_btn btn btn-danger" 
                            data-bs-toggle="modal" 
                            data-bs-target="#alertModal"
                            data-order="{{ $order->id }}" 
                            data-product="{{ $product['id'] }}">Удалить из корзины</button>
                        </div>
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-3">
                <div class="vstack gap-3">
                    <h5>Пряней на счету: {{ request()->user()->employee->cookies_num }}</h5>
                    <h5>Сумма заказа: {{ $order->sum }} пр.</h5>
                    <button class="pay_btn btn btn-primary" style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);"
                        data-bs-toggle="modal" 
                        data-bs-target="#confirmModal"
                        data-employee="{{ request()->user()->employee_id }}" 
                        data-order="{{ $order->id }}">Оплатить заказ</button>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/cart.js') }} "></script>
    @else
    <div class="row text-center py-5">
        <div class="col-6 offset-3">
            <h1>Корзина пуста!</h1>
        </div>
    </div>
    @endif    
</div>
@endsection