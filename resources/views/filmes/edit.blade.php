<x-app-layout>
    <div class="topbar">
        <h1>✏️ Editar Filme</h1>
        <a href="{{ route('filmes.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>
    <div class="card">
        <form method="POST" action="{{ route('filmes.update', $filme->id_filme) }}">
            @csrf @method('PUT')
            <div class="grid-2">
                <div class="form-group">
                    <label>Título *</label>
                    <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $filme->titulo) }}" required>
                </div>
                <div class="form-group">
                    <label>Realizador</label>
                    <input type="text" name="realizador" class="form-control" value="{{ old('realizador', $filme->realizador) }}">
                </div>
                <div class="form-group">
                    <label>Duração (minutos) *</label>
                    <input type="number" name="duracao_minutos" class="form-control" value="{{ old('duracao_minutos', $filme->duracao_minutos) }}" min="1" required>
                </div>
                <div class="form-group">
                    <label>Ano de Lançamento</label>
                    <input type="number" name="ano_lancamento" class="form-control" value="{{ old('ano_lancamento', $filme->ano_lancamento) }}" min="1888" max="2100">
                </div>
            </div>
            <div class="form-group">
                <label>Géneros</label>
                <div style="display:flex;flex-wrap:wrap;gap:10px;margin-top:8px">
                    @foreach($generos as $genero)
                    <label style="display:flex;align-items:center;gap:6px;cursor:pointer;color:#ccc">
                        <input type="checkbox" name="generos[]" value="{{ $genero->id_genero }}"
                            {{ $filme->generos->contains('id_genero', $genero->id_genero) ? 'checked' : '' }}>
                        {{ $genero->nome }}
                    </label>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary">💾 Atualizar Filme</button>
        </form>
    </div>
</x-app-layout>