<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('g_number')->nullable();
            $table->date('date')->nullable();
            $table->date('last_change_date')->nullable();
            $table->string('supplier_article')->nullable();
            $table->string('tech_size')->nullable();
            $table->string('barcode')->nullable();
            $table->unsignedInteger('total_price')->nullable();
            $table->unsignedInteger('discount_percent')->nullable();

            $table->unsignedTinyInteger('is_supply')->default(0);
            $table->unsignedTinyInteger('is_realization')->default(0);

            $table->unsignedInteger('promo_code_discount')->default(0);
            $table->string('warehouse_name')->nullable();
            $table->string('country_name')->nullable();
            $table->string('oblast_okrug_name')->nullable();
            $table->string('region_name')->nullable();

            $table->unsignedBigInteger('income_id')->nullable();
            $table->unsignedBigInteger('sale_id')->nullable();
            $table->unsignedBigInteger('odid')->nullable();
            $table->unsignedBigInteger('spp')->nullable();
            $table->double('for_pay')->nullable();
            $table->double('finished_price')->nullable();
            $table->double('price_with_disc')->nullable();

            $table->unsignedBigInteger('nm_id')->nullable();
            $table->string('subject')->nullable();
            $table->string('category')->nullable();
            $table->string('brand')->nullable();

            $table->unsignedTinyInteger('is_storno')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
