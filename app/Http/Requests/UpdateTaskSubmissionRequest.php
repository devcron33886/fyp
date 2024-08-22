<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskSubmissionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_submission_edit');
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
            'submitted_by_id' => [
                'required',
                'integer',
            ],
            'team_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
