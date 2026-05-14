<?php
namespace App\Http\Controllers;

use App\Models\Bilhete;
use App\Models\Sessao;
use App\Models\Espectador;
use Illuminate\Http\Request;

class BilheteController extends Controller
{
    public function index(Request $request)
    {
        $query = Bilhete::with(['sessao.filme', 'espectador']);

        if ($request->filled('sessao')) {
            $query->where('id_sessao', $request->sessao);
        }

        $bilhetes = $query->orderBy('data_compra', 'desc')->paginate(10);
        $sessoes = Sessao::with('filme')->orderBy('data_hora')->get();
        return view('bilhetes.index', compact('bilhetes', 'sessoes'));
    }

    public function create(Request $request)
    {
        $sessoes = Sessao::with(['filme', 'sala'])->where('data_hora', '>=', now())->orderBy('data_hora')->get();
        $espectadores = Espectador::orderBy('nome')->get();
        $sessaoSelecionada = $request->filled('sessao') ? Sessao::with('sala')->find($request->sessao) : null;
        return view('bilhetes.create', compact('sessoes', 'espectadores', 'sessaoSelecionada'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_sessao'      => 'required|exists:sessao,id_sessao',
            'cod_espectador' => 'nullable|exists:espectador,cod_espectador',
            'tipo_compra'    => 'required|in:Online,Bilheteira',
        ]);

        $sessao = Sessao::with('sala')->findOrFail($request->id_sessao);
        $vendidos = Bilhete::where('id_sessao', $sessao->id_sessao)->count();

        if ($vendidos >= $sessao->sala->capacidade) {
            return back()->withErrors(['id_sessao' => 'Sessão esgotada! Não há lugares disponíveis.'])->withInput();
        }

        Bilhete::create([
            'preco'          => $sessao->preco_base,
            'tipo_compra'    => $request->tipo_compra,
            'id_sessao'      => $request->id_sessao,
            'cod_espectador' => $request->cod_espectador,
        ]);

        return redirect()->route('bilhetes.index')->with('success', 'Bilhete emitido com sucesso!');
    }

    public function destroy(Bilhete $bilhete)
    {
        $bilhete->delete();
        return redirect()->route('bilhetes.index')->with('success', 'Bilhete cancelado com sucesso!');
    }
}