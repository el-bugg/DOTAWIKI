<x-layout>
    <video id="heroVideo" autoplay muted loop class="hero-video-bg">
        <source src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/nevermore.webm" type="video/webm">
    </video>

    <div class="relative z-10 flex items-center justify-center min-h-[80vh]">
        <div class="w-full max-w-md p-8 rounded-xl bg-slate-950/70 backdrop-blur-md border border-slate-800 shadow-2xl">
            
            <div class="mb-6 text-center">
                <h2 class="text-3xl font-cinzel text-white font-bold tracking-wide drop-shadow-[0_0_10px_rgba(34,211,238,0.5)]">
                    Welcome Back
                </h2>
                <p class="text-slate-400 text-sm mt-2 font-roboto">
                    The battlefield misses your presence, <span id="heroName" class="text-cyan-400 font-bold">SHADOW FIEND</span>.
                </p>
            </div>

            <x-auth-session-status class="mb-4 text-cyan-400" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block font-cinzel text-[10px] text-cyan-500 uppercase tracking-widest mb-1">Email Codex</label>
                    <input class="w-full rounded glass-input px-4 py-3" 
                           type="email" name="email" :value="old('email')" required autofocus placeholder="Enter your email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs" />
                </div>

                <div>
                    <label class="block font-cinzel text-[10px] text-cyan-500 uppercase tracking-widest mb-1">Secret Key</label>
                    <input class="w-full rounded glass-input px-4 py-3" 
                           type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs" />
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" class="rounded bg-slate-800 border-slate-600 text-cyan-500 focus:ring-cyan-500" name="remember">
                        <span class="ml-2 text-slate-400">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-cyan-500 hover:text-cyan-300 transition-colors" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full py-3 rounded btn-neon uppercase tracking-[0.2em] text-sm font-bold mt-2">
                    Enter Realm
                </button>

                <div class="text-center mt-6">
                    <p class="text-slate-500 text-sm">New to the realm? 
                        <a href="{{ route('register') }}" class="text-cyan-400 hover:text-cyan-200 underline">Create Account</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            const heroes = [
                { name: "SHADOW FIEND", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/nevermore.webm" },
                { name: "CRYSTAL MAIDEN", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/crystal_maiden.webm" },
                { name: "JUGGERNAUT", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/juggernaut.webm" },
                { name: "STORM SPIRIT", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/storm_spirit.webm" },
                { name: "PHANTOM ASSASSIN", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/phantom_assassin.webm" },
                { name: "INVOKER", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/invoker.webm" },
                { name: "AXE", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/axe.webm" },
                { name: "LINA", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/lina.webm" },
                { name: "PUDGE", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/pudge.webm" },
                { name: "TERRORBLADE", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/terrorblade.webm" },
                { name: "VOID SPIRIT", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/void_spirit.webm" },
                { name: "MARCI", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/marci.webm" },
                { name: "DAWNBREAKER", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/dawnbreaker.webm" },
                { name: "ANTI-MAGE", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/antimage.webm" },
                { name: "EMBER SPIRIT", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/ember_spirit.webm" }
            ];
            heroes.sort(() => Math.random() - 0.5);
            let idx = 0;
            const v = document.getElementById('heroVideo');
            const n = document.getElementById('heroName');

            function playNext() {
                if(!v) return;
                idx = (idx + 1) % heroes.length;
                v.style.opacity = '0';
                setTimeout(() => {
                    v.src = heroes[idx].video;
                    if(n) n.innerText = heroes[idx].name;
                    v.play();
                    v.style.opacity = '0.4'; // Sesuai opacity awal CSS
                }, 800);
            }
            setInterval(playNext, 3000);
        </script>
    </x-slot>
</x-layout>