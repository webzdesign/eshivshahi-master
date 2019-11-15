<?php

use Illuminate\Database\Seeder;
use App\Model\Depot;

class DepotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $depot= Depot::create(array(
            'name'=> 'depot_1',
        ));
        $depot->save();
        $depot= Depot::create(array(
            'name'=> 'depot_2',
        ));
        $depot->save();
    }
}
