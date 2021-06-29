<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
           'firstName' => 'John',
           'sirName' => 'Doe',
           'role' => 'admin',
           'email' => 'admin@crms.com',
           'mobile' => '0755011726',
           'gender' => 'male',
           'password' => Hash::make('admin')
        ]);


    }
}
