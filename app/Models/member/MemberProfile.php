<?php

namespace App\Models\member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MemberProfile extends Model
{
    use HasFactory;
    protected $table = 'client_profile_personals';

    public function profileAccount()
    {
        return $this->belongsTo(ClientProfile::class, 'auto_id', 'id');
    }


    public function getPhotoAttribute($value)
    {
	    $url = config('app.profile_url');

	return $url.$value;
    }

    public function getPanImageAttribute($value)
    {
	    $url = config('app.kyc_path');

	return $url.$value;
    }

    public function getAdhaarFrontImageAttribute($value)
    {
	    $url = config('app.kyc_path');

	return $url.$value;
    }

}
