<?php

use App\Models\Routine;
use App\Models\Workout;
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
        Schema::create('routine_workout', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Routine::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Workout::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routine_workout');
    }
};
