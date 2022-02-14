<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Laurens',
            'email' => 'l.samshuijzen@uu.nl',
            'password' => bcrypt('123456'),
        ]);
        
        User::create([
            'name' => 'Otto',
            'email' => 'o.a.lange@uu.nl',
            'password' => bcrypt('123456abc'),
        ]);
    }
}
