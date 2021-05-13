<?php

namespace App\Main\Model\SocialMedialPlatform\Query;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Main\Model\SocialMedialPlatform\SocialMediaPlatform;

class QueryBuilder extends Model
{
    public static function getall(){

        $data = DB::table('social_media_platforms')->get();

        return $data;
    }
}
