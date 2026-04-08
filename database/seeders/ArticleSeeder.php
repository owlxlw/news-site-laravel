<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // Создаём 20 фейковых новостей
        Article::factory(20)->create();
    }
}
