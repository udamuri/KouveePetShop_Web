<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DetailProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detailproduks')->insert([
            'kode_produk' => 'ABC001',
            'tgl_transaksi_produk' => Carbon::create('2019', '10', '11'),
            'jml_transaksi_produk' => 2,
            'subtotal' => 50000,
            'id_produk_fk' => 1,
            'id_transaksi_penjualan_fk' => 1,
        ]);
        DB::table('detailproduks')->insert([
            'kode_produk' => 'ABC002',
            'tgl_transaksi_produk' => Carbon::create('2019', '08', '12'),
            'jml_transaksi_produk' => 3,
            'subtotal' => 50000,
            'id_produk_fk' => 2,
            'id_transaksi_penjualan_fk' => 2,
        ]);
        DB::table('detailproduks')->insert([
            'kode_produk' => 'ABC003',
            'tgl_transaksi_produk' => Carbon::create('2019', '07', '09'),
            'jml_transaksi_produk' => 4,
            'subtotal' => 100000,
            'id_produk_fk' => 3,
            'id_transaksi_penjualan_fk' => 3,
        ]);
        DB::table('detailproduks')->insert([
            'kode_produk' => 'ABC004',
            'tgl_transaksi_produk' => Carbon::create('2019', '11', '10'),
            'jml_transaksi_produk' => 5,
            'subtotal' => 100000,
            'id_produk_fk' => 4,
            'id_transaksi_penjualan_fk' => 4,
        ]);
        DB::table('detailproduks')->insert([
            'kode_produk' => 'ABC005',
            'tgl_transaksi_produk' => Carbon::create('2019', '12', '10'),
            'jml_transaksi_produk' => 1,
            'subtotal' => 200000,
            'id_produk_fk' => 5,
            'id_transaksi_penjualan_fk' => 5,
        ]);
    }
}
