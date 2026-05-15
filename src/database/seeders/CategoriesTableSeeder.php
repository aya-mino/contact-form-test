<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
        'content' => '商品のお届けについて'
        ]);

        DB::table('categories')->insert([
        'content' => '商品の交換について'
        ]);

        DB::table('categories')->insert([
        'content' => '商品トラブル'
        ]);

        DB::table('categories')->insert([
        'content' => 'ショップへのお問い合わせ'
        ]);

        DB::table('categories')->insert([
        'content' => 'その他'
        ]);
    }
}
