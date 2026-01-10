<x-app-layout>
    <div class="main-layout py-10">
        <aside class="space-y-6">
            <div class="glass-panel text-center">
                <div class="relative inline-block mb-4">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ Auth::user()->name }}" 
                         class="avatar w-24 h-24 border-4 border-ice-blue shadow-lg mx-auto">
                </div>
                <h2 class="frozen-text text-xl uppercase" data-text="{{ Auth::user()->name }}">{{ Auth::user()->name }}</h2>
                
                <div class="follow-stats mt-6 border-t border-b border-white/10 py-4">
                    <div class="stat-box text-center">
                        <h3 class="text-ice font-bold text-xl">{{ Auth::user()->followers()->count() ?? 0 }}</h3>
                        <span class="text-[10px] text-muted uppercase">Followers</span>
                    </div>
                    <div class="stat-box text-center border-l border-white/10">
                        <h3 class="text-ice font-bold text-xl">{{ Auth::user()->following()->count() ?? 0 }}</h3>
                        <span class="text-[10px] text-muted uppercase">Following</span>
                    </div>
                </div>

                <div class="mt-6 space-y-2">
                    <a href="{{ route('profile.edit') }}" class="btn-ice w-full block text-center no-underline text-xs">
                        <i class="fas fa-user-cog mr-2"></i> Pengaturan Akun
                    </a>
                </div>
            </div>
        </aside>

        <main>
            <div class="nav-tabs mb-6">
                <div class="nav-item active font-cinzel">Arsip Strategi Anda</div>
                <div class="nav-item font-cinzel">Rekomendasi Build</div>
            </div>

            @forelse($myPosts as $post)
                <div class="post-card mb-6 glass-panel p-6 border-l-4 border-ice-blue">
                    <div class="post-header flex items-center gap-3 mb-4">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ Auth::user()->name }}" class="w-10 h-10 rounded-full border border-ice-blue">
                        <div>
                            <span class="text-ice font-bold uppercase block text-sm">{{ Auth::user()->name }}</span>
                            <small class="text-muted text-[10px] italic">{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    
                    <div class="text-main leading-relaxed mb-4 text-justify">
                        {{ $post->content }}
                    </div>

                    @if($post->image)
                        <div class="mb-4 rounded-lg overflow-hidden border border-white/10 shadow-lg">
                            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-auto object-cover">
                        </div>
                    @endif

                    @if($post->video)
                        <div class="mb-4 rounded-lg overflow-hidden border border-white/10 shadow-lg">
                            <video controls class="w-full">
                                <source src="{{ asset('storage/' . $post->video) }}" type="video/mp4">
                            </video>
                        </div>
                    @endif

                    <div class="post-actions pt-4 border-t border-white/5 flex gap-6">
                        <button class="text-ice hover:glow text-xs uppercase font-bold">
                            <i class="fas fa-heart mr-1"></i> {{ $post->likes()->count() }} Like
                        </button>
                        <button class="text-muted text-xs uppercase font-bold">
                            <i class="fas fa-comment mr-1"></i> {{ $post->comments()->count() }} Comment
                        </button>
                    </div>
                </div>
            @empty
                <div class="glass-panel text-center py-20 border-dashed border-white/20 border-2">
                    <i class="fas fa-feather-alt text-4xl text-white/10 mb-4"></i>
                    <p class="text-muted italic">Anda belum pernah memposting apapun.</p>
                    <a href="{{ route('community.index') }}" class="btn-ice inline-block mt-4 no-underline">Mulai Posting</a>
                </div>
            @endforelse
        </main>

        <aside>
            <div class="glass-panel">
                <h4 class="font-cinzel text-ice border-b border-white/10 pb-2 mb-4 uppercase text-xs tracking-widest">Statistik Tempur</h4>
                <div class="space-y-4 text-sm">
                    <div class="flex justify-between items-center">
                        <span class="text-muted uppercase text-[10px]">Total Postingan:</span>
                        <span class="text-ice font-bold">{{ $myPosts->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-muted uppercase text-[10px]">Total Vote Terima:</span>
                        <span class="text-white font-bold">0</span>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</x-app-layout>