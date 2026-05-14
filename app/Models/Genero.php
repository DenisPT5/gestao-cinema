<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model {
    public $timestamps = false;
    protected $table = 'genero';
    protected $primaryKey = 'id_genero';
    protected $fillable = ['nome'];

    public function filmes() {
        return $this->belongsToMany(Filme::class, 'filme_genero', 'id_genero', 'id_filme');
    }
}
