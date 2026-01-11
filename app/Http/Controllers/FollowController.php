<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store(User $user)
    {
        // Tidak bisa follow diri sendiri
        if (Auth::id() === $user->id) {
            return back()->with('error', 'Anda tidak bisa follow diri sendiri.');
        }

        // Attach relasi following
        Auth::user()->following()->syncWithoutDetaching($user->id);

        return back()->with('success', 'Berhasil mengikuti ' . $user->name);
    }

    public function destroy(User $user)
    {
        Auth::user()->following()->detach($user->id);

        return back()->with('success', 'Berhenti mengikuti ' . $user->name);
    }
}