<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Jabatan;
use App\Models\Lowongan;
use App\Models\Rekrutmen;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'nama' => 'Test Admin',
            'jabatan' => 'Admin',
            'status' => '',
            'status_kerja' => '',
            'nik' => '',
            'umur' => '20',
            'telepon' => '0812343710',
            'alamat' => 'Jl. Sukamaju',
            'username' => 'admin',
            'password' => bcrypt('123'),
        ]);
        User::create([
            'nama' => 'Manajer',
            'jabatan' => 'Manajer',
            'status' => '',
            'status_kerja' => '',
            'nik' => '',
            'umur' => '20',
            'telepon' => '0812343710',
            'alamat' => 'Jl. Sukamaju',
            'username' => 'manajer',
            'password' => bcrypt('123'),
        ]);
        User::create([
            'nama' => 'Test karyawn',
            'jabatan' => 'Karyawan',
            'divisi' => 'IT',
            'status' => '',
            'status_kerja' => '',
            'nik' => '',
            'umur' => '20',
            'telepon' => '0812343710',
            'alamat' => 'Jl. Sukamaju',
            'username' => 'karyawan',
            'password' => bcrypt('123'),
        ]);
        User::create([
            'nama' => 'Test karyawan 2',
            'jabatan' => 'Karyawan',
            'divisi' => 'Office',
            'status' => '',
            'status_kerja' => '',
            'nik' => '',
            'umur' => '20',
            'telepon' => '0812343710',
            'alamat' => 'Jl. Sukamaju',
            'username' => 'karyawan2',
            'password' => bcrypt('123'),
        ]);

        Lowongan::create(
            [
                'jabatan' => 'Checker',
                'status' => 'aktif',
                'deskripsi' => 'Membuat aplikasi berbasis web'
            ]
        );

        // Rekrutmen::create([
        //     'id_pelamar' => 1,
        //     'id_lowongan' => 1,
        //     'status' => 'Diterima',
        //     'file' => 'file.pdf',
        // ]);

        $jabatan = [
            [
                'jabatan' => 'Admin'
            ],
            [
                'jabatan' => 'Supervisor'
            ],
            [
                'jabatan' => 'Supir (Luar Kota/Dalam Kota)'
            ],
            [
                'jabatan' => 'Checker'
            ],
            [
                'jabatan' => 'Gudang'
            ],
        ];
        foreach ($jabatan as $j) {
            Jabatan::create($j);
        }

        // Pastikan ada data di tabel users sebelum menjalankan seeder ini
        $users = User::where('jabatan', 'Karyawan')->get();

        if ($users->isEmpty()) {
            $this->command->warn('Tidak ada data karyawan di tabel users. Harap jalankan UserSeeder terlebih dahulu.');
            return;
        }

        $absensiData = [];
        $faker = \Faker\Factory::create();

        foreach ($users as $user) {
            // Simulasi absensi masuk dan pulang untuk beberapa hari
            for ($j = 0; $j < 30; $j++) { // 30 hari absensi
                $date = now()->subDays(30 - $j);

                // Absensi masuk
                $absensiData[] = [
                    'id_karyawan' => $user->id,
                    'lokasi' => 'https://www.google.com/maps?q=' . $faker->latitude . ',' . $faker->longitude,
                    'keterangan' => 'masuk',
                    'foto' => '$faker', // Simpan gambar palsu
                    'created_at' => $date->setHour(8)->format('Y-m-d H:i:s'),
                    'updated_at' => $date->setHour(8)->format('Y-m-d H:i:s'),
                ];

                // Absensi pulang
                $absensiData[] = [
                    'id_karyawan' => $user->id,
                    'lokasi' => 'https://www.google.com/maps?q=' . $faker->latitude . ',' . $faker->longitude,
                    'keterangan' => 'pulang',
                    'foto' => '$faker', // Simpan gambar palsu
                    'created_at' => $date->setHour(17)->format('Y-m-d H:i:s'),
                    'updated_at' => $date->setHour(17)->format('Y-m-d H:i:s'),
                ];
            }
        }

        // Masukkan data ke database
        DB::table('absensis')->insert($absensiData);

        $this->command->info('Seeder Absensi berhasil dijalankan!');
    }
}
