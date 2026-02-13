<?php

use App\Models\WorkoutHistoryChild;
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
        Schema::create('workout_history_sets', function (Blueprint $table) {
            $table->id();
            $table->integer('reps');
            $table->integer('weight');
            $table->integer('drop_set_reps')->nullable();
            $table->integer('drop_set_weight')->nullable();
            $table->foreignIdFor(WorkoutHistoryChild::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_history_sets');
    }
};
