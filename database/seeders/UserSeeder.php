<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'admin@gmail.com',
            'name' => 'Admin',
            'surname' => 'Admin',
            'phone' => '09946923170',
            'city_id' => 1,
            'user_role_id' => 4,
            'password' => bcrypt('password')
        ]);
    }
}
