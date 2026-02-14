<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Http\Resources\ExerciseResource;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Throwable;

class ExerciseController extends Controller
{
    public function index(Request $request)
    {
        return ExerciseResource::collection($request->user()->exercises);
    }
    public function store(StoreExerciseRequest $request)
    {
        $attr = $request->validated();
        $exercise = $request->user()->exercises()->create($attr);
        $exercise->refresh();
        return new ExerciseResource($exercise);
    }

    public function edit(UpdateExerciseRequest $request)
    {
        $attr = $request->validated();
        $exercise = Exercise::where('id', $attr['id'])->first();
        $exercise->update($request->except(['id']));
        $exercise->refresh();
        return new ExerciseResource($exercise);
    }

    public function destroy(string $id)
    {
        try {
            $exercise = Exercise::findOrFail($id);
            $exercise->delete();
            return response()->json(null);
        } catch (Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
