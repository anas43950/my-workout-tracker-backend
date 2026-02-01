<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Requests\UpdateWorkoutRequest;
use App\Http\Resources\WorkoutResource;
use App\Models\Workout;
use App\Models\WorkoutRecord;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Throwable;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        $workouts = $request->user()->workouts;

        return WorkoutResource::collection($workouts);
    }
    public function store(StoreWorkoutRequest $request)
    {
        $attr = $request->validated();
        $workout = $request->user()->workouts()->create($attr);
        $workout->refresh();
        return new WorkoutResource($workout);
    }

    public function edit(UpdateWorkoutRequest $request)
    {
        $attr = $request->validated();
        $workout = Workout::where('id', $attr['id'])->first();
        $workout->update($request->except(['id']));
        $workout->refresh();
        return new WorkoutResource($workout);
    }

    public function destroy(string $id)
    {
        try {
            $workout = Workout::findOrFail($id);
            $workout->delete();
            return response()->json(null);
        } catch (Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
