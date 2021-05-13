<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platform = array(
            "social_media_platform_name" => array(
                "facebook",
                "youtube"
            ),
            "social_media_platform_status" => array(
                "active",
                "active"
            )
        );

        for($index = 0; $index < count($platform['social_media_platform_name']); $index++){
            DB::table('social_media_platforms')->insert([
                'social_media_platform_name' => $platform['social_media_platform_name'][$index],
                'social_media_platform_description' => null,
                'social_media_platform_status' => $platform['social_media_platform_status'][$index]
            ]);
        }
    }
}
