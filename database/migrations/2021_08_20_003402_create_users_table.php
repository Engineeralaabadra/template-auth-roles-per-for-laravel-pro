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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('name');
            $table->string('name_en');
            $table->string('organization');
            $table->string('image')->nullable();
            $table->string('address');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('phone_no1');
            $table->string('phone_no2')->nullable();
            $table->integer('national_id');
            $table->string('secret_code');
            $table->string('end_date')->nullable();
            $table->string('silent_mode')->nullable();
            $table->string('printing_method')->nullable();
            $table->string('printer')->nullable();
            $table->string('language')->nullable();
            $table->string('save_mode')->nullable();
            $table->string('reg_info');
            $table->enum('status',['InActive','Active'])->default('Active');
            $table->rememberToken();
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
