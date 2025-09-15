<?php

namespace App\Observers;

use App\Models\Client;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Support\Str;

class ClientObserver
{
    // INSERT'TEN ÖNCE ÇALIŞIR
    public function creating(Client $client): void
    {
        // qr_menu_content (slug)
        if (empty($client->qr_menu_content)) {
            $base = $client->company_name ?: 'client';
            $slug = Str::slug($base) ?: ('client');

            // çakışma varsa sonuna rastgele ek takısı koy
            if (\App\Models\Client::where('qr_menu_content', $slug)->exists()) {
                $slug .= '-' . Str::random(4);
            }
            $client->qr_menu_content = $slug;
        }

        // 8 haneli benzersiz kod
        if (empty($client->qr_menu_code)) {
            do {
                $code = str_pad((string) random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            } while (Client::where('qr_menu_code', $code)->exists());

            $client->qr_menu_code = $code;
        }
    }

    // INSERT'TEN SONRA (id hazır) QR SVG üret
    public function created(Client $client): void
    {
        // QR içeriği: /r/{code}
        $qrUrl = route('menu.resolve', ['code' => $client->qr_menu_code]);

        $svg = \Endroid\QrCode\Builder\Builder::create()
            ->writer(new \Endroid\QrCode\Writer\SvgWriter())
            ->data($qrUrl)
            ->size(300)
            ->margin(10)
            ->build()
            ->getString();

        $dir = public_path('uploads/qrcodes');
        \Illuminate\Support\Facades\File::ensureDirectoryExists($dir);
        \Illuminate\Support\Facades\File::put($dir.DIRECTORY_SEPARATOR.$client->id.'.svg', $svg);
    }

    /**
     * Handle the Client "updated" event.
     */
    public function updated(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "deleted" event.
     */
    public function deleted(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "restored" event.
     */
    public function restored(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "force deleted" event.
     */
    public function forceDeleted(Client $client): void
    {
        //
    }
}
