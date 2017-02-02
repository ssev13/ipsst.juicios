<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Juicio extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable=['causa','expediente','expteipsst','objeto','observaciones','fecha','vencimiento',
    'sentencia_id','objeto_id','descripcion','juzgado_id','estado_id','user_id'];

    public function scopeBusqueda($query, $busqueda)
    {
        if (trim($busqueda) != "") {
            $query->where('causa','like','%'.$busqueda.'%')
                    ->orWhere('expediente','like','%'.$busqueda.'%')
                    ->orWhere('descripcion','like','%'.$busqueda.'%');
        }
    }

    public function scopeVence($query, $vence_desde, $vence_hasta)
    {
        if (trim($vence_desde) != "" and trim($vence_hasta) != "") {
            $query->whereBetween('vencimiento', array($vence_desde, $vence_hasta));
        }
        else {
            if (trim($vence_desde) != "") {
                $query->where('vencimiento', '>=', $vence_desde);
            }
            else {
                if (trim($vence_hasta) != "") {
                    $query->where('vencimiento', '<=', $vence_hasta);
                }
                else{
                    $query->get();
                }
            }
        }
    }

    public function scopeFecha($query, $fecha_desde, $fecha_hasta)
    {
        if (trim($fecha_desde) != "" and trim($fecha_hasta) != "") {
            $query->whereBetween('fecha', array($fecha_desde, $fecha_hasta));
        }
        else {
            if (trim($fecha_desde) != "") {
                $query->where('fecha', '>=', $fecha_desde);
            }
            else {
                if (trim($fecha_hasta) != "") {
                    $query->where('fecha', '<=', $fecha_hasta);
                }
                else{
                    $query->get();
                }
            }
        }
    }

    public function scopeDescripcion($query, $descripcion)
    {
        if (trim($descripcion) != "") {
            $query->where('descripcion','like','%'.$descripcion.'%');
        }
    }

    public function scopeAbogado($query, $abogado)
    {
    	if (trim($abogado) != "") {
    		$query->where('user_id',$abogado);
    	}
    }

    public function scopeJuzgado($query, $juzgado)
    {
    	if (trim($juzgado) != "") {
    		$query->where('juzgado_id',$juzgado);
    	}
    }

    public function scopeObjeto($query, $objeto)
    {
    	if (trim($objeto) != "") {
    		$query->where('objeto_id',$objeto);
    	}
    }

    public function scopeEstado($query, $estado)
    {
    	if (trim($estado) != "") {
    		$query->where('estado_id',$estado);
    	}
    }

    public function scopeSentencia($query, $sentencia)
    {
    	if (trim($sentencia) != "") {
    		$query->where('sentencia_id',$sentencia);
    	}
    }

	public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function abogados()
    {
        return $this->belongsToMany(Abogado::class,'abogado_juicio')->withTimeStamps();
    }

    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class,'etiqueta_juicio')->withTimeStamps();
    }

	public function eventos()
	{
		return $this->hasMany(Evento::class);
	}

	public function historials()
	{
		return $this->hasMany(Historial::class);
	}

	public function honorarios()
	{
		return $this->hasMany(Honorario::class);
	}

	public function estado()
	{
		return $this->belongsTo(Estado::class);
	}

	public function juzgado()
	{
		return $this->belongsTo(Juzgado::class);
	}

	public function sentencia()
	{
		return $this->belongsTo(Sentencia::class);
	}

	public function objeto()
	{
		return $this->belongsTo(Objeto::class);
	}

}
