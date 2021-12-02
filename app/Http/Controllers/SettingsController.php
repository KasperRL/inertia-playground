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
        $model = User::query()->where('id', request()->userId)->first();
        $attributes = request()->validate([
            'name' => ['nullable'],
            'email' => ['nullable', 'email', Rule::unique('users', 'email')->ignore($model)],
            'password' => ['nullable', 'min:6'],
            'repeated_password' => [request('password') === null ? 'nullable' : 'required', 'same:password'],
        ]);

        $model->update($attributes);

        return redirect()->back();
    }
}