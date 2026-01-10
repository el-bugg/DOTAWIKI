<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-cinzel text-white font-bold tracking-wide">
            Verify Your Identity
        </h2>
        <p class="text-slate-400 text-sm mt-3 leading-relaxed">
            Before entering the Ancients' ground, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive it, we can summon another.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-cyan-400 p-3 border border-cyan-900 bg-cyan-900/20 rounded">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <div class="mt-6 flex flex-col gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full py-3 rounded btn-neon uppercase tracking-[0.1em] text-xs font-bold">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-sm text-slate-500 hover:text-red-400 underline decoration-red-400/30">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>