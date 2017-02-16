<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable=['nombre','detalle','estado','fecha','vencimiento','observaciones','juicio_id','tipoevento_id','user_id','file_id'];

	public function juicio()
	{
		return $this->belongsTo(Juicio::class);
	}

	public function tipoevento()
	{
		return $this->belongsTo(Tipoevento::class);
	}

}
