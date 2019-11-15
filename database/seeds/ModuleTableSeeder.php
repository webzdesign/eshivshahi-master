<?php

use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            'module_name'=>'Divisions',
            'display_name'=>'Divisions',
            'display_sequence'=>1,
            'routes'=>'division',
            'icon'=>'fa fa-bars',
        ]);
        DB::table('modules')->insert([
            'module_name'=>'Depots',
            'display_name'=>'Depots',
            'display_sequence'=>2,
            'routes'=>'depot',
            'icon'=>'fa fa-bars',
        ]);
        DB::table('modules')->insert([
            'module_name'=>'User Types',
            'display_name'=>'User Types',
            'display_sequence'=>3,
            'routes'=>'usertype',
            'icon'=>'fa fa-bars',
        ]);
        DB::table('modules')->insert([
            'module_name'=>'Access Type',
            'display_name'=>'Access Type',
            'display_sequence'=>4,
            'routes'=>'accesstype',
            'icon'=>'fa fa-bars',
        ]);
        DB::table('modules')->insert([
            'module_name'=>'Allow User Logins',
            'display_name'=>'Allow User Logins',
            'display_sequence'=>5,
            'routes'=>'allowuser',
            'icon'=>'fa fa-bars',
        ]);
        DB::table('modules')->insert([
            'module_name'=>'User Master',
            'display_name'=>'User Master',
            'display_sequence'=>6,
            'routes'=>'user',
            'icon'=>'fa fa-bars',
        ]);
        DB::table('modules')->insert([
            'module_name'=>'Permission',
            'display_name'=>'Permission',
            'display_sequence'=>7,
            'routes'=>'permission',
            'icon'=>'fa fa-bars',
        ]);
        DB::table('modules')->insert([
            'module_name'=>'Vendor',
            'display_name'=>'Vendor',
            'display_sequence'=>8,
            'routes'=>'vendordetail',
            'icon'=>'fa fa-bars',
        ]);
        DB::table('modules')->insert([
            'module_name'=>'Vendor Accountant',
            'display_name'=>'Vendor Accountant',
            'display_sequence'=>9,
            'routes'=>'vendoraccountant',
            'icon'=>'fa fa-bars',
        ]);
        DB::table('modules')->insert([
            'module_name'=>'Vehicle Master',
            'display_name'=>'Vehicle Master',
            'display_sequence'=>10,
            'routes'=>'vehicle',
            'icon'=>'fa fa-bars',
        ]);
        DB::table('modules')->insert([
            'module_name'=>'Vendor Invoice',
            'display_name'=>'Vendor Invoice',
            'display_sequence'=>11,
            'routes'=>'vendorinvoice',
            'icon'=>'fa fa-bars',
        ]);
        DB::table('modules')->insert([
            'module_name'=>'Parisishtha B',
            'display_name'=>'Parisishtha B',
            'display_sequence'=>12,
            'routes'=>'parisishthab',
            'icon'=>'fa fa-bars',
        ]);
        DB::table('modules')->insert([
            'module_name'=>'Parisishtha A',
            'display_name'=>'Parisishtha A',
            'display_sequence'=>13,
            'routes'=>'parisishthaa',
            'icon'=>'fa fa-bars',
        ]);
        DB::table('modules')->insert([
            'module_name'=>'Bill Summary',
            'display_name'=>'Bill Summary',
            'display_sequence'=>14,
            'routes'=>'billsummary',
            'icon'=>'fa fa-bars',
        ]);
        DB::table('modules')->insert([
            'module_name'=>'Module Hierarchy',
            'display_name'=>'Module Hierarchy',
            'display_sequence'=>15,
            'routes'=>'hierarchy',
            'icon'=>'fa fa-bars',
        ]);
    }
}
