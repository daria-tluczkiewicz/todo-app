<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
      return [
        'uuid' => 'sometimes|required|uuid|exists:tasks,uuid',
        'title' => 'sometimes|required|string|max:255',
        'content' => 'sometimes|nullable|string|max:1000',
        'date_added' => 'sometimes|nullable|date:d-m-Y|after_or_equal:today',
        'date_due' => 'sometimes|nullable|date:d-m-Y|after_or_equal:today',
        'priority' => 'sometimes|nullable|in:low,medium,high',
        'status' => 'sometimes|nullable|in:in_progress,todo,done',
      ];
    }

    public function getFilters(): array
    {
      return $this->only(['priority','status','date_due']);
    }
}
