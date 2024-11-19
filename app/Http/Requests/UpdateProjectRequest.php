<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Adjust this if you want to add specific authorization logic
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255', 
            // Project images (optional) 
            'image' => 'string',  
            'status' => 'required',
            'details' => 'array',
            'plans' => 'array',
            'features' => 'array',
            'images' => 'array',
            'iframeSrc' => 'string'

        ];
    }

    /**
     * Custom error messages (optional).
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The project name is required.',
            'location.required' => 'The project location is required.',
            'floors.required' => 'At least one floor is required.',
            'floors.*.floor_number.required' => 'Each floor requires a floor number.',
            'floors.*.units.required' => 'Each floor requires units.',
            'floors.*.units.*.unit_number.required' => 'Each unit requires a unit number.',
            'floors.*.units.*.size.required' => 'Each unit requires a size.',
            'floors.*.units.*.price.required' => 'Each unit requires a price.',
            'floors.*.units.*.status.in' => 'The status must be one of the allowed statuses.',
            'floors.*.units.*.booking_status.status_name.in' => 'The booking status must be valid.',
            'floors.*.units.*.booking_status.color_code.regex' => 'The color code must be a valid hex color code.',
        ];
    }
}

