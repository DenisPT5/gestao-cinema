<x-app-layout>
    <div class="topbar">
        <h1>👥 Nova Conta</h1>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>
    <div class="card">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="grid-2">
                <div class="form-group">
                    <label>Nome *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label>Password *</label>
                    <input type="password" name="password" class="form-control" required minlength="8">
                </div>
                <div class="form-group">
                    <label>Confirmar Password *</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tipo de Conta *</label>
                    <select name="role" class="form-control" required>
                        <option value="">Selecionar...</option>
                        <option value="gestor" {{ old('role') == 'gestor' ? 'selected' : '' }}>🔧 Gestor</option>
                        <option value="coordenador" {{ old('role') == 'coordenador' ? 'selected' : '' }}>👁️ Coordenador</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">💾 Criar Conta</button>
        </form>
    </div>
</x-app-layout>