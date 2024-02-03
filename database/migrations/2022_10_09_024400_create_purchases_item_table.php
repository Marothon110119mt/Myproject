<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases_item', function (Blueprint $table) {
            $table->id();
            $table->string('purchases_id');
            $table->string('product_id');
            $table->string('product_code');
            $table->string('product_name');
            $table->decimal('product_cost', $precision = 8, $scale = 2);
            $table->decimal('product_tax', $precision = 8, $scale = 2)->nullable();
            $table->decimal('product_discount', $precision = 8, $scale = 2)->nullable();
            $table->decimal('product_subtotal', $precision = 8, $scale = 2);
            $table->string('product_quantity');
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
        Schema::dropIfExists('purchases_item');
    }
}
