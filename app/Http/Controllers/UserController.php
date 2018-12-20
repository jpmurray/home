<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('users.index')->with(['users' => User::all()]);
    }

    public function create()
    {
        abort_unless(auth()->user()->email == config('home.admin-email'), 403);

        return view("users.create");
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->email == config('home.admin-email'), 403);

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create($validated);

        return redirect()->route('home')->with('status', "Utilisateur créé!");
    }

    public function edit(User $user)
    {
        abort_unless(auth()->user()->email == config('home.admin-email'), 403);

        return view("users.edit")->with(['user' => $user]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $password = $request->validate([
            'password' => 'nullable',
        ]);

        $user->update($validated);

        if (!is_null($password['password'])) {
            $user->fill([
                'password' => Hash::make($password['password'])
             ])->save();
        }

         return redirect()->route('users.edit', ["user" => $user])->with('status', 'Utilisateur mis à jour!');
    }

    public function destroy(User $user)
    {
        abort_unless(auth()->user()->email == config('home.admin-email'), 403);

        $user->delete();

        return redirect()->route('users.index', ["user" => $user])->with('status', 'Utilisateur détruit!');
    }
}
