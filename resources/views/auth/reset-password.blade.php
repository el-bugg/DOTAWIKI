<x-guest-layout>
    <div class="min-h-screen flex relative overflow-hidden bg-[#050b14]">
        
        <div class="absolute inset-0 md:relative md:w-2/3 lg:w-3/4 order-2 z-0 hidden md:block">
            <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/heroes/lich.png" 
                 class="w-full h-full object-cover object-center opacity-70">
            <div class="absolute inset-0 bg-gradient-to-r from-[#050b14] via-[#050b14]/70 to-transparent"></div>
        </div>

        <div class="relative z-10 w-full md:w-1/2 lg:w-1/3 flex flex-col justify-center px-8 md:px-16 py-12 h-full bg-[#050b14] md:bg-gradient-to-r md:from-[#050b14] md:to-transparent order-1 shadow-2xl">
            
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-white mb-2 font-cinzel">Reset Password</h2>
                <p class="text-slate-400 text-sm">Secure your account with a new password.</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label class="block text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                        class="form-control w-full bg-slate-900/50 border-slate-700 text-white rounded-lg px-4 py-3 focus:border-cyan-500">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400 text-xs" />
                </div>

                <div>
                    <label class="block text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">New Password</label>
                    <input type="password" name="password" required 
                        class="form-control w-full bg-slate-900/50 border-slate-700 text-white rounded-lg px-4 py-3 focus:border-cyan-500">
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400 text-xs" />
                </div>

                <div>
                    <label class="block text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" required 
                        class="form-control w-full bg-slate-900/50 border-slate-700 text-white rounded-lg px-4 py-3 focus:border-cyan-500">
                </div>

                <button type="submit" class="w-full py-3.5 mt-2 rounded-lg bg-cyan-500 hover:bg-cyan-400 text-[#050b14] font-bold tracking-widest shadow-lg transition font-cinzel">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>