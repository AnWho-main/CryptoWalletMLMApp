<?php

namespace App\Models\member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ClientProfile extends Model
{
    use HasFactory;
    protected $table = 'client_profile_accounts';

    public function clientProfileAccount()
    {
        return $this->belongsTo(ClientProfile::class, 'user_id', 'id');
    }

    public function clientPayouts()
    {
        return $this->hasMany(ClientPayout::class, 'user_id', 'id');
    }

}
