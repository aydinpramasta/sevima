<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoadmapPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'topic' => ['required', 'string', 'max:255'],
            'chapters' => ['required', 'array'],
            'chapters.*' => ['required', 'array'],
            'chapters.*.id' => ['required', 'numeric'],
            'chapters.*.chapter' => ['required', 'string', 'max:255'],
            'chapters.*.planned_hours' => ['required', 'numeric', 'max:32767'],
        ];
    }
}
