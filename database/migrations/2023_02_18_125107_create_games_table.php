<?php

use App\Enum\GameStatusEnum;
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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('number');
            $table->integer('package')->nullable();
            $table->integer('thematic_id')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->string('place')->nullable();
            $table->string('result_hash')->nullable();
            $table->enum('status', \App\Helper\EnumHelper::getValuesAsArray(GameStatusEnum::class));
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
