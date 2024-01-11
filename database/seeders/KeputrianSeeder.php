<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeputrianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keputrian')->insert([
            'judul' => 'Profile Keputrian',
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec velit nisl, rhoncus eu lorem vitae, interdum pellentesque elit. Cras venenatis enim sit amet mauris accumsan, non tincidunt nulla volutpat. Quisque leo ante, sagittis eget quam euismod, lobortis iaculis sem. Quisque sit amet ante felis. ',
        ]);
    }
}
