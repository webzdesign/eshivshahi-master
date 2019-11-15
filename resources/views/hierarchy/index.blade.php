@extends('layouts.master')
@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">


            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{$msgName}}</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr No.</th>
                          <th>Module</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($modules as $key=>$module)
                            <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$module->module_name}}</td>
                              <td> <a href="{{ url($route.'/set_hierarchy/'.encrypt($module->id)) }}" class="btn btn-warning btn-xs" >Set Hierarchy</a></td>
                            </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection