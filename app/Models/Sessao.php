<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Sessao extends Model {
    public $timestamps = false;
    protected $table = 'sessao';
    protected $primaryKey = 'id_sessao';
    protected $fillable = ['data_hora', 'preco_base', 'id_filme', 'id_sala', 'id_funcionario'];

    public function filme() {
        return $this->belongsTo(Filme::class, 'id_filme');
    }
    public function sala() {
        return $this->belongsTo(Sala::class, 'id_sala');
    }
    public function funcionario() {
        return $this->belongsTo(Funcionario::class, 'id_funcionario');
    }
    public function bilhetes() {
        return $this->hasMany(Bilhete::class, 'id_sessao');
    }
    public function getRouteKeyName()
    {
        return 'id_sessao';
    }
}