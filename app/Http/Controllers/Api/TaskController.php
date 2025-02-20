<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:tasks,title',
            'description' => 'required|string|min:10',
            'status' => 'required|in:pending,in-progress,completed',
        ]);

        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Task berhasil dibuat!', 'task' => $task], 201);
    }

    public function show($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$task) {
            return response()->json(['message' => 'Task tidak ditemukan'], 404);
        }

        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$task) {
            return response()->json(['message' => 'Task tidak ditemukan'], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255|unique:tasks,title,' . $task->id,
            'description' => 'required|string|min:10',
            'status' => 'required|in:pending,in-progress,completed',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Task berhasil diperbarui!', 'task' => $task], 200);
    }

    public function destroy($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$task) {
            return response()->json(['message' => 'Task tidak ditemukan'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task berhasil dihapus!'], 200);
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Login gagal!'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user], 200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json(['message' => 'Logout berhasil!'], 200);
    }
}
