<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
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
}