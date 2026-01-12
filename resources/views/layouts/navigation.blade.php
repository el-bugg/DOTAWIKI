{{-- <nav class="navbar-dota flex justify-between items-center px-8 py-4 border-b border-ice/20 bg-[#050b14]">
    <div class="flex items-center gap-8">
        <a href="{{ route('dashboard') }}" class="frozen-text text-2xl font-cinzel no-underline" data-text="DOTA WIKI">DOTA WIKI</a>
        <div class="flex gap-6">
            <a href="{{ route('dashboard') }}" class="nav-link no-underline {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('community.index') }}" class="nav-link no-underline {{ request()->routeIs('community.index') ? 'active' : '' }}">Community</a>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <span class="text-ice font-bold uppercase tracking-widest text-sm border-r border-white/20 pr-4">
            {{ Auth::user()->name }}
        </span>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-red-500 hover:text-white transition-all flex items-center gap-2 group" title="Keluar dari Akun">
                <span class="text-[10px] hidden group-hover:inline uppercase font-bold">Logout</span>
                <i class="fas fa-sign-out-alt text-xl"></i>
            </button>
        </form>
    </div>
</nav> --}}