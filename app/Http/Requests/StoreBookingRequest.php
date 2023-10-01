<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'stay' => 'required',
            'room' => 'required',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'count_adults' => 'required', 'integer',
            'count_children' => 'nullable', 'integer',
        ];
    }
}
