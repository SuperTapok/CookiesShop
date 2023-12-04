@extends('layouts/layout')
@section('body')
<div class="row py-3">
    <h1>Управление наградными действиями</h1>
</div>
<div class="row">
    <div class="col-8 offset-2">
        <div class="card p-3 bg-light">
            <table class="table">
                @foreach ($activities as $activity)
                <tr>
                    <td>{{ $activity->name }}</td>
                    <td><button class="del_btn btn btn-danger"
                        data-route="{{ route('delete_activity', ['id' => $activity->id]) }}">Удалить действие</button></td>
                        <td><a class="btn btn-primary" href="{{ route('edit_activity', ['id' => $activity->id]) }}">Изменить действие</a></td>
                </tr>
                @endforeach
            </table>
        </div>
        <a href="{{ route('add_activity') }}">Добавить действие</a>
    </div>
</div>
</div>
<script src="{{ asset('js/manage.js') }} "></script>
@endsection
