@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.task.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <button class="btn btn-default pull-right mb-4">
                        {{ App\Models\Task::STATUS_SELECT[$task->status] ?? '' }}
                    </button>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.task.fields.project') }}
                            </th>
                            <th>
                                {{ trans('cruds.task.fields.team') }}
                            </th>
                            <th>
                                {{ trans('cruds.task.fields.assigned_to') }}
                            </th>
                            <th>
                                {{ trans('cruds.task.fields.supervisor') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                {{ $task->title }}
                            </td>
                            <td>
                                {{ $task->project->title ?? '' }}
                            </td>
                            <td>
                                {{ $task->team->name ?? '' }}
                            </td>
                            <td>
                                {{ $task->assigned_to->name ?? '' }}
                            </td>
                            <td>
                                {{ $task->supervisor->name ?? '' }}
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
    <div class="card">
        <div class="card-header">
            Task Description
        </div>
        <div class="card-body">
            {{ $task->description }}
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.taskSubmission.title') }}
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                    @foreach ($task->taskSubmissions as $taskSubmission)
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
                    @endforeach
                </tbody>
            </table>

        </div>
</div @endsection
