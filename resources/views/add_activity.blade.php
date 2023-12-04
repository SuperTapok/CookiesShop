@extends('layouts/layout')
@section('body')
<div class="row py-4">
    <div class="col offset-1">
        <h2>Добавление наградного действия</h2>
    </div>
</div>
<div class="row py-4">
    <div class="col-6 offset-3">
        <form action="{{ route('add_activity_api') }}" class="card p-3 bg-light" method="POST">
            @csrf
            <div class="mb-3 row">
                <label for="name" class="col col-form-label">Название</label>
                <div class="col">
                    <input type="text" id='name' name="name" placeholder="Название..." class="form-control"/>
                </div>                
            </div>
            <div class="mb-3 row">
                <label for="cookies" class="col col-form-label">Количество пряней</label>
                <div class="col">
                    <input type="number" id='cookies' name="cookies" class="form-control"/>
                </div> 
            </div>
            <div class="mb-3 row">
                <label for="description" class="col col-form-label">Описание</label>
                <div class="col">
                    <textarea id='description' name="description" class="form-control"></textarea>
                </div> 
            </div>
            <div class="text-center">
                <button class="btn btn-primary" style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);">Добавить</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
