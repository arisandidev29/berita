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
        Schema::disableForeignKeyConstraints();

        Schema::create('news_config', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_draf_id')->unique();
            $table->foreign('news_draf_id')->references('user_id')->on('news_draf')->cascadeOnDelete();
            $table->string('tone_style')->default("formal");
            $table->string('prompt_mode')->default("default");
            $table->text('custom_prompt_text')->nullable(true);
            $table->boolean('strict_fact_mode')->default(true);
            $table->timestamps();
            
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_config');
    }
};
