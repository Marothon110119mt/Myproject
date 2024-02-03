<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('type')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('warehouse_id')->nullable();
            $table->string('total_item')->nullable();
            $table->string('paying_by')->nullable();
            $table->decimal('discount', $precision = 25, $scale = 2)->nullable();
            $table->decimal('paid', $precision = 25, $scale = 2)->nullable();
            $table->decimal('paid_khmer', $precision = 25, $scale = 2)->nullable();
            $table->decimal('payableprice', $precision = 25, $scale = 2)->nullable();
            $table->decimal('payablepricekhmer', $precision = 25, $scale = 2)->nullable();
            $table->decimal('grand_total', $precision = 25, $scale = 2)->nullable();
            $table->decimal('total', $precision = 25, $scale = 2)->nullable();
            $table->decimal('balance', $precision = 25, $scale = 2)->nullable();
            $table->decimal('balancekhmer', $precision = 25, $scale = 2)->nullable();
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
        Schema::dropIfExists('sales');
    }
}
