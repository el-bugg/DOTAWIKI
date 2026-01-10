<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-3xl font-cinzel text-white font-bold tracking-wide drop-shadow-[0_0_10px_rgba(34,211,238,0.5)]">
            Join the Ranks
        </h2>
        <p class="text-slate-400 text-sm mt-2 font-roboto">
            Begin your legacy in the Frozen Realm.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block font-cinzel text-[10px] text-cyan-500 uppercase tracking-widest mb-1">Hero Name</label>
            <input class="w-full rounded glass-input px-4 py-3 placeholder-slate-600" type="text" name="name" :value="old('name')" required autofocus placeholder="Your Display Name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-xs" />
        </div>

        <div>
            <label class="block font-cinzel text-[10px] text-cyan-500 uppercase tracking-widest mb-1">Email Codex</label>
            <input class="w-full rounded glass-input px-4 py-3 placeholder-slate-600" type="email" name="email" :value="old('email')" required placeholder="email@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs" />
        </div>

        <div>
            <label class="block font-cinzel text-[10px] text-cyan-500 uppercase tracking-widest mb-1">Secret Key</label>
            <input class="w-full rounded glass-input px-4 py-3 placeholder-slate-600" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs" />
        </div>

        <div>
            <label class="block font-cinzel text-[10px] text-cyan-500 uppercase tracking-widest mb-1">Confirm Secret Key</label>
            <input class="w-full rounded glass-input px-4 py-3 placeholder-slate-600" type="password" name="password_confirmation" required placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400 text-xs" />
        </div>

        <button type="submit" class="w-full py-3 rounded btn-neon uppercase tracking-[0.2em] text-sm font-bold mt-4">
            Register Account
        </button>

        <div class="text-center mt-6">
            <p class="text-slate-500 text-sm">Already a hero? 
                <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-200 underline">Login Here</a>
            </p>
        </div>
    </form>
</x-guest-layout>