<?php /*
    name:-Pratik
    on :- 12-09-18
*/
?>
<style>
.user_right_checkbox{
	width:25px;
	height:25px;
}
</style>
<table class='table table-bordered' style="width:80%;margin-left:10%;">
  <tr>
    <th style="text-align:center;">All</th>
    <th style="text-align:center;">Module Name</th>
    <th style="text-align:center;">Permission Create</th>
    <th style="text-align:center;">Permission Edit</th>
    <th style="text-align:center;">Permission View</th>
  </tr>
  @foreach($modules as $module)
  <input type="hidden" name="module_id[]" class="module_id" value="{{ $module->id }}" >
  @php
    $permission = Helper::getPermission($module->id,$usertype_id);
  @endphp
  @if($permission->isEmpty())
    <tr>
      <th><input type="checkbox" name="module_id1[]" class="module_id1 check_data user_right_checkbox" value="{{$module->id}}" ></th>
      <th>{{$module->display_name}}</th>
      <th style=" text-align:center;"><input name="create[]" id="create" class="create user_right_checkbox" type="checkbox" value="{{$module->id}}"></th>
      <th style=" text-align:center;"><input class="edit user_right_checkbox" name="edit[]" id="edit" type="checkbox" value="{{$module->id}}"></th>
      <th style=" text-align:center;"><input name="view[]" class="view user_right_checkbox" id="view" type="checkbox"  value="{{$module->id}}"></th>
      
    </tr>
  @else
    @php
      if($permission[0]->create == 1 && $permission[0]->edit == 1 && $permission[0]->view == 1 ){
        $allPermission = 1;
      }else{
        $allPermission = 0;
      }
    @endphp
    <tr>
      <th><input type="checkbox" name="module_id1[]" {{ ($allPermission == 1) ? 'checked' : '' }} class="module_id1 check_data user_right_checkbox" value="{{$module->id}}" ></th>
      <th>{{$module->display_name}}</th>
      <th style=" text-align:center;"><input name="create[]" id="create" {{ ($permission[0]->create == 1) ? 'checked' : '' }} class="create user_right_checkbox"  type="checkbox" value="{{$module->id}}"></th>
      <th style=" text-align:center;"><input class="edit user_right_checkbox" {{ ($permission[0]->edit == 1) ? 'checked' : '' }} name="edit[]" id="edit" type="checkbox" value="{{ $module->id }}" ></th>
      <th style=" text-align:center;"><input name="view[]" class="view user_right_checkbox" {{ ($permission[0]->view == 1) ? 'checked' : '' }} id="view" type="checkbox" value="{{ $module->id }}" ></th>
    </tr>
  @endif

  @endforeach
</table>
<script>
    $(document).ready(function(){
      $('body').on('click','.check_data',function(e){
          $(this).closest('tr').find("#create").prop('checked',$(this).prop('checked'));
          $(this).closest('tr').find("#edit").prop('checked',$(this).prop('checked'));
          $(this).closest('tr').find("#view").prop('checked',$(this).prop('checked'));
      });
    });
</script>