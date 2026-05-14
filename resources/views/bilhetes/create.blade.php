<x-app-layout>
    <div class="topbar">
        <h1>🎟️ Emitir Bilhete</h1>
        <a href="{{ route('bilhetes.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>
    <div class="card">
        <form method="POST" action="{{ route('bilhetes.store') }}">
            @csrf
            <div class="grid-2">
                <div class="form-group">
                    <label>Sessão *</label>
                    <select name="id_sessao" class="form-control" required>
                        <option value="">Selecionar sessão...</option>
                        @foreach($sessoes as $s)
                            <option value="{{ $s->id_sessao }}"
                                {{ (isset($sessaoSelecionada) && $sessaoSelecionada->id_sessao == $s->id_sessao) || old('id_sessao') == $s->id_sessao ? 'selected' : '' }}>
                                {{ $s->filme->titulo }} — {{ \Carbon\Carbon::parse($s->data_hora)->format('d/m/Y H:i') }} ({{ $s->sala->nome }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Espectador (opcional)</label>
                    <select name="cod_espectador" class="form-control">
                        <option value="">Anónimo</option>
                        @foreach($espectadores as $e)
                            <option value="{{ $e->cod_espectador }}" {{ old('cod_espectador') == $e->cod_espectador ? 'selected' : '' }}>{{ $e->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tipo de Compra *</label>
                    <select name="tipo_compra" class="form-control" required>
                        <option value="Bilheteira" {{ old('tipo_compra') == 'Bilheteira' ? 'selected' : '' }}>🏪 Bilheteira</option>
                        <option value="Online" {{ old('tipo_compra') == 'Online' ? 'selected' : '' }}>💻 Online</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">🎟️ Emitir Bilhete</button>
        </form>
    </div>
</x-app-layout>