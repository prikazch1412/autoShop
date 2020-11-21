<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert(['title' => 'Автономна Республіка Крим']);
        DB::table('regions')->insert(['title' => 'Вінницька область']);
        DB::table('regions')->insert(['title' => 'Волинська область']);
        DB::table('regions')->insert(['title' => 'Дніпропетровська область']);
        DB::table('regions')->insert(['title' => 'Донецька область']);
        DB::table('regions')->insert(['title' => 'Житомирська область']);
        DB::table('regions')->insert(['title' => 'Закарпатська область']);
        DB::table('regions')->insert(['title' => 'Запорізька область']);
        DB::table('regions')->insert(['title' => 'Івано-Франківська область']);
        DB::table('regions')->insert(['title' => 'Київська область']);
        DB::table('regions')->insert(['title' => 'Кіровоградська область']);
        DB::table('regions')->insert(['title' => 'Луганська область']);
        DB::table('regions')->insert(['title' => 'Львівська область']);
        DB::table('regions')->insert(['title' => 'Миколаївська область']);
        DB::table('regions')->insert(['title' => 'Одеська область']);
        DB::table('regions')->insert(['title' => 'Полтавська область']);
        DB::table('regions')->insert(['title' => 'Рівненська область']);
        DB::table('regions')->insert(['title' => 'Сумська область']);
        DB::table('regions')->insert(['title' => 'Тернопільська область']);
        DB::table('regions')->insert(['title' => 'Харківська область']);
        DB::table('regions')->insert(['title' => 'Херсонська область']);
        DB::table('regions')->insert(['title' => 'Хмельницька область']);
        DB::table('regions')->insert(['title' => 'Черкаська область']);
        DB::table('regions')->insert(['title' => 'Чернігівська область']);
        DB::table('regions')->insert(['title' => 'Чернівецька область']);
    }
}
