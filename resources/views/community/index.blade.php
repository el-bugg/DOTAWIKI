<x-app-layout>
    <div class="main-layout py-8">
        <aside class="space-y-6">
            <div class="glass-panel">
                <h4 class="font-cinzel text-ice mb-4">Kategori Panduan</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('community.newbie') }}" class="nav-link block p-2 hover:bg-white/5 rounded">🔰 Newbie Guide</a></li>
                    <li><a href="{{ route('community.hero') }}" class="nav-link block p-2 hover:bg-white/5 rounded">⚔️ Hero Guide</a></li>
                    <li><a href="{{ route('community.item') }}" class="nav-link block p-2 hover:bg-white/5 rounded">💎 Item Guide</a></li>
                </ul>
            </div>

            <div class="glass-panel">
                <h4 class="font-cinzel text-ice mb-2">Dota News (API)</h4>
                @forelse($dotaNews as $news)
                    <div class="mb-3 pb-2 border-b border-white/5">
                        <a href="{{ $news['url'] }}" target="_blank" class="text-[10px] text-main hover:text-ice">{{ $news['title'] }}</a>
                    </div>
                @empty
                    <p class="text-xs italic text-muted">Gagal memuat berita karena koneksi.</p>
                @endforelse
            </div>
        </aside>

        <main>
            <div class="glass-panel mb-8">
                <form action="{{ route('community.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <textarea name="content" class="form-control mb-3" placeholder="Bagikan tips atau hasil pertandingan..." required></textarea>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex gap-4 text-xs">
                            <label class="cursor-pointer text-ice hover:text-white flex items-center gap-1">
                                <i class="fas fa-image"></i> Gambar
                                <input type="file" name="image" class="hidden" onchange="this.previousSibling.textContent=' (Terpilih)'">
                            </label>
                            
                            <label class="cursor-pointer text-ice hover:text-white flex items-center gap-1">
                                <i class="fas fa-video"></i> Video
                                <input type="file" name="video" class="hidden" onchange="this.previousSibling.textContent=' (Terpilih)'">
                            </label>

                            <select name="category" class="bg-black text-ice border border-ice/30 rounded px-2">
                                <option value="general">General</option>
                                <option value="hero_guide">Hero Guide</option>
                                <option value="item_guide">Item Guide</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-ice">POST</button>
                    </div>
                </form>
            </div>

            @foreach($posts as $post)
                <div class="post-card p-4 mb-4">
                    <div class="user-info flex items-center gap-2 mb-3">
                         <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $post->user->name }}" class="w-8 h-8 rounded-full border border-ice">
                         <span class="text-ice font-bold">{{ $post->user->name }}</span>
                    </div>

                    <div class="mt-2">
                        <p class="text-main mb-3">{{ $post->content }}</p>
                        
                        @if($post->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $post->image) }}" class="rounded-lg w-full border border-white/10 shadow-lg">
                            </div>
                        @endif

                        @if($post->video)
                            <div class="mb-3">
                                <video controls class="rounded-lg w-full border border-white/10 shadow-lg">
                                    <source src="{{ asset('storage/' . $post->video) }}" type="video/mp4">
                                    Browser Anda tidak mendukung tag video.
                                </video>
                            </div>
                        @endif
                    </div>

                    <div class="mt-4 flex gap-6 text-xs pt-3 border-t border-white/5">
                        <form action="{{ route('post.like', $post) }}" method="POST">
                            @csrf
                            <button class="{{ $post->isLikedByAuthUser() ? 'text-ice font-bold' : 'text-muted' }}">
                                <i class="fas fa-heart"></i> {{ $post->likes->count() }} Like
                            </button>
                        </form>
                        <button class="text-muted"><i class="fas fa-comment"></i> Komentar</button>
                    </div>
                </div>
            @endforeach
        </main>
    </div>
</x-app-layout>