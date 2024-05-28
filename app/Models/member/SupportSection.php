<?php

namespace App\Models\member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SupportSection extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'support_sections';

}
