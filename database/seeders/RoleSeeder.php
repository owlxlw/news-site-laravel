<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Создаём роли
        $moderatorRole = Role::create([
            'name' => 'Модератор',
            'slug' => 'moderator',
        ]);

        $readerRole = Role::create([
            'name' => 'Читатель',
            'slug' => 'reader',
        ]);

        // Создаём модератора
        User::create([
            'name' => 'Модератор',
            'email' => 'moderator@test.com',
            'password' => Hash::make('12345678'),
            'role_id' => $moderatorRole->id,
        ]);

        // Создаём обычного пользователя (читателя)
        User::create([
            'name' => 'Читатель',
            'email' => 'reader@test.com',
            'password' => Hash::make('12345678'),
            'role_id' => $readerRole->id,
        ]);
    }
}
