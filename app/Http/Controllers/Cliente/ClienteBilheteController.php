<?php
namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Bilhete;
use App\Models\Sessao;
use App\Models\Espectador;
use Illuminate\Http\Request;

class ClienteBilheteController extends Controller
{
    public function index()
    {
        $cliente = Espectador::find(session('cliente_id'));

        $bilhetes = Bilhete::with(['sessao.filme', 'sessao.sala'])
            ->where('cod_espectador', $cliente->cod_espectador)
            ->orderBy('data_compra', 'desc')
            ->paginate(8);

        return view('cliente.bilhetes.index', compact('cliente', 'bilhetes'));
    }

    public function sessoes()
    {
        $sessoes = Sessao::with(['filme.generos', 'sala'])
            ->where('data_hora', '>=', now())
            ->orderBy('data_hora')
            ->paginate(9);

        return view('cliente.bilhetes.sessoes', compact('sessoes'));
    }

    public function comprar(Request $request)
    {
        $request->validate([
            'id_sessao' => 'required|exists:sessao,id_sessao',
        ]);

        $sessao   = Sessao::with('sala')->findOrFail($request->id_sessao);
        $vendidos = Bilhete::where('id_sessao', $sessao->id_sessao)->count();

        if ($vendidos >= $sessao->sala->capacidade) {
            return back()->with('error', 'Sessão esgotada! Não há lugares disponíveis.');
        }

        Bilhete::create([
            'preco'          => $sessao->preco_base,
            'tipo_compra'    => 'Online',
            'id_sessao'      => $sessao->id_sessao,
            'cod_espectador' => session('cliente_id'),
        ]);

        return redirect()->route('cliente.bilhetes')
            ->with('success', 'Bilhete comprado com sucesso! Bom filme! 🎬');
    }

    public function cancelar(Bilhete $bilhete)
    {
        if ($bilhete->cod_espectador != session('cliente_id')) {
            abort(403);
        }

        // Só pode cancelar se a sessão ainda não aconteceu
        if ($bilhete->sessao->data_hora < now()) {
            return back()->with('error', 'Não podes cancelar um bilhete de uma sessão já realizada.');
        }

        $bilhete->delete();
        return redirect()->route('cliente.bilhetes')
            ->with('success', 'Bilhete cancelado com sucesso.');
    }
}
