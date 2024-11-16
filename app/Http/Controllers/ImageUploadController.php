<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        // Validate the incoming request for the file
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:102400', // Only allow images
        ]);

        // Store the image in the 'public' disk
        $imagePath = $request->file('image')->store('images', 'public');
        $image = $request->file('image');
        // Get the file name (not full path)
        $imageName = basename($imagePath);
        $originalName = $image->getClientOriginalName();
        // Create the full URL
        $imageUrl = asset('storage/' . $imagePath); // Example: http://yourdomain.com/storage/images/image.jpg

        // Return the response with image name and URL
        return response()->json([
            'name' => $originalName,
            'src' => $imageUrl,
        ]);
    }
}
