<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Espectador extends Model {
    public $timestamps = false;
    protected $table = 'espectador';
    protected $primaryKey = 'cod_espectador';
    protected $routeKeyName = 'cod_espectador';
    protected $fillable = ['nome', 'email', 'contacto'];
}
