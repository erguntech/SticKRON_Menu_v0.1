<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigitalMenuContent extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'digital_menu_contents';

    protected $fillable = [
        'content_name',
        'content_description',
        'content_price',
        'linked_digital_menu_category_id',
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
