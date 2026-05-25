<x-app-layout>
    <div class="topbar">
        <h1>👥 Gestão de Contas</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Nova Conta</a>
    </div>
    <div class="card">
        <table>
            <thead>
                <tr><th>Nome</th><th>Email</th><th>Role</th><th>Ações</th></tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->isSuperAdmin())
                            <span class="badge badge-red">⭐ Super Admin</span>
                        @elseif($user->isGestor())
                            <span class="badge badge-blue">🔧 Gestor</span>
                        @else
                            <span class="badge badge-green">👁️ Coordenador</span>
                        @endif
                    </td>
                    <td style="display:flex;gap:6px">
                        @if(!$user->isSuperAdmin())
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">✏️</a>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                onsubmit="return confirm('Eliminar esta conta?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">🗑️</button>
                            </form>
                        @else
                            <span style="color:#666;font-size:0.8rem">Conta protegida</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>