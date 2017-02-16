<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\esResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','apellido','nombre','profile','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function juicios()
    {
        return $this->hasMany(Juicio::class);
    }

    public function juicios_vencidos()
    {
        $date = new Carbon('next monday');
        return $this->where('vencimiento','<',$date);
    }

    public function historials()
    {
        return $this->hasMany(Historial::class);
    }

    public function getNombreCompletoAttribute()
    {
        return $this->apellido.', '.$this->nombre;
    }

    public function getNombreComunAttribute()
    {
        return $this->nombre.' '.$this->apellido;
    }

    public function scopeBusqueda($query, $busqueda)
    {
        if (trim($busqueda) != "") {
            $query->where('nombre', 'like','%'.$busqueda.'%')
                    ->orWhere('apellido','like','%'.$busqueda.'%')
                    ->orWhere('profile','like','%'.$busqueda.'%')
                    ->orWhere('email','like','%'.$busqueda.'%');
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }    

}
