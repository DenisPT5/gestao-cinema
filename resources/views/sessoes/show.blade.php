<x-app-layout>
    <div class="topbar">
        <h1>📅 Detalhe da Sessão</h1>
        <div style="display:flex;gap:8px">
            <a href="{{ route('bilhetes.create', ['sessao' => $sessao->id_sessao]) }}" class="btn btn-primary">🎟️ Emitir Bilhete</a>
            <a href="{{ route('sessoes.edit', $sessao->id_sessao) }}" class="btn btn-warning">✏️ Editar</a>
            <a href="{{ route('sessoes.index') }}" class="btn btn-secondary">← Voltar</a>
        </div>
    </div>
    <div class="grid-2">
        <div class="card">
            <div class="card-title">ℹ️ Informações da Sessão</div>
            <p><strong style="color:#888">Filme:</strong> {{ $sessao->filme->titulo }}</p>
            <p><strong style="color:#888">Sala:</strong> {{ $sessao->sala->nome }}</p>
            <p><strong style="color:#888">Data/Hora:</strong> {{ \Carbon\Carbon::parse($sessao->data_hora)->format('d/m/Y H:i') }}</p>
            <p><strong style="color:#888">Preço Base:</strong> {{ number_format($sessao->preco_base, 2) }}€</p>
            <p><strong style="color:#888">Responsável:</strong> {{ $sessao->funcionario->nome ?? '—' }}</p>
        </div>
        <div class="card">
            <div class="card-title">📊 Disponibilidade</div>
            <div style="display:flex;gap:16px;margin-bottom:16px">
                <div class="stat-card" style="flex:1">
                    <div class="number" style="font-size:1.8rem">{{ $totalVendidos }}</div>
                    <div class="label">Bilhetes Vendidos</div>
                </div>
                <div class="stat-card" style="flex:1">
                    <div class="number" style="font-size:1.8rem;color:{{ $disponiveis > 0 ? '#86efac' : '#fca5a5' }}">{{ $disponiveis }}</div>
                    <div class="label">Lugares Disponíveis</div>
                </div>
                <div class="stat-card" style="flex:1">
                    <div class="number" style="font-size:1.8rem">{{ number_format($receita, 2) }}€</div>
                    <div class="label">Receita</div>
                </div>
            </div>
            @php
                $percentagem = ($sessao->sala && $sessao->sala->capacidade > 0)
                   ? (floatval($totalVendidos) / floatval($sessao->sala->capacidade)) * 100
                    : 0;
                $percentagemVisual = max($percentagem, $totalVendidos > 0 ? 1 : 0);
            @endphp
            <div style="background:#111;border-radius:999px;height:10px">
                <div style="background:#e50914;height:10px;border-radius:999px;width:{{ $percentagemVisual }}%"></div>
            </div>
            <p style="color:#888;font-size:0.8rem;margin-top:6px">{{ number_format($percentagem, 0) }}% ocupação</p>
        </div>
    </div>
    <div class="card">
        <div class="card-title">🎟️ Bilhetes Emitidos</div>
        <table>
            <thead>
                <tr>
                    <th>Nº Bilhete</th>
                    <th>Espectador</th>
                    <th>Preço</th>
                    <th>Tipo</th>
                    <th>Data Compra</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sessao->bilhetes as $bilhete)
                <tr>
                    <td>#{{ $bilhete->num_bilhete }}</td>
                    <td>{{ $bilhete->espectador->nome ?? 'Anónimo' }}</td>
                    <td>{{ number_format($bilhete->preco, 2) }}€</td>
                    <td>
                        <span class="badge {{ $bilhete->tipo_compra == 'Online' ? 'badge-blue' : 'badge-green' }}">
                            {{ $bilhete->tipo_compra }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($bilhete->data_compra)->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;color:#666">Nenhum bilhete vendido.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>