<x-app-layout>
    <div class="topbar">
        <h1>🎟️ Bilhetes</h1>
        <a href="{{ route('bilhetes.create') }}" class="btn btn-primary">+ Emitir Bilhete</a>
    </div>
    <div class="card">
        <table>
            <thead>
                <tr><th>Nº</th><th>Filme</th><th>Sessão</th><th>Espectador</th><th>Preço</th><th>Tipo</th><th>Data Compra</th><th>Ações</th></tr>
            </thead>
            <tbody>
                @forelse($bilhetes as $bilhete)
                <tr>
                    <td>#{{ $bilhete->num_bilhete }}</td>
                    <td>{{ $bilhete->sessao->filme->titulo }}</td>
                    <td>{{ \Carbon\Carbon::parse($bilhete->sessao->data_hora)->format('d/m/Y H:i') }}</td>
                    <td>{{ $bilhete->espectador->nome ?? 'Anónimo' }}</td>
                    <td>{{ number_format($bilhete->preco, 2) }}€</td>
                    <td><span class="badge {{ $bilhete->tipo_compra == 'Online' ? 'badge-blue' : 'badge-green' }}">{{ $bilhete->tipo_compra }}</span></td>
                    <td>{{ \Carbon\Carbon::parse($bilhete->data_compra)->format('d/m/Y H:i') }}</td>
                    <td>
                        <form method="POST" action="{{ route('bilhetes.destroy', $bilhete->num_bilhete) }}" onsubmit="return confirm('Cancelar este bilhete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑️ Cancelar</button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr><td colspan="8" style="text-align:center;color:#666">Nenhum bilhete encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $bilhetes->links() }}</div>
    </div>
</x-app-layout>