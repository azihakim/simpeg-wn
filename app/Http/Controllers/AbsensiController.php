<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PDF;

class AbsensiController extends Controller
{

    public function index()
    {
        $data = Absensi::all();
        if (auth()->user()->jabatan == 'Karyawan') {
            $data = Absensi::where('id_karyawan', auth()->user()->id)->get();
        }
        return view('absensi.index', compact('data'));
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'absen' => 'required|string',
            'photo' => 'required|string',
            'location' => 'required|string',
        ]);

        // Decode the base64 image data
        $imageData = $validated['photo'];
        $image = str_replace('data:image/png;base64,', '', $imageData);
        $image = str_replace(' ', '+', $image);
        $imageName = uniqid() . '.png'; // Generate a unique filename
        $path = 'absensi/' . $imageName; // Define the path where the image will be stored

        // Save the image to storage
        Storage::disk('public')->put($path, base64_decode($image));

        // Store the attendance record
        $absensi = new Absensi();
        $absensi->keterangan = $validated['absen'];
        $absensi->foto = $imageName; // Store the path of the photo in the database
        $absensi->lokasi = $validated['location'];
        $absensi->id_karyawan = auth()->user()->id;

        $absensi->save();

        return response()->json(['success' => true, 'message' => 'Absensi berhasil disimpan.']);
    }

    public function rekap(Request $request)
    {
        $tanggal_dari = $request->input('tanggal_dari');
        $tanggal_sampai = $request->input('tanggal_sampai');

        if (!$tanggal_dari || !$tanggal_sampai) {
            return back()->withErrors(['error' => 'Tanggal dari dan sampai harus diisi!']);
        }

        $tanggal_range = collect();

        // Generate range tanggal
        $start = Carbon::parse($tanggal_dari);
        $end = Carbon::parse($tanggal_sampai);
        while ($start->lte($end)) {
            $tanggal_range->push($start->format('Y-m-d'));
            $start->addDay();
        }

        // Ambil data karyawan dan absensi
        $data_karyawan = User::where('jabatan', 'Karyawan')->with(['absensi' => function ($query) use ($tanggal_dari, $tanggal_sampai) {
            $query->whereBetween('created_at', [$tanggal_dari, $tanggal_sampai]);
        }])->get()->map(function ($karyawan) use ($tanggal_range) {
            // Group absensi berdasarkan tanggal
            $absensi = $karyawan->absensi->groupBy(function ($absensi) {
                return Carbon::parse($absensi->created_at)->format('Y-m-d');
            });

            // Hitung kehadiran unik per tanggal (hanya "masuk")
            $hadir = $absensi->filter(function ($records) {
                return $records->pluck('keterangan')->contains('masuk');
            })->count();

            $persentase = ($hadir / $tanggal_range->count()) * 100;

            // Map absensi per tanggal
            $mapped_absensi = $tanggal_range->mapWithKeys(function ($date) use ($absensi) {
                if ($absensi->has($date)) {
                    $keterangan = $absensi[$date]->pluck('keterangan')->unique()->join(', ');
                } else {
                    $keterangan = '-';
                }

                return [$date => $keterangan];
            });

            return [
                'nama' => $karyawan->nama,
                'absensi' => $mapped_absensi,
                'persentase' => round($persentase, 2),
            ];
        });
        // return view('absensi.rekapPdf', compact('tanggal_dari', 'tanggal_sampai', 'tanggal_range', 'data_karyawan'));
        $pdf = FacadePdf::loadView('absensi.rekapPdf', compact('tanggal_dari', 'tanggal_sampai', 'tanggal_range', 'data_karyawan'))
            ->setPaper('a3', 'landscape');
        return $pdf->download('rekap-absensi.pdf');
    }
}
