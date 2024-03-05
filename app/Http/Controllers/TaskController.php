<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        return Task::create($request->all());
    }

    public function update(Request $request, Task $task)
    {
        $task->completed = !$task->completed;
        $task->update($request->all());
        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted']);
    }

    public function deleteTasks(Request $request)
    {
        $ids = $request->input('completedList');
        Task::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Tasks deleted']);
    }
}
