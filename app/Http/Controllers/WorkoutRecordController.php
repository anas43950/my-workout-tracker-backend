<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexForDayWorkoutRecordRequest;
use App\Http\Requests\StoreWorkoutRecordRequest;
use App\Http\Resources\WorkoutRecordResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkoutRecordController extends Controller
{
    public function index(Request $request)
    {
        return WorkoutRecordResource::collection($request->user()->workoutRecords->load('sets'));
    }

    public function recordsForDay(IndexForDayWorkoutRecordRequest $request)
    {
        $date = $request['created_at'];
        $start = Carbon::parse($date)
            ->startOfDay();

        $end = Carbon::parse($date)
            ->endOfDay();

        $records = $request->user()
            ->workoutRecords()
            ->whereBetween("created_at", [$start, $end])
            ->with('workout')
            ->with('sets')
            ->get();

        return WorkoutRecordResource::collection($records);
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
