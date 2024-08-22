<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTaskSubmissionRequest;
use App\Http\Requests\StoreTaskSubmissionRequest;
use App\Http\Requests\UpdateTaskSubmissionRequest;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\User;
use Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TaskSubmissionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('task_submission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskSubmissions = TaskSubmission::with(['task', 'submitted_by'])->get();

        return view('admin.taskSubmissions.index', compact('taskSubmissions'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_submission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.taskSubmissions.create', compact('tasks'));
    }

    public function store(StoreTaskSubmissionRequest $request)
    {
        $user = Auth::user();
        $submitted_by = auth()->user()->id;
        $taskSubmission = TaskSubmission::create(array_merge($request->all(), ['submitted_by_id' => $submitted_by]));

        return redirect()->route('admin.task-submissions.index');
    }

    public function edit(TaskSubmission $taskSubmission)
    {
        abort_if(Gate::denies('task_submission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $submitted_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taskSubmission->load('task', 'submitted_by');

        return view('admin.taskSubmissions.edit', compact('submitted_bies', 'taskSubmission', 'tasks'));
    }

    public function update(UpdateTaskSubmissionRequest $request, TaskSubmission $taskSubmission)
    {
        $taskSubmission->update($request->all());

        return redirect()->route('admin.task-submissions.index');
    }

    public function show(TaskSubmission $taskSubmission)
    {
        abort_if(Gate::denies('task_submission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskSubmission->load('task', 'submitted_by');

        return view('admin.taskSubmissions.show', compact('taskSubmission'));
    }

    public function destroy(TaskSubmission $taskSubmission)
    {
        abort_if(Gate::denies('task_submission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskSubmission->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskSubmissionRequest $request)
    {
        $taskSubmissions = TaskSubmission::find(request('ids'));

        foreach ($taskSubmissions as $taskSubmission) {
            $taskSubmission->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
