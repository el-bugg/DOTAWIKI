<section class="glass-panel space-y-6 shadow-[0_0_20px_rgba(0,217,255,0.15)] relative overflow-hidden">
    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-cyan-500 rounded-full blur-[80px] opacity-10 pointer-events-none"></div>

    <header class="relative z-10 flex flex-col md:flex-row gap-6 items-start">
        <div class="p-4 rounded-full bg-cyan-500/10 border border-cyan-500/30 shadow-[0_0_15px_rgba(0,217,255,0.2)] shrink-0">
            <svg class="w-8 h-8 text-[#00d9ff]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
            </svg>
        </div>

        <div class="space-y-2">
            <h2 class="text-2xl font-cinzel text-white drop-shadow-[0_0_5px_rgba(0,217,255,0.8)]">
                {{ __('UPDATE PASSWORD') }}
            </h2>

            <p class="text-sm text-[#88aabb] leading-relaxed max-w-2xl">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6 relative z-10">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-[#cceeff]" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="glass-input mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-[#cceeff]" />
            <x-text-input id="update_password_password" name="password" type="password" class="glass-input mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-[#cceeff]" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="glass-input mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="btn-ice">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-[#00d9ff] font-bold drop-shadow-[0_0_5px_rgba(0,217,255,0.5)]"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>