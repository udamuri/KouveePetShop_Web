<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DetailPengadaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detailpengadaans')->insert([
            'kode_stok' => 'STCK001',
            'jml_stok_pengadaan' => '45',
            'status_pengadaan_produk' => 'Belum Tersedia',
            'id_produk_fk' => 1,
            'id_stock_fk' => 1,
        ]);
        DB::table('detailpengadaans')->insert([
            'kode_stok' => 'STCK002',
            'jml_stok_pengadaan' => '300',
            'status_pengadaan_produk' => 'Belum Tersedia',
            'id_produk_fk' => 2,
            'id_stock_fk' => 2,
        ]);
        DB::table('detailpengadaans')->insert([
            'kode_stok' => 'STCK003',
            'jml_stok_pengadaan' => '525',
            'status_pengadaan_produk' => 'Tersedia',
            'id_produk_fk' => 3,
            'id_stock_fk' => 3,
        ]);
        DB::table('detailpengadaans')->insert([
            'kode_stok' => 'STCK004',
            'jml_stok_pengadaan' => '200',
            'status_pengadaan_produk' => 'Tersedia',
            'id_produk_fk' => 4,
            'id_stock_fk' => 4,
        ]);
        DB::table('detailpengadaans')->insert([
            'kode_stok' => 'STCK005',
            'jml_stok_pengadaan' => '104',
            'status_pengadaan_produk' => 'Tersedia',
            'id_produk_fk' => 5,
            'id_stock_fk' => 5,
        ]);
    }
}
