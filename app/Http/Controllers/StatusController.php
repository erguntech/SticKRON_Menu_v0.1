<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function userDeactivated()
    {
        return view('pages.authentication.user_deactivated');
    }
}
