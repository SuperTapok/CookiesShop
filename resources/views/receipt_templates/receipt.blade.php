<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>receipt_{{ $order->receipt_code }}</title>
    <style>
        html {
            margin: 60px 60px 60px 80px;
        }

        table {
            width: 100%;
            border-collapse: collapse;

        }

        td {
            height: 20px;
        }

        * {
            font-family: DejaVu Sans !important;
            color: black;
            font-size: 15px;
        }

        .b-bottom {
            border-bottom: 1px solid black;
        }

        .sign {
            display: inline-block;
            position: relative;
            border-bottom: 1px solid black;
            width: 200px;
            margin-bottom: -4px;
            text-align: center;
        }

        .sign-image {
            position: absolute;
            height: 100px;
            top: -75px;
            left: 25px;
            bottom: 0;
            right: 0;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <td colspan="7"></td>
        <td colspan="6" style="text-align: center; font-size: 20px; font-weight: bold;">Товарный чек: {{ $order->receipt_code }}
            <br>
            <br>
            <br>
            <br></td>
        <td colspan="7"></td>
    </tr>
    <tr>
        <td colspan="20">Покупатель: {{ $order->employee->surname }} {{ $order->employee->name }} 
            {{ $order->employee->middle_name }} <br><br>
        </td>
    </tr>
    <tr>
        <td colspan="10">Дата: {{ date('d.m.Y', strtotime($order->paid_at)) }} <br><br></td>
    </tr>
    <tr>
        <td colspan="1"></td>
        <td colspan="18">
            <table border="2px">
                <tr>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                </tr>
                
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['count'] }} шт.</td>
                        <td>{{ $product['cost_per_one'] }} пр.</td>
                        <td>{{ $product['cost'] }} пр.</td>
                    </tr>
                @endforeach 
                <tr>
                    <th colspan="3">Итого</th>
                    <th>{{ $order->sum }} пр.</th>    
                </tr> 
            </table>
        </td>
        <td colspan="1"></td>          
    </tr> 
    <tr>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
        <td style="width: 5%"></td>
    </tr>
</table>    
</body>
</html>
