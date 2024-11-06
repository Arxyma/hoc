<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
           'nama_event' => 'required|max:155|min:2',
            'kuota' => 'required',
            'description' => 'required',
            'tanggal' => 'required',
            'start_time' => 'required',
            'image' => 'image|nullable',
            'mentor_id' => 'required',
        ];
    }
}