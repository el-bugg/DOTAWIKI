<form action="{{ route('community.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <input type="hidden" name="category" value="general">

    <div class="flex gap-4">
        <img src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : 'https://api.dicebear.com/7.x/avataaars/svg?seed='.Auth::user()->name }}" 
             class="w-10 h-10 rounded-full border border-ice/50">
        
        <div class="w-full">
            <textarea name="content" rows="3" 
                class="w-full bg-black/40 border border-white/10 rounded-xl p-4 text-white placeholder-gray-500 focus:border-ice focus:shadow-[0_0_15px_rgba(0,210,255,0.1)] outline-none resize-none transition" 
                placeholder="Apa yang sedang terjadi di Land of Dawn?"></textarea>
        </div>
    </div>

    <div class="flex justify-between items-center border-t border-white/5 pt-3">
        <label class="cursor-pointer flex items-center gap-2 group p-2 rounded hover:bg-white/5 transition">
            <i class="fas fa-image text-ice text-lg group-hover:scale-110 transition"></i>
            <span class="text-xs text-gray-400 group-hover:text-white">Foto / Video</span>
            <input type="file" name="image" class="hidden" accept="image/*,video/*">
        </label>

        <button type="submit" class="btn-ice px-6 py-2 text-xs font-bold uppercase tracking-wider rounded">
            Posting
        </button>
    </div>
</form>