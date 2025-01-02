<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        $data = User::where('jabatan', '!=', 'Super Admin')->get();
        return view('user.index', compact('data'));
    }

    function create()
    {
        $user = new User();
        $jabatan = Jabatan::all();
        return view('user.create', compact('user', 'jabatan'));
    }

    function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'jabatan' => 'required',
        ]);

        try {
            $user = new User();
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->jabatan = $request->jabatan;
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->route('user.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.create')->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }

    function edit($id)
    {
        $data = User::find($id);
        $jabatan = Jabatan::all();
        return view('user.edit', compact('data', 'jabatan'));
    }

    function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->jabatan = $request->jabatan;
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->save();

            return redirect()->route('user.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.edit', $id)->with('error', 'Failed to update user: ' . $e->getMessage());
        }
    }

    function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            return redirect()->route('user.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }
}
