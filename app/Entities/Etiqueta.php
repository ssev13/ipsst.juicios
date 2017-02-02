<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    protected $fillable=['nombre','detalle','estado'];

	public function juicios()
	{
		return $this->belongsToMany(Juicio::class,'etiqueta_juicio')->withTimeStamps();
	}

    public function etiqueta(Juicio $juicio)
    {
        return $this->juicios()->where('juicio_id',$juicio->id)->count();
    }

    public function asignar($juicio)
    {
        if ($this->etiqueta($juicio)) return false;

        $this->juicios()->attach($juicio);

        return true;
    }

    public function desasignar($juicio)
    {
        $this->juicios()->detach($juicio);
    }

    public function scopeEtiquetaid($query, $busqueda)
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
