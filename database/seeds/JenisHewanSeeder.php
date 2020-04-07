<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class JenisHewanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenishewans')->insert([
            'nama_jenisHewan' => 'Anjing',
            'createLog_by' => 'Vincent Wibowo',
            'updateLog_by' => 'Vincent Wibowo',
            'deleteLog_by' => 'Vincent Wibowo',
            'createLog_at' => Carbon::create('2019', '10', '11'),
            'updateLog_at' => Carbon::create('2019', '10', '11'),
            'deleteLog_at' => Carbon::create('2019', '10', '11'),
            'id_pegawai_fk' => 1,
        ]);
        DB::table('jenishewans')->insert([
            'nama_jenisHewan' => 'Kucing',
            'createLog_by' => 'Al Sigit',
            'updateLog_by' => 'Al Sigit',
            'deleteLog_by' => 'Al Sigit',
            'createLog_at' => Carbon::create('2019', '10', '12'),
            'updateLog_at' => Carbon::create('2019', '10', '12'),
            'deleteLog_at' => Carbon::create('2019', '10', '12'),
            'id_pegawai_fk' => 2,
        ]);
        DB::table('jenishewans')->insert([
            'nama_jenisHewan' => 'Hamster',
            'createLog_by' => 'Vincent Wibowo',
            'updateLog_by' => 'Vincent Wibowo',
            'deleteLog_by' => 'Vincent Wibowo',
            'createLog_at' => Carbon::create('2019', '10', '11'),
            'updateLog_at' => Carbon::create('2019', '10', '11'),
            'deleteLog_at' => Carbon::create('2019', '10', '11'),
            'id_pegawai_fk' => 1,
        ]);
        DB::table('jenishewans')->insert([
            'nama_jenisHewan' => 'Iguana',
            'createLog_by' => 'Al Sigit',
            'updateLog_by' => 'Al Sigit',
            'deleteLog_by' => 'Al Sigit',
            'createLog_at' => Carbon::create('2019', '10', '12'),
            'updateLog_at' => Carbon::create('2019', '10', '12'),
            'deleteLog_at' => Carbon::create('2019', '10', '12'),
            'id_pegawai_fk' => 2,
        ]);
        DB::table('jenishewans')->insert([
            'nama_jenisHewan' => 'Kura-Kura',
            'createLog_by' => 'Vincent Wibowo',
            'updateLog_by' => 'Vincent Wibowo',
            'deleteLog_by' => 'Vincent Wibowo',
            'createLog_at' => Carbon::create('2019', '10', '11'),
            'updateLog_at' => Carbon::create('2019', '10', '11'),
            'deleteLog_at' => Carbon::create('2019', '10', '11'),
            'id_pegawai_fk' => 1,
        ]);
    }
}
