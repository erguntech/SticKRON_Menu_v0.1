<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'clients';

    protected $fillable = [
        'user_id',
        'company_name',
        'company_address',
        'company_phone',
        'qr_menu_content',
        'qr_menu_code',
        'facebook_address',
        'instagram_address',
        'is_active',
    ];

    public function linkedUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function linkedStand()
    {
        return $this->belongsTo(Stand::class, 'linked_stand_id', 'id')->withTrashed();
    }
}
