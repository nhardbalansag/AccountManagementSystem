<?php

namespace App\Main\Model\Client;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'service_category_id',
        'client_email',
        'client_phone_number',
        'client_name',
        'client_social_media_account_name',
        'client_social_media_link',
        'client_boost_number_target'
    ];
}
