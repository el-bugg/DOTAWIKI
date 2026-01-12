<x-layout>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <div class="min-h-screen bg-[#050b14] bg-[url('https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/backgrounds/bg_fog.jpg')] bg-fixed bg-cover bg-top text-[#cceeff] font-roboto selection:bg-[#00d9ff] selection:text-black">
        
        <div class="fixed top-0 left-0 w-[500px] h-[500px] bg-[#00d9ff]/10 rounded-full blur-[120px] pointer-events-none mix-blend-screen"></div>
        <div class="fixed bottom-0 right-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none mix-blend-screen"></div>

        <x-slot name="header">
            <h2 class="frozen-text text-3xl md:text-4xl font-bold tracking-widest text-center md:text-left drop-shadow-[0_0_10px_rgba(0,217,255,0.3)]" data-text="COMMUNITY DASHBOARD">
                {{ __('Community Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <aside class="hidden lg:block lg:col-span-1 space-y-6">
                    <div class="glass-panel p-6 relative group transition-all duration-500 hover:border-[#00d9ff]/50 border border-[#466d85]/30 bg-[#0b1116]/60 backdrop-blur-md rounded-xl">
                        <div class="absolute top-8 left-1/2 -translate-x-1/2 w-24 h-24 bg-[#00d9ff] rounded-full blur-[40px] opacity-10 group-hover:opacity-30 transition duration-500"></div>

                        <div class="flex flex-col items-center text-center relative z-10">
                            <div class="relative inline-block mb-4">
                                <div class="absolute inset-0 rounded-full border border-[#00d9ff]/30 animate-pulse"></div>
                                <img src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : 'https://api.dicebear.com/7.x/avataaars/svg?seed='.Auth::user()->name }}" 
                                     class="relative w-24 h-24 rounded-full border-2 border-[#466d85] shadow-[0_0_20px_rgba(0,217,255,0.15)] object-cover ring-4 ring-black/30 group-hover:scale-105 transition duration-500">
                                <span class="absolute bottom-1 right-1 w-3.5 h-3.5 bg-green-500 border-2 border-black rounded-full shadow-[0_0_8px_rgba(34,197,94,0.8)]"></span>
                            </div>
                            
                            <h2 class="font-cinzel text-xl text-white font-bold mb-1 tracking-wider text-shadow-[0_2px_10px_rgba(0,217,255,0.4)]">
                                {{ Auth::user()->name }}
                            </h2>
                            <p class="text-[#88aabb] text-[10px] mb-5 font-mono uppercase tracking-widest bg-black/40 px-3 py-1 rounded border border-[#466d85]/30">
                                {{ '@' . strtolower(str_replace(' ', '', Auth::user()->name)) }}
                            </p>
                            
                            <div class="flex justify-center gap-0 w-full mb-5 bg-[#050b14]/50 rounded-lg border border-[#466d85]/30 overflow-hidden">
                                <div class="text-center w-1/2 py-2 border-r border-[#466d85]/30 hover:bg-[#00d9ff]/5 transition cursor-default">
                                    <span class="block text-lg font-bold text-white font-cinzel">{{ Auth::user()->followers()->count() }}</span>
                                    <span class="text-[9px] text-[#00d9ff] uppercase tracking-widest font-bold">Followers</span>
                                </div>
                                <div class="text-center w-1/2 py-2 hover:bg-[#00d9ff]/5 transition cursor-default">
                                    <span class="block text-lg font-bold text-white font-cinzel">{{ Auth::user()->following()->count() }}</span>
                                    <span class="text-[9px] text-[#00d9ff] uppercase tracking-widest font-bold">Following</span>
                                </div>
                            </div>

                            <a href="{{ route('profile.show', Auth::user()->id) }}" 
                               class="w-full block py-2 px-4 rounded-lg bg-gradient-to-r from-[#0b1116] to-[#162032] border border-[#00d9ff]/30 text-[#00d9ff] text-[10px] font-bold uppercase tracking-[2px] hover:bg-[#00d9ff] hover:text-black hover:shadow-[0_0_15px_rgba(0,217,255,0.4)] transition-all duration-300 font-cinzel text-center mb-4">
                                View Profile
                            </a>

                            <div class="flex justify-center border-t border-[#466d85]/30 pt-4 w-full">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-white transition-all flex items-center gap-2 group" title="Keluar dari Akun">
                                        <span class="text-[10px] hidden group-hover:inline uppercase font-bold tracking-widest font-cinzel">Logout</span>
                                        <i class="fas fa-sign-out-alt text-xl group-hover:rotate-180 transition duration-500"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="glass-panel p-6 sticky top-24 border border-[#466d85]/30 bg-[#0b1116]/60 backdrop-blur-md rounded-xl">
                        <h4 class="font-cinzel text-[#00d9ff] text-xs font-bold mb-4 border-b border-[#466d85]/30 pb-3 tracking-[3px] opacity-80">
                            NAVIGATION
                        </h4>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('community.index') }}" 
                                   class="flex items-center p-2.5 rounded-lg transition-all duration-300 group {{ !request('category') && !request('filter') ? 'bg-[#00d9ff]/10 text-white border border-[#00d9ff]/30 shadow-[0_0_10px_rgba(0,217,255,0.1)]' : 'text-[#88aabb] hover:bg-white/5 hover:text-white border border-transparent' }}">
                                    <span class="w-8 text-center text-lg {{ !request('category') && !request('filter') ? 'text-[#00d9ff]' : 'text-[#466d85] group-hover:text-[#00d9ff]' }} transition bg-transparent"><i class="fas fa-globe"></i></span> 
                                    <span class="font-cinzel text-xs font-bold tracking-wider">All Posts</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('community.index', ['filter' => 'trending']) }}" 
                                   class="flex items-center p-2.5 rounded-lg transition-all duration-300 group {{ request('filter') == 'trending' ? 'bg-[#00d9ff]/10 text-white border border-[#00d9ff]/30 shadow-[0_0_10px_rgba(0,217,255,0.1)]' : 'text-[#88aabb] hover:bg-white/5 hover:text-white border border-transparent' }}">
                                    <span class="w-8 text-center text-lg {{ request('filter') == 'trending' ? 'text-orange-400' : 'text-[#466d85] group-hover:text-orange-400' }} transition bg-transparent">🔥</span> 
                                    <span class="font-cinzel text-xs font-bold tracking-wider">Trending</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('community.index', ['category' => 'hero_build']) }}" 
                                   class="flex items-center p-2.5 rounded-lg transition-all duration-300 group {{ request('category') == 'hero_build' ? 'bg-[#00d9ff]/10 text-white border border-[#00d9ff]/30 shadow-[0_0_10px_rgba(0,217,255,0.1)]' : 'text-[#88aabb] hover:bg-white/5 hover:text-white border border-transparent' }}">
                                    <span class="w-8 text-center text-lg {{ request('category') == 'hero_build' ? 'text-purple-400' : 'text-[#466d85] group-hover:text-purple-400' }} transition bg-transparent">⚔️</span> 
                                    <span class="font-cinzel text-xs font-bold tracking-wider">Hero Guide</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('community.index', ['category' => 'item_build']) }}" 
                                   class="flex items-center p-2.5 rounded-lg transition-all duration-300 group {{ request('category') == 'item_build' ? 'bg-[#00d9ff]/10 text-white border border-[#00d9ff]/30 shadow-[0_0_10px_rgba(0,217,255,0.1)]' : 'text-[#88aabb] hover:bg-white/5 hover:text-white border border-transparent' }}">
                                    <span class="w-8 text-center text-lg {{ request('category') == 'item_build' ? 'text-yellow-400' : 'text-[#466d85] group-hover:text-yellow-400' }} transition bg-transparent">💎</span> 
                                    <span class="font-cinzel text-xs font-bold tracking-wider">Item Guide</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>

                <main class="lg:col-span-3 space-y-8">
                    
                    <div class="glass-panel p-6 relative z-10 border border-[#466d85]/30 bg-[#0b1116]/80 backdrop-blur-xl rounded-xl shadow-[0_0_30px_rgba(0,0,0,0.5)]" 
                         x-data="{ tab: 'status' }">
                        
                        <div class="flex gap-2 mb-6 border-b border-[#466d85]/30 pb-0 overflow-x-auto no-scrollbar">
                            <button type="button" @click="tab = 'status'" 
                                :class="tab === 'status' ? 'text-[#00d9ff] border-[#00d9ff] bg-[#00d9ff]/10' : 'text-[#88aabb] border-transparent hover:text-white hover:bg-white/5 bg-transparent'" 
                                class="px-5 py-3 border-b-2 transition-all duration-300 whitespace-nowrap text-xs font-bold tracking-widest font-cinzel rounded-t-lg flex items-center gap-2">
                                📝 Status
                            </button>
                            <button type="button" @click="tab = 'match'" 
                                :class="tab === 'match' ? 'text-[#00d9ff] border-[#00d9ff] bg-[#00d9ff]/10' : 'text-[#88aabb] border-transparent hover:text-white hover:bg-white/5 bg-transparent'" 
                                class="px-5 py-3 border-b-2 transition-all duration-300 whitespace-nowrap text-xs font-bold tracking-widest font-cinzel rounded-t-lg flex items-center gap-2">
                                🎮 Match
                            </button>
                            <button type="button" @click="tab = 'item_build'" 
                                :class="tab === 'item_build' ? 'text-[#00d9ff] border-[#00d9ff] bg-[#00d9ff]/10' : 'text-[#88aabb] border-transparent hover:text-white hover:bg-white/5 bg-transparent'" 
                                class="px-5 py-3 border-b-2 transition-all duration-300 whitespace-nowrap text-xs font-bold tracking-widest font-cinzel rounded-t-lg flex items-center gap-2">
                                💎 Items
                            </button>
                            <button type="button" @click="tab = 'hero_build'" 
                                :class="tab === 'hero_build' ? 'text-[#00d9ff] border-[#00d9ff] bg-[#00d9ff]/10' : 'text-[#88aabb] border-transparent hover:text-white hover:bg-white/5 bg-transparent'" 
                                class="px-5 py-3 border-b-2 transition-all duration-300 whitespace-nowrap text-xs font-bold tracking-widest font-cinzel rounded-t-lg flex items-center gap-2">
                                ⚔️ Strategy
                            </button>
                        </div>

                        <div x-show="tab === 'status'" x-transition.opacity>
                            @include('community.partials.form-status')
                        </div>

                        <div x-show="tab === 'match'" x-transition.opacity style="display: none;">
                            @include('community.partials.form-match')
                        </div>

                        <div x-show="tab === 'item_build'" x-transition.opacity style="display: none;">
                            @include('community.partials.form-build')
                        </div>

                        <div x-show="tab === 'hero_build'" x-transition.opacity style="display: none;">
                            @include('community.partials.form-build')
                        </div>

                    </div>

                    <div class="space-y-6">
                        @forelse($posts as $post)
                            <div class="glass-panel p-6 relative group border border-[#466d85]/30 bg-[#0b1116]/60 backdrop-blur-md rounded-xl hover:border-[#00d9ff]/40 transition-all duration-300">
                                
                                <div class="flex justify-between items-start mb-5">
                                    <div class="flex gap-4">
                                        <a href="{{ route('profile.show', $post->user->id) }}" class="relative">
                                            <img src="{{ $post->user->avatar ? asset('storage/'.$post->user->avatar) : 'https://api.dicebear.com/7.x/avataaars/svg?seed='.$post->user->name }}" class="w-11 h-11 rounded-full border-2 border-[#466d85] object-cover shadow-lg">
                                            <div class="absolute inset-0 rounded-full hover:ring-2 hover:ring-[#00d9ff] transition duration-300"></div>
                                        </a>
                                        <div>
                                            <a href="{{ route('profile.show', $post->user->id) }}" class="text-white font-bold hover:text-[#00d9ff] hover:drop-shadow-[0_0_5px_rgba(0,217,255,0.8)] transition-all text-sm block font-cinzel tracking-wider">{{ $post->user->name }}</a>
                                            <div class="flex items-center gap-3 mt-1">
                                                <span class="text-[10px] text-[#88aabb] uppercase tracking-wide">{{ $post->created_at->diffForHumans() }}</span>
                                                @if($post->category == 'hero_build')
                                                    <span class="text-[9px] px-2 py-0.5 rounded-full bg-purple-500/10 text-purple-300 border border-purple-500/30 uppercase tracking-wider font-bold">Strategy</span>
                                                @elseif($post->category == 'item_build')
                                                    <span class="text-[9px] px-2 py-0.5 rounded-full bg-yellow-500/10 text-yellow-300 border border-yellow-500/30 uppercase tracking-wider font-bold">Guide</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if(Auth::id() === $post->user_id)
                                        <form action="{{ route('post.destroy', $post) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                            @csrf @method('DELETE')
                                            <button class="bg-transparent text-[#466d85] hover:text-red-500 transition-colors p-2 rounded-full border-none outline-none shadow-none">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                @if($post->category === 'match_result' && !empty($post->match_data))
                                    @php $match = $post->match_data; $isWin = ($match['result'] ?? '') == 'Win'; @endphp
                                    <div class="mb-5 p-0 rounded-lg border-l-4 {{ $isWin ? 'border-l-green-500' : 'border-l-red-500' }} relative overflow-hidden bg-gradient-to-r from-[#050b14] to-transparent border border-[#466d85]/20">
                                        <div class="p-4 relative z-10 flex justify-between items-center">
                                            <div>
                                                <h3 class="font-cinzel font-bold text-xl tracking-widest {{ $isWin ? 'text-green-400 drop-shadow-[0_0_8px_rgba(74,222,128,0.4)]' : 'text-red-400 drop-shadow-[0_0_8px_rgba(248,113,113,0.4)]' }}">
                                                    {{ $match['result'] ?? 'MATCH RESULT' }}
                                                </h3>
                                                <p class="text-[#88aabb] text-xs mt-1 uppercase tracking-wide">Playing as <strong class="text-white ml-1">{{ $match['hero_name'] ?? 'Unknown' }}</strong></p>
                                            </div>
                                            <div class="text-right bg-black/30 px-4 py-2 rounded border border-white/5">
                                                <span class="block text-2xl font-bold text-white tracking-tighter font-mono">{{ $match['kda'] ?? '-/-/-' }}</span>
                                                <span class="text-[9px] uppercase text-[#466d85] font-bold tracking-[2px]">KDA Ratio</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(($post->category === 'item_build' || $post->category === 'hero_build') && isset($post->recommended_items))
                                    <div class="mb-5 bg-[#050b14]/50 border border-[#466d85]/30 rounded-lg p-4 relative overflow-hidden">
                                        <div class="flex items-center gap-3 mb-4 border-b border-[#466d85]/30 pb-3">
                                            <div class="text-[#00d9ff] text-xl bg-transparent">
                                                <i class="fas fa-shield-alt"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-[#cceeff] font-bold text-xs font-cinzel tracking-wider">{{ $post->category == 'hero_build' ? 'HERO STRATEGY' : 'RECOMMENDED BUILD' }}</h3>
                                                @php $targetHero = $heroes->firstWhere('id', $post->hero_id); @endphp
                                                <p class="text-[10px] text-[#466d85] uppercase tracking-widest">Target Hero: {{ $targetHero ? $targetHero->name : 'Unknown' }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-wrap gap-2">
                                           @if(is_array($post->recommended_items))
                                                @foreach($post->recommended_items as $itemId)
                                                    @if($itemId)
                                                        @php 
                                                            $itemDetail = $items->firstWhere('id', $itemId); 
                                                        @endphp
                                                        @if($itemDetail)
                                                            <div class="w-10 h-10 rounded border border-[#466d85]/50 bg-black/50 overflow-hidden relative group/item" title="{{ $itemDetail->name }}">
                                                                <img src="{{ asset('storage/' . $itemDetail->image) }}" class="w-full h-full object-cover">
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                           @endif
                                        </div>
                                    </div>
                                @endif

                                <div class="text-[#cceeff] mb-5 text-sm leading-7 font-light tracking-wide whitespace-pre-wrap">{{ $post->content }}</div>

                                @if($post->image)
                                    <div class="rounded-lg overflow-hidden border border-[#466d85]/30 mb-5 bg-[#050b14] relative group/media">
                                        @if(Str::endsWith($post->image, ['.mp4', '.mov', '.avi']))
                                            <video controls class="w-full">
                                                <source src="{{ asset('storage/' . $post->image) }}" type="video/mp4">
                                            </video>
                                        @else
                                            <img src="{{ asset('storage/' . $post->image) }}" class="w-full object-cover opacity-90 group-hover/media:opacity-100 group-hover/media:scale-[1.01] transition duration-700">
                                            <div class="absolute inset-0 bg-gradient-to-t from-[#050b14] via-transparent to-transparent opacity-60"></div>
                                        @endif
                                    </div>
                                @endif

                                <div class="flex gap-6 border-t border-[#466d85]/20 pt-4">
                                    <form action="{{ route('post.like', $post) }}" method="POST">
                                        @csrf
                                        <button class="bg-transparent flex items-center gap-2 text-xs font-bold uppercase tracking-wider {{ $post->isLikedByAuthUser() ? 'text-[#00d9ff] drop-shadow-[0_0_5px_rgba(0,217,255,0.8)]' : 'text-[#88aabb] hover:text-white' }} transition duration-300 border-none outline-none shadow-none">
                                            <i class="{{ $post->isLikedByAuthUser() ? 'fas' : 'far' }} fa-heart text-lg bg-transparent"></i> 
                                            <span>{{ $post->likes_count }}</span>
                                        </button>
                                    </form>
                                    
                                    <button class="bg-transparent flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#88aabb] hover:text-[#00d9ff] transition duration-300 border-none outline-none shadow-none">
                                        <i class="far fa-comment-alt text-lg bg-transparent"></i> 
                                        <span>{{ $post->comments_count ?? 0 }}</span>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="glass-panel p-16 text-center border border-dashed border-[#466d85]/30 rounded-xl bg-[#0b1116]/40">
                                <div class="text-5xl mb-4 opacity-30 grayscale">📜</div>
                                <h3 class="text-xl text-white font-cinzel font-bold mb-2 tracking-widest">THE REALM IS SILENT</h3>
                                <p class="text-[#88aabb] text-xs font-mono uppercase tracking-widest">Be the first to break the ice.</p>
                            </div>
                        @endforelse
                    </div>

                </main>
            </div>
        </div>
    </div>
</x-layout>