<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama_event' => 'required|string|max:255',
            'mentor_id' => 'required|exists:mentors,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'start_time' => 'required|date_format:H:i',
            'kuota' => 'required|integer',
            'description' => 'nullable|string',
            'tag' => 'required|string'
            // 'tags' => 'array', // Tambahkan validasi untuk tags
            // 'tags.*' => 'exists:tags,id'
        ];
    }
}