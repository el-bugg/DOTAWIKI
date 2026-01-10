<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Frozen Wiki') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cinzel:400,700|roboto:300,400,500,700&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        cinzel: ['Cinzel', 'serif'],
                        roboto: ['Roboto', 'sans-serif'],
                    },
                    animation: {
                        'fog-flow': 'fogFlow 20s linear infinite',
                    },
                    keyframes: {
                        fogFlow: {
                            '0%': { transform: 'translateX(-10%)' },
                            '50%': { transform: 'translateX(10%)' },
                            '100%': { transform: 'translateX(-10%)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #050b14; color: #e0f2fe; }
        
        /* Glass Input Style */
        .glass-input {
            background: rgba(15, 23, 42, 0.6) !important;
            border: 1px solid rgba(34, 211, 238, 0.2) !important;
            color: white !important;
            transition: all 0.3s ease;
        }
        .glass-input:focus {
            background: rgba(5, 11, 20, 0.9) !important;
            border-color: #22d3ee !important;
            box-shadow: 0 0 15px rgba(34, 211, 238, 0.3);
            outline: none;
        }

        /* Neon Button Style */
        .btn-neon {
            background: linear-gradient(90deg, #0891b2, #22d3ee);
            color: #050b14;
            font-family: 'Cinzel', serif;
            font-weight: bold;
            box-shadow: 0 0 15px rgba(34, 211, 238, 0.3);
            transition: all 0.3s ease;
        }
        .btn-neon:hover {
            box-shadow: 0 0 25px rgba(34, 211, 238, 0.6);
            filter: brightness(1.1);
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="antialiased h-screen w-full flex overflow-hidden bg-[#050b14]">

    <div class="w-full md:w-[40%] lg:w-[35%] h-full bg-[#050b14] flex flex-col relative z-20 border-r border-cyan-900/30 shadow-[10px_0_50px_rgba(0,0,0,0.8)]">
        
        <div class="absolute top-6 left-8 flex items-center gap-3">
            <div class="w-3 h-3 rounded-full bg-cyan-400 shadow-[0_0_15px_#22d3ee] animate-pulse"></div>
            <h1 class="font-cinzel text-lg tracking-[0.2em] text-white uppercase font-bold">
                FROZEN <span class="text-cyan-400">WIKI</span>
            </h1>
        </div>

        <div class="flex-1 flex flex-col justify-center px-8 sm:px-12 overflow-y-auto custom-scrollbar">
            {{ $slot }}
        </div>

        <div class="py-4 text-center text-[10px] text-slate-600 font-cinzel tracking-wider uppercase">
            &copy; {{ date('Y') }} Frozen Wiki Realm.
        </div>
    </div>

    <div class="hidden md:flex md:w-[60%] lg:w-[65%] h-full relative bg-black items-center justify-center overflow-hidden">
        
        <video id="heroVideo" autoplay muted loop playsinline 
            class="absolute inset-0 w-full h-full object-cover transition-all duration-1000 opacity-100 transform scale-105">
            <source src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/nevermore.webm" type="video/webm">
        </video>

        <div class="absolute inset-0 bg-cyan-900/20 mix-blend-multiply z-10"></div>

        <div class="absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#050b14] via-[#050b14]/80 to-transparent z-20"></div>

        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-[#050b14] via-[#050b14]/60 to-transparent z-20"></div>

        <div class="absolute bottom-16 right-16 text-right z-30">
            <h2 class="font-cinzel text-5xl lg:text-6xl text-white tracking-[0.1em] drop-shadow-[0_4px_10px_rgba(0,0,0,1)] leading-tight opacity-90">
                THE ANCIENTS<br>AWAIT YOU.
            </h2>
            <div class="mt-4 flex justify-end items-center gap-3">
                <div class="h-[1px] w-20 bg-cyan-400 shadow-[0_0_10px_cyan]"></div>
                <p id="heroName" class="text-cyan-400 text-sm font-bold tracking-[0.3em] uppercase animate-pulse shadow-cyan-500">
                    SHADOW FIEND
                </p>
            </div>
        </div>
    </div>

    <script>
        const heroes = [
            { name: "SHADOW FIEND", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/nevermore.webm" },
            { name: "CRYSTAL MAIDEN", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/crystal_maiden.webm" },
            { name: "JUGGERNAUT", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/juggernaut.webm" },
            { name: "STORM SPIRIT", video: "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/storm_spirit.webm" }
        ];
        let idx = 0;
        const v = document.getElementById('heroVideo');
        const n = document.getElementById('heroName');

        function playNext() {
            idx = (idx + 1) % heroes.length;
            v.style.opacity = '0'; // Fade out
            setTimeout(() => {
                v.src = heroes[idx].video;
                n.innerText = heroes[idx].name;
                v.play();
                v.style.opacity = '1'; // Fade in
            }, 800);
        }
        setInterval(playNext, 8000);
    </script>
</body>
</html>