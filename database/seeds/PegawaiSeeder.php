<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawais')->insert([
            'nama_pegawai' => 'Vincent Wibowo',
            'alamat_pegawai' => 'Jl. Babarsari',
            'tglLahir_pegawai' => Carbon::create('1999', '02', '03'),
            'noTelp_pegawai' => '081244448888',
            'role_pegawai' => 'Customer Service',
            'username' => 'CS_Vincent',
            'password' => 'CS_Vincent',
            'createLog_by' => 'Lawrence Adi Noman',
            'updateLog_by' => 'Lawrence Adi Noman',
            'deleteLog_by' => 'Lawrence Adi Noman',
            'createLog_at' => Carbon::create('2019', '09', '08'),
            'updateLog_at' => Carbon::create('2019', '09', '08'),
            'deleteLog_at' => Carbon::create('2019', '09', '08'),
        ]);
        DB::table('pegawais')->insert([
            'nama_pegawai' => 'Al Sigit',
            'alamat_pegawai' => 'Jl. Gagak',
            'tglLahir_pegawai' => Carbon::create('1999', '05', '05'),
            'noTelp_pegawai' => '081256785678',
            'role_pegawai' => 'Customer Service',
            'username' => 'CS_Sigit',
            'password' => 'CS_Sigit',
            'createLog_by' => 'Lawrence Adi Noman',
            'updateLog_by' => 'Lawrence Adi Noman',
            'deleteLog_by' => 'Lawrence Adi Noman',
            'createLog_at' => Carbon::create('2019', '09', '08'),
            'updateLog_at' => Carbon::create('2019', '09', '08'),
            'deleteLog_at' => Carbon::create('2019', '09', '08'),
        ]);
        DB::table('pegawais')->insert([
            'nama_pegawai' => 'Gladdenata Adiwijaya',
            'alamat_pegawai' => 'Jl. Caturtunggal',
            'tglLahir_pegawai' => Carbon::create('1997', '10', '10'),
            'noTelp_pegawai' => '08599993333',
            'role_pegawai' => 'Owner',
            'username' => 'Own_Glad',
            'password' => 'Own_Glad',
            'createLog_by' => 'Lawrence Adi Noman',
            'updateLog_by' => 'Lawrence Adi Noman',
            'deleteLog_by' => 'Lawrence Adi Noman',
            'createLog_at' => Carbon::create('2019', '09', '08'),
            'updateLog_at' => Carbon::create('2019', '09', '08'),
            'deleteLog_at' => Carbon::create('2019', '09', '08'),
        ]);
        DB::table('pegawais')->insert([
            'nama_pegawai' => 'Donny Karno',
            'alamat_pegawai' => 'Jl. Caturtunggal',
            'tglLahir_pegawai' => Carbon::create('1997', '08', '02'),
            'noTelp_pegawai' => '08567673434',
            'role_pegawai' => 'Kasir',
            'username' => 'Kasir_Donny',
            'password' => 'Kasir_Donny',
            'createLog_by' => 'Lawrence Adi Noman',
            'updateLog_by' => 'Lawrence Adi Noman',
            'deleteLog_by' => 'Lawrence Adi Noman',
            'createLog_at' => Carbon::create('2019', '09', '08'),
            'updateLog_at' => Carbon::create('2019', '09', '08'),
            'deleteLog_at' => Carbon::create('2019', '09', '08'),
        ]);
        DB::table('pegawais')->insert([
            'nama_pegawai' => 'Owen Ferry Gunawan',
            'alamat_pegawai' => 'Jl. Condongcatur',
            'tglLahir_pegawai' => Carbon::create('1999', '10', '09'),
            'noTelp_pegawai' => '08588880000',
            'role_pegawai' => 'Kasir',
            'username' => 'Kasir_Owen',
            'password' => 'Kasir_Owen',
            'createLog_by' => 'Lawrence Adi Noman',
            'updateLog_by' => 'Lawrence Adi Noman',
            'deleteLog_by' => 'Lawrence Adi Noman',
            'createLog_at' => Carbon::create('2019', '09', '08'),
            'updateLog_at' => Carbon::create('2019', '09', '08'),
            'deleteLog_at' => Carbon::create('2019', '09', '08'),
        ]);
    }
}
