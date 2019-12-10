<?php
/*
Pratik Donga
Date:20-10-18
*/
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
        @page{
            margin-top:10px !important;
            margin-bottom:0px !important;
            margin-left:10px !important;
            margin-right:10px !important;
            padding:0px !important;
        }
	 table#parishishtha_b thead tr td span.abc {
            font-family: "akshar", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif !important;
        }
        table#parishishtha_b tr td span.abc {
            font-family: "akshar", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif !important;
        }
        table tr td{
            border: 1px solid black;
        }
        table#parishishtha_b thead tr td.lt{
        text-align:left;
        padding-left:10px;
    }
	table#parishishtha_b thead tr td
	{
		border:1px solid black;
        text-align:center;
	}
    table#parishishtha_b tbody tr td
	{
		border:1px solid black;
        text-align:center;
	}
    table#parishishtha_b tfoot tr td
	{
		border:1px solid black;
         text-align:center;
	}
    .parishish_size{
        font-size:12px;
    }
    .parishish_sizeh{
        font-size:13px;
    }
       </style>
    </head>
    <body>

        <table id="parishishtha_b" class="table table-bordered dttable" style="width:95% !important;border:1px solid black;border-collapse:collapse;">
			<thead >
                <tr>
                    <td class="lt" colspan="3">Division</td>
                    <td class="lt" colspan= "4">
                        @foreach($division as $key=>$val)
                            <label> {{ ($val->id == $vendorinvoice_data->division_id) ? $val->name : '' }} </label>
                        @endforeach
                    </td>
                    <td class="lt" colspan="3">Vendor</td>
                    <td class="lt" colspan="6">
                        @foreach($vendors as $vendor)
                            <label >
                                {{$vendorinvoice_data->vendor_id==$vendor->id?$vendor->vendor_name:''}}
                            </label>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="lt" colspan="3">Depot</td>
                    <td class="lt" colspan="4">
                        @foreach($depots as $key=>$depot)
                            <label> {{ ($depot->id == $vendorinvoice_data->depot_id) ?$depot->name:'' }} </label>
                        @endforeach
                    </td>
                    <td class="lt" colspan="3">
                        Invoice No
                    </td>
                    <td class="lt" colspan="6">
                        {{$vendorinvoice_data->invoice_no}}
                    </td>
                </tr>
                <tr>
                    <td class="lt" colspan="3">Billing Period</td>
                    <td class="lt" colspan="4">
                    @php	$dates = explode(",",$vendorinvoice_data->billing_period) @endphp
                    From: {{date("d-m-Y",strtotime($dates[0]))}}
                    To :{{date("d-m-Y",strtotime($dates[1]))}}
                    </td>
                    <td class="lt" colspan="3">Route</td>
                    <td class="lt" colspan="6">
                        @foreach($routes as $rout)
                            <label >{{$vendorinvoice_data->route_id == $rout->id ? $rout->from_depot.' - '.$rout->to_depot.' ('.$rout->scheduled_time.')' : ''}}</label>
                        @endforeach
                    </td>

                </tr>
                <tr>
                    <td class="lt" colspan="7">Schedule Time - Schedule Number</td>
                    <td class="lt" colspan="9">{{ $routes[0]->scheduled_number.' - '.$routes[0]->scheduled_time }}</td>
                </tr>
				<tr>
                    <td style="width:8%;" class="parishish_size">Date</td>
                    <td style="width:3%;font-size:12px;">Schedule Complete</td>
					<td style="width:5%;" class="parishish_size">Kms</td>
    				<td style="width:5%;" class="parishish_size">Diesel Ltr</td>
    				<td style="width:5%;" class="parishish_size">Diesel Rate</td>
        			<td style="width:5%;" class="parishish_size">Ad Blue</td>
					<td style="width:5%;" class="parishish_size">AdBlue Price</td>
					<td style="width:8%;" class="parishish_size">Break Down Charges</span></td>
					<td style="width:8%;" class="parishish_size">Vor. Exp</span></td>
					<td style="width:5%;" class="parishish_size">Parking Exp</span></td>
					<td style="width:8%;" class="parishish_size">Hotel Halt</span></td>
                    <td style="width:5%;" class="parishish_size">Washing Charges</td>
					<td style="width:8%;" class="parishish_size">Other Exp</span><span class="required"></span></td>
                    <td style="width:13%;" class="parishish_size">VehicleNumber</td>
                    <td style="width:13%;" class="parishish_size">Idling Minutes</td>
					<td style="width:12%;" class="parishish_size">Remarks</td>
				</tr>
			</thead>
            @php
                $date = explode(",",$vendorinvoice_data->date);
                $p_k = explode("*++*",$vendorinvoice_data->relevant_agreement);
                $vehicleArr = explode("*++*",$vendorinvoice_data->vehicle_id);
                $schedule_complete = explode("*++*",$vendorinvoice_data->schedule_complete);
    			$kms = explode(",",$vendorinvoice_data->kms);
    			$diesel_ltr = explode(",",$vendorinvoice_data->diesel_ltr);
    			$diese_per_ltr_price = explode(",",$vendorinvoice_data->diese_per_ltr_price);
    			$adblue = explode(",",$vendorinvoice_data->adblue);
    			$adblue_price = explode(",",$vendorinvoice_data->adblue_price);
    			$breaddown_charge = explode(",",$vendorinvoice_data->breaddown_charge);
    			$vor_exp = explode(",",$vendorinvoice_data->vor_exp);
    			$parking_exp = explode(",",$vendorinvoice_data->parking_exp);
    			$hault_tax = explode(",",$vendorinvoice_data->hault_tax);
                $wash_exp = explode(",",$vendorinvoice_data->wash_exp);
                $other_exp = explode(",",$vendorinvoice_data->other_exp);
                $idling_minutes = explode(",",$parisishthab->idling_minutes);
                $remarks = explode("*++*",$vendorinvoice_data->remarks);
                $breaddown_charge_value = explode("*++*",$vendorinvoice_data->breaddown_charge_value);
    		@endphp
            <tbody>
    		@for($i=0;$i<count($date);$i++)
                <tr class="parishishtha_b">
                    <td style="width:10%;" class="parishish_size">{{date("d-m-Y",strtotime($date[$i])) }}</td>
                    <td style="width:3%;font-size:12px;">{{$schedule_complete[$i]==1?'Yes':''}}</td>
                    <td style="width:6%;" class="parishish_size">{{$kms[$i]}}</td>
                    <td style="width:5%;" class="parishish_size">{{$diesel_ltr[$i]}}</td>
                    <td style="width:6%;" class="parishish_size">{{$diese_per_ltr_price[$i]}}</td>
                    <td style="width:6%;" class="parishish_size">{{$adblue[$i]}}</td>
                    <td style="width:8%;" class="parishish_size">{{$adblue_price[$i]}}</td>
                    <td style="width:8%;" class="parishish_size">{{$breaddown_charge[$i]}}</td>
                    <td style="width:8%;" class="parishish_size">{{$vor_exp[$i]}}</td>
                    <td style="width:5%;" class="parishish_size">{{$parking_exp[$i]}}</td>
                    <td style="width:8%;" class="parishish_size">{{$hault_tax[$i]}}</td>
                    <td style="width:5%;" class="parishish_size">{{ $wash_exp[$i] }}</td>
                    <td style="width:8%;" class="parishish_size">{{$other_exp[$i]}}</td>
                    <td style="width:10%;" class="parishish_size">{{ ($vehicleArr[$i] == 'noVehicle') ? 'No Vehicle' : $vehicle[$vehicleArr[$i]] }}</td>
                    <td style="width:8%; font-size:10px;" class="parishish_size">{{ $idling_minutes[$i] }}</td>
                    <td style="width:8%; font-size:10px;" class="parishish_size">{{ $remarks[$i] }}</td>
                </tr>
            @endfor
            </tbody>
            <tfoot>
			    <tr>
					<td colspan="2" style="width:8%;">Total</td>
                    <td style="width:6%;">{{ array_sum(explode(",",$vendorinvoice_data->kms)) }}</td>
					<td style="width:7%;">{{ array_sum(explode(",",$vendorinvoice_data->diesel_ltr)) }}</td>
					<td style="width:8%;"></td>
					<td style="width:8%;">{{array_sum($adblue)}}</td>
					<td style="width:8%;"></td>
    				<td style="width:8%;">{{array_sum($breaddown_charge)}} </td>
					<td style="width:8%;">{{array_sum($vor_exp)}} </td>
	    			<td style="width:5%;">{{array_sum($parking_exp)}}</td>
					<td style="width:8%;"> {{array_sum($hault_tax)}} </td>
                    <td style="width:8%;"> {{array_sum($wash_exp)}} </td>
					<td style="width:8%;">{{array_sum($other_exp)}}</td>
                    <td></td>
					<td></td>
					<td></td>
				</tr>
                <tr>
                    <td colspan="3">Total Kms</td>
                    <td colspan="4">Total Filled Diesel</td>
                    <td colspan="4">Diesel as per norms</td>
                    <td colspan="5">Extra Diesel Filled</td>
			    </tr>
                <tr>
				    <td colspan="3">{{ array_sum(explode(",",$vendorinvoice_data->kms)) }}</td>
				    <td colspan="4">{{ array_sum(explode(",",$vendorinvoice_data->diesel_ltr)) }}</td>
				    <td colspan="4">{{$vendorinvoice_data->diesel_as_per_gov}}</td>
				    <td colspan="5">{{ number_format(array_sum(explode(",",$vendorinvoice_data->diesel_ltr))-$vendorinvoice_data->diesel_as_per_gov,2,'.','') }}</td>
			    </tr>
                <tr>
    			    <td colspan="11" style="text-align:right;">Extra Filled Diesel Charges</td>
				    <td colspan="5">
                    <?php
                     $total_diesel=array_sum(explode(",",$vendorinvoice_data->diesel_ltr));
                     $total_price=array_sum(explode(",",$vendorinvoice_data->diese_per_ltr_price));
                     $days=0;
                     foreach($diese_per_ltr_price as $price)
                     {
                         if($price>0)
                         {
                             $days++;
                         }
                     }
                     $final_price = $total_price/$days;
                     $extra_price=($total_diesel-$vendorinvoice_data->diesel_as_per_gov)*$final_price;
                    ?>
                    {{ is_nan($extra_price)?0:number_format($extra_price,2,'.','')}}


                    </td>
                </tr>
                <tr>
                    <td colspan="11" style="text-align:right;">Amount</td>
				    <td colspan="5"> {{ number_format($vendorinvoice_data->total_amount,2,'.','') }}</td>

			    </tr>
                <tr>
                    <td colspan="11" style="text-align:right;">Total Deduction</th>
                    <td colspan="5">{{ number_format($vendorinvoice_data->total_charge,2,'.','') }}</td>
				</tr>
                 <tr>
                    <td colspan="11" style="text-align:right;">Grand Total</th>
                    <td colspan="5">{{ number_format($vendorinvoice_data->grand_amount,2,'.','') }}</td>
				</tr>
			</tfoot>
		</table>
    </body>
</html>