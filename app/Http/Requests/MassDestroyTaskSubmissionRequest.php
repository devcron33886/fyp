<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaskSubmissionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('task_submission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids' => 'required|array',
            'ids.*' => 'exists:task_submissions,id',
        ];
    }
}
