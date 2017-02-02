<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $fillable=['nombre','detalle','estado','fecha','tipo','user_id','juicio_id','observaciones'];

	public function juicios()
	{
		return $this->belongsTo(Juicio::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}


}
