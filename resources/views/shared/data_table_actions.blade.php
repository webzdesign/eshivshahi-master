@php
$usertype_id = Auth::user()->usertype_id;
@endphp
@if($usertype_id != '2' && $usertype_id !='3')
<a href="{{ url($route.'/'.encrypt($editId).'/edit') }}" class="btn btn-warning btn-xs" ><i class='glyphicon glyphicon-edit'></i> Edit</a>
@else
@endif
<?php /*<form action="{{ url($route.'/'.$DeleteId) }} " method="post">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger btn-xs confirm-delete-no-modal">Delete</button>
</form>
*/
?>