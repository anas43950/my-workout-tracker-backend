<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Resources\WorkoutResource;
use Illuminate\Http\Request;

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
        return new WorkoutResource($request->user()->workouts()->create([
            'name' => $attr['name']
        ]));
    }
}
