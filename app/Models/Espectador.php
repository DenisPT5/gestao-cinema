<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Espectador extends Authenticatable
{
    use Notifiable;

    protected $table = 'espectador';
    protected $primaryKey = 'cod_espectador';
    public $timestamps = false;

    protected $fillable = [
        'nome', 'email', 'contacto', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function getRouteKeyName(): string
    {
        return 'cod_espectador';
    }

    public function bilhetes()
    {
        return $this->hasMany(Bilhete::class, 'cod_espectador');
    }
}
