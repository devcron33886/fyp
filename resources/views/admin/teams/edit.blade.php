@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.team.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.teams.update', [$team->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.team.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', $team->name) }}" required>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="users">{{ trans('cruds.team.fields.user') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                            style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                            style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}" name="users[]"
                        id="users" multiple required>
                        @foreach ($users as $id => $user)
                            <option value="{{ $id }}"
                                {{ in_array($id, old('users', [])) || $team->users->contains($id) ? 'selected' : '' }}>
                                {{ $user }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('users'))
                        <div class="invalid-feedback">
                            {{ $errors->first('users') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.user_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="supervisor_id">{{ trans('cruds.team.fields.supervisor') }}</label>
                    <select class="form-control select2 {{ $errors->has('supervisor') ? 'is-invalid' : '' }}"
                        name="supervisor_id" id="supervisor_id" required>
                        @foreach ($supervisors as $id => $entry)
                            <option value="{{ $id }}"
                                {{ (old('supervisor_id') ? old('supervisor_id') : $team->supervisor->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('supervisor'))
                        <div class="invalid-feedback">
                            {{ $errors->first('supervisor') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.team.fields.supervisor_helper') }}</span>
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
