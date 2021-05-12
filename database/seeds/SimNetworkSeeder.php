<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SimNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $network = array(
            "networkname" => array(
                "globe",
                "smart",
                "tm",
                "dito",
                "gomo",
                "talk n text"
            ),
            "networkstatus" => array(
                "active",
                "active",
                "active",
                "active",
                "active",
                "active"
            )
        );

        for($index = 0; $index < count($network['networkname']); $index++){
            DB::table('sim_net_works')->insert([
                'networkname' => $network['networkname'][$index],
                'networkdescription' => null,
                'networkstatus' => $network['networkstatus'][$index]
            ]);
        }
    }
}
