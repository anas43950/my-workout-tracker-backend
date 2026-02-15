<?php

use App\Models\WorkoutChild;
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
        Schema::create('workout_child_sets', function (Blueprint $table) {
            $table->id();
            $table->integer('reps');
            $table->decimal('weight', 8, 3);
            $table->integer('drop_set_reps')->nullable();
            $table->decimal('drop_set_weight', 8, 3)->nullable();
            $table->foreignIdFor(WorkoutChild::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_child_sets');
    }
};
