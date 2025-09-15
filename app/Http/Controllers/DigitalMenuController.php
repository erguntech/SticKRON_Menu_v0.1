<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class DigitalMenuController extends Controller
{
    public function resolveByCode(string $code)
    {
        $client = Client::where('qr_menu_code', $code)->firstOrFail();
        return redirect()->route('menu.slug', ['slug' => $client->qr_menu_content], 302);
    }

    public function showBySlug(string $slug)
    {
        $client = Client::where('qr_menu_content', $slug)->firstOrFail();
        return view('pages.digital_menu.digital_menu_index', compact('client'));
    }
}
