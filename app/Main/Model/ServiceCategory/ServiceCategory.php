<?php

namespace App\Main\Model\ServiceCategory;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable = [
        'social_media_platform_id',
        'service_category_name',
        'service_category_description',
        'service_category_status'
    ];
}
