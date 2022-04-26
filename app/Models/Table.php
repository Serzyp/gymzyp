<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;


    protected $connection = 'mysql';
    protected $table = 'table';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

	// Relación uno a muchos
	public function comments(){
		return $this->hasMany('App\Models\Comment')->orderBy('id', 'desc');
	}

	// Relación uno a muchos
	public function likes(){
		return $this->hasMany('App\Models\Like');
	}

    // Relación uno a muchos
	public function exercise(){
		return $this->hasMany('App\Models\Exercise');
	}

	// Relación de Muchos a Uno
	public function user(){
		return $this->belongsTo('App\Models\User', 'user_id');
	}
}
