<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';

	// Relación de Muchos a Uno
	public function user(){
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	// Relación de Muchos a Uno
	public function table(){
		return $this->belongsTo('App\Models\Table', 'table_id');
	}
}
