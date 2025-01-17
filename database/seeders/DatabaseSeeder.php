<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Jabatan;
use App\Models\Lowongan;
use App\Models\Rekrutmen;
use App\Models\User;
use Illuminate\Database\Seeder;

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

        $jabatan = [
            [
                'nama_jabatan' => 'Admin'
            ],
            [
                'nama_jabatan' => 'Supervisor'
            ],
            [
                'nama_jabatan' => 'Supir Dalam Kota'
            ],
            [
                'nama_jabatan' => 'Supir Luar Kota'
            ],
            [
                'nama_jabatan' => 'Checker'
            ],
            [
                'nama_jabatan' => 'Gudang'
            ],
        ];
        foreach ($jabatan as $j) {
            Jabatan::create($j);
        }

        Lowongan::create(
            [
                'jabatan' => 1,
                'status' => 'aktif',
                'deskripsi' => 'Finance JobDesk',
            ]
        );

        //   User::create([
        //    'nama' => 'Budi',
        //    'jabatan' => 'Pelamar',
        //    'status' => '',
        //    'status_kerja' => '',
        //    'nik' => '',
        //    'umur' => '20',
        //    'telepon' => '0812343710',
        //    'alamat' => 'Jl. Sukamaju',
        //    'username' => 'budi',
        //    'password' => bcrypt('123'),
        //   ]);
        // Rekrutmen::create([
        //     'id_pelamar' => 1,
        //     'id_lowongan' => 1,
        //     'status' => 'Diterima',
        //     'file' => 'file.pdf',
        // ]);

        User::create([
            'nama' => 'Super Admin',
            'jabatan' => 'Super Admin',
            'status' => '',
            'status_kerja' => '',
            'nik' => '',
            'umur' => '20',
            'telepon' => '0812343710',
            'alamat' => 'Jl. Sukamaju',
            'username' => 'sa',
            'password' => bcrypt('123'),
        ]);
        User::create([
            'nama' => 'Manajer',
            'jabatan' => 'Manajer',
            'divisi_id' => 1,
            'status' => '',
            'status_kerja' => '',
            'nik' => '',
            'umur' => '20',
            'telepon' => '0812343710',
            'alamat' => 'Jl. Sukamaju',
            'username' => 'Manajer',
            'password' => bcrypt('123'),
        ]);

        User::create([
            'nama' => 'Karyawan 1',
            'jabatan' => 'Karyawan',
            'divisi_id' => 2,
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
            'nama' => 'Karyawan 2',
            'jabatan' => 'Karyawan',
            'divisi_id' => 1,
            'status' => '',
            'status_kerja' => '',
            'nik' => '',
            'umur' => '20',
            'telepon' => '0812343710',
            'alamat' => 'Jl. Sukamaju',
            'username' => 'karyawan 2',
            'password' => bcrypt('123'),
        ]);
    }
}
