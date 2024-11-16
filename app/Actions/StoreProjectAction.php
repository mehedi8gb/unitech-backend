<?php

namespace App\Actions;

use App\Models\Project;
use App\Models\Floor;
use App\Models\Unit;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class StoreProjectAction
{
    /**
     * Execute the action to store a project and related data.
     */
    public function execute(array $data): Project
    {
        $project = new Project();
        $project->data = json_encode($data);
        $project->save();
        return $project;
        // return DB::transaction(function () use ($data) {
        //     // Create the project
        //     $project = Project::create([
        //         'name' => $data['name'],
        //         'description' => $data['description'] ?? null,
        //         'location' => $data['location'],
        //     ]);

        //     // Handle project images if provided
        //     if (isset($data['images'])) {
        //         foreach ($data['images'] as $imagePath) {
        //             $project->images()->create(['url' => $imagePath]);
        //         }
        //     }

        //     // Create floors and units
        //     foreach ($data['floors'] as $floorData) {
        //         $floor = $project->floors()->create([
        //             'floor_number' => $floorData['floor_number'],
        //             'description' => $floorData['description'] ?? null,
        //         ]);

        //         foreach ($floorData['units'] as $unitData) {
        //             $unit = $floor->units()->create([
        //                 'unit_number' => $unitData['unit_number'],
        //                 'size' => $unitData['size'],
        //                 'price' => $unitData['price'],
        //             ]);

        //             // Handle booking status if provided
        //             if (isset($unitData['booking_status'])) {
        //                 $unit->bookingStatus()->create([
        //                     'status_name' => $unitData['booking_status']['status_name'],
        //                     'color_code' => $unitData['booking_status']['color_code'],
        //                 ]);
        //             }

        //             // Handle unit images if provided
        //             if (isset($unitData['images'])) {
        //                 foreach ($unitData['images'] as $imagePath) {
        //                     $unit->images()->create(['url' => $imagePath]);
        //                 }
        //             }
        //         }
        //     }

        //     return $project;
        // });
    }
}

