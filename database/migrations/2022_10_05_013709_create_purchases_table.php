<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('reference_no');
            $table->string('supplier_id');
            $table->string('warehouse_id');
            $table->string('payment_method');
            $table->string('note')->nullable();
            $table->decimal('total', $precision = 25, $scale = 4);
            $table->decimal('grand_total', $precision = 25, $scale = 4);
            $table->decimal('total_discount', $precision = 25, $scale = 4);
            $table->string('shipping')->nullable();
            $table->string('paid')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
