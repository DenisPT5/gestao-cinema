<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — CineMax</title>
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-bg"></div>
    <div class="auth-bg-text">CINEMA</div>

    <div class="auth-card">
        <div class="auth-logo">
            <div class="icon">🎬</div>
            <h1>Cine<em>Max</em></h1>
            <p>Entra na tua conta para continuar</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">❌ {{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('cliente.login') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                    placeholder="o_teu_email@exemplo.com"
                    value="{{ old('email') }}" required autofocus>
                @error('email')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control"
                    placeholder="••••••••" required>
                @error('password')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn-submit" style="width:100%;margin-top:8px">
                Entrar →
            </button>
        </form>

        <div class="auth-divider">ou</div>

        <div class="auth-footer">
            Não tens conta?
            <a href="{{ route('cliente.register') }}">Regista-te gratuitamente</a>
        </div>
    </div>
</div>
</body>
</html>
