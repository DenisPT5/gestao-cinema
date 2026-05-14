<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model {
    public $timestamps = false;
    protected $table = 'funcionario';
    protected $primaryKey = 'id_funcionario';
    protected $fillable = ['nome', 'funcao'];
}