<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CineMax') — Área do Cliente</title>
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
    @stack('styles')
</head>
<body>

<nav class="navbar" id="navbar">
    <a href="{{ route('cliente.dashboard') }}" class="navbar-brand">
        <div class="logo">🎬</div>
        <span>Cine<em>Max</em></span>
    </a>

    <div class="navbar-nav">
        <a href="{{ route('cliente.dashboard') }}" class="{{ request()->routeIs('cliente.dashboard') ? 'active' : '' }}">
            🏠 Início
        </a>
        <a href="{{ route('cliente.sessoes') }}" class="{{ request()->routeIs('cliente.sessoes') ? 'active' : '' }}">
            🎬 Sessões
        </a>
        <a href="{{ route('cliente.bilhetes') }}" class="{{ request()->routeIs('cliente.bilhetes') ? 'active' : '' }}">
            🎟️ Os Meus Bilhetes
        </a>
        <a href="{{ route('cliente.perfil') }}" class="{{ request()->routeIs('cliente.perfil') ? 'active' : '' }}">
            👤 Perfil
        </a>
    </div>

    <div class="navbar-user">
        <div class="navbar-avatar">{{ strtoupper(substr(session('cliente_nome', 'C'), 0, 1)) }}</div>
        <span class="navbar-name">{{ session('cliente_nome') }}</span>
        <a href="{{ route('cliente.logout') }}" class="btn-logout">Sair</a>
    </div>
</nav>

<div class="main-wrapper">
    @if(session('success'))
        <div class="container" style="padding-top:20px">
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="container" style="padding-top:20px">
            <div class="alert alert-error">❌ {{ session('error') }}</div>
        </div>
    @endif

    @yield('content')
</div>

<script>
// Navbar scroll effect
window.addEventListener('scroll', () => {
    const navbar = document.getElementById('navbar');
    navbar.classList.toggle('scrolled', window.scrollY > 50);
});

// Animate elements on scroll
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.film-card, .bilhete-card, .sessao-card, .stat-card').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    observer.observe(el);
});
</script>
@stack('scripts')
</body>
</html>
