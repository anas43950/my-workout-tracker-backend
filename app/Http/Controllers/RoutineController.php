<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRoutineRequest;
use App\Http\Requests\StoreRoutineRequest;
use App\Http\Requests\UpdateRoutineRequest;
use App\Http\Resources\RoutineResource;
use App\Models\Routine;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\ItemNotFoundException;
use Throwable;

use function PHPUnit\Framework\isEmpty;

class RoutineController extends Controller
{
    public function index(Request $request)
    {
        $routines = $request->user()->routines;

        return RoutineResource::collection($routines->load(['positionedWorkouts', 'positionedWorkouts.workout']));
    }
    public function routineByName(IndexRoutineRequest $request)
    {
        try {
            return new RoutineResource($request->user()->routines->where('name', $request->name)->firstOrFail()->load(['positionedWorkouts', 'positionedWorkouts.workout']));
        } catch (ItemNotFoundException $e) {
            return response(['message' => 'No routine found for this day'], 404);
        }
    }
    public function store(StoreRoutineRequest $request)
    {
        $attr = $request->validated();

        $routine = $request->user()->routines()->create([
            'name' => $attr['name']
        ]);

        foreach ($attr['workouts_ids'] as $key => $value) {
            $routine->positionedWorkouts()->create([
                'index' => $key,
                'workout_id' => $value,
            ]);
        }
        return new RoutineResource($routine->load(['positionedWorkouts', 'positionedWorkouts.workout']));
    }

    public function edit(UpdateRoutineRequest $request)
    {
        $attr = $request->validated();
        $routine = Routine::where('id', $attr['id'])->first();
        $routine->update([
            'name' => $request->get('name', $routine->name)
        ]);

        $routine->positionedWorkouts()->delete();
        foreach ($attr['workouts_ids'] as $key => $value) {
            $routine->positionedWorkouts()->create([
                'index' => $key,
                'workout_id' => $value,
            ]);
        }

        return new RoutineResource($routine->load(['positionedWorkouts', 'positionedWorkouts.workout']));
    }


    public function destroy(string $id)
    {
        try {
            $routine = Routine::findOrFail($id);
            $routine->delete();
            return response()->json(null);
        } catch (Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
