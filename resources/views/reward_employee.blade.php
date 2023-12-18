@extends('layouts/layout')
@section('body')

@include('templates.modal_alert')

<div class="row py-3">
    <div class="col offset-1">
        <h2>Начисление пряней</h2>
    </div>
</div>
<div class="row">
    <div class="col-6 offset-3">
        <form class="card p-3 bg-light" id="form">
            <div class="mb-3 row">
                <label for="employee" class="col col-form-label">Выберите сотрудника</label>
                <div class="col">
                    <select name="employee" id="employee" class="form-control">
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->surname }} {{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="activity" class="col col-form-label">Выберите наградное действие</label>
                <div class="col">
                    <select name="activity" id="activity" class="form-control">
                        @foreach ($activities as $activity)
                            <option value="{{ $activity->id }}">{{ $activity->name }} - {{ $activity->cookies }} пр.</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="text-center">       
                <button class="btn btn-primary" type="submit"
                data-bs-toggle="modal" 
                data-bs-target="#alertModal"
                style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);">Наградить</button>
            </div>
        </form>
        @if (request()->user()->user_type->name == 'Admin')
        <a href="{{ route('manage_activities') }}">Управлять наградными действиями</a>
        @endif
        
    </div>
</div>
<script src="{{asset('js/reward.js')}} "></script>
</div>
@endsection