<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Show tasks for logged-in user
    public function index()
    {
        $userId = Auth::id();
        
        if (!$userId) {
            abort(403, 'You must be logged in to view your tasks.');
        }

        $tasks = Task::where('user_id', $userId)
                    ->with('response')
                    ->get();

        return view('tasks.index', compact('tasks'));
    }


    // Show single task
    public function show(Task $task)
    {
        // Optional: verify the task belongs to the logged-in user
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        return view('tasks.show', compact('task'));
    }

    // Submit response for a task
    public function submit(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'response' => 'required|string',
        ]);

        TaskResponse::create([
            'task_id'  => $task->id,
            'user_id'  => Auth::id(),
            'response' => $request->response,
        ]);

        $task->update(['status' => 'completed']);

        return back()->with('success', 'Response submitted!');
    }
}
