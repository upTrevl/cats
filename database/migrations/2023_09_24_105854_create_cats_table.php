<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('cats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->foreignId('breed_id')
                ->constrained()
                ->onDelete('cascade');
            $table->unsignedBigInteger('image_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cats');
    }
};
