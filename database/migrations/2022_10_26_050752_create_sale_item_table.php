<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_item', function (Blueprint $table) {
            $table->id();
            $table->string('sale_id');
            $table->string('product_id')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_name')->nullable();
            $table->decimal('product_price', $precision = 8, $scale = 2)->nullable();
            $table->decimal('product_discount', $precision = 8, $scale = 2)->nullable();
            $table->decimal('product_subtotal', $precision = 8, $scale = 2)->nullable();
            $table->string('product_quantity')->nullable();
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
        Schema::dropIfExists('sale_item');
    }
}
