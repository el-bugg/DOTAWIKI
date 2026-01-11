<section class="glass-panel space-y-6 shadow-[0_0_20px_rgba(0,217,255,0.15)] relative overflow-hidden">
    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-cyan-500 rounded-full blur-[80px] opacity-10 pointer-events-none"></div>

    <header class="relative z-10 flex flex-col md:flex-row gap-6 items-start">
        <div class="p-4 rounded-full bg-cyan-500/10 border border-cyan-500/30 shadow-[0_0_15px_rgba(0,217,255,0.2)] shrink-0">
            <svg class="w-8 h-8 text-[#00d9ff]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15a2.25 2.25 0 002.25-2.25V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
            </svg>
        </div>

        <div class="space-y-2">
            <h2 class="text-2xl font-cinzel text-white drop-shadow-[0_0_5px_rgba(0,217,255,0.8)]">
                {{ __('FOTO PROFIL') }}
            </h2>

            <p class="text-sm text-[#88aabb] leading-relaxed max-w-2xl">
                {{ __('Ganti avatar untuk ditampilkan di komunitas dan dashboard.') }}
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('profile.photo') }}" class="mt-6 space-y-6 relative z-10" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="flex flex-col sm:flex-row items-center gap-8 p-4 rounded-xl bg-black/20 border border-white/5">
            <div class="shrink-0 relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-[#00d9ff] to-cyan-600 rounded-full blur opacity-40 group-hover:opacity-75 transition duration-500"></div>
                <img class="relative h-24 w-24 object-cover rounded-full border-2 border-[#00d9ff] shadow-lg" 
                     src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . $user->name }}" 
                     alt="Current profile photo" />
            </div>

            <div class="flex-1 w-full">
                <label class="block">
                    <span class="sr-only">Choose profile photo</span>
                    <input type="file" name="avatar" class="block w-full text-sm text-[#88aabb]
                        file:mr-4 file:py-2 file:px-6
                        file:rounded-md file:border file:border-cyan-500/50
                        file:text-xs file:font-bold file:uppercase
                        file:bg-cyan-500/10 file:text-[#00d9ff]
                        hover:file:bg-cyan-500/20 hover:file:border-cyan-400
                        file:cursor-pointer cursor-pointer
                        transition-all duration-300
                    "/>
                </label>
                <p class="mt-2 text-xs text-gray-500 italic">* Format: JPG, PNG, atau GIF. Maks 2MB.</p>
            </div>
        </div>

        @error('avatar')
            <p class="text-red-400 text-sm mt-2 drop-shadow-[0_0_5px_rgba(239,68,68,0.3)]">{{ $message }}</p>
        @enderror

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="btn-ice">
                {{ __('Simpan Foto') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-[#00d9ff] font-bold drop-shadow-[0_0_5px_rgba(0,217,255,0.5)]"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>