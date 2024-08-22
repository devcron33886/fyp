<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskSubmissionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_submission_create');
    }

    public function rules()
    {
        return [
            'task_id' => [
                'required',
                'integer',
            ],
            'url' => [
                'string',
                'required',
            ],

        ];
    }
}
