<?php

namespace App\Exports;

use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentExport implements FromView
{

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        $payments = Payment::all();
        return view('admin.exportPayments',compact('payments'));
    }

}
