<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [

                'name' => 'Bintang',
                'email' => 'muhbintang650@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('bintang0202'),
            ],
            [
                'name' => 'Fery',
                'email' => 'feryfadulrahman@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
            ],
            [
                'name' => 'develop',
                'email' => 'develop@email',
                'password' => bcrypt('bintangganteng'),
                'role' => 'user',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
