<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;


    protected $connection = 'mysql';
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'amount',
        'paypal_payment_id',

    ];
	// Relación de Muchos a Uno
	public function user(){
		return $this->belongsTo('App\Models\User', 'user_id');
	}
}
