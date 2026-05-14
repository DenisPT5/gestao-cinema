<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model {
    public $timestamps = false;
    protected $table = 'sala';
    protected $primaryKey = 'id_sala';
    protected $fillable = ['nome', 'capacidade'];

    public function sessoes() {
        return $this->hasMany(Sessao::class, 'id_sala');
    }
}