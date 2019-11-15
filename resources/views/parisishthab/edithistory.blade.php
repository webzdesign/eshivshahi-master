<?php
  /*
    Hardik
    Date:24-8-18
  */
  /*
    Modified
    name :Puja Ramvani
    Date:7-9-18
  */
?>
@extends('layouts.master')
@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              </div>
              <div class="title_right">

              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
            @if(session()->has('msg'))
                <div class="alert alert-success">
                  {{ session()->get('msg') }}
                </div>
				      	@endif
             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{ $modulename }}</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr no.</th>
                          <th>User Name</th>
                          <th>Updated Date</th>
                          <th>Updated Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $key=>$history)
                          <tr>
                              <td>{{$key}}</td>
                              <td>{{ $history->first_name.' '.$history->last_name}}</td>
                              <td>{{ date('d-m-Y',strtotime($history->updated_at))}}</td>
                              <td>{{ date('H:i',strtotime($history->updated_at))}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                      </tfoot>
                    </table>
                    <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                            <a href="{{url($redirect)}}"  class="btn btn-warning" >Cancel </a>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection
