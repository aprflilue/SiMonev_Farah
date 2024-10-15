<?php

namespace Database\Seeders;

use App\Models\{
    User
};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminAkunSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('000000'),  
            'role_id' => 1,  
        ]);
    }
}
