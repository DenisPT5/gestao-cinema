<?php
namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Genero;
use Illuminate\Http\Request;

class FilmeController extends Controller
{
    public function index()
    {
        $filmes = Filme::with('generos')->orderBy('titulo')->paginate(10);
        return view('filmes.index', compact('filmes'));
    }

    public function create()
    {
        $generos = Genero::orderBy('nome')->get();
        return view('filmes.create', compact('generos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'            => 'required|string|max:100',
            'duracao_minutos'   => 'required|integer|min:1',
            'ano_lancamento'    => 'nullable|integer|min:1888|max:2100',
            'realizador'        => 'nullable|string|max:100',
            'generos'           => 'nullable|array',
        ]);

        $filme = Filme::create($request->only('titulo','duracao_minutos','ano_lancamento','realizador'));

        if ($request->has('generos')) {
            $filme->generos()->sync($request->generos);
        }

        return redirect()->route('filmes.index')->with('success', 'Filme criado com sucesso!');
    }

    public function show(Filme $filme)
    {
        $filme->load('generos', 'sessoes.sala');
        return view('filmes.show', compact('filme'));
    }

    public function edit(Filme $filme)
    {
        $generos = Genero::orderBy('nome')->get();
        $filme->load('generos');
        return view('filmes.edit', compact('filme', 'generos'));
    }

    public function update(Request $request, Filme $filme)
    {
        $request->validate([
            'titulo'            => 'required|string|max:100',
            'duracao_minutos'   => 'required|integer|min:1',
            'ano_lancamento'    => 'nullable|integer|min:1888|max:2100',
            'realizador'        => 'nullable|string|max:100',
            'generos'           => 'nullable|array',
        ]);

        $filme->update($request->only('titulo','duracao_minutos','ano_lancamento','realizador'));
        $filme->generos()->sync($request->generos ?? []);

        return redirect()->route('filmes.index')->with('success', 'Filme atualizado com sucesso!');
    }

    public function destroy(Filme $filme)
    {
        $filme->delete();
        return redirect()->route('filmes.index')->with('success', 'Filme eliminado com sucesso!');
    }
}