<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $table = 'exercise';

	// Relación de Muchos a Uno
	public function user(){
		return $this->belongsTo('App\Models\Table', 'table_id');
	}

	// Relación de Muchos a Uno
	public function table(){
		return $this->belongsTo('App\Models\Day', 'day_id');
	}
}
