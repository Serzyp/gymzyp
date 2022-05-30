@php
    use Carbon\Carbon;
@endphp

<table id="tableGym" style="border-collapse: collapse;border: 1px solid rgb(0, 0, 0);">
    <tr></tr>
    <tr>
        <th></th>
        <th colspan="5" style="text-align:center;border:1px solid black;font-size: 30px;font-weight: bolder;height:50px;background-color: #F7D43A;">GYMZYP</th>
    </tr>
    <tr></tr>
    <tr>
        <th></th>

        <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:200px;border:2px solid black;">User ID</th>
        <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:200px;border:2px solid black;">Amount</th>
        <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:200px;border:2px solid black;">Paypal Payment Id</th>
        <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:200px;border:2px solid black;">Created at</th>
        <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:200px;border:2px solid black;">Updated at</th>
    </tr>
    @foreach ($payments as $payment)
        <tr>
            <td></td>
            <td style="text-align:center;border:1px solid black;">{{ $payment->user_id }}</td>
            <td style="text-align:center;border:1px solid black;">{{ $payment->amount }}€</td>
            <td style="text-align:center;border:1px solid black;">{{ $payment->paypal_payment_id }}</td>
            <td style="text-align:center;border:1px solid black;">{{ Carbon::parse($payment->created_at)->formatLocalized('%d %B %Y'); }}</td>
            <td style="text-align:center;border:1px solid black;">{{ Carbon::parse($payment->updated_at)->formatLocalized('%d %B %Y'); }}</td>
        </tr>
    @endforeach
</table>

