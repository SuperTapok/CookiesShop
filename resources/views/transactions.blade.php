@extends('layouts/layout')
@section('body')
<div class="row py-3">
    <h1>Ваши транзакции:</h1>
</div>
<div class="row">
    <div class="col-8 offset-2">
        <div class="card p-3 bg-light">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Дата</th>
                        <th scope="col">Сумма</th>
                        <th scope="col">Примечание</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ date('d.m.Y', strtotime($transaction['date'])) }}</td>
                        @if ($transaction['type'] == 'order')
                            <td style="color: red" >-{{ $transaction['sum'] }}</td>
                            <td><a href="{{ route('get_order')."?order_id=".$transaction['info'] }}" target="_blank">Чек</a></td>
                        @else
                            <td style="color: green" >+{{ $transaction['sum'] }}</td>
                            <td>{{ $transaction['info'] }}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection