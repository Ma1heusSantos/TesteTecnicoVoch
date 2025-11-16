<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function Audits()
    {
        $audits = DB::table('audits')->latest()->paginate(20);

        return view('Admin.audit', compact('audits'));
    }

    public function dashboard()
    {
        return view('Admin.dashboard');
    }

    public function createUser()
    {
        return view('Admin.CreateUser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:admin,user',
            'avatar' => 'nullable|image|max:2048',
        ]);


        $avatarPath = null;

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'avatar' => $avatarPath,
        ]);

        session()->flash('global-success', true);
        session()->flash('message', 'Usuário criado com sucesso!');
        return redirect()->route('economicGroup.show');
    }
}
