<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_item', function (Blueprint $table) {
            $table->id();
            $table->string('issue_id');
            $table->string('product_id');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('product_type');
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
        Schema::dropIfExists('issue_item');
    }
}
