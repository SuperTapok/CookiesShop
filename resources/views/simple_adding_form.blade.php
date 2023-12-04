@extends('layouts/layout')
@section('body')
<div class="row py-3">
    <h1>Добавить {{ $name['singular'] }}</h1>
</div>
<div class="row">
    <div class="col-4 offset-4">
        <form action="{{ route($routes['route_add']) }}" class="card p-3 bg-light" method="POST">
            @csrf
            <div class="mb-3 row">
                <label for="name" class="col col-form-label">Название</label>
                <div class="col">
                    <input type="text" name="name" id="name" placeholder="Название..." class="form-control"/>
                </div>
                
            </div>
            <div class="text-center">       
                <button class="btn btn-primary" style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);">Добавить {{ $name['singular'] }}</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
