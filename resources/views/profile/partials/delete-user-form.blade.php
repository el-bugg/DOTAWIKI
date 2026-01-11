<section class="glass-panel space-y-6 border-red-900/30 shadow-[0_0_20px_rgba(220,38,38,0.15)] relative overflow-hidden">
    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-red-600 rounded-full blur-[80px] opacity-10 pointer-events-none"></div>

    <header class="relative z-10 flex flex-col md:flex-row gap-6 items-start">
        <div class="p-4 rounded-full bg-red-500/10 border border-red-500/30 shadow-[0_0_15px_rgba(220,38,38,0.2)] shrink-0">
            <svg class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
        </div>

        <div class="space-y-2">
            <h2 class="text-2xl font-cinzel text-white drop-shadow-[0_0_5px_rgba(220,38,38,0.8)]">
                {{ __('DELETE ACCOUNT') }}
            </h2>

            <p class="text-sm text-[#88aabb] leading-relaxed max-w-2xl">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>
        </div>
    </header>

    <div class="flex justify-end pt-4 relative z-10">
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="btn-danger-ice !bg-transparent hover:!bg-red-600/80 !border-red-500/50"
        >{{ __('Delete Account') }}</x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-[#0b1116] border border-[#466d85] rounded-lg shadow-[0_0_30px_rgba(0,217,255,0.1)] relative overflow-hidden">
            @csrf
            @method('delete')

            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-red-600 to-transparent"></div>

            <h2 class="text-xl font-cinzel text-white text-center md:text-left">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-3 text-sm text-[#88aabb] text-center md:text-left">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <div class="relative">
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="glass-input block w-full placeholder-gray-500"
                        placeholder="{{ __('Password') }}"
                    />
                </div>

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="!bg-transparent !border-[#466d85] !text-[#88aabb] hover:!text-white hover:!border-[#00d9ff] transition-all">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="btn-danger-ice !ml-0">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>