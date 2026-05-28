<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta — CineMax</title>
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-bg"></div>
    <div class="auth-bg-text">CINEMA</div>

    <div class="auth-card" style="max-width:500px">
        <div class="auth-logo">
            <div class="icon">🎬</div>
            <h1>Cine<em>Max</em></h1>
            <p>Cria a tua conta gratuita</p>
        </div>

        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <div>❌ {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('cliente.register') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>Nome Completo</label>
                    <input type="text" name="nome" class="form-control"
                        placeholder="O teu nome"
                        value="{{ old('nome') }}" required>
                    @error('nome')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Telemóvel</label>
                    <input type="text" name="contacto" class="form-control"
                        placeholder="9XXXXXXXX"
                        value="{{ old('contacto') }}" required>
                    @error('contacto')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                    placeholder="o_teu_email@exemplo.com"
                    value="{{ old('email') }}" required>
                @error('email')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control"
                        placeholder="Mínimo 8 caracteres" required minlength="8">
                    @error('password')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Confirmar Password</label>
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Repete a password" required>
                </div>
            </div>
            <button type="submit" class="btn-submit" style="width:100%;margin-top:8px">
                Criar Conta Gratuita 🎬
            </button>
        </form>

        <div class="auth-divider">ou</div>

        <div class="auth-footer">
            Já tens conta? <a href="{{ route('cliente.login') }}">Fazer login</a>
        </div>
    </div>
</div>
</body>
</html>
