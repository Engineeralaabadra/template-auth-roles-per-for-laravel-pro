<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->string('image')->nullable();
            $table->string('whole_sale_price')->nullable();
            $table->string('main_selling_price')->nullable();
            $table->string('sec_selling_price')->nullable();
            $table->integer('description');
            $table->string('main_quantity')->nullable();
            $table->string('sec_quantity')->nullable();
            $table->string('qty_label')->nullable();
            $table->string('sec_qty_label')->nullable();
            $table->string('item_weight')->nullable();
            $table->string('code')->unique()->nullable();
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
        Schema::dropIfExists('products');
    }
}
