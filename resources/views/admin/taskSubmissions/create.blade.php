@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.taskSubmission.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.task-submissions.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="task_id">{{ trans('cruds.taskSubmission.fields.task') }}</label>
                    <select class="form-control select2 {{ $errors->has('task') ? 'is-invalid' : '' }}" name="task_id"
                        id="task_id" required>
                        @foreach ($tasks as $id => $entry)
                            <option value="{{ $id }}" {{ old('task_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('task'))
                        <div class="invalid-feedback">
                            {{ $errors->first('task') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.taskSubmission.fields.task_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="url">{{ trans('cruds.taskSubmission.fields.url') }}</label>
                    <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url"
                        id="url" value="{{ old('url', '') }}" required>
                    @if ($errors->has('url'))
                        <div class="invalid-feedback">
                            {{ $errors->first('url') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.taskSubmission.fields.url_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="notes">{{ trans('cruds.taskSubmission.fields.notes') }}</label>
                    <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes') }}</textarea>
                    @if ($errors->has('notes'))
                        <div class="invalid-feedback">
                            {{ $errors->first('notes') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.taskSubmission.fields.notes_helper') }}</span>
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
