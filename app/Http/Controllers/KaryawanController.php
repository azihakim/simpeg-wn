<?php

namespace App\Http\Controllers;

use App\Models\Rekrutmen;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('jabatan', 'Karyawan')->get();
        return view('karyawan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelamar = Rekrutmen::where('status', 'Diterima')->with('user')->get();
        return view('karyawan.create', compact('pelamar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'pelamar' => 'required|exists:users,id',
        //     'nama' => 'required|string|max:255',
        //     'tgl_lahir' => 'required|numeric',
        //     'jenis_kelamin' => 'required|string',
        //     'telepon' => 'required|string|max:15',
        //     'status_kerja' => 'required|string',
        //     'nik' => 'required|string|max:20',
        // ]);

        try {
            // Find the user by pelamar ID
            $karyawan = User::find($request->pelamar);
            $id_pelamar = (int) $request->id_pelamar;
            $pelamar = Rekrutmen::where('id_pelamar', $id_pelamar)->first();

            if (!$karyawan) {
                return redirect()->back()->with('error', 'Data pelamar tidak ditemukan.');
            }

            // Assign the request data to the user
            $karyawan->nama = $request->nama;
            $karyawan->tgl_lahir = $request->tgl_lahir;
            $karyawan->jenis_kelamin = $request->jenis_kelamin;
            $karyawan->telepon = $request->telepon;
            $karyawan->status_kerja = $request->status_kerja;
            $karyawan->divisi_id = $pelamar->lowongan->jabatan;
            $karyawan->status = 'Aktif';
            $karyawan->nik = $request->nik;
            $karyawan->jabatan = 'Karyawan';
            $karyawan->berkas = $pelamar->file;
            // Save the changes
            $karyawan->save();

            $pelamar = Rekrutmen::where('id_pelamar', $request->id_pelamar)->first();
            $pelamar->delete();

            return redirect()->back()->with('success', 'Data karyawan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data karyawan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('karyawan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate input data if necessary
            $validated = $request->validate([
                'nama' => 'required|string',
                'tgl_lahir' => 'required|integer',
                'jenis_kelamin' => 'required|string',
                'telepon' => 'required|string',
                'nik' => 'required|string',
                'status_kerja' => 'required|string',
            ]);

            // Find the employee by ID
            $karyawan = User::findOrFail($id);

            // Update the employee data
            $karyawan->nama = $request->nama;
            $karyawan->tgl_lahir = $request->tgl_lahir;
            $karyawan->jenis_kelamin = $request->jenis_kelamin;
            $karyawan->telepon = $request->telepon;
            $karyawan->nik = $request->nik;
            $karyawan->status_kerja = $request->status_kerja;

            // Save the updated data
            $karyawan->save();

            return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('karyawan.index')->with('error', 'Gagal memperbarui data karyawan: ' . $e->getMessage());
        }
    }
    function destroy($id)
    {
        try {
            $karyawan = User::findOrFail($id);
            $karyawan->delete();

            return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus.');
        } catch (\Exception $e) {
            // return redirect()->route('karyawan.index')->with('error', 'Gagal menghapus data karyawan: ' . $e->getMessage());
            return redirect()->route('karyawan.index')->with('error', 'Gagal menghapus data karyawan karena data masih terhubung dengan data lain.');
        }
    }
}
