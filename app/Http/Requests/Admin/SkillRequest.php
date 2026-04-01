<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'skill_name' => 'required|string|max:255',
            'skill_level' => 'required|integer|min:0|max:100',
            'order' => 'nullable|integer'
        ];
    }
}
