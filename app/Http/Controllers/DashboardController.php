<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userType = Auth::user()->user_type;

        switch ($userType) {
            case "1":
                return view('pages.dashboards.dashboard_administrators_index');
            case "2":
                return view('pages.dashboards.dashboard_clients_index');
        }
    }
}
