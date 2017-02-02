<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Sentencia extends Model
{
    protected $fillable=['nombre','detalle','estado'];

	public function juicios()
	{
		return $this->hasMany(Juicio::class);
	}

    public function scopeEstadoid($query, $busqueda)
    {
        if (trim($busqueda) != "") {
            $query->where('id',$busqueda);
        }
    }

    public function scopeBusqueda($query, $busqueda)
    {
        if (trim($busqueda) != "") {
            $query->where('detalle','like','%'.$busqueda.'%')
                    ->orWhere('nombre','like','%'.$busqueda.'%');
        }
    }


}
