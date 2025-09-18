<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;


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
        'file'    => 'nullable|file|max:10240', // up to 10MB
    ]);

    $fileId   = null;
    $fileName = null;

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        // Folder path: tasks/{YYYY-MM-DD}
        $folder = 'tasks/' . now()->format('Y-m-d');

        // Ensure the folder exists → trick: upload an .init file if missing
        if (!Storage::disk('google')->exists($folder)) {
            Storage::disk('google')->put($folder.'/.init', '');
        }

        // Now safely upload the file
        $path = $folder . '/' . $fileName;
        Storage::disk('google')->put($path, fopen($file->getRealPath(), 'r+'));

        // In yaza/nao-pon driver, $path itself is treated as identifier
        $fileId = $path;
    }

    // Save the task in DB
    $task = Task::create([
        'admin_id'  => Auth::id(),
        'user_id'   => $request->user_id,
        'content'   => $request->content,
        'status'    => 'pending',
        'file_id'   => $fileId,
        'file_name' => $fileName,
    ]);

    // 🔔 Notify user by WhatsApp
    $user = User::find($request->user_id);
    if ($user && $user->phone) {
        $adminName = Auth::user()->name;
        $message = "New Task Assigned by {$adminName}. Please check your dashboard.";
        \App\Helpers\WhatsappHelper::send($user->phone, $message);
    }

    return redirect()->route('admin.tasks.create')->with('success', 'Task created successfully.');
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


public function downloadTaskFile(Task $task)
{
    if (!$task->file_id) {
        return redirect()->back()->with('error', 'No file attached to this task.');
    }

    $disk = Storage::disk('google');

    try {
        return new StreamedResponse(function () use ($disk, $task) {
            $stream = $disk->readStream($task->file_id);

            if ($stream === false) {
                throw new \Exception('Unable to read file from Google Drive.');
            }

            fpassthru($stream);
            fclose($stream);
        }, 200, [
            "Content-Type" => "application/octet-stream",
            "Content-Disposition" => "attachment; filename=\"{$task->file_name}\""
        ]);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error downloading file: ' . $e->getMessage());
    }
}

public function downloadResponse(TaskResponse $response)
{


    if (!$response->file_id) {
        return back()->with('error', 'No file attached to this response.');
    }

    $disk = Storage::disk('google');

    try {
        return new StreamedResponse(function () use ($disk, $response) {
            $stream = $disk->readStream($response->file_id);
            if ($stream === false) throw new \Exception('Unable to read file from Google Drive.');
            fpassthru($stream);
            fclose($stream);
        }, 200, [
            "Content-Type" => "application/octet-stream",
            "Content-Disposition" => "attachment; filename=\"{$response->file_name}\""
        ]);
    } catch (\Exception $e) {
        return back()->with('error', 'Error downloading file: ' . $e->getMessage());
    }
}
}
