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

        Schema::create('news_result', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_draft_id')->unique();
            $table->text('content_generated');
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->foreign("news_draft_id")->references("id")->on("news_draf")->cascadeOnDelete();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_result');
    }
};
