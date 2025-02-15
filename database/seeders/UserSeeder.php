<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder {
    public function run(): void {
        User::create( [
            'name' => 'sistema',
            'email' => 'sistema@shnoa.com.ar',
            'password' => bcrypt( 'p@ssword' ), // El password debe estar hasheado
        ] );
        User::create( [
            'name' => 'belen',
            'email' => 'belen@shnoa.com.ar',
            'password' => bcrypt( 'barco.vela.blanca' ), // El password debe estar hasheado
        ] );
    }
}
