<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title>Cookies Shop</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg" data-bs-theme="dark" style="background-color: rgb(255, 100, 0)">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('catalog') }}" aria-current="true">
                        <img src="/storage/images/system/лого.png" alt="CookiesShop" width="30" height="30" class="d-inline-block align-text-center">
                        Cookies.Shop
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Переключатель навигации">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-evenly" id="navbarText">
                        @if (request()->user()->user_type->name != 'User')
                            @if (request()->user()->user_type->name == 'Moderator')
                                <a href="{{ route('orders') }}" class="btn btn-light navbar-btn">Выдать заказ</a>
                                <a href="{{ route('add_product') }}" class="btn btn-light navbar-btn">Добавить товар</a>
                            @endif
                            @if (request()->user()->user_type->name == 'Manager')
                                <a href="{{ route('reward_employee') }}" class="btn btn-light navbar-btn">Начислить пряни</a>
                            @endif
                            @if (request()->user()->user_type->name == 'Admin')
                                <a href="{{ route('orders') }}" class="btn btn-light navbar-btn">Выдать заказ</a>
                                <a href="{{ route('add_product') }}" class="btn btn-light navbar-btn">Добавить товар</a>
                                <a href="{{ route('reward_employee') }}" class="btn btn-light navbar-btn">Начислить пряни</a>
                            @endif   
                        @endif
                    </div>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarText">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart') }}">
                                    <img src="/storage/images/system/cart.png" alt="CookiesShop" width="30" height="30" class="d-inline-block align-text-center">
                                        Корзина
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile') }}">
                                    <img src="/storage/images/system/profile.png" alt="CookiesShop" width="30" height="30" class="d-inline-block align-text-center">
                                        {{ request()->user()->name }}
                                </a>
                            </li>
                        </ul>
                    </div>                
                </div>
            </nav>
        </div>
        <div class="container">
            @yield('navbar')
            @yield('body')
        </div>
        <footer class="d-flex mt-auto flex-wrap justify-content-between align-items-center py-2 border-top">
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <p class="text-body-secondary">© Пуховский Сергей Александрович, 2023 </p>
                    </div>
                    <div class="col-1 offset-6">
                        <a href="{{ route('catalog') }}" class="nav-link px-2 text-body-secondary">CookiesShop</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
