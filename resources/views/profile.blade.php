@extends('layouts/layout')
@section('body')
<div class="row py-4">
    <div class="col-1 offset-11">
        <a href="{{ route("logout") }}" class="btn btn-danger">Выйти</a>
    </div>
    
    <h1>Здравствуйте, {{ request()->user()->employee->surname }} 
        {{ request()->user()->employee->name }} 
        {{ request()->user()->employee->middle_name }}!</h1>
    <p>{{ request()->user()->employee->position->company->name }}, {{ request()->user()->employee->position->name }}</p>
    <h2>Количество пряней на счету: {{ request()->user()->employee->cookies_num }}</h2>
    <a href="{{ route("transactions") }}">Посмотреть историю транзакций</a>
</div>
</div>
@endsection