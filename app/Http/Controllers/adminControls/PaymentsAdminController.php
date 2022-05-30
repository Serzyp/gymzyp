<?php

namespace App\Http\Controllers\adminControls;

use Carbon\Carbon;
use App\Models\Payment;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

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
            ->editColumn('created_at', function ($row) {
                $created = Carbon::parse($row->created_at)->formatLocalized('%d %B %Y');
                return $created;
            })
            ->editColumn('updated_at', function ($row) {
                $updated = Carbon::parse($row->updated_at)->formatLocalized('%d %B %Y');
                return $updated;
            })
            ->make(true);
        }
    }


}

// realizar donde salga el create y update
// $dt = Carbon::parse($data->created_at) //from database

// echo $dt->toDateTimeString();
