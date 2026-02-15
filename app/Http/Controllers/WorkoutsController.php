<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexForRoutineWorkoutsRequest;
use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Resources\WorkoutResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkoutsController extends Controller
{
    public function index(Request $request)
    {
        return WorkoutResource::collection($request->user()->workouts()->with(['children', 'children.sets', 'children.exercise'])->get());
    }

    public function workoutsForRoutine(IndexForRoutineWorkoutsRequest $request)
    {
        $workouts = $request->user()
            ->workouts()
            ->where('routine_id', $request->routine_id)
            ->with(['children', 'children.sets', 'children.exercise'])
            ->get();

        return WorkoutResource::collection($workouts);
    }
    public function store(StoreWorkoutRequest $request)
    {
        $attr = $request->validated();
        $workoutRecord = $request->user()->workouts()->create(
            $request->only(['note', 'routine_id'])
        );

        foreach ($attr['logs'] as $value) {
            $child = $workoutRecord->children()->create([
                'exercise_id' => $value['exercise_id']
            ]);
            $child->sets()->createMany($value['sets']);
        }
        return new WorkoutResource($workoutRecord->load(['children', 'children.sets', 'children.exercise']));
    }
}
