<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Aleksey Kononenko',
            'email' => 'a.kononenko@neovoxtech.ru',
            'password' => Hash::make('KrA2/xW/'),
        ]);

        DB::table('users')->insert([
            'name' => 'Alyona Bondarenko',
            'email' => 'a.bondarenko@neovox.ru',
            'password' => Hash::make('H36#p#G7'),
        ]);
    }
}
