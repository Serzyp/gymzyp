
@php
    $n = 1;
@endphp
<table id="tableGym" style="border-collapse: collapse;border: 1px solid rgb(0, 0, 0);">
    <tr></tr>
    <tr>
        <th></th>
        <th colspan="3" style="text-align:center;border:1px solid black;font-size: 30px;font-weight: bolder;height:50px;background-color: #F7D43A;">GYMZYP</th>
    </tr>
    <tr>
        <th></th>
        <th style="text-align:center;border:1px solid black;background-color: #D5D5D5;">NOMBRE DE LA TABLA:</th>
        <th colspan="2" style="text-align:center;border:1px solid black;">{{ $table->name }}</th>
    </tr>
    <tr>
        <th></th>
        <th style="text-align:center;border:1px solid black;background-color: #D5D5D5;">Creada por:</th>
        <th colspan="2" style="text-align:center;border:1px solid black;">{{ $table->user->nick }}</th>
    </tr>
    <tr></tr>
    @foreach ($exercises as $i => $exercise)
        @if ($loop->first)
            <tr class="text-center bg-light">
                <th></th>
                <th colspan="3" style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #6766CC;color: black;border:2px solid black;">{{ __($exercise->day) }} - {{ __($exercise->moment) }}</th>
            </tr>
            <tr>
                <th></th>
                <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:500px;border:2px solid black;">Ejercicio</th>
                <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:100px;border:2px solid black;">Series</th>
                <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;width:200px;border:2px solid black;">Repeticiones</th>
            </tr>
            <tr>
                <td></td>
                <td style="text-align:center;border:1px solid black;">{{ $exercise->content }}</td>
                <td style="text-align:center;border:1px solid black;">{{ $exercise->sets }}</td>
                <td style="text-align:center;border:1px solid black;">{{ $exercise->reps }}</td>
            </tr>
            @php
                $n = $i;
            @endphp
        @else
            @if($exercises[$i]->day_id != $exercises[$n]->day_id)
                <tr class="text-center bg-light">
                    <th></th>
                    <th colspan="3" style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #6766CC;color: black;">{{ $exercise->day }} - {{ $exercise->moment }}</th>
                </tr>
                <tr>
                    <th></th>
                    <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;border:2px solid black;">Ejercicio</th>
                    <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;border:2px solid black;">Series</th>
                    <th style="padding-top: 12px;padding-bottom: 12px;text-align: center;background-color: #00ccff;color: black;border:2px solid black;">Repeticiones</th>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align:center;border:1px solid black;">{{ $exercise->content }}</td>
                    <td style="text-align:center;border:1px solid black;">{{ $exercise->sets }}</td>
                    <td style="text-align:center;border:1px solid black;">{{ $exercise->reps }}</td>
                </tr>
                @php
                    $n = $i;
                @endphp
            @else
                <tr>
                    <td></td>
                    <td style="text-align:center;border:1px solid black;">{{ $exercise->content }}</td>
                    <td style="text-align:center;border:1px solid black;">{{ $exercise->sets }}</td>
                    <td style="text-align:center;border:1px solid black;">{{ $exercise->reps }}</td>
                </tr>
            @endif
            {{-- @if ($loop->last)
                <tr>
                    <td>{{ $exercise->content }}</td>
                    <td>{{ $exercise->sets }}</td>
                    <td>{{ $exercise->reps }}</td>
                </tr>
            @endif --}}
        @endif
    @endforeach
</table>

