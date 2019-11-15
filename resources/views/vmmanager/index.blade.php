<?php
  /*
    Pratik
    Date:03-11-18
  */
?>
@extends('layouts.master')
@section('content')
@php
  $btn = 'Update';
  $formUrl = route('vmmanager.update',$result[0]->id);
@endphp
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
          <form id="frm_single" method="post"  action="{{ $formUrl }}"   class="form-horizontal form-label-left" autocomplete="off">
          @method('PUT')
          @csrf
          <input type="hidden" name="id" value="{{ $result[0]->id }}">
          <div class="form-group">
                <label class=" col-md-3 col-sm-3 col-xs-12" >Need Vendor Manager Approval (Bill Summary)<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="radio" id="approve" {{ ($result[0]->approve == '0') ? 'checked' : '' }} name="approve" value="0">Yes
                    <input type="radio" id="approve" {{ ($result[0]->approve != '0') ? 'checked' : '' }} name="approve" value="1">No
                </div>
            </div>

            <div class="ln_solid"></div>

            <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit"  class="btn btn-primary">{{ $btn }}</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function() {


});
</script>
@endsection