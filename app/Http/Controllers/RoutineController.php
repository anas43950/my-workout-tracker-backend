<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRoutineRequest;
use App\Http\Requests\StoreRoutineRequest;
use App\Http\Resources\RoutineResource;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\ItemNotFoundException;

use function PHPUnit\Framework\isEmpty;

class RoutineController extends Controller
{
    public function index(Request $request)
    {
        $routines = $request->user()->routines;

        if ($routines && count($routines) == 0) {
            return response(['message' => 'No routines found for the user'], 404);
        }
        return RoutineResource::collection($routines->load('workouts'));
    }
    public function routineForDay(IndexRoutineRequest $request)
    {
        try {
            return new RoutineResource($request->user()->routines->where('day', $request->day)->firstOrFail()->load('workouts'));
        } catch (ItemNotFoundException $e) {
            return response(['message' => 'No routine found for this day'], 404);
        }
    }
    public function store(StoreRoutineRequest $request)
    {
        
        $routine = $request->user()->routines()->create([
            'name' => $request->validated()['name'],
            'day' => $request->validated()['day'],
            ]);
        $workouts_ids = $request['workouts_ids'];
        foreach ($workouts_ids as $id) {
            $routine->workouts()->attach($id);
        }

        return new RoutineResource($routine->load('workouts'));
    }
}
