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

        Schema::create('news_draf', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('title');
            $table->string('tokoh');
            $table->string('peristiwa');
            $table->string('lokasi');
            $table->date('waktu')->useCurrent();
            $table->string('kronologi');
            $table->text('content_berita')->nullable(true);
            $table->text('data_pendukung')->nullable(true);
            $table->enum('status', ["panding","generate","publish"]);
            $table->text('image')->nullable(true);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_draf');
    }
};
