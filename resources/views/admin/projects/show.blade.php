@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.project.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.projects.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.description') }}
                            </th>
                            <td>
                                {{ $project->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.supervisor') }}
                            </th>
                            <td>
                                {{ $project->supervisor->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.status') }}
                            </th>
                            <td>
                                {{ App\Models\Project::STATUS_SELECT[$project->status] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.project.fields.team') }}
                            </th>
                            <td>
                                {{ $project->team->name ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.projects.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
