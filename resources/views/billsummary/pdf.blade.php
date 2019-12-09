<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Bill Summary</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

        @page{

            margin-top:10px !important;

            margin-bottom:0px !important;

            margin-left:10px !important;

            margin-right:10px !important;

            padding:0px !important;

        }

      @font-face {

            font-family: "akshar";

            src: local("akshar"), url({{ storage_path("fonts\akshar.ttf")}}) format("truetype");

            font-weight: normal;

            font-style: normal;

        }

	 table tr td span.abc {

            font-family: "akshar", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif !important;

        }

        span.abc {

            font-family: "akshar", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif !important;

        }

	table tr td

	{

		border:1px solid black;

	}

    table tr td.lt{

        padding-left:10px;

    }
    /** table border style */
    table tr th.border-left, table tr td.border-left
    {
        border-left:1px solid rgb(0,0,0) !important;
    }

    table tr th.border-right, table tr td.border-right
    {
        border-right:1px solid rgb(0,0,0) !important;
    }

    table tr th.border-top, table tr td.border-top
    {
        border-top:1px solid rgb(0,0,0) !important;
    }

    table tr th.border-bottom, table tr td.border-bottom
    {
        border-bottom:1px solid rgb(0,0,0) !important;
    }

    table tr th.no-border-left, table tr td.no-border-left
    {
        border-left:none !important;
    }

    table tr th.no-border-right, table tr td.no-border-right
    {
        border-right:none !important;
    }

    table tr th.no-border-top, table tr td.no-border-top
    {
        border-top:none !important;
    }

    table tr th.no-border-bottom, table tr td.no-border-bottom
    {
        border-bottom:none !important;
    }

    </style>

</head>

<body>

    <table   class="table table-bordered dttable" style="width:100%;border-collapse:collapse">

    <tr>

            <td colspan="2" class="lt">Division</td>

            <td colspan="4" class="lt" >

            @foreach($division as $key=>$divisions)

                    <label> {{ ($divisions->id == $billsummary[0]->division_id) ? $divisions->name :''}}</label>

                @endforeach

            </td>

            <td colspan="2" class="lt">Vendor</td>

            <td  colspan="4" class="lt">

                @foreach($vendor as $key=>$val)

                    <label> {{ ($val->id == $billsummary[0]->vendor_id) ? $val->vendor_name :''}}</label>

                @endforeach

            </td>

        </tr>

        <tr>

            <td colspan="2"  class="lt">Depot</td>

            <td  colspan="4"  class="lt">

            @foreach($depots as $key=>$depot)

                    <label> {{ ($depot->id == $billsummary[0]->depot_id) ? $depot->name :''}}</label>

                @endforeach



            </td>

                        <td colspan="2"  class="lt">Billing Period</td>

                        <td  colspan="4"  class="lt">

                        @php $dates = explode(",",$billsummary[0]->billing_period) @endphp

                From :{{date("d-m-Y",strtotime($dates[0]))}}

                &nbsp;&nbsp;

                To:{{date("d-m-Y",strtotime($dates[1]))}}

                        </td>



        </tr>

        <tr>

        <td colspan="12" style="text-align:center;border-left:none;border-right:none;border-bottom:none">&nbsp;</td>

        </tr>

        <tr>

            <td style="text-align:center;width:4% !important">Sr.No.</td>

            <td style="text-align:center;width:7% !important">Voucher No</td>

            <td style="text-align:center;width:9% !important">Route</td>

            <td style="text-align:center;width:7% !important">Vendor Invoice</td>

            <td style="text-align:center;width:9% !important;padding-left:5px;padding-right:5px;">Amount Demanded By Vendor</td>

            <td style="text-align:center;width:7% !important;padding-left:5px;padding-right:5px;">MSRTC Approved Amount </td>

            <td style="text-align:center;width:7% !important;padding-left:5px;padding-right:5px;">Total Recovery Amount </td>

            <td style="text-align:center;width:7% !important;padding-left:5px;padding-right:5px;">Other Deductions</td>

            <td style="text-align:center;width:7% !important;padding-left:5px;padding-right:5px;">Other Deductions Remark</td>

            <td style="text-align:center;width:12% !important;padding-left:5px;padding-right:5px;">60 % Deduction</td>

            <td style="text-align:center;width:12% !important;padding-left:5px;padding-right:5px;">60 % Deduction Remark</td>

           <!-- <td style="text-align:center;width:6% !important;padding-left:5px;padding-right:5px;">Previous Deduction</td>

            <td style="text-align:center;width:7% !important;padding-left:5px;padding-right:5px;">Previous Deduction Remark</td> -->

            <td style="text-align:center;width:12% !important;padding-left:5px;padding-right:5px;">Total Amount</td>

        </tr>

        @foreach($billsummary as $key=>$val)

        <tr>

            <td style="text-align:center;">

                {{ $key+1 }}

            </td>

            <td style="text-align:center;">{{ $val->gov_voucher_no }}</td>



            <td style="text-align:center;">{{ $val->route->fromdepot->name.'-'.$val->route->todepot->name.' ('.$val->route->scheduled_number.' - '.$val->route->scheduled_time.')' }}</td>



            <td  style="text-align:center;">{{ isset($val->vendorinvoice->invoice_no) ? $val->vendorinvoice->invoice_no : '' }}</td>



            <td style="text-align:center;">{{ $val->vendorinvoice->grand_amount }}</td>



            <td style="text-align:center;">{{ $val->gov_approve_amt }}</td>



            <td style="text-align:center;">{{ $val->vendor_deduction_amt }}</td>



            <td style="text-align:center;">{{ $val->other_deduction }}</td>

                <td style="text-align:center;">{{  $val->other_deduction_remark }}</td>

                <td style="text-align:center;">{{ $val->per_deduction }}</td>

                <td style="text-align:center;">{{ $val->per_deduction_remark }}

            </td>

          <!--  <td style="text-align:center;">{{ $val->prev_deduction }}</td>

            <td style="text-align:center;">{{ $val->prev_deduction_remark }}</td> -->

            <td style="text-align:center;">{{ $val->final_payable_amt }} </td>

        </tr>

        <tr>

        <td colspan="12" style="text-align:center;border-left:none;border-right:none;border-bottom:none">&nbsp;</td>

        </tr>

        <tr>

      <th colspan="8" style="border-left:none;border-top:none;border-bottom:none;"></th>
      <th colspan="2" class="border-left border-top border-bottom" style="text-align:center;"> - </th>
          <td style="text-align:center;" colspan="1"><span class="abc">Total Amount Due</td>



               <td  style="text-align:center;">{{ $val->final_payable_amt }}</td>

      </tr>

      <tr>

            <td colspan="8" style="border-left:none;border-top:none;border-bottom:none;"></td>

            <td colspan="2" class="border-left border-bottom" style="text-align:center;"> {{ $billsummary[0]->vendor_previous_deduction_remarks }}</td>

            <td style="text-align:center;" colspan="1">Vendor Previous Deduction</td>

            <td style="text-align:center;" >{{ $billsummary[0]->vendor_deduction }}</td>

      </tr>

      <tr>

            <td colspan="8" style="border-left:none;border-top:none;border-bottom:none;"></td>

            <td colspan="2" class="border-left border-bottom" style="text-align:center;"> {{ $billsummary[0]->vendor_reimbursement_remark }} </td>

            <td style="text-align:center;" colspan="1">Vendor Reimbursement</td>

            <td style="text-align:center;" >{{ $billsummary[0]->vendor_reimbursement }}</td>

        </tr>

      <tr>

          <td colspan="8" style="border-left:none;border-top:none;border-bottom:none;"></td>
          <th colspan="2" class="border-left border-bottom" style="text-align:center;"> - </th>
          <td style="text-align:center;" colspan="1">TDS</td>

          <td style="text-align:center;" >{{ $billsummary[0]->tds }}</td>

      </tr>


      <tr>

          <td colspan="8" style="border-left:none;border-top:none;border-bottom:none;"></td>
          <th colspan="2" class="border-left border-bottom" style="text-align:center;"> - </th>
          <td style="text-align:center;" colspan="1">Grand Total</td>

          <td style="text-align:center;">{{ $billsummary[0]->amount_after_tds }}</td>

      </tr>

    @endforeach

    </table>

    &nbsp;



    <h3 style="text-align:center">Approval History</h3>

    <table id="datatable" border="1" width="100%" class="table table-bordered" style="border-collapse:collapse">

                                <thead>

                                <tr>

                                    <th style="text-align:center;">Level</th>

                                    <th style="text-align:center;">Name</th>

                                    <th style="text-align:center;">Designation</th>

                                    <th style="text-align:center;">Date</th>

                                    <th style="text-align:center;">Time</th>

                                    <th style="text-align:center;">Remarks</th>

                                </tr>

                                </thead>

                                <tbody>

                                    @foreach($result as $key=>$val)

                                    @if($val->query !=null)

                                    <tr>

                                    <td style="text-align:center">{{ $key+1 }}</td>

                                    <td  class="lt">{{ $val->fm.' '.$val->lm }}</td>

                                        <td  class="lt">{{ $val->usertype_name }}</td>

                                        <td  class="lt">{{ ($val->user_id != null) ? date("d-M-Y",strtotime($val->queryraised_at)) : '' }}</td>

                                        <td  class="lt">{{ ($val->user_id != null) ? date("h:i:s a",strtotime($val->queryraised_at)) : '' }}</td>



                                        <td  class="lt"> {{ $val->query }}</td>

                                    </tr>

                                    @endif

                                    <tr>

                                        <td style="text-align:center">{{ $key+1 }}</td>

                                        <td  class="lt">{{ $val->first_name.' '.$val->last_name }}</td>

                                        <td  class="lt">{{ $val->usertype_name }}</td>

                                        <td  class="lt">{{ ($val->confirm_by != '0') ? date("d-M-Y",strtotime($val->updated_at)) : '' }}</td>

                                        <td colspan="2"  class="lt">{{ ($val->confirm_by != '0') ? date("h:i:s a",strtotime($val->updated_at)) : '' }}</td>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>

</body>

</html>