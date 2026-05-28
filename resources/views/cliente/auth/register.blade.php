<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema - Criar Conta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        @keyframes floatParticles {
            0% { transform: translateY(100vh) translateX(0px) scale(0.8); opacity: 0; }
            50% { opacity: 0.4; }
            100% { transform: translateY(-10vh) translateX(50px) scale(1.2); opacity: 0; }
        }
        @keyframes projectorBeam {
            0%, 100% { transform: rotate(-5deg) scale(1); opacity: 0.1; }
            50% { transform: rotate(5deg) scale(1.15); opacity: 0.2; }
        }
        .particle {
            position: absolute;
            bottom: -20px;
            background: rgba(220, 38, 38, 0.3);
            border-radius: 50%;
            pointer-events: none;
        }
    </style>
</head>
<body class="antialiased bg-black m-0 p-0 overflow-hidden w-screen h-screen">

    <div class="fixed inset-0 w-full h-full bg-gradient-to-tr from-black via-zinc-950 to-neutral-900 flex flex-col justify-center items-center px-4 select-none z-0 overflow-y-auto">

        <div class="absolute top-0 right-0 w-[1000px] h-[700px] bg-gradient-to-bl from-white/10 via-transparent to-transparent opacity-20 origin-top-right pointer-events-none"
             style="animation: projectorBeam 10s infinite ease-in-out; clip-path: polygon(100% 0, 0 100%, 100% 100%);">
        </div>

        <div class="absolute w-[700px] h-[700px] bg-red-700 rounded-full blur-[150px] opacity-15 -bottom-40 -left-20 animate-pulse" style="animation-duration: 5s;"></div>
        <div class="absolute w-[600px] h-[600px] bg-zinc-800 rounded-full blur-[140px] opacity-10 top-10 right-10 animate-pulse" style="animation-duration: 7s;"></div>

        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="particle w-2 h-2" style="left: 10%; animation: floatParticles 14s infinite linear; animation-delay: 1s;"></div>
            <div class="particle w-3 h-3" style="left: 40%; animation: floatParticles 10s infinite linear; animation-delay: 2s;"></div>
            <div class="particle w-1.5 h-1.5" style="left: 70%; animation: floatParticles 16s infinite linear; animation-delay: 0s;"></div>
            <div class="particle w-2.5 h-2.5" style="left: 85%; animation: floatParticles 12s infinite linear; animation-delay: 4s;"></div>
        </div>

        <div class="w-full sm:max-w-lg bg-zinc-900/70 backdrop-blur-2xl p-10 rounded-3xl shadow-[0_0_100px_rgba(0,0,0,0.95)] border border-white/5 transform transition-all duration-700 hover:border-red-500/30 hover:shadow-[0_0_60px_rgba(220,38,38,0.15)] z-10 my-8">

            @if ($errors->any())
                <div class="mb-5 p-3.5 bg-red-500/10 border border-red-500/20 rounded-xl text-xs text-red-400 font-medium">
                    @foreach ($errors->all() as $error)
                        <div>❌ {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if(session('success'))
                <div class="mb-5 p-3.5 bg-green-500/10 border border-green-500/20 rounded-xl text-xs text-green-400 font-medium">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('cliente.register') }}" class="space-y-5">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2 group">
                        <label class="block text-zinc-400 font-semibold text-xs uppercase tracking-wider ml-1 group-focus-within:text-red-400 transition-colors duration-300">
                            Nome Completo
                        </label>
                        <input type="text" name="nome"
                               class="block w-full bg-black/60 border border-zinc-800 text-white placeholder-zinc-600 rounded-xl px-4 py-3.5 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500/30 transition-all duration-300 shadow-2xl font-medium text-sm"
                               value="{{ old('nome') }}"
                               placeholder="O teu nome"
                               required autofocus />
                    </div>

                    <div class="space-y-2 group">
                        <label class="block text-zinc-400 font-semibold text-xs uppercase tracking-wider ml-1 group-focus-within:text-red-400 transition-colors duration-300">
                            Telemóvel
                        </label>
                        <input type="text" name="contacto"
                               class="block w-full bg-black/60 border border-zinc-800 text-white placeholder-zinc-600 rounded-xl px-4 py-3.5 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500/30 transition-all duration-300 shadow-2xl font-medium text-sm"
                               value="{{ old('contacto') }}"
                               placeholder="9XXXXXXXX"
                               required />
                    </div>
                </div>

                <div class="space-y-2 group">
                    <label class="block text-zinc-400 font-semibold text-xs uppercase tracking-wider ml-1 group-focus-within:text-red-400 transition-colors duration-300">
                        Email
                    </label>
                    <input type="email" name="email"
                           class="block w-full bg-black/60 border border-zinc-800 text-white placeholder-zinc-600 rounded-xl px-4 py-3.5 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500/30 transition-all duration-300 shadow-2xl font-medium text-sm"
                           value="{{ old('email') }}"
                           placeholder="exemplo@cinema.com"
                           required />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2 group">
                        <label class="block text-zinc-400 font-semibold text-xs uppercase tracking-wider ml-1 group-focus-within:text-red-400 transition-colors duration-300">
                            Password
                        </label>
                        <input type="password" name="password"
                               class="block w-full bg-black/60 border border-zinc-800 text-white placeholder-zinc-600 rounded-xl px-4 py-3.5 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500/30 transition-all duration-300 shadow-2xl font-medium text-sm"
                               placeholder="Mínimo 8 caracteres"
                               required minlength="8" />
                    </div>

                    <div class="space-y-2 group">
                        <label class="block text-zinc-400 font-semibold text-xs uppercase tracking-wider ml-1 group-focus-within:text-red-400 transition-colors duration-300">
                            Confirmar Password
                        </label>
                        <input type="password" name="password_confirmation"
                               class="block w-full bg-black/60 border border-zinc-800 text-white placeholder-zinc-600 rounded-xl px-4 py-3.5 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500/30 transition-all duration-300 shadow-2xl font-medium text-sm"
                               placeholder="Repete a password"
                               required />
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-red-700 via-red-600 to-amber-600 hover:from-red-600 hover:via-red-500 hover:to-amber-500 text-white font-bold py-4 px-4 rounded-xl shadow-xl shadow-red-950/60 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 text-center uppercase tracking-widest text-xs font-black">
                        Criar Conta Gratuita 🎬
                    </button>
                </div>

                <div class="relative flex items-center py-1">
                    <div class="flex-grow border-t border-zinc-800"></div>
                    <span class="mx-3 text-zinc-600 text-xs uppercase tracking-widest">ou</span>
                    <div class="flex-grow border-t border-zinc-800"></div>
                </div>

                <a href="{{ route('login') }}"
                   class="block w-full border border-zinc-700 hover:border-red-500/50 text-zinc-400 hover:text-white font-bold py-4 px-4 rounded-xl transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 text-center uppercase tracking-widest text-xs hover:bg-red-500/10">
                    Já tenho conta
                </a>

            </form>
        </div>

        <p class="absolute bottom-6 text-[10px] text-zinc-600 tracking-widest uppercase pointer-events-none">
            Cinema Management System © {{ date('Y') }}
        </p>
    </div>

</body>
</html>