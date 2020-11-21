<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert(['title' => 'Cервісне ТО']);
        DB::table('services')->insert(['title' => 'Гальмівна система']);
        DB::table('services')->insert(['title' => 'Підвіска']);
        DB::table('services')->insert(['title' => 'Рульове управління']);
        DB::table('services')->insert(['title' => 'Двигун']);
        DB::table('services')->insert(['title' => 'Паливна система']);
        DB::table('services')->insert(['title' => 'Електрика']);
        DB::table('services')->insert(['title' => 'Вихлопна система']);
        DB::table('services')->insert(['title' => 'Зчеплення']);
        DB::table('services')->insert(['title' => 'Трансмісія']);
        DB::table('services')->insert(['title' => 'Кузов']);
        DB::table('services')->insert(['title' => 'Додатково']);
    }
}
