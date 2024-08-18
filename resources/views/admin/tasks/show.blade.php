@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.task.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.tasks.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.id') }}
                            </th>
                            <td>
                                {{ $task->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.title') }}
                            </th>
                            <td>
                                {{ $task->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.project') }}
                            </th>
                            <td>
                                {{ $task->project->title ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.team') }}
                            </th>
                            <td>
                                {{ $task->team->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.assigned_to') }}
                            </th>
                            <td>
                                {{ $task->assigned_to->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.supervisor') }}
                            </th>
                            <td>
                                {{ $task->supervisor->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.description') }}
                            </th>
                            <td>
                                {{ $task->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.status') }}
                            </th>
                            <td>
                                {{ App\Models\Task::STATUS_SELECT[$task->status] ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.tasks.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
