<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('profile_pic')->nullable();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Personal Info
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table->string('info_title');
            $table->string('info_desc');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_infos');
        Schema::dropIfExists('abouts');
    }
};
