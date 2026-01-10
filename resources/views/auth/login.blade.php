<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-3xl font-cinzel text-white font-bold tracking-wide drop-shadow-[0_0_10px_rgba(34,211,238,0.5)]">
            Welcome Back
        </h2>
        <p class="text-slate-400 text-sm mt-2 font-roboto">
            The battlefield misses your presence.
        </p>
    </div>

    <x-auth-session-status class="mb-4 text-cyan-400" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf
        <div>
            <label class="block font-cinzel text-[10px] text-cyan-500 uppercase tracking-widest mb-1">Email Codex</label>
            <input class="w-full rounded bg-slate-900/50 border border-slate-700 text-white px-4 py-3 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 outline-none transition-all placeholder-slate-600 glass-input" 
                   type="email" name="email" :value="old('email')" required autofocus placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs" />
        </div>

        <div>
            <label class="block font-cinzel text-[10px] text-cyan-500 uppercase tracking-widest mb-1">Secret Key</label>
            <input class="w-full rounded bg-slate-900/50 border border-slate-700 text-white px-4 py-3 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 outline-none transition-all placeholder-slate-600 glass-input" 
                   type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs" />
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" class="rounded bg-slate-800 border-slate-600 text-cyan-500 focus:ring-cyan-500" name="remember">
                <span class="ml-2 text-slate-400">Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-cyan-500 hover:text-cyan-300 transition-colors" href="{{ route('password.request') }}">
                    Forgot Password?
                </a>
            @endif
        </div>

        <button type="submit" class="w-full py-3 rounded btn-neon uppercase tracking-[0.2em] text-sm font-bold mt-2">
            Enter Realm
        </button>

        <div class="text-center mt-6">
            <p class="text-slate-500 text-sm">New to the realm? 
                <a href="{{ route('register') }}" class="text-cyan-400 hover:text-cyan-200 underline">Create Account</a>
            </p>
        </div>
    </form>
</x-guest-layout>