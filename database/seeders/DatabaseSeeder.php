<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        // Новости пока не добавляем, чтобы не было ошибки
        // $this->call(ArticleSeeder::class);
    }
}
