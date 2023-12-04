@extends('layouts/layout')
@section('body')
<div class="row py-3">
    <h1>Редактирование наградного действия</h1>
</div>
<div class="row">
    <div class="col-4 offset-4">
        <form action="{{ route('edit_activity_api') }}" class="card p-3 bg-light" method="POST">
            @csrf
            <div class="mb-3 row">
                <label for="name" class="col col-form-label">Название</label>
                <div class="col">
                    <input type="text" id='name' name="name" placeholder="Название..." class="form-control"
                    value="{{ $activity->name }}"/>
                </div>
                <input type="hidden" name="id" value="{{ $activity->id }}">              
            </div>
            <div class="mb-3 row">
                <label for="cookies" class="col col-form-label">Количество пряней</label>
                <div class="col">
                    <input type="number" id='cookies' name="cookies" class="form-control" value="{{ $activity->cookies }}"/>
                </div> 
            </div>
            <div class="mb-3 row">
                <label for="description" class="col col-form-label">Описание</label>
                <div class="col">
                    <textarea id='description' name="description" class="form-control">{{ $activity->description }}</textarea>
                </div> 
            </div>
            <div class="text-center">       
                <button class="btn btn-success" style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);">Изменить</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
