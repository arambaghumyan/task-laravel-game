<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'      => 'admin',
            'phone'     => '777777',
            'password'  => Hash::make('adminadmin')
        ]);
        $adminRole = Role::where('name', 'admin')->first();
        $user->role()->attach([
            'role_id'   =>  $adminRole->id
        ]);
    }
}
