<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FreshInstallSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => env('SUPER_ADMIM_NAME', 'Super Admin'),
            'email' => env('SUPER_ADMIM_EMAIL', 'super@admin.com'),
            'password' => Hash::make(env('SUPER_ADMIM_PASSWORD', 'secret')),
        ]);
    }
}