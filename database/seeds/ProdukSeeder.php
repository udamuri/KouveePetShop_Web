<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produks')->insert([
            'nama_produk' => 'Vita Fortan',
            'harga_produk' => 50000,
            'stok_produk' => 25,
            'min_stok_produk' => 5,
            'satuan_produk' => 'Botol',
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '08', '10'),
            'updateLog_at' => Carbon::create('2019', '08', '10'),
            'deleteLog_at' => Carbon::create('2019', '08', '10'),
            'id_pegawai_fk' => 3,
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'Royal Canin Mini Adult',
            'harga_produk' => 20000,
            'stok_produk' => 10,
            'min_stok_produk' => 5,
            'satuan_produk' => 'Pack',
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '08', '10'),
            'updateLog_at' => Carbon::create('2019', '08', '10'),
            'deleteLog_at' => Carbon::create('2019', '08', '10'),
            'id_pegawai_fk' => 3,
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'Blackwood Lamb ',
            'harga_produk' => 25000,
            'stok_produk' => 15,
            'min_stok_produk' => 5,
            'satuan_produk' => 'Pack',
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '08', '10'),
            'updateLog_at' => Carbon::create('2019', '08', '10'),
            'deleteLog_at' => Carbon::create('2019', '08', '10'),
            'id_pegawai_fk' => 3,
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'Maxima Shampo ',
            'harga_produk' => 30000,
            'stok_produk' => 12,
            'min_stok_produk' => 5,
            'satuan_produk' => 'Botol',
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '08', '11'),
            'updateLog_at' => Carbon::create('1998', '08', '11'),
            'deleteLog_at' => Carbon::create('1998', '08', '11'),
            'id_pegawai_fk' => 3,
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'Jerry High Lamb',
            'harga_produk' => 55000,
            'stok_produk' => 24,
            'min_stok_produk' => 5,
            'satuan_produk' => 'Pack',
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '08', '11'),
            'updateLog_at' => Carbon::create('2019', '08', '11'),
            'deleteLog_at' => Carbon::create('2019', '08', '11'),
            'id_pegawai_fk' => 3,
        ]);
    }
}
