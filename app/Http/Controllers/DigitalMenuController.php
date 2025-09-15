<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DigitalMenuCampaign;
use App\Models\DigitalMenuCategory;
use App\Models\DigitalMenuContent;
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

        $clientCategories = DigitalMenuCategory::query()
            ->where('linked_client_id', $client->id)
            ->where('is_active', true)
            ->whereHas('contents', function ($q) use ($client) {
                $q->where('linked_client_id', $client->id)
                    ->where('is_active', true);
            })
            ->with(['contents' => function ($q) use ($client) {
                $q->where('linked_client_id', $client->id)
                    ->where('is_active', true)
                    ->orderBy('order')
                    ->orderBy('content_name');
            }])
            ->orderBy('order')
            ->orderBy('category_name')
            ->get();
        $clientCampaigns = DigitalMenuCampaign::where('linked_client_id', $client->id)->where('is_active', true)->get();
        return view('pages.digital_menu.digital_menu_index', compact('client', 'clientCategories', 'clientCampaigns'));
    }
}
