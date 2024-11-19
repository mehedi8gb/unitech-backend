<?php

namespace App\Http\Controllers;

use App\Actions\StoreProjectAction;
use App\Actions\UpdateProjectAction;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    /**
     * Store a new project with associated data.
     */
    public function store(StoreProjectRequest $request, StoreProjectAction $action): JsonResponse
    {
        $validatedData = $request->validated(); 
        // Call the action to store data
        $project = $action->execute($validatedData);

        return response()->json(['data' => ['id'=>$project->id, ...json_decode( $project->data, true)]   ], 201);
    }
    public function update(UpdateProjectRequest $request, UpdateProjectAction $action, $id): JsonResponse
    {
        $validatedData = $request->validated(); 
        // Call the action to store data
        $project = $action->execute($validatedData);
         
        return response()->json(['data' => ['id'=>$project->id, ...json_decode( $project->data, true)]   ], 200);
    }

    /**
     * List all projects with minimal data.
     */
    public function index(): JsonResponse
    {
        // $projects = Project::with([
        //     'floors.units',
        //     'floors.units.bookingStatus',
        //     'floors.units.images',
        //     'images'])->get();
        $projects = Project::all();
        return response()->json(new ProjectCollection($projects));
    }

    /**
     * Show detailed information for a specific project.
     */
    public function show(int $id): JsonResponse
    {
        $project = Project::findOrFail($id);

        return response()->json( new ProjectResource($project));
    }
    public function destroy(int $id): JsonResponse
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json(['message' => 'Project deleted!']);
    }
}

