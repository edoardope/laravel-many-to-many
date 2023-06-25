<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user && $user->role == 'admin') {
            return view('admin.dashboard');
        }

        return redirect()->route('403'); // Reindirizza all'URL specificato nella route 'guest.welcome'
    }
}