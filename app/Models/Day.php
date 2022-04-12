<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $table = 'day';

    // Relación uno a muchos
	public function exercise(){
		return $this->hasMany('App\Models\Exercise');
	}
}
