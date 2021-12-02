<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        return Inertia::render('Settings', [
            'user' => [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'id' => Auth::user()->id
            ]
        ]);
    }

    public function update()
    {
        $user = User::findOrFail(request('userId'));
        $attributes = request()->validate([
            'name' => ['nullable'],
            'email' => ['nullable', 'email', Rule::unique('users', 'email')->ignore($user)],
        ]);

        if (request('password') !== null) {
            $password = request()->validate([
                'password' => ['nullable', 'min:6'],
                'repeated_password' => ['required', 'same:password'],
            ]);

            $attributes['password'] = $password['password'];
        }

        $user->update($attributes);

        return redirect()->back();
    }
}