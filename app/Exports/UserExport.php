<?php

namespace App\Exports;


use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        // dd($this->table['id_table']);
        $users = User::all();
        return view('admin.exportUsers',compact('users'));
    }

}
