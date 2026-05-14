<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Bilhete extends Model {
    public $timestamps = false;
    protected $table = 'bilhete';
    protected $primaryKey = 'num_bilhete';
    protected $routeKeyName = 'num_bilhete';
    protected $fillable = ['preco', 'data_compra', 'tipo_compra', 'id_sessao', 'cod_espectador'];

    public function sessao() {
        return $this->belongsTo(Sessao::class, 'id_sessao');
    }
    public function espectador() {
        return $this->belongsTo(Espectador::class, 'cod_espectador');
    }
    public function getRouteKeyName()
    {
    return 'num_bilhete';
    }
}
