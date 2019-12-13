@php error_reporting(0); @endphp

<div class="table-responsive" style="width:100%;margin: 0 auto;">

<table border="1" class="table table-bordered dttable" cellspacing="0" style="width:1800px;">

    <tr>

        <th style="text-align:center;">अ.क्र</th>

        <th style="text-align:center;">महामंडठ्ठाचा देयक क्र</th>

        <th width="150px !important;"  style="text-align:center;">मार्ग (वेळापत्रक)</th>

        <th style="text-align:center;">पुरवठादाराने दिलेला देयक क्र</th>

        <th style="text-align:center;">पुरवठादाराने मागणी केलेली रक्कम रु</th>

        <th style="text-align:center;">महामंडठ्ठाने मंजुर केलेली ऐकूण रक्कम रु</th>

        <th style="text-align:center;">वसुली रक्कम रु</th>

        <th style="text-align:center;">Other Deductions</th>

        <th style="text-align:center;">Other Deductions Remarks</th>

        <th style="text-align:center;">60 % Deduction</th>

        <th width="200px !important;" style="text-align:center;">60 % Deduction Remarks</th>

      <!-- <th style="text-align:center;">Previous Deduction</th>

        <th style="text-align:center;">Previous Deduction Remarks</th> -->

        <th style="text-align:center;"  width="10%">निव्व्ठ्ठ देय रक्कम</th>

    </tr>

    @php

        $total = 0;

        $k=1;

        $cnt = 0;

    @endphp

    @foreach($parisishthaa as $key=>$val)

        <tr>

            <th style="text-align:center;">

            <input type="hidden" id="parisishtha_a_id" name="parisishtha_a_id[]" class="form-control parisishtha_a_id" value="{{ $val->id }}" />

            <input type="hidden" id="parisishtha_b_id" name="parisishtha_b_id[]" class="form-control parisishtha_b_id" value="{{ $val->parisishtha_b_id }}" />

            <input type="hidden" id="depot_id" name="depot_id[]" class="form-control depot_id" value="{{ $val->depot_id }}" />

            <input type="hidden" id="division_id" name="division_id[]" class="form-control division_id" value="{{ $val->division_id }}" />

            <input type="hidden" id="vehicle_id" name="vehicle_id[]" class="form-control" value="{{ $val->vehicle_id }}" />

            <input type="hidden" id="route_id" name="route_id[]" class="form-control" value="{{ $val->route_id }}" />

            <input type="hidden" id="vendorinvoice_id" name="vendorinvoice_id[]" class="form-control" value="{{ $val->vendorinvoice_id }}" />



            {{ $k }}</th>

            <th width="150px !important;" style="text-align:center;"><input type="text" name="voucher_no[]" class="form-control" readonly value="{{ $val->voucher_no }}" /></th>



            <th width="300px !important;" style="text-align:center;"><input type="text" class="form-control" readonly value="{{ $val->route->fromdepot->name.'-'.$val->route->todepot->name.' ('.$val->route->scheduled_number.' - '.$val->route->scheduled_time.')' }}" /></th>



            <th style="text-align:center;"><input type="text" class="form-control" readonly value="{{ $val->vendorinvoice->invoice_no }}" /></th>



            <th style="text-align:center;"><input type="text" name="vendor_invoice_amt[]" class="form-control" readonly value="{{ isset($val->vendorinvoice->grand_amount) ? $val->vendorinvoice->grand_amount : '' }}"/></th>



            <th style="text-align:center;"><input type="text" name="gov_approve_amt[]" id="gov_approve_amt" class="form-control gov_approve_amt" readonly value="{{ $val->amountWoDeduct }}" /></th>



            <th style="text-align:center;"><input type="text" name="vendor_deduction_amt[]" id="vendor_deduction_amt" class="form-control vendor_deduction_amt" readonly value="{{ $val->total_tax }}" /></th>



            <th style="text-align:center;"><input type="text" name="other_deduction[]" id="other_deduction" class="form-control amountonly other_deduction" /></th>

            <th style="text-align:center;"><textarea rows="1" name="other_deduction_remark[]" id="other_deduction_remark" class="form-control other_deduction_remark"></textarea></th>

            <th width="150px !important;" style="text-align:center;"><input type="text" name="per_deduction[]" id="per_deduction" class="form-control amountonly per_deduction" /></th>

            <th style="text-align:center;"><textarea rows="1" name="per_deduction_remark[]" id="per_deduction_remark" class="form-control per_deduction_remark"></textarea></th>

         <!-- <th style="text-align:center;"><input type="text" name="prev_deduction[]" id="prev_deduction" class="form-control prev_deduction" /></th>

            <th style="text-align:center;"><textarea rows="1" name="prev_deduction_remark[]" id="prev_deduction_remark" class="form-control prev_deduction_remark"></textarea></th> -->



            <th style="text-align:center;"><input type="text" name="final_payable_amt[]" id="final_payable_amt" class="form-control final_payable_amt" readonly value="{{ $val->amount_payable }}" /></th>

        </tr>

        @php

            $total += $val->amount_payable;

            $k++;$cnt++;

        @endphp

    @endforeach


    <tr>

        <th style="text-align:right;" colspan="">Total Bill Summary :</th>

        <th colspan="1"><input type="text" class="form-control" readonly value="{{ $cnt }}" /></th>

        <th colspan="7"></th>
        <th style="text-align:center;"> - </th>
        <th style="text-align:center;" colspan="1">ऐकुण रक्कम रु</th>

        <th><input type="text" name="finalAmount" class="form-control finalAmount" id="finalAmount" readonly value="{{ $total }}" /></th>

    </tr>

    <tr>

        <th colspan="9"></th>
        <th> <textarea placeholder="Enter Vendor Previous Deduction Remarks"   id="vendor_previous_deduction_remarks" name="vendor_previous_deduction_remarks"></textarea> </th>
        <th >Vendor Previous Deduction</th>

        <th colspan="1"><input type="text" class="form-control vendor_deduction numberonly" id="vendor_deduction" name="vendor_deduction" value="{{ abs($prevDeducton) }}" /></th>

    </tr>

    <tr>

        <th colspan="9"></th>
        <th> <textarea placeholder="Enter Vendor Reimbursement Remarks"   id="vendor_reimbursement_remark" name="vendor_reimbursement_remark"></textarea> </th>
        <th >Vendor Reimbursement</th>

        <th colspan="1"><input type="text" class="form-control vendor_reimbursement numberonly" id="vendor_reimbursement" name="vendor_reimbursement" value="0" /></th>

    </tr>

    <tr>

        <th colspan="9"></th>
        <th style="text-align:center;"> - </th>
        <th style="text-align:center;" colspan="1">TDS</th>

        <th><input type="text" class="form-control tds" id="tds" name="tds"  value="" /></th>

    </tr>

    <tr>

        <th colspan="9"></th>
        <th style="text-align:center;"> - </th>
        <th style="text-align:center;" colspan="1">Grand Total</th>

        <th><input type="text" class="form-control" name="amountafter_tds" id="amountafter_tds"  value=""  readonly/></th>

    </tr>

</table>

</div>