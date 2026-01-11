<section class="glass-panel space-y-6 shadow-[0_0_20px_rgba(0,217,255,0.15)] relative overflow-hidden">
    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-cyan-500 rounded-full blur-[80px] opacity-10 pointer-events-none"></div>

    <header class="relative z-10 flex flex-col md:flex-row gap-6 items-start">
        <div class="p-4 rounded-full bg-cyan-500/10 border border-cyan-500/30 shadow-[0_0_15px_rgba(0,217,255,0.2)] shrink-0">
            <svg class="w-8 h-8 text-[#00d9ff]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
        </div>

        <div class="space-y-2">
            <h2 class="text-2xl font-cinzel text-white drop-shadow-[0_0_5px_rgba(0,217,255,0.8)]">
                {{ __('PROFILE INFORMATION') }}
            </h2>

            <p class="text-sm text-[#88aabb] leading-relaxed max-w-2xl">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 relative z-10">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-[#cceeff]" />
            <x-text-input id="name" name="name" type="text" class="glass-input mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#cceeff]" />
            <x-text-input id="email" name="email" type="email" class="glass-input mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 rounded-lg border border-yellow-500/20 bg-yellow-500/5">
                    <p class="text-sm text-[#88aabb]">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-[#00d9ff] hover:text-white hover:shadow-[0_0_10px_rgba(0,217,255,0.5)] transition-all rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 offset-gray-900">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400 drop-shadow-[0_0_5px_rgba(74,222,128,0.5)]">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="btn-ice">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
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