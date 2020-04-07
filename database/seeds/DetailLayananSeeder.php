<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DetailLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detaillayanans')->insert([
            'kode_layanan' => 'ABCD001',
            'tgl_transaksi_layanan' => Carbon::create('2019', '05', '11'),
            'jml_transaksi_layanan' => 4,
            'subtotal' => 150000,
            'id_layanan_fk' => 1,
            'id_transaksi_penjualan_fk' => 1,
        ]);
        DB::table('detaillayanans')->insert([
            'kode_layanan' => 'ABCD002',
            'tgl_transaksi_layanan' => Carbon::create('2019', '07', '12'),
            'jml_transaksi_layanan' => 3,
            'subtotal' => 50000,
            'id_layanan_fk' => 2,
            'id_transaksi_penjualan_fk' => 2,
        ]);
        DB::table('detaillayanans')->insert([
            'kode_layanan' => 'ABCD003',
            'tgl_transaksi_layanan' => Carbon::create('2019', '06', '13'),
            'jml_transaksi_layanan' => 2,
            'subtotal' => 150000,
            'id_layanan_fk' => 3,
            'id_transaksi_penjualan_fk' => 3,
        ]);
        DB::table('detaillayanans')->insert([
            'kode_layanan' => 'ABCD004',
            'tgl_transaksi_layanan' => Carbon::create('2019', '08', '14'),
            'jml_transaksi_layanan' => 1,
            'subtotal' => 200000,
            'id_layanan_fk' => 4,
            'id_transaksi_penjualan_fk' => 4,
        ]);
        DB::table('detaillayanans')->insert([
            'kode_layanan' => 'ABCD005',
            'tgl_transaksi_layanan' => Carbon::create('2019', '11', '15'),
            'jml_transaksi_layanan' => 3,
            'subtotal' => 200000,
            'id_layanan_fk' => 5,
            'id_transaksi_penjualan_fk' => 5,
        ]);
    }
}
