<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->where('id', '!=', Auth::user()->id)
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($user) => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'id' => $user->id,
                ]),
            'filters' => Request::only(['search']),
            'can' => [
                'createUsers' => Auth::user()->can('create', User::class),
                'editUsers' => Auth::user()->can('edit', User::class),
                'deleteUsers' => Auth::user()->can('delete', User::class),
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store()
    {
        $attributes = Request::validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6'],
            'repeated_password' => ['required', 'same:password'],
        ]);

        User::create($attributes);

        return redirect('/users');
    }

    public function edit($id)
    {
        return Inertia::render('Users/Edit', [
            "user" => User::findOrFail($id)->only("name", "email", "id")
        ]);
    }

    public function update($id)
    {
        $model = User::query()->where('id', $id)->first();
        $attributes = request()->validate([
            'name' => ['nullable'],
            'email' => ['nullable', 'email', Rule::unique('users', 'email')->ignore($model)],
            'password' => ['nullable', 'min:6'],
            'repeated_password' => [request('password') === null ? 'nullable' : 'required', 'same:password'],
        ]);

        $model->update($attributes);

        return redirect()->back();
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back();
    }
}