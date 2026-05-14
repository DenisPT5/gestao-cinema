<x-app-layout>
    <div class="topbar">
        <h1>📊 Dashboard</h1>
        <span style="color:#888">Bem-vindo, {{ Auth::user()->name }}!</span>
    </div>

    <div class="grid-4">
        <div class="stat-card">
            <div class="number">{{ $totalFilmes }}</div>
            <div class="label">🎬 Filmes</div>
        </div>
        <div class="stat-card">
            <div class="number">{{ $totalSessoes }}</div>
            <div class="label">📅 Sessões</div>
        </div>
        <div class="stat-card">
            <div class="number">{{ $totalBilhetes }}</div>
            <div class="label">🎟️ Bilhetes Vendidos</div>
        </div>
        <div class="stat-card">
            <div class="number">{{ number_format($receitaTotal, 2) }}€</div>
            <div class="label">💰 Receita Total</div>
        </div>
    </div>

    <div class="card">
        <div class="card-title">📅 Próximas Sessões</div>
        @if($sessoesPróximas->isEmpty())
            <p style="color:#666">Não há sessões futuras agendadas.</p>
        @else
        <table>
            <thead>
                <tr>
                    <th>Filme</th>
                    <th>Sala</th>
                    <th>Data/Hora</th>
                    <th>Preço Base</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessoesPróximas as $sessao)
                <tr>
                    <td>{{ $sessao->filme->titulo }}</td>
                    <td>{{ $sessao->sala->nome }}</td>
                    <td>{{ \Carbon\Carbon::parse($sessao->data_hora)->format('d/m/Y H:i') }}</td>
                    <td>{{ number_format($sessao->preco_base, 2) }}€</td>
                    <td><a href="{{ route('sessoes.show', $sessao->id_sessao) }}" class="btn btn-secondary btn-sm">Ver</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</x-app-layout>