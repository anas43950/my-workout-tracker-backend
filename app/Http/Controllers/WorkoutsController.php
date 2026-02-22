<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexForDateWorkoutsRequest;
use App\Http\Requests\IndexForRoutineWorkoutsRequest;
use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Resources\WorkoutResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkoutsController extends Controller
{
    public function index(Request $request)
    {
        return WorkoutResource::collection(
            $request->user()->workouts()
                ->orderByDesc('created_at')
                ->with(['children', 'children.sets', 'children.exercise'])
                ->get()
        );
    }

    public function workoutsForDate(IndexForDateWorkoutsRequest $request)
    {
        $date = Carbon::parse($request['date']);

        $workout = $request->user()
            ->workouts()
            ->whereDay("created_at", $date)
            ->with(['children', 'children.sets', 'children.exercise'])
            ->get();

        return WorkoutResource::collection($workout);
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
            [
                'routine_id' => $request->routine_id,
                'note' => $request->note,
                'started_at' => $request->has('started_at') ? Carbon::parse($request->started_at)->utc()->toIso8601String() : null,
            ]
        );

        foreach ($attr['logs'] as $value) {
            $child = $workoutRecord->children()->create([
                'exercise_id' => $value['exercise_id']
            ]);

            $child->sets()->createMany($value['sets'] ?? []);
        }
        $workoutRecord->refresh();
        return new WorkoutResource($workoutRecord->load(['children', 'children.sets', 'children.exercise']));
    }
}
