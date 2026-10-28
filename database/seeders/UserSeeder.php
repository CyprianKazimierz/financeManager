<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
        * User seeder 
        */

        User::create([
            'name'=>'admin',
            'surname'=>'project manager',
            'email'=>'cyprian@projectmanager.com',
            'password'=> Hash::make('Cahoda.2025'),
            'monetary_currency'=>'EUR',
            'locale'=>'es_ES',
            'user_type'=> UserType::where('name','admin')->first()->id,
            'verified'=> true,
        ]);
    }
}
