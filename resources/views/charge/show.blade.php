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
                    <h2>{{ $moduleName }}</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <form id="frm_charge" method="post"  action ="" class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="id" value="{{$charges->id}}" />
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="diesel_rate">Diesel Rate <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="diesel_rate" name="diesel_rate" class="form-control col-md-7 col-xs-12 focusClass amountonly" placeholder="Enter Diesel Rate" value="{{$charges->diesel_rate}}" readonly>
                        @if ($errors->has('diesel_rate'))
                        <div class="error requride_cls">{{ $errors->first('diesel_rate') }}
                        </div>
                        @endif
                        </div>
                    </div>

                    <div class="table-responsive form-group" style="width: 100%; margin: 0 auto;">
                        <div class="col-md-12 col-sm-12">
                            <div class="col-md-4 col-sm-4">
                            <table  class="table table-bordered" >
                                <thead>
                                    <tr>
                                        <th>VOR Charges</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $vor_arr = explode(",",$charges->vor_charges);

                                    $cnt=0;
                                    ?>
				                   @foreach($vor_arr as $key=>$val)
                                    <tr class="vor_chargesdetail">
                                        <td>
                                            <input id="vor_charges" placeholder="0" name="vor_charges[]"  class="form-control col-md-7 col-xs-12 box focusClass amountonly" value="{{$val}}" readonly>
                                            @if ($errors->has('vor_charges'))
                                            <div class="error requride_cls">{{ $errors->first('vor_charges') }}
                                            </div>
                                            @endif
                                        </td>

                                    </tr>
                                    <?php $cnt++; ?>
                                    @endforeach

                                </tbody>
                            </table>
                            </div>
                            <div class="col-md-4 col-sm-4">
                            <table  class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Washing Charges</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $washing_arr = explode(",",$charges->washing_charges);

                                    $cnt=0;
                                    ?>
                                    @foreach($washing_arr as $key=>$val)
                                    <tr class="washing_chargesdetail">
                                        <td>
                                            <input id="washing_charges" placeholder="0" name="washing_charges[]"  class="form-control col-md-7 col-xs-12 box focusClass amountonly" value="{{$val}}" readonly>
                                            @if ($errors->has('washing_charges'))
                                            <div class="error requride_cls">{{ $errors->first('washing_charges') }}
                                            </div>
                                            @endif
                                        </td>

                                    </tr>
                                    <?php $cnt++; ?>
                                    @endforeach

                                </tbody>
                            </table>
                            </div>
                            <div class="col-md-4 col-sm-4">
                            <table  class="table table-bordered" >
                                <thead>
                                    <tr>
                                        <th>Parking Charges</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $parking_arr = explode(",",$charges->parking_charges);

                                    $cnt=0;
                                    ?>
                                    @foreach($parking_arr as $key=>$val)
                                    <tr class="parking_chargesdetail">
                                        <td>
                                            <input id="parking_charges" placeholder="0" name="parking_charges[]"  class="form-control col-md-7 col-xs-12 box focusClass amountonly" value="{{$val}}" readonly>
                                            @if ($errors->has('parking_charges'))
                                            <div class="error requride_cls">{{ $errors->first('parking_charges') }}
                                            </div>
                                            @endif
                                        </td>


                                    </tr>
                                    <?php $cnt++; ?>
                                    @endforeach

                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href=" {{ url('charges') }}"><button type="button" class="btn btn-primary">Cancel</button></a>

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
$(document).ready(function(){
    /* Validation */
    $('#frm_charge').validate({
        rules:{
          diesel_rate:{
            required:true,
          },
          "vor_charges[]":{
            required:true,
          },
          "washing_charges[]":{
            required:true,
          },
          "parking_charges[]":{
            required:true,
          }

        },
        messages:
        {
            diesel_rate:{
              required:"Enter Diesel Rate",
            },
            "vor_charges[]":{
              required:"Enter VOR Charges",
            },
            "washing_charges[]":{
                required:"Enter Washing Charges",
            },
            "parking_charges[]":{
            required:"Enter Parking Charges",
            },
        },
        errorPlacement: function(error, element){
          if(element.is('select')) {
              error.insertAfter(element.next());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(form) {
          $(':input[type="submit"]').prop('disabled', true);
          form.submit();
        }
    });

});
</script>
@endsection