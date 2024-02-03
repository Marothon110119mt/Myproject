<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('type');
            $table->string('quantity');
            $table->decimal('row', $precision = 8, $scale = 2);
            $table->decimal('price', $precision = 8, $scale = 2);
            $table->decimal('cost', $precision = 8, $scale = 2);
            $table->string('photo')->nullable();
            $table->string('brand')->nullable();
            $table->string('category');
            $table->string('unit');
            $table->string('alert')->nullable();
            $table->string('hide')->nullable();
            $table->string('status')->nullable();
            $table->string('detail')->nullable();
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
        Schema::dropIfExists('product');
    }
}
