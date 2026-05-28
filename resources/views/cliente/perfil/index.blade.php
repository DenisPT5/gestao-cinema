@extends('cliente.layouts.app')
@section('title', 'O Meu Perfil')

@section('content')
<div class="container page-content">
    <div class="section-header" style="padding-top:20px;margin-bottom:32px">
        <div class="section-title" style="font-size:1.8rem">👤 O Meu Perfil</div>
    </div>

    <div class="perfil-grid">
        {{-- SIDEBAR DO PERFIL --}}
        <div class="perfil-sidebar">
            <div class="perfil-card">
                <div class="perfil-avatar">
                    {{ strtoupper(substr($cliente->nome, 0, 1)) }}
                </div>
                <div class="perfil-name">{{ $cliente->nome }}</div>
                <div class="perfil-email">{{ $cliente->email }}</div>
                @if($cliente->contacto)
                    <div style="color:var(--text3);font-size:0.85rem;margin-top:4px">📱 {{ $cliente->contacto }}</div>
                @endif
                <div class="perfil-stats">
                    <div class="perfil-stat">
                        <div class="number">{{ $cliente->bilhetes->count() }}</div>
                        <div class="label">Bilhetes</div>
                    </div>
                    <div class="perfil-stat">
                        <div class="number">{{ number_format($cliente->bilhetes->sum('preco'), 0) }}€</div>
                        <div class="label">Gasto</div>
                    </div>
                </div>
            </div>

            <div class="form-card" style="text-align:center">
                <p style="color:var(--text3);font-size:0.85rem;margin-bottom:12px">
                    Membro desde<br>
                    <strong style="color:var(--text)">{{ now()->format('Y') }}</strong>
                </p>
                <a href="{{ route('cliente.sessoes') }}" class="btn-submit" style="text-decoration:none;display:block">
                    🎬 Ver Sessões
                </a>
            </div>
        </div>

        {{-- FORMULÁRIOS --}}
        <div>
            {{-- EDITAR DADOS --}}
            <div class="form-card">
                <h3>Editar Dados Pessoais</h3>

                @if(session('success'))
                    <div class="alert alert-success">✅ {{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('cliente.perfil.update') }}">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nome Completo</label>
                            <input type="text" name="nome" class="form-control"
                                value="{{ old('nome', $cliente->nome) }}" required>
                            @error('nome')<div class="error-msg">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label>Telemóvel</label>
                            <input type="text" name="contacto" class="form-control"
                                value="{{ old('contacto', $cliente->contacto) }}" required>
                            @error('contacto')<div class="error-msg">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $cliente->email) }}" required>
                        @error('email')<div class="error-msg">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn-submit">💾 Guardar Alterações</button>
                </form>
            </div>

            {{-- ALTERAR PASSWORD --}}
            <div class="form-card">
                <h3>Alterar Password</h3>
                <form method="POST" action="{{ route('cliente.perfil.password') }}">
                    @csrf
                    <div class="form-group">
                        <label>Password Atual</label>
                        <input type="password" name="password_atual" class="form-control"
                            placeholder="A tua password atual" required>
                        @error('password_atual')<div class="error-msg">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nova Password</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Mínimo 8 caracteres" required minlength="8">
                            @error('password')<div class="error-msg">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label>Confirmar Nova Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Repete a nova password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">🔒 Alterar Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
