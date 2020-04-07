<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'nama_customer' => 'Wahyu Chandra',
            'alamat_customer' => 'Jl. Manissemu',
            'tglLahir_customer' =>	Carbon::create('1997', '11', '11'),
            'noTelp_customer' => '08989897676',
            'createLog_by' => 'Vincent Wibowo',
            'updateLog_by' => 'Vincent Wibowo',
            'deleteLog_by' => 'Vincent Wibowo',
            'createLog_at' => Carbon::create('2019', '10', '01'),
            'updateLog_at' => Carbon::create('2019', '10', '01'),
            'deleteLog_at' => Carbon::create('2019', '10', '01'),
            'id_pegawai_fk' => 1,
        ]);
        DB::table('customers')->insert([
            'nama_customer' => 'Andiantama',
            'alamat_customer' => 'Jl. Babarsari',
            'tglLahir_customer' =>	Carbon::create('1998', '01', '07'),
            'noTelp_customer' => '08292929292',
            'createLog_by' => 'Vincent Wibowo',
            'updateLog_by' => 'Vincent Wibowo',
            'deleteLog_by' => 'Vincent Wibowo',
            'createLog_at' => Carbon::create('2019', '10', '01'),
            'updateLog_at' => Carbon::create('2019', '10', '01'),
            'deleteLog_at' => Carbon::create('2019', '10', '01'),
            'id_pegawai_fk' => 1,
        ]);
        DB::table('customers')->insert([
            'nama_customer' => 'Lukas Layan',
            'alamat_customer' => 'Jl. Merpati',
            'tglLahir_customer' =>	Carbon::create('1996', '03', '05'),
            'noTelp_customer' => '08789804563',
            'createLog_by' => 'Vincent Wibowo',
            'updateLog_by' => 'Vincent Wibowo',
            'deleteLog_by' => 'Vincent Wibowo',
            'createLog_at' => Carbon::create('2019', '10', '01'),
            'updateLog_at' => Carbon::create('2019', '10', '01'),
            'deleteLog_at' => Carbon::create('2019', '10', '01'),
            'id_pegawai_fk' => 1,
        ]);
        DB::table('customers')->insert([
            'nama_customer' => 'Putu Ary',
            'alamat_customer' => 'Jl. Manisjingga',
            'tglLahir_customer' =>	Carbon::create('1997', '01', '02'),
            'noTelp_customer' => '08934561234',
            'createLog_by' => 'Al Sigit',
            'updateLog_by' => 'Al Sigit',
            'deleteLog_by' => 'Al Sigit',
            'createLog_at' => Carbon::create('2019', '10', '02'),
            'updateLog_at' => Carbon::create('2019', '10', '02'),
            'deleteLog_at' => Carbon::create('2019', '10', '02'),
            'id_pegawai_fk' => 2,
        ]);
        DB::table('customers')->insert([
            'nama_customer' => 'Sukirman',
            'alamat_customer' => 'Jl. Manismangga',
            'tglLahir_customer' =>	Carbon::create('1997', '02', '11'),
            'noTelp_customer' => '09834562345',
            'createLog_by' => 'Al Sigit',
            'updateLog_by' => 'Al Sigit',
            'deleteLog_by' => 'Al Sigit',
            'createLog_at' => Carbon::create('2019', '10', '02'),
            'updateLog_at' => Carbon::create('2019', '10', '02'),
            'deleteLog_at' => Carbon::create('2019', '10', '02'),
            'id_pegawai_fk' => 2,
        ]);
    }
}
