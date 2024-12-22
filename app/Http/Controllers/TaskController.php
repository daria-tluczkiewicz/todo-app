<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterTasksRequest;
use App\Http\Requests\TaskRequest;
use App\Models\SharedTask;
use App\Models\Task;
use App\Models\TaskHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TaskController extends Controller
{

  public function index(): \Illuminate\Contracts\View\View
  {
    $userTasks = Task::where('user_id', auth()->id())
      ->orderBy('id', 'desc')
      ->get();

    return view('tasks.index', ['userTasks' => $userTasks]);
  }

  public function history(): \Illuminate\Contracts\View\View
  {
    $taskHistory = Task::with('history')
    ->where('user_id', auth()->id())
    ->get();

    return view('tasks.history', ['taskHistory' => $taskHistory]);
  }


  public function filter(TaskRequest $request)
  {
    $filters = $request->getFilters();
    $query = Task::where('user_id', auth()->id());

    if ($filters['priority']) {
      $query->where('priority', $filters['priority']);
    }

    if ($filters['status']) {
      $query->where('status', $filters['status']);
    }

    if ($filters['date_due']) {
      $query->whereDate('date_due', '=', $filters['date_due']);
    }

    $tasks = $query->get();

    return view('tasks.index', ['userTasks' => $tasks]);
  }

  public function create(TaskRequest $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
  {
    try {

      $task = array_merge(
        ['user_id' => auth()->id()],
        $request->validated()
      );

      Task::create($task);

      return redirect()->back()->with('success', 'Task created successfully');
    } catch (\Illuminate\Database\QueryException $exception) {
      return response()->json([
        'success' => false,
        'message' => 'Database error: ' . $exception->getMessage(),
      ], 500);
    } catch (\Exception $exception) {
      return response()->json([
        'success' => false,
        'message' => 'An unexpected error occurred: ' . $exception->getMessage(),
      ], 500);
    }
  }

  public function delete(Request $request, Task $task): \Illuminate\Http\RedirectResponse
  {
    if ($request->user()->cannot('delete', $task)) {
      abort(403);
    }

    $task->delete();

    return redirect()->back()->with('success', 'Task deleted successfully.');
  }

  public function update(Task $task, TaskRequest $request): \Illuminate\Http\JsonResponse
  {
    try {
      if ($request->user()->cannot('update', $task)) {
        abort(403);
      }

      $originalTask = $task->replicate();

      $task->update(array_merge(
        $request->validated(),
        ['user_id' => auth()->id()]
      ));

      $changes = $task->getChanges();

      var_dump($changes);

      foreach ($changes as $field => $newValue) {
        if ($field === 'updated_at') {
          continue;
        }

        TaskHistory::create([
          'task_id' => $task->id,
          'action' => 'update',
          'change_type' => $field,
          'changed_from' => $originalTask->{$field},
          'changed_to' => $newValue,
          'change_date' => now(),
        ]);
      }

      return response()->json([
        'success' => true,
        'message' => 'Task updated successfully'
      ], 201);
    } catch (\Exception $exception) {
      Log::error('Error updating task: ' . $exception->getMessage());

      return response()->json([
        'success' => false,
        'message' => $exception->getMessage()
        ], 500);
      }
    }

    public function getSharableLink (Request $request, Task $task): \Illuminate\Http\JsonResponse
    {
      if ($request->user()->cannot('share', $task)) {
        abort(403);
      }

      $sharedTask = SharedTask::create([
        'user_id' => auth()->id(),
        'uuid' => Str::uuid()->toString(),
        'task_id' => $task->id,
      ]);

      $link = url('/task/share/' . $sharedTask->uuid);

      return response()->json([
        'success' => true,
        'link' => $link,
        'task' => $task,
      ]);
    }

    public function share (string $uuid): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
      $sharedTask = SharedTask::where('uuid', $uuid)->first();
      if (!$sharedTask) {
        abort(404);
      }
      return view('tasks.share', ['task' => $sharedTask->task]);
    }
}
