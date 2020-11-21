<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert(['title' => 'Автовласник']);
        DB::table('user_roles')->insert(['title' => 'Майстер']);
        DB::table('user_roles')->insert(['title' => 'Сервісний центр']);
        DB::table('user_roles')->insert(['title' => 'Адміністратор']);
    }
}
