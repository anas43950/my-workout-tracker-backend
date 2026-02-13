<?php

use App\Models\Workout;
use App\Models\WorkoutHistory;
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
        Schema::create('workout_history_children', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WorkoutHistory::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Workout::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_history_children');
    }
};
