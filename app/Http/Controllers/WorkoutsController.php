<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexForDayWorkoutsRequest;
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

    public function workoutsForDay(IndexForDayWorkoutsRequest $request)
    {
        $date = Carbon::parse($request['created_at']);

        $workout = $request->user()
            ->workouts()
            ->whereDate("created_at", $date)
            ->with(['children', 'children.sets', 'children.exercise'])
            ->get();

        return WorkoutResource::collection($workout);
    }
    public function store(StoreWorkoutRequest $request)
    {
        $attr = $request->validated();
        $workoutRecord = $request->user()->workouts()->create(
            $request->only(['note'])
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
