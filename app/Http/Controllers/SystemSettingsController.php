<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\SystemSettingsRequest;

class SystemSettingsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(['role:Sistem Yöneticisi'], only: ['index', 'update']),
        ];
    }

    public function index()
    {
        return view('pages.system_settings.system_settings_index');
    }

    public function update(SystemSettingsRequest $request)
    {
        settings()->set('app_maintenance_mode', $request['input-app_maintenance_mode']);

        return redirect()->route('Settings.System.Index')
            ->with('result','warning')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Kayıt başarı ile güncellendi.");
    }
}
