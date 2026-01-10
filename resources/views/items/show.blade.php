<x-layout>
    <x-slot:title>{{ $item->dname }} - Ancient Library</x-slot>

    <div class="relative min-h-screen pb-20 overflow-x-hidden !bg-[#050b14] !text-slate-300 !font-sans">
        
        <div class="fixed inset-0 pointer-events-none z-0">
            <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/backgrounds/bg_fog.jpg" 
                 class="absolute inset-0 w-full h-full object-cover opacity-20 mix-blend-lighten">
            <div class="absolute top-0 left-0 w-full h-1/2 bg-gradient-to-b from-cyan-900/20 to-transparent"></div>
        </div>

        <div class="relative z-10 pt-24 pb-12 border-b border-white/5 bg-gradient-to-b from-[#050b14]/90 to-[#050b14]/0">
            <div class="max-w-7xl mx-auto px-6 !flex !flex-col md:!flex-row !items-center !gap-8">
                
                <div class="relative group shrink-0">
                    <div class="absolute -inset-2 bg-cyan-500/30 rounded-full blur-xl opacity-50 group-hover:opacity-100 transition duration-700"></div>
                    <img src="{{ $item->img_url }}" class="relative w-32 h-auto md:w-40 rounded-lg shadow-2xl border border-white/10 z-10">
                </div>

                <div class="text-center md:text-left !w-full !flex-1">
                    <h4 class="!text-cyan-500 !font-bold !tracking-[0.2em] !text-xs !uppercase !mb-2">
                        Artifact Level 4
                    </h4>
                    <h1 class="!font-cinzel !text-4xl md:!text-6xl !font-black !text-white !uppercase !tracking-tighter !drop-shadow-2xl !mb-4 !leading-tight">
                        {{ $item->dname }}
                    </h1>
                    
                    <div class="!flex !flex-wrap !justify-center md:!justify-start !items-center !gap-3">
                        <div class="!inline-flex !items-center !gap-2 !px-4 !py-1.5 !bg-yellow-500/10 !border !border-yellow-500/30 !rounded-full">
                            <i class="fas fa-coins !text-yellow-500 text-sm"></i>
                            <span class="!text-yellow-500 !font-bold !font-mono !text-lg">{{ number_format($item->cost) }}</span>
                        </div>
                        
                        @if(isset($item->cooldown) && $item->cooldown)
                        <div class="!inline-flex !items-center !gap-2 !px-4 !py-1.5 !bg-slate-800 !border !border-white/10 !rounded-full">
                            <i class="fas fa-clock !text-slate-400 text-sm"></i>
                            <span class="!text-slate-300 !font-bold !text-sm">{{ is_array($item->cooldown) ? implode('/', $item->cooldown) : $item->cooldown }}s</span>
                        </div>
                        @endif

                        @if(isset($item->manacost) && $item->manacost)
                        <div class="!inline-flex !items-center !gap-2 !px-4 !py-1.5 !bg-blue-900/20 !border !border-blue-500/30 !rounded-full">
                            <div class="w-3 h-3 bg-blue-500 rounded-sm"></div>
                            <span class="!text-blue-400 !font-bold !text-sm">{{ is_array($item->manacost) ? implode('/', $item->manacost) : $item->manacost }} Mana</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="!mt-6 md:!mt-0 shrink-0">
                    <a href="{{ route('items.index') }}" 
                       class="!no-underline !inline-flex !items-center !gap-3 !px-8 !py-4 !bg-[#1e293b] !border !border-white/10 !rounded-xl hover:!bg-cyan-900/30 hover:!border-cyan-500 hover:!text-white !text-slate-400 !text-xs !font-black !tracking-[0.2em] !uppercase !transition-all !duration-300 !whitespace-nowrap shadow-lg">
                        <i class="fas fa-arrow-left"></i>
                        <span>Armory</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 mt-12">
            <div class="!grid !grid-cols-1 lg:!grid-cols-12 !gap-8">
                
                <div class="lg:!col-span-8 !space-y-8">
                    
                    <div class="!bg-[#10141d]/80 !backdrop-blur-md !border !border-white/5 !rounded-3xl !p-8 !shadow-2xl relative overflow-hidden group">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-500 via-blue-600 to-transparent"></div>
                        
                        @if($item->attrib)
                        <div class="!grid !grid-cols-2 md:!grid-cols-3 !gap-6 !mb-8 !pb-8 !border-b !border-white/5">
                            @foreach(explode('<br />', $item->attrib) as $stat)
                                @if(!empty(trim($stat)))
                                <div class="!flex !items-start !gap-3">
                                    <div class="mt-1.5 w-1.5 h-1.5 bg-cyan-400 rotate-45 shrink-0 shadow-[0_0_10px_cyan]"></div>
                                    <span class="!text-slate-300 !text-sm !font-medium !leading-relaxed">{!! strip_tags($stat) !!}</span>
                                </div>
                                @endif
                            @endforeach
                            @if($item->base_str) <div class="!text-slate-300 !font-bold text-sm">+{{ $item->base_str }} Strength</div> @endif
                            @if($item->base_agi) <div class="!text-slate-300 !font-bold text-sm">+{{ $item->base_agi }} Agility</div> @endif
                            @if($item->base_int) <div class="!text-slate-300 !font-bold text-sm">+{{ $item->base_int }} Intelligence</div> @endif
                        </div>
                        @endif

                        <div class="!space-y-6">
                            <h5 class="!text-slate-500 !text-[10px] !font-black !uppercase !tracking-[0.3em] !flex !items-center !gap-4">
                                <span class="h-px w-8 bg-slate-700"></span>
                                Mechanics
                            </h5>
                            <div class="item-modern-desc !text-slate-300 !text-base !leading-8 !font-light">
                                {!! $item->desc !!}
                            </div>
                        </div>

                        @if($item->lore)
                        <div class="!mt-8 !pt-8 !border-t !border-white/5 !flex !gap-4">
                            <div class="w-1 bg-purple-500/50 rounded-full"></div>
                            <p class="!text-slate-500 !italic !font-serif !text-lg !leading-relaxed">"{!! $item->lore !!}"</p>
                        </div>
                        @endif
                    </div>

                    <div class="!bg-[#10141d]/80 !backdrop-blur-md !border !border-white/5 !rounded-3xl !p-8">
                        <div class="!flex !justify-between !items-center !mb-8">
                            <div>
                                <h3 class="!font-cinzel !text-2xl !text-white !font-bold !flex !items-center !gap-3">
                                    <i class="fas fa-users text-cyan-500"></i> Community Insight
                                </h3>
                                <p class="!text-slate-500 !text-xs !mt-1">Recommended heroes based on {{ number_format(rand(1000, 5000)) }} votes</p>
                            </div>
                            <button class="!px-5 !py-2 !bg-cyan-600/10 hover:!bg-cyan-600 !text-cyan-400 hover:!text-white !border !border-cyan-500/30 !rounded-full !text-[10px] !font-black !uppercase !tracking-wider !transition-all">
                                <i class="fas fa-plus mr-1"></i> Vote
                            </button>
                        </div>

                        <div class="!grid !grid-cols-2 sm:!grid-cols-4 md:!grid-cols-5 !gap-4">
                            @php
                                $heroes = [
                                    ['name' => 'Anti-Mage', 'img' => 'antimage', 'wr' => '54%'],
                                    ['name' => 'Juggernaut', 'img' => 'juggernaut', 'wr' => '51%'],
                                    ['name' => 'P. Assassin', 'img' => 'phantom_assassin', 'wr' => '49%'],
                                    ['name' => 'Slark', 'img' => 'slark', 'wr' => '52%'],
                                    ['name' => 'Faceless Void', 'img' => 'faceless_void', 'wr' => '48%'],
                                ];
                            @endphp

                            @foreach($heroes as $h)
                            <div class="group relative bg-slate-900 border border-white/5 rounded-xl overflow-hidden hover:border-cyan-500/50 transition-all cursor-pointer">
                                <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/heroes/{{ $h['img'] }}.png" class="w-full h-24 object-cover group-hover:scale-110 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                                <div class="absolute bottom-0 left-0 w-full p-3">
                                    <p class="text-white text-[10px] font-bold uppercase truncate">{{ $h['name'] }}</p>
                                    <p class="text-green-400 text-[10px] font-mono">{{ $h['wr'] }} WR</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:!col-span-4 !space-y-6">
                    
                    <div class="!bg-[#0f1218] !border !border-white/10 !rounded-3xl !overflow-hidden !shadow-xl">
                        <div class="!px-6 !py-4 !bg-[#151a23] !border-b !border-white/5 !text-center">
                            <span class="!text-[10px] !font-black !text-slate-400 !uppercase !tracking-[0.3em]">Build Hierarchy</span>
                        </div>
                        
                        <div class="!p-8 !flex !flex-col !items-center !gap-6 relative">
                            <div class="absolute inset-0 flex justify-center pointer-events-none">
                                <div class="w-px h-full bg-gradient-to-b from-transparent via-white/10 to-transparent"></div>
                            </div>

                            <div class="relative z-10">
                                <div class="p-1 bg-cyan-500/20 rounded-lg border border-cyan-500 shadow-[0_0_20px_rgba(6,182,212,0.3)]">
                                    <img src="{{ $item->img_url }}" class="w-20 rounded">
                                </div>
                            </div>

                            <i class="fas fa-chevron-up text-slate-600 relative z-10"></i>

                            <div class="relative z-10 !flex !flex-wrap !justify-center !gap-3">
                                @if($item->components && count($item->components) > 0)
                                    @foreach($item->components as $comp)
                                    <div class="w-12 h-9 bg-slate-800 border border-white/10 rounded hover:border-white hover:scale-110 transition cursor-help shadow-lg" title="{{ $comp }}">
                                        <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/items/{{ $comp }}.png" class="w-full h-full object-cover rounded-sm">
                                    </div>
                                    @endforeach
                                @else
                                    <span class="text-[10px] text-slate-600 font-bold uppercase bg-black/30 px-3 py-1 rounded">Base Item</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="!px-6 !py-3 !bg-[#151a23] !border-t !border-white/5 !text-center">
                            <p class="!text-[10px] !text-slate-500">Total Cost: <span class="!text-yellow-500 !font-bold">{{ number_format($item->cost) }}</span></p>
                        </div>
                    </div>

                    <div class="!bg-gradient-to-b !from-slate-800 !to-slate-900 !border !border-white/5 !rounded-3xl !p-6 !shadow-xl">
                        <h5 class="!text-white !font-cinzel !text-xs !font-bold !tracking-widest !mb-4">Recent Guides</h5>
                        <div class="!space-y-3">
                            @forelse($communityGuides->take(3) as $guide)
                                <a href="#" class="!block !p-4 !bg-black/20 !rounded-xl !border !border-white/5 hover:!bg-white/5 hover:!border-cyan-500/30 !transition-all group !no-underline">
                                    <h6 class="!text-slate-200 !font-bold !text-sm !mb-1 group-hover:!text-cyan-400">{{ $guide->title }}</h6>
                                    <div class="!flex !items-center !gap-2">
                                        <div class="w-4 h-4 rounded-full bg-slate-700"></div>
                                        <span class="!text-[10px] !text-slate-500 !font-bold !uppercase">{{ $guide->user->name }}</span>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center py-6 opacity-50">
                                    <i class="fas fa-book-open text-2xl mb-2"></i>
                                    <p class="text-[10px]">No guides available yet.</p>
                                </div>
                            @endforelse
                        </div>
                        <a href="{{ route('community.index') }}" class="!mt-4 !block !w-full !py-3 !bg-white/5 hover:!bg-white/10 !text-center !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-white !rounded-xl !transition !no-underline">
                            Open Strategy Hub
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .item-modern-desc b { color: white !important; font-weight: 700 !important; }
        .font-cinzel { font-family: 'Cinzel', serif !important; }
    </style>
</x-layout>