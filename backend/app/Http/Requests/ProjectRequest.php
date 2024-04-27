<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {


        return [
            'title' => ['required', 'min:5'],
            'description' => ['nullable'],
            'start_date' => 'required',
            'due_date' => 'required',
            'selected_users' => 'sometimes|array', // Assuming 'selected_users' holds user IDs
            'selected_users.*' => 'exists:users,id',
            'roles' => 'sometimes|array', // If managing roles
            'roles.*' => 'exists:roles,id',
        ];


        // return [
        //     'title' => ['required', 'min:5'],
        //     'start_date' => 'required',
        //     // 'slug' => 'required',
        //     // 'photo' => ['required', 'image'],
        //     'due_date' => 'required'
        // ];
    }
}