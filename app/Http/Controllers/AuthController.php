<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginpage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    }
    public function dashboard()
    {
        $tasks = Task::join('users', 'users.id', '=', 'tasks.user_id')
            ->where('tasks.user_id', auth()->id())
            ->select('tasks.*', 'users.name as user_name')
            ->get();
        return view('dashboard', ['tasks' => $tasks]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
