<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('name', 'ADMIN')->first();
        if ($users == null) {
            User::create([
                'name' => 'ADMIN',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
            ]);
        }
    }
}
