<?php
  /*
    Pratik
    Date:27-09-18
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
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Approval History</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                            <table id="datatable" border="1" width="100%" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="text-align:center;">Level</th>
                                    <th style="text-align:center;">Name</th>
                                    <th style="text-align:center;">Designation</th>
                                    <th style="text-align:center;">Date</th>
                                    <th style="text-align:center;">Time</th>
                                    <th>Remarks</th>
                                    <th>Query Resolved</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($result as $key=>$val)
                                    @if(count($resultquery)>0)
                                        @foreach($resultquery as $k=>$value)
                                        @if($val->usertype_name==$value->usertype_name)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->first_name.' '.$value->last_name }}</td>
                                            <td>{{ $value->usertype_name }}</td>
                                            <td>{{ ($value->user_id != null) ? date("d-M-Y",strtotime($value->queryraised_at)) : '' }}</td>
                                            <td >{{ ($value->user_id != null) ? date("h:i:s a",strtotime($value->queryraised_at)) : '' }}</td>
                                            <td style="color:red">{{ $value->query }}</td>
                                            <td>{{($value->query_status == 2) ? 'Query Resolved' : ''}}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    @endif
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $val->first_name.' '.$val->last_name }}</td>
                                        <td>{{ $val->usertype_name }}</td>
                                        <td>{{ ($val->confirm_by != '0') ? date("d-M-Y",strtotime($val->updated_at)) : '' }}</td>
                                        <td colspan="2">{{ ($val->confirm_by != '0') ? date("h:i:s a",strtotime($val->updated_at)) : '' }}</td>
                                        <td></td>
                                    </tr>

                                    @endforeach
                                </tbody>


                            </table>

                      <!--  <div class="ln_solid"></div>
                         @if(count($resultquery)>0)
                        <h2> Query History</h2>
                        <div class="ln_solid"></div>
                        <table id="datatable1" border="1" width="100%" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="text-align:center;">Level</th>
                                    <th style="text-align:center;">Name</th>
                                    <th style="text-align:center;">Designation</th>
                                    <th style="text-align:center;">Date</th>
                                    <th style="text-align:center;">Time</th>
                                    <th style="text-align:center;">Remarks</th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($resultquery as $key=>$val)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $val->first_name.' '.$val->last_name }}</td>
                                        <td>{{ $val->usertype_name }}</td>
                                        <td>{{ ($val->user_id != null) ? date("d-M-Y",strtotime($val->queryraised_at)) : '' }}</td>
                                        <td>{{ ($val->user_id != null) ? date("h:i:s a",strtotime($val->queryraised_at)) : '' }}</td>
                                        <td>{{ $val->query }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif -->
                            <div class="ln_solid"></div>
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
                           <input type="hidden" name="publish_flag" id="publish_flag" value="" />
                            <a href="{{url("/$route")}}"  class="btn btn-warning" >Cancel </a>
                           </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('#datatable').DataTable();
    $("#datatable1").DataTable();
});
</script>
@endsection