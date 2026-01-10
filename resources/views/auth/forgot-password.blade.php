<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-cinzel text-white font-bold tracking-wide">
            Lost Your Way?
        </h2>
        <p class="text-slate-400 text-sm mt-3 leading-relaxed">
            Forgot your secret key? No problem. Just let us know your email address and we will beam a password reset link to your location.
        </p>
    </div>

    <x-auth-session-status class="mb-4 text-cyan-400 font-bold" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label class="block font-cinzel text-[10px] text-cyan-500 uppercase tracking-widest mb-1">Email Codex</label>
            <input class="w-full rounded glass-input px-4 py-3 placeholder-slate-600" type="email" name="email" :value="old('email')" required autofocus placeholder="Enter your registered email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs" />
        </div>

        <div class="mt-6 flex flex-col gap-3">
            <button type="submit" class="w-full py-3 rounded btn-neon uppercase tracking-[0.1em] text-xs font-bold">
                Email Password Reset Link
            </button>
            
            <a href="{{ route('login') }}" class="text-center text-slate-500 hover:text-white text-sm transition-colors">
                &larr; Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>