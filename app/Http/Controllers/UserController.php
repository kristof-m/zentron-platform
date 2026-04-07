<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class UserController extends Controller
{
    function account(): View
    {
        $user = auth()->user();
        return view('account', compact('user'));
    }
}
