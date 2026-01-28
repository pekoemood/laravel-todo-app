<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class Register extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'name' => ['string', 'max:255', 'required'],
            'email' => ['email', 'required'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create($validated);
        Auth::login($user);
        return redirect('/');
    }
}
