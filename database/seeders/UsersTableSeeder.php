<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Créer un utilisateur admin
        $admin = User::create([
            'name' => 'secretaire',
            'email' => 'secretaire@gmail.com',
            'password' => bcrypt('passer'),
        ]);
        
        // Affecter le rôle admin à l'utilisateur
        $admin->assignRole('secretaire');
    }
    }

