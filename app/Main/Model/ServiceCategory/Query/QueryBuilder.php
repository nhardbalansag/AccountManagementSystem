<?php

namespace App\Main\Model\ServiceCategory\Query;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Main\Model\ServiceCategory\ServiceCategory;

class QueryBuilder extends Model
{
    public static function getall($request){

        $data = DB::table('service_categories')
                ->join('social_media_platforms', 'social_media_platforms.id', '=', 'service_categories.social_media_platform_id')
                ->select(
                    'service_categories.*',
                    'social_media_platforms.social_media_platform_name as platformName'
                )
                ->where('social_media_platforms.id', $request)
                ->get();

        return $data;
    }

    public static function getData($model, $whereid, $filtercolumn){
        $data = DB::table($model)
              ->where($filtercolumn, $whereid)
              ->first();

        return $data;
    }

    public static function createServiceCategory($request, $platformId){
        $data = ServiceCategory::create([
            'service_category_name' => $request['service_category_name'],
            'service_category_description' => $request['service_category_description'],
            'service_category_status' => $request['service_category_status'],
            'social_media_platform_id' => $platformId
        ]);

        return $data;
    }

    public static function deleteServiceCategory($model, $id){

        $data = DB::table($model)
                ->where('id', $id)
                ->delete();

        return $data;
    }

}
