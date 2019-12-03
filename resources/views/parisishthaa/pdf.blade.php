<?php

error_reporting(0);
header( 'Content-Type: text/html; charset=utf-8' );
?>
<html>
    <head>
        <title></title>
        <style>
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
    /* table#parishishtha_b tbody tr td
	{
		border:1px solid black;
        text-align:center;
	}
    table#parishishtha_b tfoot tr td
	{
		border:1px solid black;
	} */
       </style>
    </head>
    <body>
                       <table class="table table-bordered dttable" style="width:100%;!important;border:1px solid black;border-collapse:collapse;">

                       <thead>
                            <tr>
                         <td colspan="2" class="lt">Depot</td>
                         <td  class="lt">{{ $parisishthab->depot->name }}</td>
                         <td  class="lt" colspan="2">Billing Period</td>
                         <td  class="lt" colspan="2">
                         @php
                                $billingPeriode = explode(",",$parisishthab->billing_period);
                            @endphp
                            From:{{ date("d-m-Y",strtotime($billingPeriode[0])) }} &nbsp;&nbsp;
                            To:{{ date("d-m-Y",strtotime($billingPeriode[1])) }}
                         </td>
                        </tr>
                        <tr>
                            <td colspan="2"  class="lt">Vendor Name</td>
                            <td  class="lt">{{ $parisishthab->vendor->vendor_name  }}</td>
                            <td colspan="2"  class="lt">Vendor Invoice</td>
                            <td colspan="2"  class="lt">{{ $parisishthab->vendorinvoice->invoice_no }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"  class="lt">Route</td>
                            <td  class="lt">{{ $parisishthab->route->fromdepot->name.'-'.$parisishthab->route->todepot->name.' ('.$parisishthab->route->scheduled_number.' - '.$parisishthab->route->scheduled_time.')' }}</td>
                            <td colspan="2"  class="lt">Voucher No.</td>
                            <td colspan="2"  class="lt">
                            {{ $parisishthab->voucher_no }}
                            </td>
                        </tr>
                       </thead>
                         </table>
                         (A) Due Amount
                        <table  class="table table-bordered dttable" style="width:100%;!important;border:1px solid black;border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <td style="text-align:center;">Sr.No.</td>
                                    <td style="text-align:center;">Details</td>
                                    <td style="text-align:center;">Total km</td>
                                    <td style="text-align:center;">Average</td>
                                    <td style="text-align:center;">Rate</td>
                                    <td style="text-align:center;">Amount</td>
                                    <td style="text-align:center;">Total Amount (Rs)</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">1</td>
                                    <td style="text-align:center;"> KM Basis</td>
                                    <td style="text-align:center;">{{ $parisishthaa->total_kms }}</td>

                                    <td style="text-align:center;">{{ $parisishthaa->avg_kms }}</td>

                                    <td style="text-align:center;">{{ $parisishthaa->per_km_rate }}</td>

                                    <td style="text-align:center;">{{ $parisishthaa->amount }}</td>

                                    <td style="text-align:center;">{{ $parisishthaa->total_amount }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">2</td>
                                    <td style="text-align:center;">Monthly Average Deduction / Reimbursement</td>
                                    <td style="text-align:center;">{{ $parisishthaa->avg_km_as_per_contract }}</td>

                                    <td style="text-align:center;">{{ $parisishthaa->avg_km_total_as_per_contract }} </td>

                                    <td style="text-align:center;">{{ $parisishthaa->rate_for_avg_km }}</td>

                                    <td style="text-align:center;">{{ $parisishthaa->amount_for_avg_km }}</td>

                                    <td style="text-align:center;">{{ $parisishthaa->total_amount_for_avg }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">3</td>
                                    <td style="text-align:center;"> Diesel Savings</td>
                                    <td style="text-align:center;" colspan="2">{{ $parisishthaa->diesel_amt }}</td>

                                    <td style="text-align:center;">{{ $parisishthaa->diesel_rate }}</td>

                                    <td style="text-align:center;">{{ $parisishthaa->diesel_amount }}</td>

                                    <td style="text-align:center;">{{ $parisishthaa->diesel_final_amount }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;"></td>
                                    <td style="text-align:center;">(A) Total</td>
                                    <td style="text-align:center;" colspan="4">{{ $parisishthaa->amountWoDeduct }}</td>
                                    <td style="text-align:center;"></td>
                                </tr>
                            </thead>
                        </table>
                            <label> (B) Recovery</label>

                        <table  class="table table-bordered dttable" style="width:100%;!important;border:1px solid black;border-collapse:collapse;" >
                            <thead>
                                <tr>
                                    <td style="text-align:center;">Sr.No.</td>
                                    <td style="text-align:center;">Details</td>

                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">1</td>
                                    <td style="text-align:center;">Extra Filled Diesel Charges</td>
                                    <td style="text-align:center;">{{ $parisishthaa->extra_diesel_amt }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">2</td>
                                    <td style="text-align:center;">Adblue Charges</td>
                                    <td style="text-align:center;">{{ $parisishthaa->adblue_charge }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">3</td>
                                    <td style="text-align:center;">Break Down Charges</td>

                                    <td style="text-align:center;">{{ $parisishthaa->vehical_exp }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">4</td>
                                    <td style="text-align:center;"> Vor. Charges </td>

                                    <td style="text-align:center;">{{ $parisishthaa->vor_exp }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">5</td>
                                    <td style="text-align:center;">Parking Charges</td>

                                    <td style="text-align:center;">{{ $parisishthaa->parking_charge }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">6</td>
                                    <td style="text-align:center;">Halt Charges</td>

                                    <td style="text-align:center;">{{ $parisishthaa->hault_tax }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">7</td>
                                    <td style="text-align:center;">Washing Charge</td>

                                    <td style="text-align:center;">{{ $parisishthaa->wash_exp }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">8</td>
                                    <td style="text-align:center;">Other Charges</td>

                                    <td style="text-align:center;">{{ $parisishthaa->other_exp }}</td>
                                </tr>

                                <tr>
                                    <td style="text-align:center;"></td>
                                    <td style="text-align:center;">(B) Total Recovery</td>

                                    <td style="text-align:center;">{{ $parisishthaa->total_tax }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;"></td>
                                    <td style="text-align:center;">Total Amount Due (A-B)</td>

                                    <td style="text-align:center;"> {{ $parisishthaa->amount_payable }} </td>
                                </tr>
                            </thead>
                        </table>

</body>
</html>
