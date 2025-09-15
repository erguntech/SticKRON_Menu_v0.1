<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingsRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

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

    public function update(Request $request)
    {
        $client = Client::find(Auth::user()->linkedClient->id);
        $client->facebook_address = $request['input-facebook_address'];
        $client->instagram_address = $request['input-instagram_address'];
        $client->save();

        return redirect()->route('Settings.Store.Index')
            ->with('result','warning')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Kayıt başarı ile güncellendi.");
    }
}
