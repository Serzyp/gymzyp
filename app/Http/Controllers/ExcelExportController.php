<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Table;
use App\Exports\UserExport;
use App\Exports\TableExport;
use App\Exports\PaymentExport;
use Maatwebsite\Excel\Facades\Excel;



class ExcelExportController extends Controller
{
    //Exportación tabla
    public function table(){
        ob_end_clean();
        ob_start();
        return Excel::download(new TableExport(request()->all()),'TablaEntrenamiento.xlsx');
    }
    //Exportación usuarios
    public function user(){
        ob_end_clean();
        ob_start();
        return Excel::download(new UserExport(request()->all()),'UserList.xlsx');
    }
    //Exportación pagos
    public function payment(){
        ob_end_clean();
        ob_start();
        return Excel::download(new PaymentExport(request()->all()),'Payments.xlsx');
    }
}
