@extends('layouts.master')
@section('content')
@php
  if($userTypeId != '2' || $userTypeId != '3'){

  }
@endphp
<div class="right_col" role="main">
  <div class="">
    <div class="row top_tiles">
    @if($userTypeId != '1' && $userTypeId != '2' && $userTypeId != '3')

        <a href="{{ url('billsummaryconfirm') }}">
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-check-square-o"></i></div>
              <div class="count">{{ $billSummaryCnt }}</div>
              <h3>Bill Summary</h3>
              <p>Pending Bill Summary Confirm</p>
            </div>
          </div>
        </a>

        <a href="{{url('/query')}}">
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats" style="height: 120px;">
              <div class="icon"><i class="fa fa-question"></i></div>
              <div class="count">{{$PendingQuery}}</div>
              <h3>Pendding Query</h3>
              <p>Pendding Query</p>
            </div>
          </div>
        </a>

    @else
    {{--  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
        <h2>Dashboard</h2>
        <div class="clearfix"></div>
        </div>
        <div class="x_content">

        </div>
      </div>
      </div>
    </div>  --}}

    <a href="{{url('/query')}}">
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" style="height: 120px;">
          <div class="icon"><i class="fa fa-question"></i></div>
          <div class="count">{{$PendingQuery}}</div>
          <h3>Pendding Query</h3>
          <p>Pendding Query</p>
        </div>
      </div>
    </a>

    @endif
    </div>
  </div>
</div>
@endsection