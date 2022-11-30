<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('acc_id');
            $table->string('sr_code')->unique()->nullable();
            $table->string('gsuite_email')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('contact')->unique()->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('suffixname')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('classification')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('blood_type')->nullable();
            $table->integer('title')->nullable();
            $table->string('position')->nullable();
            $table->string('license_no')->nullable();
            $table->string('signature')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('password');
            $table->boolean('is_verified')->default(0);
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('home_add_id')->nullable()->unique();
            $table->integer('birth_add_id')->nullable()->unique();
            $table->integer('dorm_add_id')->nullable()->unique();
            $table->integer('fd_id')->nullable()->unique();
            $table->integer('ec_id')->nullable()->unique();
            $table->integer('gl_id')->nullable();
            $table->integer('dept_id')->nullable();
            $table->integer('prog_id')->nullable();
            $table->integer('mhpi_id')->nullable()->unique();
            $table->integer('mha_id')->nullable()->unique();
            $table->integer('mhp_id')->nullable()->unique();
            $table->integer('mhmi_id')->nullable()->unique();
            $table->integer('ad_id')->nullable()->unique();
            $table->integer('vs_id')->nullable()->unique();
        });

        DB::table('accounts')->insert([
            'sr_code' => 'admin',
            'password' => Hash::make('Calma@123'),
            'classification' => 'infirmary personnel',
            'position' => 'admin',
            'is_verified' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
