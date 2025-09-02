<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Admin: list all tasks
    public function index()
    {
        $tasks = Task::with('user', 'response')->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    // Admin: show single task + response
    public function show(Task $task)
    {
        $task->load('response');
        return view('admin.tasks.show', compact('task'));
    }

    // Admin: create new task form
    public function create()
    {
        $users = User::all();
        return view('admin.tasks.create', compact('users'));
    }

    // Admin: store new task
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $task = Task::create([
            'admin_id' => Auth::id(),
            'user_id'  => $request->user_id,
            'content'  => $request->content,
            'status'   => 'pending',
        ]);

        // 🔔 Send WhatsApp notification to assigned user
        $user = User::find($request->user_id);

        if ($user && $user->phone) {
            $adminName = Auth::user()->name;

            $message = "New Task Assigned by {$adminName} Please check your dashboard to respond.";

            \App\Helpers\WhatsappHelper::send($user->phone, $message);
        }

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully.');
    }

    // Admin: review a task response
// Admin: review a task response
public function review(Request $request, TaskResponse $response)
{
    $request->validate([
        'status' => 'required|in:approved,rejected',
        'feedback' => 'nullable|string'
    ]);

    // Update response status
    $response->update([
        'status'   => $request->status,
        'feedback' => $request->feedback ?? null
    ]);

    // Update parent task status as well
    $response->task->update(['status' => $request->status]);

    // 🔔 Send WhatsApp notification to the user
    $user = $response->task->user;
    if ($user && $user->phone) {
        $statusText = $request->status === 'approved' ? 'accepted' : 'rejected';
        $date = $response->task->created_at->format('Y-m-d');

        $message = "Your task for {$date} has been {$statusText}.";

        \App\Helpers\WhatsappHelper::send($user->phone, $message);
    }

    return redirect()->back()->with('success', 'Task reviewed successfully!');
}

}
