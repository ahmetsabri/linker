<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(User $user = null)
    {
        $user = auth()->user()->load('links');

        return view('dashboard', compact('user'));
    }
}
