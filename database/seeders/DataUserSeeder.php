<?php

namespace Database\Seeders;
use App\Models\DataUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataUser::create([
            'user_id' => 1,
            'user_name' => 'nurulaulia',
            'user_email' => 'john@example.com',
            'user_password' => bcrypt('Nurulauliaseptiani9@gmail.com'),
            'user_gender' => 'female',
            'user_photo' => 'nurul.jpg',
            'role_id' => 1,
            'user_token' => 123
            
        ]);
    }
}
