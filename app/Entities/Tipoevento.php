<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Tipoevento extends Model
{
    //
    protected $fillable=['nombre','detalle','estado'];
    
    public function eventos()
    {
    	return $this->hasMany(Evento::class);
    }

    public function scopeTipoeventoid($query, $busqueda)
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
