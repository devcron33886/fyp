<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'project_id' => [
                'required',
                'integer',
            ],
            'team_id' => [
                'required',
                'integer',
            ],
            'assigned_to_id' => [
                'required',
                'integer',
            ],

            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
