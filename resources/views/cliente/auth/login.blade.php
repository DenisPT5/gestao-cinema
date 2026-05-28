<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Cinema</title>
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-bg"></div>
    <div class="auth-bg-text">CINEMA</div>

    <div class="auth-card">

        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">❌ {{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">❌ Email ou password incorretos.</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                    placeholder="o_teu_email@exemplo.com"
                    value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control"
                    placeholder="••••••••" required>
            </div>
            <div class="form-group" style="display:flex;align-items:center;gap:8px;margin-bottom:0">
                <input type="checkbox" name="remember" id="remember" style="accent-color:var(--accent)">
                <label for="remember" style="color:var(--text2);font-size:0.85rem;margin:0;cursor:pointer">Manter sessão</label>
            </div>
            <button type="submit" class="btn-submit" style="width:100%;margin-top:16px">
                Entrar →
            </button>
        </form>

        <div class="auth-divider">novo cliente?</div>

        <div class="auth-footer">
            Não tens conta?
            <a href="{{ route('cliente.register') }}">Regista-te gratuitamente</a>
        </div>
    </div>
</div>
</body>
</html>