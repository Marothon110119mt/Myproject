<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_item', function (Blueprint $table) {
            $table->id();
            $table->string('process_id');
            $table->string('product_id');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('product_type');
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
        Schema::dropIfExists('process_item');
    }
}
