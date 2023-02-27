<?php

use App\Enum\GameResultStatusEnum;
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
        Schema::table('games', function (Blueprint $table) {
            $table->enum(
                'result_status',
                \App\Helper\EnumHelper::getValuesAsArray(GameResultStatusEnum::class)
            )->after('status')->default(GameResultStatusEnum::IN_QUEUE->value);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn('result_status');
        });
    }
};
