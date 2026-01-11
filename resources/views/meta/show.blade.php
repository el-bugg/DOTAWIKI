<x-layout>
    <x-slot:title>{{ $hero->name_localized }} Details - Frozen Wiki</x-slot>

    <div class="hero-navigation">
        <a href="{{ route('heroes.show', $prevHero->id) }}" class="nav-arrow prev-arrow text-decoration-none">
            <div class="nav-content">
                <img src="{{ $prevHero->icon_url }}" class="nav-img">
                <span class="text-[10px] text-white font-cinzel">PREVIOUS</span>
            </div>
            <i class="fas fa-chevron-left text-cyan-400"></i>
        </a>
        <a href="{{ route('heroes.show', $nextHero->id) }}" class="nav-arrow next-arrow text-decoration-none">
            <i class="fas fa-chevron-right text-cyan-400"></i>
            <div class="nav-content">
                <img src="{{ $nextHero->icon_url }}" class="nav-img">
                <span class="text-[10px] text-white font-cinzel">NEXT</span>
            </div>
        </a>
    </div>

    <div class="position-relative vh-100 overflow-hidden bg-black flex items-center justify-center">
        <video id="heroVideo" autoplay muted loop class="hero-video-bg opacity-40">
            <source src="{{ $hero->video_render_url }}" type="video/webm">
        </video>
        
        <div class="position-absolute bottom-0 start-0 w-100 p-10 bg-gradient-to-t from-[#050b14] to-transparent z-10">
            <div class="container">
                <h1 class="display-1 frozen-text mb-0" data-text="{{ strtoupper($hero->name_localized) }}">
                    {{ strtoupper($hero->name_localized) }}
                </h1>
                <div class="flex items-center gap-4 mt-2">
                    <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/icons/primary_attribute_{{ $hero->primary_attr }}.png" width="30">
                    <span class="text-cyan-400 font-cinzel tracking-[0.3em]">{{ strtoupper($hero->attack_type) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-10 relative z-10">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="glass-panel p-6">
                    <h4 class="font-cinzel text-white border-bottom border-slate-700 pb-3 mb-4">ATTRIBUTES</h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400">Strength</span>
                            <span class="text-red-500 font-bold">{{ $hero->base_str }} <small class="text-slate-500">+{{ $hero->str_gain }}</small></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400">Agility</span>
                            <span class="text-green-500 font-bold">{{ $hero->base_agi }} <small class="text-slate-500">+{{ $hero->agi_gain }}</small></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400">Intelligence</span>
                            <span class="text-cyan-500 font-bold">{{ $hero->base_int }} <small class="text-slate-500">+{{ $hero->int_gain }}</small></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="glass-panel p-6">
                    <h4 class="font-cinzel text-white mb-6">ABILITIES</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($hero->abilities as $ability)
                        <div class="flex gap-4 p-3 rounded bg-black/40 border border-slate-800 hover:border-cyan-500/50 transition-all">
                            <img src="{{ $ability->img_url }}" class="w-16 h-16 rounded shadow-lg border border-slate-700">
                            <div>
                                <h6 class="text-cyan-400 font-bold mb-1">{{ $ability->name }}</h6>
                                <p class="text-xs text-slate-400 leading-relaxed">{{ $ability->description }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>