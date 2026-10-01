<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat admin & user
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@siakad.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        Profile::create([
            'user_id' => $admin->id,
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1, Jakarta',
            'birth_date' => '1985-05-15',
        ]);


        // == Buat 5 user Dosen
        $dosenUsers = [];
        $dosenNames = ['Prof. Dr. Moh. Farozin, M.Pd.', 'Prof. Dr. Muhammad Nur Wangid, M.Si.', 'Dr. Suwarjo, M.Si.', 'Prof. Dr. Budi Astuti, M.Si.', 'Prof. Dr. Edi Purwanta, M.Pd.'];
        foreach ($dosenNames as $i => $name) {
            $user = User::create([
                'name' =>$name,
                'email' => 'dosen' . ($i + 1) . '@siakad.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
            
            Profile::create([
                'user_id' => $user->id,
                'phone' => '0812345678' . ($i + 10),
                'address' => 'Jl. Dosen No. ' . ($i + 1),
                'birth_date' => '198' . $i . '-0' . ($i + 1) . '-10',
            ]);

            $dosenUsers[] = $user;
        }

        // === Buat 10 user mahasiswa
        $mhsUsers = [];
        $mhsNames = [];

    }
}
