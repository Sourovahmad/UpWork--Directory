<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            $table->string('reg_no');
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
  

            $table->string('password');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('mangalik_status');
            $table->string('birth_date');
            $table->string('state')->nullable();
            $table->longText('image_file');

            $table->string('payment');
            $table->string('facebook')->nullable();
            $table->string('insta')->nullable();
            $table->string('mobile_no');
            $table->string('address');
            $table->string('father_name');
            $table->string('father_occuption');

            $table->string('mother_name');
            $table->string('mother_occuption');


            $table->string('month')->nullable();
            $table->string('year')->nullable();
        
            $table->string('time');

            $table->string('birth_city');


            $table->string('height');
            $table->string('complexion');
            $table->string('occupation');
            $table->string('income');
            $table->string('education_qualification');
            $table->string('drinking');
            $table->string('eating');
            $table->string('weight');
            $table->string('smoker');
            $table->string('relation');
            
            $table->string('rnumber');
            $table->string('rname');
            $table->string('bussiness_and_company_name');
            $table->string('family_gotra');
            
            $table->string('working_city');
            $table->string('min_income')->nullable();
            $table->string('rashi');
            $table->string('preference');

            $table->longText('additional');
            $table->string('brothers');
            $table->string('sisters');
            $table->string('designation');


            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
