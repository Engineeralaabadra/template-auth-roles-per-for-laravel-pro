<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            $table->string('address');
            $table->string('phone_no1');
            $table->string('phone_no2')->nullable();
            $table->string('deserved')->nullable();
            $table->string('paid')->nullable();
            $table->enum('status_pay',['UnPaid','Paid'])->default('UnPaid');
            $table->enum('status',['InActive','Active'])->default('Active');
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
        Schema::dropIfExists('clients');
    }
}
