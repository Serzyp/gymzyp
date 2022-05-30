<table id="tableGym" style="border-collapse: collapse;border: 1px solid rgb(0, 0, 0);">
    <tr></tr>
    <tr>
        <th></th>
        <th colspan="6" style="text-align:center;border:1px solid black;font-size: 30px;font-weight: bolder;height:50px;background-color: #F7D43A;">GYMZYP</th>
    </tr>
    <tr></tr>
    <tr>
        <th></th>
        <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:200px;border:2px solid black;">Name</th>
        <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:200px;border:2px solid black;">Surname</th>
        <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:200px;border:2px solid black;">Nickname</th>
        <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:200px;border:2px solid black;">Email</th>
        <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:200px;border:2px solid black;">Image path</th>
        <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:200px;border:2px solid black;">External Auth</th>
        <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:200px;border:2px solid black;">Created at</th>
        <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:200px;border:2px solid black;">Updated at</th>
    </tr>
    @foreach ($users as $user)
        <tr>
            <td></td>
            <td style="text-align:center;border:1px solid black;">{{ $user->name }}</td>
            <td style="text-align:center;border:1px solid black;">{{ $user->surname }}</td>
            <td style="text-align:center;border:1px solid black;">{{ $user->nick }}</td>
            <td style="text-align:center;border:1px solid black;">{{ $user->email }}</td>
            <td style="text-align:center;border:1px solid black;">{{ $user->image }}</td>
            <td style="text-align:center;border:1px solid black;">{{ $user->external_auth }}</td>
            <td style="text-align:center;border:1px solid black;">{{ Carbon::parse($payment->created_at)->formatLocalized('%d %B %Y'); }}</td>
            <td style="text-align:center;border:1px solid black;">{{ Carbon::parse($payment->updated_at)->formatLocalized('%d %B %Y'); }}</td>
        </tr>
    @endforeach
</table>

