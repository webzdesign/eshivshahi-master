<?php
/*
        By : Puja Ramvani - API
        Created On : 24 - 08 - 2018
        Desc : Controller For AccessType
*/
namespace App\Http\Controllers;

use App\Model\Accesstype;
use Illuminate\Http\Request;
use App\Http\Requests\AccesstypeRequest;
use Auth;

class AccesstypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $route = 'accesstype'; 
    public $view = 'accesstype'; 
	public $primaryId = 'id';
    public $moduleName = 'Access Type'; 

    public function index()
    {
        $accesstypes=Accesstype::orderBy('id','desc')->get();
        $title=$this->moduleName;
        $module='modal';
        $tabletype='';
        $dataurl='accesstypedata';
        $validateurl ='checkaccesstype';
        $checkremote=true;
        $route=$this->route;
        $action='insert';
        return view($this->view.'/index',compact('accesstypes','title','route','action','dataurl','module','tabletype','validateurl','checkremote'));
    }

    //to get data will refreshing datatable
    public function accesstypedata()
    {
        $accesstypes=Accesstype::orderBy('id','desc')->get();
        foreach($accesstypes as $key=>$value)
        {
            $action="<a data-toggle='modal' id='edit' data-target='#AddEditModal' data-backdrop='static' data-id='$value->id' class='btn  btn-warning  btn-xs'><i class='fa fa-pencil'></i> Edit</a>";
            $access['data'][$key]=array($key+1,$value->name,$action);
        }
        echo json_encode($access);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $result=Accesstype::create($request->all());
        if($result->id>0)
        {
            echo json_encode(true);
        }
        else
        {
            echo json_encode(false);
        }
    }

    public function show(Accesstype $accesstype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Accesstype  $accesstype
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accesstype = Accesstype::findOrFail($id);
        $accesstype['action']='update';
        $accesstype['button']='Update';
        $accesstype['popuptitle']='Update'.$this->moduleName;
        return $accesstype;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Accesstype  $accesstype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accesstype $accesstype)
    {
        $result=Accesstype::find($request->id)->update($request->all());
        if($result>0)
        {
            echo json_encode(true);
        }
        else
        {
            echo json_encode(false);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Accesstype  $accesstype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accesstype $accesstype)
    {
        //
    }

    //to check duplication of accesstype name
    public function checkaccesstype(Request $request)
    {
        if($request->id=='')
        {
            $rows=Accesstype::where('name',$request->name)->count();
        }
        else
        {
            $rows=Accesstype::where('name',$request->name)->where('id','!=',$request->id)->count();
        }
       
        if($rows>0){
            echo json_encode(false) ;
        }else{
            echo json_encode(true) ;
        }
    }
}
