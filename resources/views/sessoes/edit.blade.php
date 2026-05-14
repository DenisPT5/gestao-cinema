<x-app-layout>
    <div class="topbar">
        <h1>✏️ Editar Sessão</h1>
        <a href="{{ route('sessoes.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>
    <div class="card">
        <form method="POST" action="{{ route('sessoes.update', $sessao->id_sessao) }}">
            @csrf @method('PUT')
            <div class="grid-2">
                <div class="form-group">
                    <label>Filme *</label>
                    <select name="id_filme" class="form-control" required>
                        @foreach($filmes as $f)
                            <option value="{{ $f->id_filme }}" {{ $sessao->id_filme == $f->id_filme ? 'selected' : '' }}>{{ $f->titulo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Sala *</label>
                    <select name="id_sala" class="form-control" required>
                        @foreach($salas as $s)
                            <option value="{{ $s->id_sala }}" {{ $sessao->id_sala == $s->id_sala ? 'selected' : '' }}>{{ $s->nome }} ({{ $s->capacidade }} lugares)</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Data e Hora *</label>
                    <input type="datetime-local" name="data_hora" class="form-control"
                        value="{{ \Carbon\Carbon::parse($sessao->data_hora)->format('Y-m-d\TH:i') }}" required>
                </div>
                <div class="form-group">
                    <label>Preço Base (€) *</label>
                    <input type="number" step="0.01" name="preco_base" class="form-control" value="{{ $sessao->preco_base }}" min="0" required>
                </div>
                <div class="form-group">
                    <label>Funcionário Responsável</label>
                    <select name="id_funcionario" class="form-control">
                        <option value="">Nenhum</option>
                        @foreach($funcionarios as $f)
                            <option value="{{ $f->id_funcionario }}" {{ $sessao->id_funcionario == $f->id_funcionario ? 'selected' : '' }}>{{ $f->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">💾 Atualizar Sessão</button>
        </form>
    </div>
</x-app-layout>