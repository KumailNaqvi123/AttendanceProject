<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Storage;



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
        'file'     => 'nullable|file|max:10240', // optional file up to 10MB
    ]);

    $fileId = null;
    $fileName = null;

    // Handle file upload
    if ($request->hasFile('file')) {
    $file = $request->file('file');
    $fileName = $file->getClientOriginalName();

    // Folder structure: responses/YYYY-MM-DD
    $folder = 'responses/' . now()->format('Y-m-d');

    // Ensure folder exists (trick: .init file)
    if (!Storage::disk('google')->exists($folder)) {
        Storage::disk('google')->put($folder.'/.init', '');
    }

    // Upload the file safely to Google Drive
    $path = Storage::disk('google')->putFileAs($folder, $file, $fileName);
    $fileId = $path;
}


    try {
        // Save response in DB
        TaskResponse::create([
            'task_id'   => $task->id,
            'user_id'   => Auth::id(),
            'response'  => $request->response,
            'file_id'   => $fileId,
            'file_name' => $fileName,
            'status'    => 'submitted',
        ]);

        $task->update(['status' => 'completed']);

        return back()->with('success', 'Response submitted successfully!');
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to submit response. Please try again.');
    }
}

public function downloadResponse(TaskResponse $response)
{
    // if ($response->user_id !== Auth::id()) {
    //     abort(403);
    // }

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

// TaskController.php
public function downloadTaskFile(Task $task)
{
    // if ($task->user_id !== Auth::id()) {
    //     abort(403);
    // }

    if (!$task->file_id) {
        return back()->with('error', 'No file attached to this task.');
    }

    $disk = Storage::disk('google');

    try {
        return new StreamedResponse(function () use ($disk, $task) {
            $stream = $disk->readStream($task->file_id);
            if ($stream === false) throw new \Exception('Unable to read file from Google Drive.');
            fpassthru($stream);
            fclose($stream);
        }, 200, [
            "Content-Type" => "application/octet-stream",
            "Content-Disposition" => "attachment; filename=\"{$task->file_name}\""
        ]);
    } catch (\Exception $e) {
        return back()->with('error', 'Error downloading file: ' . $e->getMessage());
    }
}


}
