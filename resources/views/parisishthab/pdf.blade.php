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

	 table#parishishtha_b thead tr td span.abc {

            font-family: "akshar", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif !important;

        }

        table#parishishtha_b tr td span.abc {

            font-family: "akshar", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif !important;

        }

	table#parishishtha_b thead tr td

	{

		border:1px solid black;

        text-align:center;

	}

    table#parishishtha_b thead tr td.lt{

        text-align:left;

        padding-left:10px;

    }

    table#parishishtha_b thead tr td.rt{

        text-align:right;

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

    table tr td{

        border:1px solid black;

    }

       </style>

    </head>

    <body>



        <table id="parishishtha_b" class="table table-bordered dttable" style="width:100%!important;border:1px solid black;border-collapse:collapse;">

			<thead >

                <tr>

                    <td class="lt" colspan="3">Division</td>

                    <td class="lt" colspan="4">

                        @foreach($division as $key=>$val)

                            <label> {{ ($val->id == $parisishthab->division_id) ? $val->name : '' }} </label>

                        @endforeach

                    </td>

                <td colspan="3" class="lt">Vendor</td>

                <td colspan="7" class="lt">

                    @foreach($vendors as $vendor)

                        <label >

                                {{$parisishthab->vendor_id==$vendor->id?$vendor->vendor_name:''}}

                        </label>

                    @endforeach

                </td>

            </tr>

            <tr>



              <td class="lt" colspan="3">Depot</td>

                  <td class="lt" colspan="4">

                      @foreach($depots as $key=>$val)

                          <label>{{($val->id == $parisishthab->depot_id) ?$val->name:'' }}</label>

                      @endforeach

                  </td>



                  <td class="lt" colspan="3">Vendor Invoice No</td>

                  <td class="lt" colspan="7">

                  {{$invoiceNo}}

                  </td>



              </tr>

              <tr>

                <td class="lt" colspan="3">Route</td>

                    <td class="lt" colspan="4">

                    @foreach($routes as $rout)

                        <label >{{$parisishthab->route_id == $rout->id?$rout->from_depot.' - '.$rout->to_depot.' ('.$rout->scheduled_time.')' : ''}}</label>

                    @endforeach

                    </td>

                <td class="lt" colspan="3">Voucher No</td>

                <td class="lt" colspan="7">

                    {{isset($parisishthab->voucher_no)?$parisishthab->voucher_no:''}}

                </td>

            </tr>

            <tr>
                <td class="lt"  colspan="3">Billing Period</td>
                <td class="lt" colspan="4">
                @php	
                    $dates = explode(",",$parisishthab->billing_period) 
                @endphp
                    From: {{date("d-m-Y",strtotime($dates[0]))}} &nbsp;&nbsp;
                    To :{{date("d-m-Y",strtotime($dates[1]))}}
                </td>
                <td class="lt" colspan="3">Voucher Date</td>
                <td class="lt" colspan="7">
                    {{ date('d-m-Y',strtotime($parisishthab->voucher_date)) }}
                </td>
            </tr>
            <tr>
                <td class="lt" colspan="7">Schedule Number - Schedule Time </td>
                <td class="lt" colspan="10">{{ $routes[0]->scheduled_number.' - '.$routes[0]->scheduled_time }}</td>
            </tr>

                {{--  <tr>

            <td class="lt" colspan="3">Route</td>

                <td  class="lt" colspan="14">

                    @foreach($routes as $rout)

                        <label >{{$parisishthab->route_id == $rout->id?$rout->from_depot.' - '.$rout->to_depot:''}}</label>

                    @endforeach

                </td>

            </tr>  --}}

    				<!-- <td style="width:8%;">Date/<span class="abc">दिनांक</span></td>

					<td style="width:5%;">Kms/<span class="abc">सार्थ किमी</span></td>

    				<td style="width:5%;">Diesel Ltr/<span class="abc">पुरविलेले डिझेल (लिटर)</span></td>

    				<td style="width:6%;" >Diesel Rate/<span class="abc">डिझेल दर प्रति लिटर रू</td>

        			<td style="width:5%;" >Ad Blue</td>

					<td style="width:8%;">AdBlue Price</td>

					<td style="width:8%;">Break Down Charges/<span class="abc">वाहन बिघाड रक्कम</span></td>

					<td style="width:8%;">Vor. Exp/<span class="abc">मार्ग बंद वाहने वसुली</span></td>

					<td style="width:5%;">Parking Exp. /<span class="abc">पार्किंग वीज इ. रक्कम</span></td>

					<td style="width:8%;">Hotel Halt/<span class="abc">थांबा वसुली रक्कम</span></td>

                    <td style="width:5%;">Washing Charges</td>

					<td style="width:8%;">Other Exp./<span class="abc">इतर वसुली रक्कम</span><span class="required"></span></td>

                    <td style="width:13%;">VehicleNumber</td>

                    <td style="width:5%;">Idling Minutes</td>

					<td style="width:8%;">Remarks</td> -->

                    <tr>

                    	<td style="width:10%;">Date</td>

                        <td style="width:3%;font-size:12px;">Relevant Agreement</td>

                        <td style="width:3%;font-size:12px;">Schedule Complete</td>

					    <td style="width:5%;">Kms</td>

    				    <td style="width:5%;">Diesel Ltr</td>

    				    <td style="width:5%;" >Diesel Rate</td>

        			    <td style="width:4%;" >Ad Blue</td>

					    <td style="width:5%;">AdBlue Price</td>

					    <td style="width:8%;">Break Down Charges</td>

					    <td style="width:5%;">Vor. Exp</td>

					    <td style="width:8%;">Parking Exp.</td>

					    <td style="width:5%;">Hotel Halt</td>

                        <td style="width:5%;">Washing Charges</td>

					    <td style="width:5%;">Other Exp.</td>

                        <td style="width:12%;">VehicleNumber</td>

                        <td style="width:4%;font-size:12px;">Idling Minutes</td>

					    <td style="width:13%;">Remarks</td>

				    </tr>

			</thead>

            @php

                $date = explode(",",$parisishthab->date);

                $p_k = explode("*++*",$parisishthab->relevant_agreement);

                $schedule_complete = explode("*++*",$parisishthab->schedule_complete);

                $vehicleArr = explode("*++*",$parisishthab->vehicle_id);

    			$kms = explode(",",$parisishthab->kms);

    			$diesel_ltr = explode(",",$parisishthab->diesel_ltr);

    			$diese_per_ltr_price = explode(",",$parisishthab->diese_per_ltr_price);

    			$adblue = explode(",",$parisishthab->adblue);

    			$adblue_price = explode(",",$parisishthab->adblue_price);

    			$breaddown_charge = explode(",",$parisishthab->breaddown_charge);

    			$vor_exp = explode(",",$parisishthab->vor_exp);

    			$parking_exp = explode(",",$parisishthab->parking_exp);

    			$hault_tax = explode(",",$parisishthab->hault_tax);

                $wash_exp = explode(",",$parisishthab->wash_exp);

                $other_exp = explode(",",$parisishthab->other_exp);

                $idling_minutes = explode(",",$parisishthab->idling_minutes);

                $remarks = explode("*++*",$parisishthab->remarks);

                $breaddown_charge_value = explode("*++*",$parisishthab->breaddown_charge_value);

    		@endphp

            <tbody>

    		@for($i=0;$i<count($date);$i++)

                <tr class="parishishtha_b">

                    <td style="width:10%;">{{date("d-m-Y",strtotime($date[$i])) }}</td>

                    <td style="width:3%">{{$p_k[$i]==1?'Yes':''}}</td>

                    <td style="width:3%">{{$schedule_complete[$i]==1?'Yes':''}}</td>

                    <td style="width:5%;">{{$kms[$i]}}</td>



                    <td style="width:5%;">{{$diesel_ltr[$i]}}</td>

                    <td style="width:5%;">{{$diese_per_ltr_price[$i]}}</td>

                    <td style="width:4%;">{{$adblue[$i]}}</td>

                    <td style="width:5%;">{{$adblue_price[$i]}}</td>

                    <td style="width:8%;">{{$breaddown_charge[$i]}}</td>

                    <td style="width:5%;">{{$vor_exp[$i]}}</td>

                    <td style="width:8%;">{{$parking_exp[$i]}}</td>

                    <td style="width:5%;">{{$hault_tax[$i]}}</td>

                    <td style="width:5%;">{{ $wash_exp[$i] }}</td>

                    <td style="width:5%;">{{$other_exp[$i]}}</td>

                    <td style="width:12%;">{{ ($vehicleArr[$i] == 'noVehicle') ? 'No Vehicle' : $vehicle[$vehicleArr[$i]]}}</td>

                    <td style="width:4%;">{{$idling_minutes[$i]}}</td>

                    <td style="width:13%;">{{ $remarks[$i] }}</td>

                </tr>

            @endfor

            </tbody>

            <tfoot>

			    <tr>

                    <td  style="width:8%;">Total</td>
                    <td></td>
                    <td style="width:8%;"></td>
                    <td style="width:6%;">{{ array_sum(explode(",",$parisishthab->kms)) }}</td>

					<td style="width:7%;">{{ array_sum(explode(",",$parisishthab->diesel_ltr)) }}</td>

                    <td style="width:8%;"></td>

					<td style="width:8%;">{{array_sum($adblue)}}</td>


                    <td></td>



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

                    <td colspan="3">Total Filled Diesel</td>

                    <td colspan="5">Diesel as per norms</td>

                    <td colspan="6">Extra Diesel Filled</td>

			    </tr>

                <tr>

				    <td colspan="3">{{ array_sum(explode(",",$parisishthab->kms)) }}</td>

				    <td colspan="3">

                    <?php

                        $totalLtr = array_sum(explode(",",$parisishthab->diesel_ltr));

                        $totalMin = 0;

                        for($i=0;$i < count($idling_minutes); $i++){

                            $totalMin += ($idling_minutes[$i]*6)/100;

                        }

                        $totalLtr = $totalLtr-$totalMin;

                    ?>



                    {{ $totalLtr }}</td>

                    <td colspan="5">{{$parisishthab->diesel_as_per_gov}}</td>

				    <td colspan="6">  {{  number_format($parisishthab->extra_filled_diesel, 2, '.', '')}}</td>

			    </tr>

                <tr>

    			    <td colspan="13" style="text-align:right;">Extra Filled Diesel Charges</td>

				    <td colspan="4">{{  number_format($parisishthab->extra_diesel_charged, 2, '.', '')}}</td>

			    </tr>

			</tfoot>

		</table>



    </body>

</html>





