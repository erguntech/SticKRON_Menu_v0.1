<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingsRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class StoreSettingsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(['role:İşletme Yöneticisi'], only: ['index', 'update']),
        ];
    }


    public function index()
    {
        return view('pages.store_settings.store_settings_index');
    }

    public function update(StoreSettingsRequest $request)
    {

        return redirect()->route('Settings.Store.Index')
            ->with('result','warning')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Kayıt başarı ile güncellendi.");
    }
}
