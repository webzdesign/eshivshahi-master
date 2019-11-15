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
                    <form id="frm_charge" method="post"  action ="{{route('charges.store')}}"  class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="diesel_rate">Diesel Rate <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="diesel_rate" name="diesel_rate" class="form-control col-md-7 col-xs-12 focusClass amountonly" placeholder="Enter Diesel Rate" value="{{old('diesel_rate')}}" >
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="vor_chargesdetail">
                                        <td>
                                            <input id="vor_charges" placeholder="0" name="vor_charges[]"  class="form-control col-md-7 col-xs-12 box focusClass amountonly">
                                            @if ($errors->has('vor_charges'))
                                            <div class="error requride_cls">{{ $errors->first('vor_charges') }}
                                            </div>
                                            @endif
                                        </td>
                                        <td width="35%">
                                            <button  tabindex="1" type="button" class="btn btn-success btn-xs add_row_vorcharge"><i class="fa fa-plus"></i></button>
                                            <button tabindex="1" type="button" class="btn btn-danger btn-xs remove_row_vorcharge" ><i class="fa fa-minus"></i></button>
                                        </td>
                                    </tr>
                                    <tr><td colspan="2"><label id="vor_charges-error" class="error" for="vor_charges"></label></td></tr>
                                </tbody>
                            </table>
                            </div>
                            <div class="col-md-4 col-sm-4">
                            <table  class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Washing Charges</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="washing_chargesdetail">
                                        <td>
                                            <input id="washing_charges" placeholder="0" name="washing_charges[]"  class="form-control col-md-7 col-xs-12 box focusClass amountonly">
                                            @if ($errors->has('washing_charges'))
                                            <div class="error requride_cls">{{ $errors->first('washing_charges') }}
                                            </div>
                                            @endif
                                        </td>
                                        <td width="35%">
                                            <button  tabindex="1" type="button" class="btn btn-success btn-xs add_row_washcharge"><i class="fa fa-plus"></i></button>
                                            <button tabindex="1" type="button" class="btn btn-danger btn-xs remove_row_washcharge" ><i class="fa fa-minus"></i></button>
                                        </td>
                                    </tr>
                                    <tr><td colspan="2"><label id="washing_charges-error" class="error" for="washing_charges"></label></td></tr>
                                </tbody>
                            </table>
                            </div>
                            <div class="col-md-4 col-sm-4">
                            <table  class="table table-bordered" >
                                <thead>
                                    <tr>
                                        <th>Parking Charges</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="parking_chargesdetail">
                                        <td>
                                            <input id="parking_charges" placeholder="0" name="parking_charges[]"  class="form-control col-md-7 col-xs-12 box focusClass amountonly">
                                            @if ($errors->has('parking_charges'))
                                            <div class="error requride_cls">{{ $errors->first('parking_charges') }}
                                            </div>
                                            @endif
                                        </td>

                                        <td width="35%">
                                            <button  tabindex="1" type="button" class="btn btn-success btn-xs add_row_parkingcharge"><i class="fa fa-plus"></i></button>
                                            <button tabindex="1" type="button" class="btn btn-danger btn-xs remove_row_parkingcharge" ><i class="fa fa-minus"></i></button>
                                        </td>
                                    </tr>
                                    <tr><td colspan="2"><label id="parking_charges-error" class="error" for="parking_charges"></label></td></tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href=" {{ url('charges') }}"><button type="button" class="btn btn-primary">Cancel</button></a>
                        <button type="submit" class="btn btn-success focusClass">Submit</button>
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


    /* Vor Charges */
    $('body').on('click',".add_row_vorcharge",function(){
        var $tr = $(this).closest('.vor_chargesdetail');
        var $clone = $tr.clone();
        $clone.find('select').select2({placeholder: "Select",width: '100%',allowClear: true});

      $clone.find('span').remove();
        $clone.find('input').val('');
        $tr.after($clone);
    });

    $('body').on('click','.remove_row_vorcharge' ,function(event){
        if($(".vor_chargesdetail").length > 1){
            $(this).closest(".vor_chargesdetail").remove();
        }
    });

    /* Washing Charges */
    $('body').on('click',".add_row_washcharge",function(){
        var $tr = $(this).closest('.washing_chargesdetail');
        var $clone = $tr.clone();
        $clone.find('select').select2({placeholder: "Select",width: '100%',allowClear: true});

      $clone.find('span').remove();
        $clone.find('input').val('');
        $tr.after($clone);
    });

    $('body').on('click','.remove_row_washcharge' ,function(event){
        if($(".washing_chargesdetail").length > 1){
            $(this).closest(".washing_chargesdetail").remove();
        }
    });

    /*Parking Charges*/
    $('body').on('click',".add_row_parkingcharge",function(){
        var $tr = $(this).closest('.parking_chargesdetail');
        var $clone = $tr.clone();
        $clone.find('select').select2({placeholder: "Select",width: '100%',allowClear: true});

      $clone.find('span').remove();
        $clone.find('input').val('');
        $tr.after($clone);
    });

    $('body').on('click','.remove_row_parkingcharge' ,function(event){
        if($(".parking_chargesdetail").length > 1){
            $(this).closest(".parking_chargesdetail").remove();
        }
    });


});
</script>
@endsection