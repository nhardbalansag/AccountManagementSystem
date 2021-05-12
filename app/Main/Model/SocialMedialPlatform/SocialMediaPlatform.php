<?php

namespace App\Main\Model\SocialMedialPlatform;

use Illuminate\Database\Eloquent\Model;

class SocialMediaPlatform extends Model
{
    protected $fillable = [
        'social_media_platform_name',
        'social_media_platform_description',
        'social_media_platform_status'
    ];
}
