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
        User::updateOrCreate(
            [
                'name' => 'Laurens'
            ],
            [
                'name' => 'Laurens',
                'email' => 'l.samshuijzen@uu.nl',
                'password' => 'dlsnclksdmcklsmdkclmsdklcmskldmcsdkldscsdcsdcsdc'
            ]
        );
        
        User::updateOrCreate(
            [
                'name' => 'Otto'
            ],
            [
                'name' => 'Otto',
                'email' => 'o.a.lange@uu.nl',
                'password' => 'skjdcnsdncjksdncjksndjkcnsdjkncjksdsdcsdcsdvewvs'
            ]
        );
    }
}
