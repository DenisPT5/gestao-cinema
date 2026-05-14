<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎬 Gestão de Sala de Cinema</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #0f0f0f; color: #f0f0f0; font-family: 'Segoe UI', sans-serif; }
        .sidebar { width: 250px; min-height: 100vh; background: #1a1a2e; padding: 20px 0; position: fixed; top: 0; left: 0; }
        .sidebar .brand { text-align: center; padding: 20px; font-size: 1.2rem; font-weight: bold; color: #e50914; border-bottom: 1px solid #333; margin-bottom: 10px; }
        .sidebar a { display: block; padding: 12px 24px; color: #ccc; text-decoration: none; transition: all 0.2s; }
        .sidebar a:hover, .sidebar a.active { background: #e50914; color: white; padding-left: 30px; }
        .sidebar .nav-section { font-size: 0.7rem; color: #666; padding: 16px 24px 4px; text-transform: uppercase; letter-spacing: 1px; }
        .main-content { margin-left: 250px; padding: 30px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding-bottom: 15px; border-bottom: 1px solid #333; }
        .topbar h1 { font-size: 1.6rem; color: #fff; }
        .btn { padding: 8px 18px; border-radius: 6px; border: none; cursor: pointer; font-size: 0.9rem; text-decoration: none; display: inline-block; transition: opacity 0.2s; }
        .btn:hover { opacity: 0.85; }
        .btn-primary { background: #e50914; color: white; }
        .btn-secondary { background: #333; color: #ccc; }
        .btn-warning { background: #f59e0b; color: white; }
        .btn-danger { background: #7f1d1d; color: #fca5a5; }
        .btn-sm { padding: 5px 12px; font-size: 0.8rem; }
        .card { background: #1a1a1a; border-radius: 10px; padding: 24px; margin-bottom: 20px; border: 1px solid #2a2a2a; }
        .card-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 16px; color: #e50914; }
        .stat-card { background: #1a1a1a; border-radius: 10px; padding: 20px; border: 1px solid #2a2a2a; text-align: center; }
        .stat-card .number { font-size: 2.5rem; font-weight: bold; color: #e50914; }
        .stat-card .label { color: #888; font-size: 0.85rem; margin-top: 4px; }
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #111; color: #888; font-size: 0.8rem; text-transform: uppercase; padding: 10px 14px; text-align: left; }
        td { padding: 12px 14px; border-bottom: 1px solid #222; font-size: 0.9rem; }
        tr:hover td { background: #1f1f1f; }
        .badge { padding: 3px 10px; border-radius: 999px; font-size: 0.75rem; font-weight: 600; }
        .badge-red { background: #7f1d1d; color: #fca5a5; }
        .badge-green { background: #14532d; color: #86efac; }
        .badge-blue { background: #1e3a5f; color: #93c5fd; }
        .badge-yellow { background: #78350f; color: #fcd34d; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; margin-bottom: 6px; color: #aaa; font-size: 0.85rem; }
        .form-control { width: 100%; padding: 10px 14px; background: #111; border: 1px solid #333; border-radius: 6px; color: #fff; font-size: 0.9rem; box-sizing: border-box; }
        .form-control:focus { outline: none; border-color: #e50914; }
        .alert { padding: 12px 18px; border-radius: 6px; margin-bottom: 20px; }
        .alert-success { background: #14532d; color: #86efac; border: 1px solid #166534; }
        .alert-danger { background: #7f1d1d; color: #fca5a5; border: 1px solid #991b1b; }
        .error-text { color: #fca5a5; font-size: 0.8rem; margin-top: 4px; }
        .pagination { display: flex; gap: 6px; margin-top: 20px; justify-content: center; }
        .pagination a, .pagination span { padding: 6px 12px; background: #1a1a1a; border: 1px solid #333; border-radius: 4px; color: #ccc; text-decoration: none; font-size: 0.85rem; }
        .pagination .active span { background: #e50914; border-color: #e50914; color: white; }
        select.form-control option { background: #1a1a1a; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">🎬 Cinema</div>
    <span class="nav-section">Principal</span>
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">📊 Dashboard</a>
    <span class="nav-section">Gestão</span>
    <a href="{{ route('filmes.index') }}" class="{{ request()->routeIs('filmes.*') ? 'active' : '' }}">🎬 Filmes</a>
    <a href="{{ route('sessoes.index') }}" class="{{ request()->routeIs('sessoes.*') ? 'active' : '' }}">📅 Sessões</a>
    <a href="{{ route('bilhetes.index') }}" class="{{ request()->routeIs('bilhetes.*') ? 'active' : '' }}">🎟️ Bilhetes</a>
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