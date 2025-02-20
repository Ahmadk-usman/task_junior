<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CRUDControler extends Controller
{
    public function getCreate()
    {
        return view('create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:tasks,title',
            'description' => 'required|string',
            'status' => 'required|in:pending,in-progress,completed',
        ]);
        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard')->with('success', 'Task berhasil ditambahkan!');
    }
    public function destroy($id)
    {
        $task = Task::where('user_id', auth()->id())->findOrFail($id);
        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Task berhasil dihapus!');
    }
    public function edit($id)
    {
        $task = Task::where('user_id', auth()->id())->findOrFail($id); // Pastikan hanya user terkait yang bisa edit
        return view('edit', compact('task'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:tasks,title,' . $id, // Title harus unik kecuali task ini sendiri
            'description' => 'required|string',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        $task = Task::where('user_id', auth()->id())->findOrFail($id); // Hanya user pemilik task yang bisa mengedit
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard')->with('success', 'Task berhasil diperbarui!');
    }
}
