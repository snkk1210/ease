<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@localhost',
                'password' => bcrypt("easeease"),
                'role' => 1,
            ],
            [
                'name' => 'read-only',
                'email' => 'read@localhost',
                'password' => bcrypt("easeease"),
                'role' => 15,
            ],
        ]);
    }
}
