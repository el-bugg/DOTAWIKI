<x-layout>
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
                    
                    <div class="glass-panel p-6 relative z-10 border border-[#466d85]/30 bg-[#0b1116]/80 backdrop-blur-xl rounded-xl shadow-[0_0_30px_rgba(0,0,0,0.5)]" x-data="{ tab: 'status', fileName: null }">
                        
                        <div class="flex gap-2 mb-6 border-b border-[#466d85]/30 pb-0 overflow-x-auto no-scrollbar">
                            <button type="button" @click="tab = 'status'" 
                                :class="tab === 'status' ? 'text-[#00d9ff] border-[#00d9ff] bg-[#00d9ff]/10' : 'text-[#88aabb] border-transparent hover:text-white hover:bg-white/5 bg-transparent'" 
                                class="px-5 py-3 border-b-2 transition-all duration-300 whitespace-nowrap text-xs font-bold tracking-widest font-cinzel rounded-t-lg">
                                📝 Status
                            </button>
                            <button type="button" @click="tab = 'match'" 
                                :class="tab === 'match' ? 'text-[#00d9ff] border-[#00d9ff] bg-[#00d9ff]/10' : 'text-[#88aabb] border-transparent hover:text-white hover:bg-white/5 bg-transparent'" 
                                class="px-5 py-3 border-b-2 transition-all duration-300 whitespace-nowrap text-xs font-bold tracking-widest font-cinzel rounded-t-lg">
                                🎮 Match
                            </button>
                            <button type="button" @click="tab = 'item_build'" 
                                :class="tab === 'item_build' ? 'text-[#00d9ff] border-[#00d9ff] bg-[#00d9ff]/10' : 'text-[#88aabb] border-transparent hover:text-white hover:bg-white/5 bg-transparent'" 
                                class="px-5 py-3 border-b-2 transition-all duration-300 whitespace-nowrap text-xs font-bold tracking-widest font-cinzel rounded-t-lg">
                                💎 Items
                            </button>
                            <button type="button" @click="tab = 'hero_build'" 
                                :class="tab === 'hero_build' ? 'text-[#00d9ff] border-[#00d9ff] bg-[#00d9ff]/10' : 'text-[#88aabb] border-transparent hover:text-white hover:bg-white/5 bg-transparent'" 
                                class="px-5 py-3 border-b-2 transition-all duration-300 whitespace-nowrap text-xs font-bold tracking-widest font-cinzel rounded-t-lg">
                                ⚔️ Strategy
                            </button>
                        </div>

                        <form action="{{ route('community.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="category" x-bind:value="tab === 'status' ? 'general' : (tab === 'match' ? 'match_result' : (tab === 'item_build' ? 'item_build' : 'hero_build'))">
                            
                            <div x-show="tab === 'match'" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4" style="display: none;">
                                <select name="hero_name" class="w-full bg-[#050b14] border border-[#466d85]/50 rounded-lg px-4 py-3 text-white text-sm focus:border-[#00d9ff] focus:ring-1 focus:ring-[#00d9ff] outline-none transition shadow-inner">
                                    <option value="">-- Select Hero --</option>
                                    @foreach($heroes as $hero)
                                        <option value="{{ $hero->name }}">{{ $hero->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="kda" placeholder="K / D / A (e.g., 10/2/15)" class="bg-[#050b14] border border-[#466d85]/50 rounded-lg px-4 py-3 text-white text-sm focus:border-[#00d9ff] focus:ring-1 focus:ring-[#00d9ff] outline-none transition shadow-inner placeholder-[#466d85]">
                                <select name="match_result" class="md:col-span-2 bg-[#050b14] border border-[#466d85]/50 rounded-lg px-4 py-3 text-white text-sm focus:border-[#00d9ff] focus:ring-1 focus:ring-[#00d9ff] outline-none transition shadow-inner">
                                    <option value="Win" class="text-green-400 font-bold">Victory 🏆 (Radiant/Dire)</option>
                                    <option value="Loss" class="text-red-400 font-bold">Defeat ❌</option>
                                </select>
                            </div>

                            <div x-show="tab === 'item_build' || tab === 'hero_build'" x-transition class="space-y-4 mb-4" style="display: none;">
                                <div>
                                    <label class="block text-[10px] text-[#00d9ff] mb-1 uppercase tracking-wider font-bold font-cinzel" x-text="tab === 'hero_build' ? 'Hero Focus' : 'Target Hero'"></label>
                                    <select name="hero_id" class="w-full bg-[#050b14] border border-[#466d85]/50 rounded-lg px-4 py-3 text-white text-sm focus:border-[#00d9ff] focus:ring-1 focus:ring-[#00d9ff] outline-none transition shadow-inner">
                                        <option value="">-- Choose Hero --</option>
                                        @foreach($heroes as $hero)
                                            <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[10px] text-[#88aabb] mb-2 uppercase tracking-wider font-bold">Inventory / Core Items</label>
                                    <div class="grid grid-cols-3 md:grid-cols-6 gap-2">
                                        @for($i=1; $i<=6; $i++)
                                            <div class="relative group">
                                                <select name="items[]" class="w-full bg-[#050b14] border border-[#466d85]/50 rounded px-2 py-3 text-white text-[10px] focus:border-[#00d9ff] focus:ring-1 focus:ring-[#00d9ff] outline-none appearance-none text-center shadow-inner hover:border-[#00d9ff]/50 transition">
                                                    <option value="">Slot {{ $i }}</option>
                                                    @foreach($items as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none text-[#466d85] text-[8px]"><i class="fas fa-chevron-down"></i></div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <textarea name="content" rows="3" class="w-full bg-[#050b14] border border-[#466d85]/50 rounded-xl p-4 text-[#cceeff] placeholder-[#466d85] focus:border-[#00d9ff] focus:ring-1 focus:ring-[#00d9ff] outline-none resize-none mb-3 transition-all duration-300 shadow-inner leading-relaxed" placeholder="Bagikan strategi, cerita, atau panduanmu..."></textarea>
                            @error('content') <span class="text-red-500 text-xs block mb-2 font-bold">{{ $message }}</span> @enderror

                            <div class="flex justify-between items-center border-t border-[#466d85]/20 pt-4 mt-2">
                                <div class="flex items-center">
                                    <label class="cursor-pointer group flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#00d9ff]/10 transition duration-300 border border-transparent hover:border-[#00d9ff]/20">
                                        <div class="text-[#00d9ff] group-hover:scale-110 transition drop-shadow-[0_0_5px_rgba(0,217,255,0.8)]">
                                            <i class="fas fa-paperclip"></i>
                                        </div>
                                        <span class="text-xs text-[#88aabb] group-hover:text-white font-bold tracking-wide uppercase">Add Media</span>
                                        <input type="file" name="image" class="hidden" accept="image/*,video/*" @change="fileName = $event.target.files[0].name">
                                    </label>
                                    <span x-show="fileName" x-transition class="ml-3 text-[10px] font-mono text-[#00d9ff] bg-[#00d9ff]/10 px-2 py-1 rounded border border-[#00d9ff]/20 truncate max-w-[150px]" x-text="fileName"></span>
                                </div>
                                <button type="submit" class="bg-gradient-to-r from-[#00d9ff] to-[#0078ff] hover:from-[#00aaff] hover:to-[#0055ff] text-[#050b14] text-xs font-bold uppercase tracking-[2px] px-8 py-2.5 rounded-lg shadow-[0_0_15px_rgba(0,210,255,0.4)] hover:shadow-[0_0_25px_rgba(0,210,255,0.6)] transition-all transform hover:-translate-y-0.5 border border-[#cceeff]/20 font-cinzel">
                                    Publish
                                </button>
                            </div>
                        </form>
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

                                @if($post->category === 'item_build' || $post->category === 'hero_build')
                                    <div class="mb-5 bg-[#050b14]/50 border border-[#466d85]/30 rounded-lg p-4 relative overflow-hidden">
                                        <div class="flex items-center gap-3 mb-4 border-b border-[#466d85]/30 pb-3">
                                            <div class="text-[#00d9ff] text-xl bg-transparent">
                                                <i class="fas fa-shield-alt"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-[#cceeff] font-bold text-xs font-cinzel tracking-wider">{{ $post->category == 'hero_build' ? 'HERO STRATEGY' : 'RECOMMENDED BUILD' }}</h3>
                                                <p class="text-[10px] text-[#466d85] uppercase tracking-widest">Target ID: {{ $post->hero_id ?? 'Unknown' }}</p>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-6 gap-2">
                                            @if(isset($post->items) && is_array($post->items))
                                                @foreach($post->items as $itemId)
                                                    <div class="aspect-square bg-[#0a101a] rounded border border-[#466d85]/40 flex items-center justify-center text-xs text-[#466d85] group/item relative hover:border-[#ffd700] hover:shadow-[0_0_10px_rgba(255,215,0,0.3)] transition cursor-help">
                                                        <i class="fas fa-gem"></i>
                                                        <span class="absolute -top-8 text-[9px] bg-black border border-[#00d9ff] text-white px-2 py-1 rounded opacity-0 group-hover/item:opacity-100 whitespace-nowrap z-20 pointer-events-none shadow-lg">{{ $itemId }}</span>
                                                    </div>
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