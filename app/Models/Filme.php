<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model {
    public $timestamps = false;
    protected $table = 'filme';
    protected $primaryKey = 'id_filme';
    protected $routeKeyName = 'id_filme';
    protected $fillable = ['titulo', 'duracao_minutos', 'ano_lancamento', 'realizador'];

    public function generos() {
        return $this->belongsToMany(Genero::class, 'filme_genero', 'id_filme', 'id_genero');
    }
    public function sessoes() {
        return $this->hasMany(Sessao::class, 'id_filme');
    }

    public function getRouteKeyName()
    {   
    return 'id_filme';
    }
}

