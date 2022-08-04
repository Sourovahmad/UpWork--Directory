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
            'gender' => 'Boy',
            'marital_status' => 'unmarried',
            'mangalik_status' => 'no',
            'birth_date' => '25/01/2002',
            'state' => 'sylhet',
            'image_file' => "user_1.png",

            'payment' => 'TRUE',
            'facebook' => 'facebook.com',
            'insta' => 'instagram.com',
            'mobile_no' => '12345678',
            'address' => 'Sylhet',
            'father_name' => 'Father',
            'father_occuption' => 'Business Man',
            'mother_name' => 'Mother',
            'mother_occuption' => 'teacher',
            'month' => '01',
            'year' => '2002',
            'time' => '10:35 PM',
            'birth_city' => 'city',
            'height' => "5'7",
            'complexion' => 'fear',
            'occupation' => 'programmer',
            'income' => '100k',
            'education_qualification' => 'B.tech',
            'drinking' => 'no',
            'eating' => 'yes',
            'weight' => '70kg',
            'smoker' => 'no',
            'relation' => 'friend',
            'number' => '123456',
            'rname' => 'NJ',
            'bussiness_and_company_name' => 'Business',
            'family_gotra' => 'shekh',
            'working_city' => 'india',
            'min_income' => '45000',
            'rashi' => 'none',
            'preference' => 'none',
            'additional' => 'must be 0',
            'brothers' => '2',
            'sisters' => '3',
            'designation' => 'CEO',
        ]);
    }
}
