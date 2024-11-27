<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function uploadImage(Request $request): \Illuminate\Http\JsonResponse
    {
        // Validate the incoming request for the file
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:102400', // Only allow images
        ]);

        // Initialize the ImageManager with the appropriate driver (GD or Imagick)
        $manager = new ImageManager(new Driver()); // You can change to Imagick if needed

        // Store the original image in the 'public' disk
        $image = $request->file('image');
        $imageName = Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
        $originalName = $image->getClientOriginalName();

        // Load the image using the ImageManager (v3.x)
        $imageInstance = $manager->read($image);

        // Define the folder names for different sizes
        $sizes = [
            'original' => null,           // Original (no resizing)
            'thumbnail' => [300, 200],    // Thumbnail (150x150)
            'small' => [400, 300],        // Small size (300x200)
            'medium' => [800, 600],       // Medium size (800x600)
            'large' => [1200, 800],       // Large size (1200x800)
        ];

        // Define the base folder path
        $baseFolderPath = public_path('storage/images');

        // Create the main folder if it doesn't exist
        if (!file_exists($baseFolderPath)) {
            mkdir($baseFolderPath, 0777, true); // Create the main 'images' folder if it doesn't exist
        }

// Loop through the sizes and save each image
        foreach ($sizes as $size => $dimensions) {
            // If the size is 'original', we don't resize and save the original image directly
            if ($size === 'original') {
                $originalFolderPath = "{$baseFolderPath}/original";
                if (!file_exists($originalFolderPath)) {
                    mkdir($originalFolderPath, 0777, true); // Create the 'original' folder if it doesn't exist
                }
                $imageInstance->save("{$originalFolderPath}/{$imageName}");
                continue; // Skip the rest of the loop and continue to the next size
            }

            // For other sizes, create the folder for the current size if it doesn't exist
            $folderPath = "{$baseFolderPath}/{$size}";
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true); // Create the folder if it doesn't exist
            }

            // Get image width and height
            $width = $imageInstance->width();
            $height = $imageInstance->height();

            // Determine if the image is landscape or portrait
            if ($width > $height) {
                // Landscape: Resize to the specified dimensions
                $imageInstance->resize($dimensions[0], $dimensions[1])->save("{$folderPath}/{$imageName}");
            } else {
                // Portrait: Swap width and height for resizing
                $imageInstance->resize($dimensions[1], $dimensions[0])->save("{$folderPath}/{$imageName}");
            }
        }


        // Prepare URLs for all sizes, including original
        $urls = [
            'original' => asset('storage/images/original/' . $imageName),  // Original image URL
            'thumbnail' => asset('storage/images/thumbnail/' . $imageName), // Thumbnail URL
            'small' => asset('storage/images/small/' . $imageName),        // Small size URL
            'medium' => asset('storage/images/medium/' . $imageName),       // Medium size URL
            'large' => asset('storage/images/large/' . $imageName),         // Large size URL
        ];

        // Return the response with image name and all sizes
        return response()->json([
            'name' => $originalName,
            'src' => $urls['original'], // Use the original size URL for backward compatibility
            'sizes' => $urls,           // Includes URLs for all sizes, including original
        ]);

    }
}

