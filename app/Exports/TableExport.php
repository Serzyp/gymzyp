<?php

namespace App\Exports;


use App\Models\Table;
use App\Models\Exercise;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TableExport implements FromView
{

    protected $table;

    public function __construct($v)
    {
        $this->table = $v;

    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        // dd($this->table['id_table']);
        $table = Table::find($this->table['id_table']);
        $exercises = Exercise::join('day', 'day.id', '=', 'exercise.day_id')->select('exercise.*','day.day','day.moment')->where('exercise.table_id','=',$this->table['id_table'])->orderBy('day.id')->get();
        return view('tables.exportTable',compact('table','exercises'));
    }

}
