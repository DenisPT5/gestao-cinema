<?php
namespace App\Http\Controllers;

use App\Models\Sessao;
use App\Models\Filme;
use App\Models\Sala;
use App\Models\Funcionario;
use App\Models\Bilhete;
use Illuminate\Http\Request;

class SessaoController extends Controller
{
    public function index(Request $request)
    {
        $query = Sessao::with(['filme', 'sala', 'funcionario']);

        if ($request->filled('filme')) {
            $query->where('id_filme', $request->filme);
        }
        if ($request->filled('sala')) {
            $query->where('id_sala', $request->sala);
        }
        if ($request->filled('data')) {
            $query->whereDate('data_hora', $request->data);
        }

        $sessoes = $query->orderBy('data_hora')->paginate(10);
        $filmes = Filme::orderBy('titulo')->get();
        $salas = Sala::orderBy('nome')->get();

        return view('sessoes.index', compact('sessoes', 'filmes', 'salas'));
    }

    public function create()
    {
        $filmes = Filme::orderBy('titulo')->get();
        $salas = Sala::orderBy('nome')->get();
        $funcionarios = Funcionario::orderBy('nome')->get();
        return view('sessoes.create', compact('filmes', 'salas', 'funcionarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'data_hora'      => 'required|date',
            'preco_base'     => 'required|numeric|min:0',
            'id_filme'       => 'required|exists:filme,id_filme',
            'id_sala'        => 'required|exists:sala,id_sala',
            'id_funcionario' => 'nullable|exists:funcionario,id_funcionario',
        ]);

        // Verificar conflito de sala/horário
        $conflito = Sessao::where('id_sala', $request->id_sala)
            ->where('data_hora', $request->data_hora)
            ->exists();

        if ($conflito) {
            return back()->withErrors(['data_hora' => 'Já existe uma sessão nessa sala nesse horário.'])->withInput();
        }

        Sessao::create($request->all());
        return redirect()->route('sessoes.index')->with('success', 'Sessão criada com sucesso!');
    }

        public function show($id)
    {
    $sessao = Sessao::findOrFail($id);
    $sessao->load('filme', 'sala', 'funcionario', 'bilhetes.espectador');

    $totalVendidos = $sessao->bilhetes->count();
    $capacidade = $sessao->sala ? $sessao->sala->capacidade : 0;
    $disponiveis = $capacidade - $totalVendidos;
    $receita = $sessao->bilhetes->sum('preco');

    return view('sessoes.show', compact('sessao', 'totalVendidos', 'disponiveis', 'receita'));
}

public function edit($id)
{
    $sessao = Sessao::findOrFail($id);
    $filmes = Filme::orderBy('titulo')->get();
    $salas = Sala::orderBy('nome')->get();
    $funcionarios = Funcionario::orderBy('nome')->get();
    return view('sessoes.edit', compact('sessao', 'filmes', 'salas', 'funcionarios'));
}

public function update(Request $request, $id)
{
    $sessao = Sessao::findOrFail($id);

    $request->validate([
        'data_hora'      => 'required|date',
        'preco_base'     => 'required|numeric|min:0',
        'id_filme'       => 'required|exists:filme,id_filme',
        'id_sala'        => 'required|exists:sala,id_sala',
        'id_funcionario' => 'nullable|exists:funcionario,id_funcionario',
    ]);

    $conflito = Sessao::where('id_sala', $request->id_sala)
        ->where('data_hora', $request->data_hora)
        ->where('id_sessao', '!=', $id)
        ->exists();

    if ($conflito) {
        return back()->withErrors(['data_hora' => 'Já existe uma sessão nessa sala nesse horário.'])->withInput();
    }

    $sessao->update($request->all());
    return redirect()->route('sessoes.index')->with('success', 'Sessão atualizada com sucesso!');
}

public function destroy($id)
{
    $sessao = Sessao::findOrFail($id);
    $sessao->delete();
    return redirect()->route('sessoes.index')->with('success', 'Sessão eliminada com sucesso!');
}
}