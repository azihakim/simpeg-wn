<?php

namespace App\Http\Controllers;

use App\Models\Kontrak;
use App\Models\User;
use Illuminate\Http\Request;

class KontrakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->jabatan == 'Karyawan') {
            $data = Kontrak::where('user_id', auth()->user()->id)->get();
        } else {
            $data = Kontrak::all();
        }
        return view('kontrak.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawan = User::where('jabatan', 'Karyawan')->get();
        return view('kontrak.create', compact('karyawan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if ($request->hasFile('surat_kontrak')) {
            $file = $request->file('surat_kontrak');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/surat_kontrak', $filename);
            $request->merge(['surat_kontrak' => $filename]);
        }

        $data = new Kontrak();
        $data->user_id = $request->user_id;
        $data->mulai_kontrak = $request->mulai_kontrak;
        $data->akhir_kontrak = $request->akhir_kontrak;
        $data->deskripsi = $request->deskripsi;
        $data->keterangan = $request->keterangan;
        $data->surat = $filename;
        $data->save();

        return redirect()->route('kontrak.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kontrak $kontrak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Kontrak::find($id);
        $karyawan = User::where('jabatan', 'Karyawan')->get();
        return view('kontrak.edit', compact('data', 'karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        try {
            $request->validate([
                'mulai_kontrak' => 'required|date',
                'akhir_kontrak' => 'required|date',
                'deskripsi' => 'required|string',
                'keterangan' => 'required|string',
                'surat_kontrak' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            ]);
            if ($request->hasFile('surat_kontrak')) {
                $file = $request->file('surat_kontrak');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/surat_kontrak', $filename);
                $request->merge(['surat_kontrak' => $filename]);
            }
            $data = Kontrak::find($id);
            $data->mulai_kontrak = $request->mulai_kontrak;
            $data->akhir_kontrak = $request->akhir_kontrak;
            $data->deskripsi = $request->deskripsi;
            $data->keterangan = $request->keterangan;
            $data->surat = $filename ?? $data->surat;
            $data->save();

            return redirect()->route('kontrak.index')->with('success', 'Data berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->route('kontrak.index')->with('error', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Kontrak::find($id);
        $data->delete();
        return redirect()->route('kontrak.index')->with('success', 'Data berhasil dihapus.');
    }

    public function status(Request $request, $id)
    {
        $data = Kontrak::find($id);
        $data->status = $request->status;
        $data->save();
        return redirect()->route('kontrak.index')->with('success', 'Data berhasil diubah.');
    }
}
