<?php

namespace App\Http\Controllers\adminControls;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Yajra\DataTables\DataTables;

class PaymentsAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $paymentList = Payment::all();

        return view('admin.payment',compact('paymentList'));
    }

    public function getDatatable(){
        if (request()->ajax()) {
            return Datatables::of(Payment::all())
            ->addIndexColumn()
            ->make(true);
        }
    }


}
