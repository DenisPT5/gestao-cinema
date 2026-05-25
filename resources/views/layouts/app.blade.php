<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎬 Gestão de Sala de Cinema</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/cinema.css') }}">
</head>
<body>

<div class="sidebar">
    <div class="brand">🎬 Cinema</div>
    <span class="nav-section">Principal</span>
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">📊 Dashboard</a>

    @if(Auth::user()->isSuperAdmin() || Auth::user()->isGestor())
    <span class="nav-section">Gestão</span>
    <a href="{{ route('filmes.index') }}" class="{{ request()->routeIs('filmes.*') ? 'active' : '' }}">🎬 Filmes</a>
    <a href="{{ route('bilhetes.index') }}" class="{{ request()->routeIs('bilhetes.*') ? 'active' : '' }}">🎟️ Bilhetes</a>
    @endif

    <span class="nav-section">Sessões</span>
    <a href="{{ route('sessoes.index') }}" class="{{ request()->routeIs('sessoes.*') ? 'active' : '' }}">📅 Sessões</a>

    @if(Auth::user()->isSuperAdmin())
    <span class="nav-section">Administração</span>
    <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">👥 Contas</a>
    @endif

    <span class="nav-section">Conta</span>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">🚪 Sair</a>
    </form>
</div>

<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error) <div>❌ {{ $error }}</div> @endforeach
        </div>
    @endif
    {{ $slot }}
</div>

</body>
</html>