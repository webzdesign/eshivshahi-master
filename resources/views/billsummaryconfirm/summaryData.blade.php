<table id="dataTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
<thead>
    <tr>
        <th>Sr no.</th>
        <th>Vendor</th>
        <th>Depot</th>
        <th>Division</th>
        <th>Vehicle No</th>
        <th>Voucher No</th>
        <th>Billing Period</th>
        <th>Action1</th>
    </tr>
</thead>
<tbody>
    @foreach($billSummary as $key=>$val)
        @php
            $billing_period=explode(",",$val->parisisthab->billing_period);
            $from=date("d-m-Y",strtotime($billing_period[0]));
            $to=date("d-m-Y",strtotime($billing_period[1]));
            $billing_period = $from ." to ".$to;
            $url = url('billsummaryconfirm',Crypt::encryptString($val->id));


            $billSummaryConfirm = App\Model\BillSummaryConfirm::where('usertype_id',$userTypeId)->where('billsummary_id',$val->id)->where('confirm_by',0)->get();

            if(! $billSummaryConfirm->isEmpty()){
                /* get current seq */
                $curSeq = $billSummaryConfirm[0]->sequence;

                if($curSeq == '1'){
                    $confirmStatus = 0;
                }else{
                    /* prev seq check */
                    $prevSeq = intval($curSeq)-intval(1);

                    $confirmCheck = App\Model\BillSummaryConfirm::where('billsummary_id',$val->id)->where('confirm_by','!=','0')->where('sequence',$prevSeq)->get();
                    if(! $confirmCheck->isEmpty()){
                        $confirmStatus = 0;
                    }else{
                        $confirmStatus = 1;
                    }
                }
            }else{
                $confirmStatus = 1;
            }

        @endphp
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $val->vendor->vendor_name }}</td>
            <td>{{ $val->depot->name }}</td>
            <td>{{ $val->division->name }}</td>
            <td>{{ $val->vehicle->vehicle_no }}</td>
            <td>{{ $val->vendorinvoice->invoice_no }}</td>
            <td>{{ $billing_period }}</td>
            <td><a id='edit' href='{{ $url }}' class='btn  btn-info btn-xs'><i class='fa fa-eye'></i> View </a>
            @if($confirmStatus == '0')
            <a id='confirm' href='{{ $url }}' class='btn  btn-success btn-xs'><i class='fa fa-check'></i> Confirm </a>
            @endif
            </td>
        </tr>
    @endforeach
</tbody>
<tfoot>
</tfoot>
</table>
<script>
jQuery(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>