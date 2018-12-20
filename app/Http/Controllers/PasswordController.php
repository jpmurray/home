<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required',
        ]);

         $request->user()->fill([
            'password' => Hash::make($validated['password'])
         ])->save();

         return redirect()->route('motdepasse.edit')->with('status', 'Mot de passe changé!');
    }
}
