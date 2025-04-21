<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreloginController extends Controller
{
    public function index()
    {
        // If user is already authenticated, redirect to dashboard
        if (auth()->check()) {
            return redirect()->route('user.dashboard');
        }

        return view('auth.prelogin');
    }
} 