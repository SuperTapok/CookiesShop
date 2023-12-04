@extends('layouts/layout')
@section('body')
<div class="modal fade" id="alertModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5">Сообщение</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body" id="modalText">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" id="modalOk" class="btn btn-secondary" data-bs-dismiss="modal" 
                    style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);">Ок</button>
        </div>
        </div>
    </div>
</div>

<div class="row py-3">
    <div class="col offset-1">
        <h2>Поиск заказа</h2>
    </div>
</div>
<div class="row">
    <div class="col-4 offset-4">
        <form class="card p-3 bg-light">
            <div class="mb-3 row">
                <label for="employeeSelect" class="col col-form-label">Фамилия сотрудника</label>
                <div class="col">
                    <select id="employeeSelect" class="form-control">
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->surname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="receiptCode" class="col col-form-label">Номер чека</label>
                <div class="col">
                    <input type="text" id="receiptCode" placeholder="Чек.." class="form-control"/>
                </div>
            </div>
        </form>
    </div>
    
</div>
<div class="row">
    <div class="col offset-1">
        <h2>Заказы</h2>
    </div>
</div>
<div class="row">
    <div class="col-8 offset-2"> 
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Номер чека</th>
                <th scope="col">Фамилия</th>
                <th scope="col">Дата выдачи</th>
                <th scope="col">Чек</th>
            </tr>
        </thead>
        <tbody id="orderList">
            @foreach ($orders as $order)
            <tr>
                <td scope="row">{{ $order->receipt_code }}</td>
                <td>{{ $order->employee->surname }}</td>
                @if ($order->given_at == null)
                    <td><button class="giveOrder btn btn-primary" id="giveOrder"
                                data-order="{{ $order->id }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#alertModal"
                                style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);">Выдать заказ</button></td>
                @else
                    <td>{{ date('d.m.Y', strtotime($order->given_at)) }}</td>
                @endif
                <td><a href="{{ $order->receipt_url }}">Чек</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
<script src="{{asset('js/order.js')}} "></script>

</div>
@endsection