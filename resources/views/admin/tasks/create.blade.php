@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.task.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.tasks.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="title">{{ trans('cruds.task.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                        id="title" value="{{ old('title', '') }}" required>
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.task.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="project_id">{{ trans('cruds.task.fields.project') }}</label>
                    <select class="form-control select2 {{ $errors->has('project') ? 'is-invalid' : '' }}" name="project_id"
                        id="project_id" required>
                        @foreach ($projects as $id => $entry)
                            <option value="{{ $id }}" {{ old('project_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('project'))
                        <div class="invalid-feedback">
                            {{ $errors->first('project') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.task.fields.project_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="team_id">{{ trans('cruds.task.fields.team') }}</label>
                    <select class="form-control select2 {{ $errors->has('team') ? 'is-invalid' : '' }}" name="team_id"
                        id="team_id" required>
                        @foreach ($teams as $id => $entry)
                            <option value="{{ $id }}" {{ old('team_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('team'))
                        <div class="invalid-feedback">
                            {{ $errors->first('team') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.task.fields.team_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="assigned_to_id">{{ trans('cruds.task.fields.assigned_to') }}</label>
                    <select class="form-control select2 {{ $errors->has('assigned_to') ? 'is-invalid' : '' }}"
                        name="assigned_to_id" id="assigned_to_id" required>
                        @foreach ($assigned_tos as $id => $entry)
                            <option value="{{ $id }}" {{ old('assigned_to_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('assigned_to'))
                        <div class="invalid-feedback">
                            {{ $errors->first('assigned_to') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.task.fields.assigned_to_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="supervisor_id">{{ trans('cruds.task.fields.supervisor') }}</label>
                    <select class="form-control select2 {{ $errors->has('supervisor') ? 'is-invalid' : '' }}"
                        name="supervisor_id" id="supervisor_id" required>
                        @foreach ($supervisors as $id => $entry)
                            <option value="{{ $id }}" {{ old('supervisor_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('supervisor'))
                        <div class="invalid-feedback">
                            {{ $errors->first('supervisor') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.task.fields.supervisor_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="description">{{ trans('cruds.task.fields.description') }}</label>
                    <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text"
                        name="description" id="description" value="{{ old('description', '') }}">
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.task.fields.description_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.task.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                        id="status">
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\Task::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('status', 'pending') === (string) $key ? 'selected' : '' }}>{{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.task.fields.status_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
