<?php

namespace App\Models\member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class NewsAndEvent extends Model
{
    use HasFactory;
    protected $table = 'news_events';

    public function getInfoImgAttribute($value)
    {
	    $url = config('app.news_url');

	return $url.$value;
    }
}
