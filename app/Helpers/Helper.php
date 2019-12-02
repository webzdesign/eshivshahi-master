<?php

/* Pratik Donga on 12-09-18 */



namespace App\Helpers;

use App\Model\Permission;

use App\Model\Vehicle;

use App\Model\RateMaster;
use App\Model\RouteMaster;



class Helper

{

  public static function getPermission($module,$usertype_id){

    return Permission::where('module_id',$module)->where('usertype_id',$usertype_id)->get();

  }



  public static function getModulePermission($module,$usertype_id){

    $permission = Permission::where('module_id',$module)->where('usertype_id',$usertype_id)->get();

    if(! $permission->isEmpty()){

      if($permission[0]->create != 0 || $permission[0]->edit != 0 || $permission[0]->view != 0){

        $status = 0;

      }else{

        $status = 1;

      }

    }else{

      $status = 1;

    }

    return $status;

  }

  public static function getVehicle($vehicle_id){

    return $vehicle = Vehicle::where('status',1)->where('id',$vehicle_id)->first();

  }



  public static function getVehicleNo($vehicleId){

   $vehicle = Vehicle::where('status',1)->whereIn('id',$vehicleId)->get();

    $vehicleNo = array();

    foreach($vehicle as $val){

      $vehicleNo[] = $val->vehicle_no;

    }



    return $vehicles = implode(" , ",$vehicleNo);

  }



  public static function getRate($km,$route_id){

    $routeType = RouteMaster::where('status',1)->where('id',$route_id)->first();

    $type= $routeType->bus_type;
    $km = round($km);
    $kms = RateMaster::where('from_km','<=',$km)->where('to_km','>=',$km)->where('bus_type',$type)->get();

    if(count($kms) > 0){

      return $rate = $kms[0]->rate;

    }else{

      return '0';

    }

  }

  public static function activeInactiveMsg($type,$msg) {
		if($type == 'active') {
			Session()->flash('message', $msg.' Active Successfully !');
		} else {
			Session()->flash('message', $msg.' Inactive Successfully !');
		}
  }

  public function getRoute($routeId){
    $schedule_time = RouteMaster::select('scheduled_time')->findorfail($routeId);
    return $schedule_time;
  }

  public function getIdulingMinutes($routeId)
  {
      $getminutes = Routemaster::where('id',$routeId)->first();
      $idealing_minutes = ($getminutes->maximum_ideling_minutes)/5;

      $edit_ideal_min = array();
      $cnt = 0;
      $edit_ideal_min[]  = 0;
      for($i = 0; $i<$idealing_minutes; $i++)
      {
        $cnt = $cnt+5;
        $edit_ideal_min[] = $cnt;
      }

      return $edit_ideal_min;
  }


}