<x-layout>
    <video id="heroVideo" autoplay muted loop class="hero-video-bg">
        <source src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/nevermore.webm" type="video/webm">
    </video>

    <div class="relative z-10 flex items-center justify-center min-h-[85vh] py-10">
        <div class="w-full max-w-md p-8 rounded-xl bg-slate-950/70 backdrop-blur-md border border-slate-800 shadow-2xl">
            
            <div class="mb-6 text-center">
                <h2 class="text-3xl font-cinzel text-white font-bold tracking-wide drop-shadow-[0_0_10px_rgba(34,211,238,0.5)]">
                    Join the Ranks
                </h2>
                <p class="text-slate-400 text-sm mt-2 font-roboto">
                    Begin your legacy in the Frozen Realm, <span id="heroName" class="text-cyan-400 font-bold">SHADOW FIEND</span>.
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block font-cinzel text-[10px] text-cyan-500 uppercase tracking-widest mb-1">Hero Name</label>
                    <input class="w-full rounded glass-input px-4 py-3 placeholder-slate-600" 
                           type="text" name="name" :value="old('name')" required autofocus placeholder="Your Display Name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-xs" />
                </div>

                <div>
                    <label class="block font-cinzel text-[10px] text-cyan-500 uppercase tracking-widest mb-1">Email Codex</label>
                    <input class="w-full rounded glass-input px-4 py-3 placeholder-slate-600" 
                           type="email" name="email" :value="old('email')" required placeholder="email@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs" />
                </div>

                <div>
                    <label class="block font-cinzel text-[10px] text-cyan-500 uppercase tracking-widest mb-1">Secret Key</label>
                    <input class="w-full rounded glass-input px-4 py-3 placeholder-slate-600" 
                           type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs" />
                </div>

                <div>
                    <label class="block font-cinzel text-[10px] text-cyan-500 uppercase tracking-widest mb-1">Confirm Secret Key</label>
                    <input class="w-full rounded glass-input px-4 py-3 placeholder-slate-600" 
                           type="password" name="password_confirmation" required placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400 text-xs" />
                </div>

                <button type="submit" class="w-full py-3 rounded btn-neon uppercase tracking-[0.2em] text-sm font-bold mt-4 transition-all">
                    Register Account
                </button>

                <div class="text-center mt-6">
                    <p class="text-slate-500 text-sm">Already a hero? 
                        <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-200 underline">Login Here</a>
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