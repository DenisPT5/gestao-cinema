<?php
namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Espectador;
use App\Models\Sessao;
use App\Models\Filme;
use App\Models\Bilhete;

class ClienteDashboardController extends Controller
{
    public function index()
    {
        $cliente = Espectador::find(session('cliente_id'));

        // Próximos bilhetes do cliente
        $proximosBilhetes = Bilhete::with(['sessao.filme', 'sessao.sala'])
            ->where('cod_espectador', $cliente->cod_espectador)
            ->whereHas('sessao', function ($q) {
                $q->where('data_hora', '>=', now());
            })
            ->orderBy('data_compra', 'desc')
            ->take(3)
            ->get();

        // Filmes em destaque (com sessões futuras)
        $filmesDestaque = Filme::with(['generos', 'sessoes' => function ($q) {
                $q->where('data_hora', '>=', now())->orderBy('data_hora');
            }])
            ->whereHas('sessoes', function ($q) {
                $q->where('data_hora', '>=', now());
            })
            ->take(6)
            ->get();

        // Stats do cliente
        $totalBilhetes = Bilhete::where('cod_espectador', $cliente->cod_espectador)->count();
        $totalGasto    = Bilhete::where('cod_espectador', $cliente->cod_espectador)->sum('preco');

        return view('cliente.dashboard.index', compact(
            'cliente', 'proximosBilhetes', 'filmesDestaque', 'totalBilhetes', 'totalGasto'
        ));
    }
}
