<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('project_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:projects,title,'.request()->route('project')->id,
            ],
            'supervisor_id' => [
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
