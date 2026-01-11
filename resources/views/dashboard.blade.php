<x-layout>
    <div class="min-h-screen bg-[#050b14] bg-[url('https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/backgrounds/bg_fog.jpg')] bg-fixed bg-cover bg-top text-[#cceeff] font-roboto selection:bg-[#00d9ff] selection:text-black">
        
        <div class="fixed top-0 left-0 w-[500px] h-[500px] bg-[#00d9ff]/10 rounded-full blur-[120px] pointer-events-none mix-blend-screen"></div>
        <div class="fixed bottom-0 right-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none mix-blend-screen"></div>

        <x-slot name="header">
            <h2 class="frozen-text text-3xl md:text-4xl font-bold tracking-widest text-center md:text-left drop-shadow-[0_0_10px_rgba(0,217,255,0.3)]" data-text="DASHBOARD">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <aside class="hidden lg:block lg:col-span-1 space-y-6">
                    
                    <div class="p-6 relative group transition-all duration-500 hover:border-[#00d9ff]/50 border border-[#466d85]/30 bg-[#0b1116]/80 backdrop-blur-xl rounded-xl">
                        
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

                            <a href="{{ route('profile.edit') }}" 
                               class="w-full block py-2 px-4 rounded-lg bg-gradient-to-r from-[#0b1116] to-[#162032] border border-[#00d9ff]/30 text-[#00d9ff] text-[10px] font-bold uppercase tracking-[2px] hover:bg-[#00d9ff] hover:text-black hover:shadow-[0_0_15px_rgba(0,217,255,0.4)] transition-all duration-300 font-cinzel text-center">
                                Edit Profile
                            </a>
                        </div>
                    </div>

                    <div class="p-6 sticky top-24 border border-[#466d85]/30 bg-[#0b1116]/80 backdrop-blur-xl rounded-xl">
                        <h4 class="font-cinzel text-[#00d9ff] text-xs font-bold mb-4 border-b border-[#466d85]/30 pb-3 tracking-[3px] opacity-80">
                            NAVIGATION
                        </h4>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('community.index') }}" 
                                   class="flex items-center p-2.5 rounded-lg transition-all duration-300 group {{ !request('category') && !request('filter') ? 'bg-[#00d9ff]/10 text-white border border-[#00d9ff]/30 shadow-[0_0_10px_rgba(0,217,255,0.1)]' : 'text-[#88aabb] hover:bg-[#00d9ff]/10 hover:text-white border border-transparent' }}">
                                    <span class="w-8 text-center text-lg {{ !request('category') && !request('filter') ? 'text-[#00d9ff]' : 'text-[#466d85] group-hover:text-[#00d9ff]' }} transition bg-transparent"><i class="fas fa-arrow-left"></i></span> 
                                    <span class="font-cinzel text-xs font-bold tracking-wider">Back to Community</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>

                <main class="lg:col-span-3 space-y-8" x-data="{ currentTab: 'posts' }">
                    
                    <div class="sticky top-24 z-20 flex justify-center mb-8">
                        <div class="p-1.5 rounded-full flex space-x-2 shadow-[0_0_20px_rgba(0,0,0,0.5)] bg-black/90 border border-[#466d85]/50">
                            <button @click="currentTab = 'posts'" 
                                    :class="currentTab === 'posts' ? 'bg-[#00d9ff] text-black shadow-[0_0_15px_rgba(0,217,255,0.6)]' : 'text-[#88aabb] hover:text-white hover:bg-[#00d9ff]/10 bg-transparent'"
                                    class="px-8 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all duration-300 font-cinzel border-none outline-none">
                                <i class="fas fa-stream mr-2"></i> Timeline
                            </button>
                            <button @click="currentTab = 'media'" 
                                    :class="currentTab === 'media' ? 'bg-[#00d9ff] text-black shadow-[0_0_15px_rgba(0,217,255,0.6)]' : 'text-[#88aabb] hover:text-white hover:bg-[#00d9ff]/10 bg-transparent'"
                                    class="px-8 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all duration-300 font-cinzel border-none outline-none">
                                <i class="fas fa-images mr-2"></i> Gallery
                            </button>
                        </div>
                    </div>

                    <div x-show="currentTab === 'posts'" class="space-y-6">
                        
                        <div class="p-6 relative overflow-hidden border border-[#466d85]/30 bg-[#0b1116]/80 backdrop-blur-xl rounded-xl" x-data="{ fileName: null }">
                            <form action="{{ route('community.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="category" value="general">
                                
                                <div class="flex gap-4">
                                    <img src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : 'https://api.dicebear.com/7.x/avataaars/svg?seed='.Auth::user()->name }}" class="w-10 h-10 rounded-full border border-[#466d85] object-cover">
                                    <div class="flex-1">
                                        <textarea name="content" rows="2" class="w-full bg-[#050b14] border border-[#466d85]/50 rounded-xl p-4 text-[#cceeff] focus:border-[#00d9ff] focus:ring-1 focus:ring-[#00d9ff] resize-none text-sm placeholder-[#466d85] transition-all shadow-inner" placeholder="Apa yang sedang terjadi di Land of Dawn?"></textarea>
                                        
                                        <div class="flex justify-between items-center mt-3 pt-3 border-t border-[#466d85]/20">
                                            <div class="flex items-center gap-3">
                                                <label class="cursor-pointer text-[#00d9ff] hover:text-white flex items-center gap-2 text-xs transition px-3 py-1.5 rounded-lg hover:bg-[#00d9ff]/10 border border-transparent hover:border-[#00d9ff]/20">
                                                    <i class="fas fa-image text-sm"></i>
                                                    <span class="font-bold tracking-wide uppercase">Media</span>
                                                    <input type="file" name="image" class="hidden" accept="image/*,video/*" @change="fileName = $event.target.files[0].name">
                                                </label>
                                                <span x-show="fileName" class="text-[10px] text-[#00d9ff] bg-[#00d9ff]/10 px-2 py-1 rounded border border-[#00d9ff]/20 truncate max-w-[100px] font-mono" x-text="fileName"></span>
                                            </div>
                                            <button type="submit" class="bg-gradient-to-r from-[#00d9ff] to-[#0078ff] hover:from-[#00aaff] hover:to-[#0055ff] text-[#050b14] font-bold px-6 py-1.5 rounded-lg text-xs uppercase tracking-[2px] shadow-[0_0_10px_rgba(0,217,255,0.4)] transition-all transform hover:-translate-y-0.5 border border-[#cceeff]/20 font-cinzel">
                                                Kirim
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @forelse($posts as $post)
                            <div class="p-6 relative group border border-[#466d85]/30 bg-[#0b1116]/80 backdrop-blur-xl rounded-xl hover:border-[#00d9ff]/40 transition-all duration-300">
                                
                                <div class="flex justify-between items-start mb-5">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $post->user->avatar ? asset('storage/'.$post->user->avatar) : 'https://api.dicebear.com/7.x/avataaars/svg?seed='.$post->user->name }}" class="w-11 h-11 rounded-full border-2 border-[#466d85] object-cover shadow-lg">
                                        <div>
                                            <h4 class="text-white font-bold text-sm font-cinzel group-hover:text-[#00d9ff] transition-colors tracking-wider">{{ $post->user->name }}</h4>
                                            <p class="text-[10px] text-[#88aabb] uppercase tracking-wide">{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    @if(Auth::id() === $post->user_id)
                                        <form action="{{ route('post.destroy', $post) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                            @csrf @method('DELETE')
                                            <button class="bg-transparent text-[#466d85] hover:text-red-500 transition-colors p-2 rounded-full border-none outline-none shadow-none hover:bg-transparent"><i class="fas fa-trash-alt text-xs"></i></button>
                                        </form>
                                    @endif
                                </div>

                                @if($post->category === 'match' && !empty($post->match_data))
                                    @php $match = $post->match_data; $isWin = ($match['result'] ?? '') == 'Win'; @endphp
                                    <div class="relative bg-[#050b14] rounded-lg p-4 mb-4 border-l-4 {{ $isWin ? 'border-l-green-500' : 'border-l-red-500' }} overflow-hidden border border-[#466d85]/20">
                                        <div class="absolute right-0 top-0 h-full w-2/3 bg-gradient-to-l from-black/40 to-transparent pointer-events-none"></div>
                                        
                                        <div class="flex justify-between items-center relative z-10">
                                            <div>
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span class="text-xs font-bold uppercase px-2 py-0.5 rounded {{ $isWin ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }} font-cinzel tracking-widest">
                                                        {{ $match['result'] ?? 'Match' }}
                                                    </span>
                                                    <span class="text-xs text-[#88aabb] uppercase">Playing <strong class="text-white">{{ $match['hero_name'] ?? 'Unknown' }}</strong></span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-2xl font-bold text-white tracking-tighter font-mono">{{ $match['kda'] ?? '0/0/0' }}</div>
                                                <div class="text-[9px] uppercase text-[#466d85] font-bold tracking-[2px]">KDA</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="text-[#cceeff] text-sm leading-7 font-light tracking-wide whitespace-pre-wrap mb-4">{{ $post->content }}</div>
                                
                                @if($post->image)
                                    <div class="rounded-lg overflow-hidden border border-[#466d85]/30 bg-[#050b14] relative group/media mb-4">
                                        @if(Str::endsWith($post->image, ['.mp4', '.mov', '.avi']))
                                            <video controls class="w-full max-h-[400px] object-contain">
                                                <source src="{{ asset('storage/' . $post->image) }}" type="video/mp4">
                                            </video>
                                        @else
                                            <img src="{{ asset('storage/' . $post->image) }}" class="w-full max-h-[500px] object-cover hover:scale-[1.01] transition duration-700 opacity-90 group-hover/media:opacity-100">
                                        @endif
                                    </div>
                                @endif
                                
                                <div class="flex gap-6 border-t border-[#466d85]/20 pt-4">
                                    <form action="{{ route('post.like', $post) }}" method="POST">
                                        @csrf
                                        <button class="bg-transparent flex items-center gap-2 text-xs font-bold uppercase tracking-wider {{ $post->isLikedByAuthUser() ? 'text-[#00d9ff] drop-shadow-[0_0_5px_rgba(0,217,255,0.8)]' : 'text-[#88aabb] hover:text-white' }} transition duration-300 border-none outline-none shadow-none hover:bg-transparent">
                                            <i class="{{ $post->isLikedByAuthUser() ? 'fas' : 'far' }} fa-heart text-lg bg-transparent"></i> 
                                            <span>{{ $post->likes_count }}</span>
                                        </button>
                                    </form>
                                    <button class="bg-transparent flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#88aabb] hover:text-[#00d9ff] transition duration-300 border-none outline-none shadow-none hover:bg-transparent">
                                        <i class="far fa-comment-alt text-lg bg-transparent"></i> 
                                        <span>{{ $post->comments_count ?? 0 }}</span>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="p-16 text-center border border-dashed border-[#466d85]/30 rounded-xl bg-[#0b1116]/40">
                                <div class="text-5xl mb-4 opacity-30 grayscale">📜</div>
                                <h3 class="text-xl text-white font-cinzel font-bold mb-2 tracking-widest">THE REALM IS SILENT</h3>
                                <p class="text-[#88aabb] text-xs font-mono uppercase tracking-widest">Be the first to break the ice.</p>
                            </div>
                        @endforelse
                    </div>

                    <div x-show="currentTab === 'media'" style="display: none;">
                        <div class="p-1 border border-[#466d85]/30 bg-[#0b1116]/80 backdrop-blur-xl rounded-xl">
                            <div class="grid grid-cols-3 gap-1">
                                @forelse($posts->whereNotNull('image') as $post)
                                    <div class="aspect-square relative group overflow-hidden cursor-pointer">
                                        @if(Str::endsWith($post->image, ['.mp4', '.mov', '.avi']))
                                            <video class="w-full h-full object-cover">
                                                <source src="{{ asset('storage/' . $post->image) }}" type="video/mp4">
                                            </video>
                                            <div class="absolute top-2 right-2 bg-black/50 px-2 py-0.5 rounded text-[10px] text-white backdrop-blur-sm"><i class="fas fa-play"></i></div>
                                        @else
                                            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                        @endif
                                        <div class="absolute inset-0 bg-[#00d9ff]/20 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                                    </div>
                                @empty
                                    <div class="col-span-3 py-20 text-center text-[#88aabb]">Galeri kosong.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </main>
            </div>
        </div>
    </div>
</x-layout>