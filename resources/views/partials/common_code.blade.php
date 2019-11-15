<script>

/*

    name:-puja

*/

  $(document).ready(function(){

      //on modal hide and reset the validation and values

    $('.modal').on('hidden.bs.modal', function(e)

    {

        var _get=$(this).find('form').attr('id');

        var validator = $('#'+_get).validate();

        validator.resetForm();

        $('#'+_get)[0].reset();

        $('#'+_get+" select").val(null).trigger('change');

         check=0;

    });



    //click on new button

    $(document).on("click","#new",function(){

        $('input[type=submit]').val('Submit');
        $('#action').val('insert');

    });



    //on form submit

    $("#frm").on('submit',function (event) {

    //check is form valid

      if($("#frm").valid())

      {

        $(':input[type="submit"]').prop('disabled', true);

        event.preventDefault();

        var formdata = new FormData(this);

        //checks the action and defines msg and url according to it

        if($('#action').val()=='insert'){

            message='Successfully Added';

            url='{{$route}}';

        }

        else

        {

            var id=$("#id").val();

            message='Successfully Updated';

            url='{{$route}}'+'/'+id;

        }

        /*variable passed form controller here it checks if

        true then it will check validations

        else will not check

        */

        if('{{$checkremote}}'==true)

        {

            duplicate_url = "{{url($validateurl)}}";

            formdata.delete('_method');

            $.ajax({

            type: 'POST',

            url: duplicate_url,

            processData: false,

            contentType: false,

            dataType:'json',

            data:formdata,

            success: function(res){

            if(res == false)

            {

                swal("Cancelled", "Duplicate entry", "error");

                $(':input[type="submit"]').prop('disabled', false);

            }

            else

            {

                insert_update();

            }

            }

            });

        }

        else

        {

            insert_update();

        }

         /*

         checking validation ends

        */

    //function to insert and update the data

      function insert_update()

        {

            if($('#action').val()=='update'){

                formdata.append('_method', 'PUT');

              }
              else
              {
                formdata.delete('_method');
              }

              $.ajax({

                type: 'POST',

                url: url,

                dataType:'json',

                processData: false,

                contentType: false,

                data: formdata,

                success: function(res){

                    if(res==true)

                    {

                        var check=0;

                        $(".modal").modal('hide');

                        $(':input[type="submit"]').prop('disabled', false);

                        swal({

                            title: 'Success!',

                            text: message,

                            icon: "success",

                        })

                        .then((willDelete) => {

                            if (willDelete) {

                                //controller variable condition for datatable

                                if('{{$tabletype}}'=='serverside')

                                {

                                    $('#datatable-responsive').DataTable().ajax.reload(null,false);

                                }

                                else

                                {

                                    $('#datatable-responsive').DataTable().destroy();

                                    var datatabletable=$('#datatable-responsive').DataTable({

                                        ajax:{

                                            "url": "{{ url($dataurl) }}",

                                        },

                                        columnDefs: [

                                            { orderable: false, targets: [0,2] }

                                        ],

                                        aaSorting:[],

                                    });
                                    datatabletable.on( 'order.dt search.dt', function () {
                                    datatabletable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                                    cell.innerHTML = i+1;
                                        } );
                                    } ).draw();

                                }

                            }

                        });

                    }

                    else

                    {

                        swal({

                            title: 'Error!',

                            text: "Some Error Occured",

                            icon: "warning",

                        })

                    }



                }

              });

        }

          //function end insert_update

        }

    });

    //on form submit ends

    //when click on delete sweet alert

    $(document).on("click", ".confirm-delete", function (e) {

        var d=$(this).data('id');

        url="{{url($route)}}"+'/'+d;

        e.preventDefault();

        swal({

          title: "Are you sure?",

          text: "Once deleted, you will not be able to recover",

          icon: "warning",

          buttons: true,

          dangerMode: true,

        })

        .then((willDelete) => {

          if (willDelete) {

          $.ajax({

                type: 'DELETE',

                url:url,

                dataType:'json',

                data: {id:d},

                success: function(res){

                    if(res==true) {

                        swal('Success!','Deleted Successful','success');

                        //controller variable condition for datatable

                        if('{{$tabletype}}'=='serverside')

                        {

                          $('#datatable-responsive').DataTable().ajax.reload(null,false);

                        }

                        else

                        {

                           var datatabletable=$('#datatable-responsive').DataTable({

                                    ajax:{

                                        "url": "{{ url($dataurl) }}",

                                    },

                                    columnDefs: [

                                        { orderable: false, targets: [0,2] }

                                    ],

                                    aaSorting:[],

                                    });
                                    datatabletable.on( 'order.dt search.dt', function () {
                                    datatabletable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                                    cell.innerHTML = i+1;
                                    } );
                                    } ).draw();

                        }

                    }

                    else {

                        swal('Warning!','Used in Other Module So Can Not Delete It','warning');

                    }

                }

        });

          }

        });

    });

    //ends sweet alert

});

</script>