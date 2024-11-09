<?php

namespace App\Http\Controllers;

use App\Actions\StoreProjectAction;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectCollection;
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

        return response()->json(['data' => $project], 201);
    }

    /**
     * List all projects with minimal data.
     */
    public function index(): JsonResponse
    {
        $projects = Project::with([
            'floors.units',
            'floors.units.bookingStatus',
            'floors.units.images',
            'images'])->get();
        return response()->json(new ProjectCollection($projects));
    }

    /**
     * Show detailed information for a specific project.
     */
    public function show(int $id): JsonResponse
    {
        $project = Project::with('floors.units.bookingStatus', 'floors.units.agentSales.agent', 'images')
            ->findOrFail($id);

        return response()->json(['data' => $project]);
    }
}

