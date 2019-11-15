<?php

use Illuminate\Database\Seeder;
use App\Model\Division;

class DivisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $division= Division::create(array(
            'name'=> 'abc',
        ));
        $division->save();
        $division= Division::create(array(
            'name'=> 'xyz',
        ));
        $division->save();
    }
}
