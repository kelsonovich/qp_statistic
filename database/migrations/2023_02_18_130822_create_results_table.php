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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id');
            $table->integer('team_id');
            $table->float('place')->nullable();
            $table->float('round_1')->nullable();
            $table->float('round_2')->nullable();
            $table->float('round_3')->nullable();
            $table->float('round_4')->nullable();
            $table->float('round_5')->nullable();
            $table->float('round_6')->nullable();
            $table->float('round_7')->nullable();
            $table->float('round_8')->nullable();
            $table->float('round_9')->nullable();
            $table->float('round_10')->nullable();
            $table->float('round_11')->nullable();
            $table->float('round_12')->nullable();
            $table->float('round_13')->nullable();
            $table->float('round_14')->nullable();
            $table->float('round_15')->nullable();
            $table->float('total')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
