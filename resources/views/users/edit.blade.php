<x-app-layout>
    <div class="topbar">
        <h1>✏️ Editar Conta</h1>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>
    <div class="card">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf @method('PUT')
            <div class="grid-2">
                <div class="form-group">
                    <label>Nome *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="form-group">
                    <label>Nova Password <span style="color:#666">(deixar vazio para não alterar)</span></label>
                    <input type="password" name="password" class="form-control" minlength="8">
                </div>
                <div class="form-group">
                    <label>Confirmar Nova Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <div class="form-group">
                    <label>Tipo de Conta *</label>
                    <select name="role" class="form-control" required>
                        <option value="gestor" {{ $user->role == 'gestor' ? 'selected' : '' }}>🔧 Gestor</option>
                        <option value="coordenador" {{ $user->role == 'coordenador' ? 'selected' : '' }}>👁️ Coordenador</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">💾 Atualizar Conta</button>
        </form>
    </div>
</x-app-layout>