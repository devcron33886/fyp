<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('team_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'users.*' => [
                'integer',
            ],
            'users' => [
                'required',
                'array',
                'unique:team_user,user_id',
            ],
            'supervisor_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
