<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Outsider'],
            ['id' => 2, 'name' => 'Student'],
            ['id' => 3, 'name' => 'Lecturer'],
            ['id' => 4, 'name' => 'Admin'],
            ['id' => 5, 'name' => 'Super Admin'],
        ]);
    }
}
