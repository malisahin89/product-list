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
        Schema::create('urunler', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable();
            $table->integer('sira')->nullable();
            $table->string('tr');
            $table->string('slug')->nullable();
            $table->integer('price');
            $table->longText('image');
            $table->string('en')->nullable();
            $table->string('ru')->nullable();
            $table->string('ar')->nullable();
            $table->enum('status',['0','1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
