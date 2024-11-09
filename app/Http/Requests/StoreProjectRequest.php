<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',

            // Project images (optional)
            'images' => 'nullable|array',
            'images.*' => 'string|url',

            // Floors (required array of floors)
            'floors' => 'required|array',
            'floors.*.floor_number' => 'required|integer|min:1',
            'floors.*.description' => 'nullable|string',

            // Units for each floor
            'floors.*.units' => 'required|array',
            'floors.*.units.*.unit_number' => 'required|string|max:50',
            'floors.*.units.*.size' => 'required|integer|min:1',
            'floors.*.units.*.price' => 'required|numeric|min:0',
            'floors.*.units.*.status' => 'required|string|in:Available,Booked,Reserved,Sold,Pending,Cancelled,Under Offer',

            // Booking status for each unit
            'floors.*.units.*.booking_status.status_name' => 'required|in:Available,Booked,Reserved,Sold,Pending,Cancelled,Under Offer',
            'floors.*.units.*.booking_status.color_code' => 'nullable|string|max:7|regex:/^#[A-Fa-f0-9]{6}$/',

            // Unit images (optional)
            'floors.*.units.*.images' => 'nullable|array',
            'floors.*.units.*.images.*' => 'string|url',
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

