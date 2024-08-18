@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.taskSubmission.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.task-submissions.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.taskSubmission.fields.id') }}
                            </th>
                            <td>
                                {{ $taskSubmission->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.taskSubmission.fields.task') }}
                            </th>
                            <td>
                                {{ $taskSubmission->task->title ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.taskSubmission.fields.url') }}
                            </th>
                            <td>
                                {{ $taskSubmission->url }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.taskSubmission.fields.notes') }}
                            </th>
                            <td>
                                {{ $taskSubmission->notes }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.taskSubmission.fields.submitted_by') }}
                            </th>
                            <td>
                                {{ $taskSubmission->submitted_by->name ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.task-submissions.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
