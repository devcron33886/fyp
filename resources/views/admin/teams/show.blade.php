@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.team.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.teams.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.id') }}
                            </th>
                            <td>
                                {{ $team->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.name') }}
                            </th>
                            <td>
                                {{ $team->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.user') }}
                            </th>
                            <td>
                                @foreach ($team->users as $key => $user)
                                    <span class="label label-info">{{ $user->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.supervisor') }}
                            </th>
                            <td>
                                {{ $team->supervisor->name ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.teams.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
