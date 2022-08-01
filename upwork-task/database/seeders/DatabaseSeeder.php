<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        DB::table('users')->insert([
            'reg_no' => '1215',
            'name' => 'super admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt(11223344),
            'gender' => 'male',
            'marital_status' => 'unmarried',
            'mangalik_status' => 'no',
            'birth_date' => '25/01/2002',
            'state' => 'sylhet',
            'image_file' => public_path('images/profile/sourov_profile.png'),
        ]);
    }
}
