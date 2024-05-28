<?php

namespace App\Models\member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CmsOrgProfile extends Model
{
    use HasFactory;
    protected $table = 'cms_org_profiles';
    protected $primaryKey = 'id';
}
