<x-guest-layout>
    <style>
        @keyframes floatParticles {
            0% { transform: translateY(100vh) translateX(0px) scale(0.8); opacity: 0; }
            50% { opacity: 0.6; }
            100% { transform: translateY(-10vh) translateX(50px) scale(1.2); opacity: 0; }
        }
        @keyframes projectorBeam {
            0%, 100% { transform: rotate(-5deg) scale(1); opacity: 0.15; }
            50% { transform: rotate(5deg) scale(1.1); opacity: 0.25; }
        }
        .particle {
            position: absolute;
            bottom: -20px;
            background: rgba(220, 38, 38, 0.4);
            border-radius: 50%;
            pointer-events: none;
        }
        /* Forçar o layout do Breeze a não esmagar a página em desktop */
        .min-h-screen { width: 100vw !important; margin: 0 !important; max-width: 100% !important; }
    </style>

    <div class="fixed inset-0 w-full h-full bg-gradient-to-tr from-black via-zinc-950 to-neutral-900 flex flex-col justify-center items-center relative overflow-hidden px-4 select-none z-0">
        
        <div class="absolute top-0 right-0 w-[800px] h-[600px] bg-gradient-to-bl from-white/10 via-transparent to-transparent opacity-20 origin-top-right pointer-events-none" 
             style="animation: projectorBeam 8s infinite ease-in-out; clip-path: polygon(100% 0, 0 100%, 100% 100%);">
        </div>

        <div class="absolute w-[600px] h-[600px] bg-red-600 rounded-full blur-[140px] opacity-10 -bottom-40 -left-20 animate-pulse" style="animation-duration: 4s;"></div>
        <div class="absolute w-[500px] h-[500px] bg-amber-500 rounded-full blur-[130px] opacity-5 top-10 right-10 animate-pulse" style="animation-duration: 6s;"></div>

        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="particle w-2 h-2" style="left: 15%; animation: floatParticles 12s infinite linear; animation-delay: 1s;"></div>
            <div class="particle w-3 h-3" style="left: 45%; animation: floatParticles 9s infinite linear; animation-delay: 3s;"></div>
            <div class="particle w-1.5 h-1.5" style="left: 75%; animation: floatParticles 15s infinite linear; animation-delay: 0s;"></div>
            <div class="particle w-2.5 h-2.5" style="left: 85%; animation: floatParticles 11s infinite linear; animation-delay: 5s;"></div>
        </div>

        <div class="w-full sm:max-w-lg bg-zinc-900/60 backdrop-blur-2xl p-10 rounded-3xl shadow-[0_0_80px_rgba(0,0,0,0.9)] border border-white/5 transform transition-all duration-700 hover:border-red-500/30 hover:scale-[1.01] hover:shadow-[0_0_50px_rgba(220,38,38,0.2)] z-10">
            
            <x-auth-session-status class="mb-6 text-center text-sm p-3 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400 shadow-lg" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="space-y-1.5 relative group">
                    <x-input-label for="email" :value="__('Email')" class="text-zinc-400 font-semibold text-xs uppercase tracking-wider ml-1 group-focus-within:text-red-400 transition-colors duration-300" />
                    <x-text-input id="email" 
                                  class="block w-full bg-black/60 border-zinc-800 text-white placeholder-zinc-600 rounded-xl px-4 py-3.5 focus:border-red-500 focus:ring focus:ring-red-500/10 transition-all duration-300 shadow-2xl group-hover:border-zinc-700 font-medium text-sm" 
                                  type="email" 
                                  name="email" 
                                  :value="old('email')" 
                                  required 
                                  autofocus 
                                  placeholder="exemplo@cinema.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500 font-medium" />
                </div>

                <div class="space-y-1.5 relative group">
                    <x-input-label for="password" :value="__('Password')" class="text-zinc-400 font-semibold text-xs uppercase tracking-wider ml-1 group-focus-within:text-red-400 transition-colors duration-300" />
                    <x-text-input id="password" 
                                  class="block w-full bg-black/60 border-zinc-800 text-white placeholder-zinc-600 rounded-xl px-4 py-3.5 focus:border-red-500 focus:ring focus:ring-red-500/10 transition-all duration-300 shadow-2xl group-hover:border-zinc-700 font-medium text-sm"
                                  type="password"
                                  name="password"
                                  required 
                                  placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500 font-medium" />
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" class="rounded bg-black border-zinc-800 text-red-600 focus:ring-red-500/20" name="remember">
                        <span class="ms-2 text-zinc-400 group-hover:text-zinc-200 transition-colors duration-300 font-medium">Manter sessão</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-zinc-500 hover:text-red-400 transition-colors duration-300 font-medium hover:underline" href="{{ route('password.request') }}">
                            {{ __('Esqueceu a senha?') }}
                        </a>
                    @endif
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-gradient-to-r from-red-600 via-red-700 to-amber-600 hover:from-red-500 hover:via-red-600 hover:to-amber-500 text-white font-bold py-4 px-4 rounded-xl shadow-xl shadow-red-950/50 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 text-center uppercase tracking-widest text-xs font-black">
                        {{ __('Iniciar Sessão') }}
                    </button>
                </div>
            </form>
        </div>

        <p class="absolute bottom-6 text-[10px] text-zinc-600 tracking-widest uppercase pointer-events-none">
            Powered by Tailwind & Laravel Breeze
        </p>
    </div>
</x-guest-layout>