<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceModeController extends Controller
{
    public function maintenanceMode()
    {
        return view('pages.maintenance_mode.maintenance_mode_index');
    }
}
