<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            'nama_supplier' => 'Jojon Dugem',
            'alamat_supplier' => 'Jl.Pringwulung no 1',
            'telepon_supplier' => '0829842985',
            'stok_supplier' => 50,
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '10', '11'),
            'updateLog_at' => Carbon::create('2019', '10', '11'),
            'deleteLog_at' => Carbon::create('2019', '10', '11'),
            'id_pegawai_fk' => 3,
            'id_stock_fk' => 1,
        ]);
        DB::table('suppliers')->insert([
            'nama_supplier' => 'Andi Wihnu',
            'alamat_supplier' => 'Jl.Pringwulung no 2',
            'telepon_supplier' => '0829845678',
            'stok_supplier' => 50,
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '09', '11'),
            'updateLog_at' => Carbon::create('2019', '09', '11'),
            'deleteLog_at' => Carbon::create('2019', '09', '11'),
            'id_pegawai_fk' => 3,
            'id_stock_fk' => 2,
        ]);
        DB::table('suppliers')->insert([
            'nama_supplier' => 'Joko Sundoyo',
            'alamat_supplier' => 'Jl.Pringwulung no 3',
            'telepon_supplier' => '0829842985',
            'stok_supplier' => 50,
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '11', '11'),
            'updateLog_at' => Carbon::create('2019', '11', '11'),
            'deleteLog_at' => Carbon::create('2019', '11', '11'),
            'id_pegawai_fk' => 3,
            'id_stock_fk' => 3,
        ]);
        DB::table('suppliers')->insert([
            'nama_supplier' => 'Joko Anwar',
            'alamat_supplier' => 'Jl.Pringwulung',
            'telepon_supplier' => '0829842985',
            'stok_supplier' => 50,
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '08', '11'),
            'updateLog_at' => Carbon::create('2019', '08', '11'),
            'deleteLog_at' => Carbon::create('2019', '08', '11'),
            'id_pegawai_fk' => 3,
            'id_stock_fk' => 4,
        ]);
        DB::table('suppliers')->insert([
            'nama_supplier' => 'Janwaroko ',
            'alamat_supplier' => 'Jl.Pringwulung',
            'telepon_supplier' => '0829842985',
            'stok_supplier' => 50,
            'createLog_by' => 'Gladdenata Adiwijaya',
            'updateLog_by' => 'Gladdenata Adiwijaya',
            'deleteLog_by' => 'Gladdenata Adiwijaya',
            'createLog_at' => Carbon::create('2019', '08', '11'),
            'updateLog_at' => Carbon::create('2019', '08', '11'),
            'deleteLog_at' => Carbon::create('2019', '08', '11'),
            'id_pegawai_fk' => 3,
            'id_stock_fk' => 5,
        ]);
    }
}
