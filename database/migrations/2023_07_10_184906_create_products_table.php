<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price', 8, 2);
            $table->double('priceSale', 8, 2);
            $table->string('gender');
            $table->text('description');
            $table->integer('view')->default(0);
            $table->unsignedBigInteger('idCategory');
            $table->foreign('idCategory')->references('id')->on('categories');
            $table->unsignedBigInteger('idBrand');
            $table->foreign('idBrand')->references('id')->on('brands');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
