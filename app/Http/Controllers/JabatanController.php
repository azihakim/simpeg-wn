<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    function index()
    {
        $data = Jabatan::all();
        return view('jabatan.index', compact('data'));
    }

    function create()
    {
        return view('jabatan.create');
    }

    function store(Request $request)
    {
        try {
            $jabatan = new Jabatan();
            $jabatan->nama_jabatan = $request->nama_jabatan;
            $jabatan->save();

            return redirect()->route('jabatan.index')->with('success', 'Data jabatan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data jabatan gagal ditambahkan.');
        }
    }

    function edit($id)
    {
        $data = Jabatan::find($id);
        return view('jabatan.edit', compact('data'));
    }

    function update(Request $request, $id)
    {
        try {
            $jabatan = Jabatan::find($id);
            $jabatan->nama_jabatan = $request->nama_jabatan;
            $jabatan->save();

            return redirect()->route('jabatan.index')->with('success', 'Data jabatan berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data jabatan gagal diubah.');
        }
    }

    function destroy($id)
    {
        try {
            $jabatan = Jabatan::find($id);
            $jabatan->delete();

            return redirect()->route('jabatan.index')->with('success', 'Data jabatan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data jabatan gagal dihapus, karena data ini masih terhubung dengan data lain.');
        }
    }
}
