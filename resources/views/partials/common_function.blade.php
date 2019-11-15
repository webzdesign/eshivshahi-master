<script>
/*
    name:-puja
*/
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	/* Hardik */ 
    $(".select2_single").select2({
        placeholder: "Select",
        allowClear: true
    });
	
                 $('.datepicker').datepicker({
						 autoclose: true,
					 	format: 'dd-mm-yyyy'
				});
	/* Hardik */ 
});
</script>
@if(isset($module) && $module =='modal')
    @include('partials.common_code')
@endif