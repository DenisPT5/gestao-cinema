<?php
namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Sessao;
use App\Models\Bilhete;
use App\Models\Sala;

class DashboardController extends Controller
{
    public function index()
    {
        $totalFilmes = Filme::count();
        $totalSessoes = Sessao::count();
        $totalBilhetes = Bilhete::count();
        $totalSalas = Sala::count();
        $receitaTotal = Bilhete::sum('preco');
        $sessoesPróximas = Sessao::with(['filme', 'sala'])
            ->where('data_hora', '>=', now())
            ->orderBy('data_hora')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalFilmes', 'totalSessoes', 'totalBilhetes',
            'totalSalas', 'receitaTotal', 'sessoesPróximas'
        ));
    }
}