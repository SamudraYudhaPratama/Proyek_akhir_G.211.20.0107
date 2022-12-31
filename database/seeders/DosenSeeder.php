<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dosens')->insert([
            'nama' => 'Samudra Yudha Pratama',
            'jeniskelamin' => 'cowo',
            'notelpon' => '085840181851',
        ]);
    }
}
