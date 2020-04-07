<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('layanans')->insert([
            'nama_layanan' => 'Grooming Mandi Anjing Small',
            'harga_layanan' => 100000,
            'jenis_layanan' => 'Grooming',
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '08', '08'),
            'updateLog_at' => Carbon::create('2019', '08', '08'),
            'deleteLog_at' => Carbon::create('2019', '08', '08'),
            'id_pegawai_fk' => 3,
            'id_ukuranHewan_fk' => 1,
        ]);
        DB::table('layanans')->insert([
            'nama_layanan' => 'Grooming Mandi Kucing Medium',
            'harga_layanan' => 200000,
            'jenis_layanan' => 'Grooming',
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '07', '08'),
            'updateLog_at' => Carbon::create('2019', '07', '08'),
            'deleteLog_at' => Carbon::create('2019', '07', '08'),
            'id_pegawai_fk' => 3,
            'id_ukuranHewan_fk' => 2,
        ]);
        DB::table('layanans')->insert([
            'nama_layanan' => 'Penitipan Anjing Medium',
            'harga_layanan' => 300000,
            'jenis_layanan' => 'Penitipan',
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '05', '08'),
            'updateLog_at' => Carbon::create('2019', '05', '08'),
            'deleteLog_at' => Carbon::create('2019', '05', '08'),
            'id_pegawai_fk' => 3,
            'id_ukuranHewan_fk' => 2,
        ]);
        DB::table('layanans')->insert([
            'nama_layanan' => 'Penitipan Kucing Small',
            'harga_layanan' => 400000,
            'jenis_layanan' => 'Penitipan',
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '06', '08'),
            'updateLog_at' => Carbon::create('2019', '06', '08'),
            'deleteLog_at' => Carbon::create('2019', '06', '08'),
            'id_pegawai_fk' => 3,
            'id_ukuranHewan_fk' => 1,
        ]);
        DB::table('layanans')->insert([
            'nama_layanan' => 'Potong Bulu Hamster Small',
            'harga_layanan' => 300000,
            'jenis_layanan' => 'Potong Bulu',
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '04', '08'),
            'updateLog_at' => Carbon::create('2019', '04', '08'),
            'deleteLog_at' => Carbon::create('2019', '04', '08'),
            'id_pegawai_fk' => 3,
            'id_ukuranHewan_fk' => 1,
        ]);
    }
}
