<x-app-layout>
    <div class="topbar">
        <h1>🎬 Novo Filme</h1>
        <a href="{{ route('filmes.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>
    <div class="card">
        <form method="POST" action="{{ route('filmes.store') }}">
            @csrf
            <div class="grid-2">
                <div class="form-group">
                    <label>Título *</label>
                    <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
                </div>
                <div class="form-group">
                    <label>Realizador</label>
                    <input type="text" name="realizador" class="form-control" value="{{ old('realizador') }}">
                </div>
                <div class="form-group">
                    <label>Duração (minutos) *</label>
                    <input type="number" name="duracao_minutos" class="form-control" value="{{ old('duracao_minutos') }}" min="1" required>
                </div>
                <div class="form-group">
                    <label>Ano de Lançamento</label>
                    <input type="number" name="ano_lancamento" class="form-control" value="{{ old('ano_lancamento') }}" min="1888" max="2100">
                </div>
            </div>
            <div class="form-group">
                <label>Géneros</label>
                <div style="display:flex;flex-wrap:wrap;gap:10px;margin-top:8px">
                    @foreach($generos as $genero)
                    <label style="display:flex;align-items:center;gap:6px;cursor:pointer;color:#ccc">
                        <input type="checkbox" name="generos[]" value="{{ $genero->id_genero }}"
                            {{ in_array($genero->id_genero, old('generos', [])) ? 'checked' : '' }}>
                        {{ $genero->nome }}
                    </label>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary">💾 Guardar Filme</button>
        </form>
    </div>
</x-app-layout>