<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Abogado extends Model
{
    protected $fillable=['matricula','nombre','observaciones'];

    public function juiciosACargo()
    {
        return $this->belongsToMany(Juicio::class,'abogado_juicio')->withTimeStamps();
    }

    public function abogado(Juicio $juicio)
    {
        return $this->juiciosACargo()->where('juicio_id',$juicio->id)->count();
    }

    public function asignar($juicio)
    {
        if ($this->abogado($juicio)) return false;

        $this->juiciosACargo()->attach($juicio);

        return true;
    }

    public function desasignar($juicio)
    {
        $this->juiciosACargo()->detach($juicio);
    }

    public function scopeMatricula($query, $busqueda)
    {
        if (trim($busqueda) != "") {
            $query->where('matricula',$busqueda);
        }
    }

    public function scopeBusqueda($query, $busqueda)
    {
        if (trim($busqueda) != "") {
            $query->where('matricula',$busqueda)
                    ->orWhere('nombre','like','%'.$busqueda.'%');
        }
    }

}
