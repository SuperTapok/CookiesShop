@extends('layouts/layout')
@section('body')

@include('templates.modal_alert')
@include('templates.modal_confirm')


<div class="row py-3">
    <h1>Управление {{ $name['plural'] }}</h1>
</div>
<div class="row">
    <div class="col-8 offset-2">
        <div class="card p-3 bg-light">
            <table class="table">
                @foreach ($elements as $element)
                <tr>
                    <td>{{ $element['name'] }}</td>
                    <td>
                        <button class="del_btn btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#confirmModal"
                        data-route="{{ route($routes['route_delete'], ['id' => $element['id']]) }}">Удалить {{ $name['singular'] }}</button>
                    </td>
                    <td>
                        <a href="{{ route($routes['route_edit'], ['id' => $element['id']]) }}" class="btn btn-primary">Изменить {{ $name['singular'] }}</a>
                    </td>
                </tr>
                @endforeach
            </table>
            <a href="{{ route($routes['route_add']) }}">Добавить {{ $name['singular'] }}</a>
        </div>
    </div>
    
</div>
</div>
<script src="{{ asset('js/delete_smf.js') }} "></script>
@endsection
