<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $role=Role::create(['name' => 'admin']);
        // $role=Role::create(['name' => 'chefdep']);
        // $role=Role::create(['name' => 'secretaire']);
        // $role=Role::create(['name' => 'etudiant']);
        $role=Role::create(['name' => 'postulant']);

    }
}
