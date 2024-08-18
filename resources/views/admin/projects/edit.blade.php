@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.project.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.projects.update", [$project->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.project.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $project->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.project.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $project->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="supervisor_id">{{ trans('cruds.project.fields.supervisor') }}</label>
                <select class="form-control select2 {{ $errors->has('supervisor') ? 'is-invalid' : '' }}" name="supervisor_id" id="supervisor_id" required>
                    @foreach($supervisors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('supervisor_id') ? old('supervisor_id') : $project->supervisor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('supervisor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('supervisor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.supervisor_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.project.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Project::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $project->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="team_id">{{ trans('cruds.project.fields.team') }}</label>
                <select class="form-control select2 {{ $errors->has('team') ? 'is-invalid' : '' }}" name="team_id" id="team_id" required>
                    @foreach($teams as $id => $entry)
                        <option value="{{ $id }}" {{ (old('team_id') ? old('team_id') : $project->team->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('team'))
                    <div class="invalid-feedback">
                        {{ $errors->first('team') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.team_helper') }}</span>
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