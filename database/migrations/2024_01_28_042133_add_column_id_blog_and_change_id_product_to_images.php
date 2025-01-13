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
        Schema::table('images', function (Blueprint $table) {
            $table->unsignedBigInteger('idBlog')->nullable()->after('idProduct');
            $table->foreign('idBlog')->references('id')->on('blogs');
            // Chỉnh sửa cột idProduct và cho phép giá trị NULL
            $table->unsignedBigInteger('idProduct')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            //
            
        });
    }
};