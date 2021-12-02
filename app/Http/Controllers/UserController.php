<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->where('id', '!=', Auth::user()->id)
                ->orderBy('name')
                ->when(request('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($user) => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'id' => $user->id,
                    'role' => $user->getRoleNames()->first() ?? "Guest",
                ]),
            'filters' => request()->only(['search']),
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
        $attributes = request()->validate([
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
            "user" => [
                'data' => User::findOrFail($id)->only("name", "email", "id"),
                'role' => User::findOrFail($id)->getRoleNames()->first() ?? "Guest",
            ],
            "roles" => Role::all()->pluck('name'),
            "can" => [
                'assignRoles' => Auth::user()->can('assignRoles', User::class),
            ]
        ]);
    }

    public function update($id)
    {
        $user = User::findOrFail($id);
        $userRoles = $user->getRoleNames() ?? null;

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

        if ($userRoles !== null) {
            if (request('role') != $userRoles->first()) {
                foreach ($userRoles as $role) {
                    $user->removeRole($role);
                }
                if (request('role') != "Guest") {
                    $user->assignRole(request('role'));
                }
            }
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back();
    }
}