<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigitalMenuCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'digital_menu_categories';

    protected $fillable = [
        'category_name',
        'content_description',
        'linked_client_id',
        'order',
        'is_active',
    ];

    public function linkedClient()
    {
        return $this->belongsTo(Client::class, 'linked_client_id', 'id')->withTrashed();
    }

    public function contents()
    {
        return $this->hasMany(DigitalMenuContent::class, 'linked_digital_menu_category_id', 'id');
    }
}
