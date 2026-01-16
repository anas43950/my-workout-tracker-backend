<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexWorkoutRecordRequest;
use App\Http\Requests\StoreWorkoutRecordRequest;
use App\Http\Resources\WorkoutRecordResource;
use Illuminate\Http\Request;

class WorkoutRecordController extends Controller
{
    public function index(Request $request)
    {
        return WorkoutRecordResource::collection($request->user()->workoutRecords->load('sets'));
    }

    public function recordsForDay(IndexWorkoutRecordRequest $request)
    {
        return WorkoutRecordResource::collection($request->user()->workoutRecords->load('sets'));
    }
    public function store(StoreWorkoutRecordRequest $request)
    {
        $attr = $request->validated();
        $record = $request->user()->workoutRecords()->create(['workout_id' => $attr['workout_id']]);


        foreach ($attr['sets'] as $item) {
            $record->sets()->create($item);
        }

        return new WorkoutRecordResource($record->load('sets'));
    }
}
