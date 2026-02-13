<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexForDayWorkoutHistoryRequest;
use App\Http\Requests\StoreWorkoutHistoryRequest;
use App\Http\Resources\WorkoutHistoryResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkoutHistoryController extends Controller
{
    public function index(Request $request)
    {
        return WorkoutHistoryResource::collection($request->user()->workoutHistory()->load('sets'));
    }

    public function historyForDay(IndexForDayWorkoutHistoryRequest $request)
    {
        $date = Carbon::parse($request['created_at']);

        $history = $request->user()
            ->workoutHistory()
            ->whereDate("created_at", $date)
            ->with(['children', 'children.sets', 'children.workout'])
            ->get();

        return WorkoutHistoryResource::collection($history);
    }
    public function store(StoreWorkoutHistoryRequest $request)
    {
        $attr = $request->validated();
        $historyRecord = $request->user()->workoutHistory()->create(
            $request->only(['note'])
        );

        foreach ($attr['logs'] as $value) {
            $child = $historyRecord->children()->create([
                'workout_id' => $value['workout_id']
            ]);
            $child->sets()->createMany($value['sets']);
        }
        return new WorkoutHistoryResource($historyRecord->load(['children', 'children.sets', 'children.workout']));
    }
}
