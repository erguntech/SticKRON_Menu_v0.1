<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigitalMenuCampaign extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'digital_menu_campaigns';

    protected $fillable = [
        'campaign_name',
        'campaign_description',
        'campaign_price',
        'linked_client_id',
        'order',
        'is_active',
    ];

    public function linkedClient()
    {
        return $this->belongsTo(Client::class, 'linked_client_id', 'id')->withTrashed();
    }

    public function linkedDigitalMenuCategory()
    {
        return $this->belongsTo(DigitalMenuCategory::class, 'linked_digital_menu_category_id', 'id')->withTrashed();
    }
}
