<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::exists()) {
            return;
        }

        $password = (string) env('ADMIN_PASSWORD', '');

        if (strlen($password) < 8) {
            throw new RuntimeException('ADMIN_PASSWORD wajib diisi dan minimal 8 karakter.');
        }

        if (app()->environment('production') && in_array(strtolower($password), ['password', 'secret'], true)) {
            throw new RuntimeException('ADMIN_PASSWORD tidak boleh memakai nilai default di production.');
        }

        User::create([
            'name' => env('ADMIN_NAME', 'Administrator'),
            'email' => env('ADMIN_EMAIL', 'admin@example.com'),
            'password' => Hash::make($password),
        ]);
    }
}

