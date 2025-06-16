<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Equip;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'administrador',
        ]);

        foreach (Equip::all() as $equip){
            User::create([
                'name' => 'Manager  '.$equip->nom,
                'email' => str_replace(' ', '', $equip->nom).'@example.com',
                'password' => Hash::make('1234'),
                'role' => 'manager',
                'equip_id' => $equip->id,
            ]);
        }
        User::factory()->count(10)->arbitre()->unverified()->create();
    }
}
