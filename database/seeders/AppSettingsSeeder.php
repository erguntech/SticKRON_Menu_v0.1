<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppSettingsSeeder extends Seeder
{
    public function run(): void
    {
        settings()->set([
            'app_name' => 'SticKRON Dijital Menü',
            'app_title' => 'SticKRON Dijital Menü',
            'app_alias' => 'SticKRON Dijital Menü',
            'app_domain' => 'https://digitalmenu.stickron.com',
            'app_email' => 'dijitalmenu@stickron.com',
            'app_version' => 'v0.1',
            'app_description' => '',
            'app_keywords' => '',
            'app_contact_domain' => 'https://dijitalmenu.stickron.com',
            'app_contact_email' => 'info@plakaart.com',
            'app_contact_phone' => '+905385674114',
            'app_contact_whatsapp' => '905385674114',
            'app_company_address' => 'Fenerbahçe Mahallesi, İğrip Sokak, No:13, Daire: 01, Kadıköy, İstanbul',
            'app_social_instagram_address' => '@stickronsocial',
            'app_maintenance_mode' => '0',
        ]);
    }
}
