<?php

namespace App\Actions;

use App\Models\Project;
use App\Models\Floor;
use App\Models\Unit;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class UpdateProjectAction
{
    /**
     * Execute the action to store a project and related data.
     */
    public function execute(array $data): Project
    {
        $project = Project::findOrFail($data['id']);
        $project->data = json_encode($data);
        $project->save(); 
        return $project;
 
    }
}

