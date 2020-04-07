<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orderstocks')->insert([
            'nama_stock' => 'Blackwood Lamb',
            'satuan_stock' => 'Pack',
            'tgl_pesan' => Carbon::create('2019', '10', '11'),
            'tgl_cetak' => Carbon::create('2019', '10', '11'),
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '10', '11'),
            'updateLog_at' => Carbon::create('2019', '10', '11'),
            'deleteLog_at' => Carbon::create('2019', '10', '11'),
            'id_pegawai_fk' => 3,
        ]);
        DB::table('orderstocks')->insert([
            'nama_stock' => 'Maxima Shampo',
            'satuan_stock' => 'Botol',
            'tgl_pesan' => Carbon::create('2019', '09', '10'),
            'tgl_cetak' => Carbon::create('2019', '09', '10'),
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '09', '10'),
            'updateLog_at' => Carbon::create('2019', '09', '10'),
            'deleteLog_at' => Carbon::create('2019', '11', '11'),
            'id_pegawai_fk' => 3,
        ]);
        DB::table('orderstocks')->insert([
            'nama_stock' => 'Pawloshopy Shampo',
            'satuan_stock' => 'Botol',
            'tgl_pesan' => Carbon::create('2019', '08', '12'),
            'tgl_cetak' => Carbon::create('2019', '08', '12'),
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '08', '12'),
            'updateLog_at' => Carbon::create('2019', '08', '12'),
            'deleteLog_at' => Carbon::create('2019', '11', '11'),
            'id_pegawai_fk' => 3,
        ]);
        DB::table('orderstocks')->insert([
            'nama_stock' => 'Jerry High Lamb',
            'satuan_stock' => 'Pack',
            'tgl_pesan' => Carbon::create('2019', '11', '11'),
            'tgl_cetak' => Carbon::create('2019', '11', '11'),
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '11', '11'),
            'updateLog_at' => Carbon::create('2019', '11', '11'),
            'deleteLog_at' => Carbon::create('2019', '11', '11'),
            'id_pegawai_fk' => 3,
        ]);
        DB::table('orderstocks')->insert([
            'nama_stock' => 'Jerky Stick Carrot ',
            'satuan_stock' => 'Pack',
            'tgl_pesan' => Carbon::create('2019', '07', '15'),
            'tgl_cetak' => Carbon::create('2019', '07', '15'),
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '07', '15'),
            'updateLog_at' => Carbon::create('2019', '07', '15'),
            'deleteLog_at' => Carbon::create('2019', '07', '15'),
            'id_pegawai_fk' => 3,
        ]);
    }
}
