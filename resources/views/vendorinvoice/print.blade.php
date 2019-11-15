@php error_reporting(0);
function number_to_words ($x)
	{
		 $nwords = array(  "", "One", "Two", "Three", "Four", "Five", "Six",
				  "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
				  "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen",
				  "Nineteen", "Twenty", 30 => "Thirty", 40 => "Fourty",
						 50 => "Fifty", 60 => "Sixty", 70 => "Seventy", 80 => "Eigthy",
						 90 => "Ninety" );

		 if(!is_numeric($x))
		 {
			 $w = '#';
		 }else if(fmod($x, 1) != 0)
		 {
			 $w = '#';
		 }else{
			 if($x < 0)
			 {
				 $w = 'minus ';
				 $x = -$x;
			 }else{
				 $w = '';
			 }
			 if($x < 21)
			 {
				 $w .= $nwords[$x];
			 }else if($x < 100)
			 {
				 $w .= $nwords[10 * floor($x/10)];
				 $r = fmod($x, 10);
				 if($r > 0)
				 {
					 $w .= ' '. $nwords[$r];
				 }
			 } else if($x < 1000)
			 {

				 $w .= $nwords[floor($x/100)] .' Hundred';
				 $r = fmod($x, 100);
				 if($r > 0)
				 {
					 $w .= ' '. number_to_words($r);
				 }
			 } else if($x < 100000)
			 {
				$w .= number_to_words(floor($x/1000)) .' Thousand';
				 $r = fmod($x, 1000);
				 if($r > 0)
				 {
					 $w .= ' ';
					 if($r < 100)
					 {
						 $w .= ' ';
					 }
					 $w .= number_to_words($r);
				 }
			 } else {
				 $w .= number_to_words(floor($x/100000)) .' Lacs';
				 $r = fmod($x, 100000);
				 if($r > 0)
				 {
					 $w .= ' ';
					 if($r < 100)
					 {
						 $word .= ' ';
					 }
					 $w .= number_to_words($r);
				 }
			 }
		 }
		 return $w;

	}




	function number_to_words_decimal($num){
	$decones = array(
				'01' => "One",
				'02' => "Two",
				'03' => "Three",
				'04' => "Four",
				'05' => "Five",
				'06' => "Six",
				'07' => "Seven",
				'08' => "Eight",
				'09' => "Nine",
				10 => "Ten",
				11 => "Eleven",
				12 => "Twelve",
				13 => "Thirteen",
				14 => "Fourteen",
				15 => "Fifteen",
				16 => "Sixteen",
				17 => "Seventeen",
				18 => "Eighteen",
				19 => "Nineteen"
				);
	$ones = array(
				0 => " ",
				1 => "One",
				2 => "Two",
				3 => "Three",
				4 => "Four",
				5 => "Five",
				6 => "Six",
				7 => "Seven",
				8 => "Eight",
				9 => "Nine",
				10 => "Ten",
				11 => "Eleven",
				12 => "Twelve",
				13 => "Thirteen",
				14 => "Fourteen",
				15 => "Fifteen",
				16 => "Sixteen",
				17 => "Seventeen",
				18 => "Eighteen",
				19 => "Nineteen"
				);
	$tens = array(
				0 => "",
				2 => "Twenty",
				3 => "Thirty",
				4 => "Forty",
				5 => "Fifty",
				6 => "Sixty",
				7 => "Seventy",
				8 => "Eighty",
				9 => "Ninety"
				);
	$hundreds = array(
				"Hundred",
				"Thousand",
				"Million",
				"Billion",
				"Trillion",
				"Quadrillion"
				);
				//limit t quadrillion
	$num = number_format($num,2,".",",");
	$num_arr = explode(".",$num);
	$wholenum = $num_arr[0];
	$decnum = $num_arr[1];
	$whole_arr = array_reverse(explode(",",$wholenum));
	krsort($whole_arr);
	$rettxt = "";
	foreach($whole_arr as $key => $i){
		if($i < 20)
		{
			$rettxt .= $ones[$i];
		}
		elseif($i < 100)
		{
			$rettxt .= $tens[substr($i,0,1)];
			$rettxt .= " ".$ones[substr($i,1,1)];
		}
		else
		{
			$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
		   $rettxt .= " ".$tens[substr($i,1,1)];
			$rettxt .= " ".$ones[substr($i,2,1)];
		}
		if($key > 0)
		{
			$rettxt .= " ".$hundreds[$key]." ";
		}

	}
	//$rettxt = $rettxt." Rupees";

	if($decnum > 0)
	{
		$rettxt .= " and ";
		if($decnum < 20)
		{
			$rettxt .= $decones[$decnum];
		}
		elseif($decnum < 100)
		{
			$rettxt .= $tens[substr($decnum,0,1)];
			$rettxt .= " ".$ones[substr($decnum,1,1)];
		}
		$rettxt = $rettxt." Paise";
	}
	return $rettxt;
	}


	function decimal_to_words($x)
	{
		$x = str_replace(',','',$x);
		$pos = strpos((string)$x, ".");
		if ($pos !== false) { $decimalpart= substr($x, $pos+1, 3); $x = substr($x,0,$pos); }
		$tmp_str_rtn = number_to_words ($x);
		if(!empty($decimalpart))
			$tmp_str_rtn .= ' and '  . number_to_words_decimal ($decimalpart) . ' paise';
		return   $tmp_str_rtn;
	}

@endphp
<html>
    <head>
        <style>
            *{
                margin:0px;
                padding:0px;
            }
            .header-table{
                border-collapse: collapse;
            }
            .header-table tr{
                text-align:center;
            }
            .header-table tr td h2{
                font-size:40px;
                padding:20px 0px;
                color:green;
                border-bottom:2px solid #111;
            }
            .second-heading-desc{
                height:2px;
                margin-bottom:80px;
                display:block;
                border-bottom:2px solid #111;
            }
            .main-body-wrap{
                width:80%;
                margin:0 auto;
            }
            .small-font{
                font-size:12px;
            }
           .tbl{
               text-align:center;
           }
           .tbl tr th{
               padding:4px;
           }
		   @page{
				margin-top:200px !important;
			}
        </style>
    </head>
    <body>


         <div class="main-body-wrap">

                <!-- Part Of Declaration -->
                <table class="decl-table"  width="100%">
                        <tr>
                            <td><b class="small-font">INVOICE NO: </b>{{ $result['invoice_no'] }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:14px;"></td>
                            <td><b class="small-font">Date:{{ date("d-m-Y",strtotime($result['invoice_date'])) }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="small-font">TO,  -</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="small-font"><b>The Depot Manager,</b></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="small-font"><b>Maharashtra State Road Transport Corporation</b></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="padding:10px 0px;"></td>
                        </tr>
                        <tr class="small-font">
                            @php
                                $arrDate = explode(",",$result['billing_period']);
                            @endphp
                            <td colspan="5"><b>BILLING PERIOD:</b>  {{ date("d-m-Y",strtotime($arrDate[0])) }} To {{ date("d-m-Y",strtotime($arrDate[1])) }}</td>
                        </tr>
                        <tr class="small-font">
                            <td colspan="5"><b>DEPOT:</b> {{$depot}}</td>
                        </tr>
                        <tr class="small-font">
                            <td colspan="5"><b>DIVISON:</b> {{$divison}}</td>
                        </tr>
                        <tr class="small-font">
                            <td colspan="5"><b>VEH.NO:</b> {{$vehicleNo}}</td>
                        </tr>

                </table>
                <table width="100%" class="tbl" border="1" cellspacing="0">
                         <tr class="small-font">
                            <th width="14%">DATE</th>
                            <th width="30%">ROUTE</th>
                            <th width="10%">TOTAL KMS</th>
                            <th width="10%">RATE</th>
                            <th>TOTAL AMOUNT</th>
                            <th>REMARK</th>
                        </tr>

                        @php
                            $dateArr = explode("**++**",$result['date']);
                            $routeArr = explode("**++**",$result['route']);
							$vehicleArr = explode("**++**",$result['vehicle_id']);
                            $kmsArr = explode("**++**",$result['kms']);
                            $rateArr = explode("**++**",$result['rate']);
                            $amountArr = explode("**++**",$result['amount']);
                            $remarkArr = explode("**++**",$result['remark']);
                        @endphp
                        @for($i=0;$i<count($dateArr);$i++)
						@php
						$routeLen = strlen($routeArr[$i]);
						$vehicle = Helper::getVehicle($vehicleArr[$i]);
						@endphp
                            <tr>
                                <td>{{date("d-m-Y",strtotime($dateArr[$i]))}}</td>
                                <td @if($routeLen > '22') style="font-size:14px;" @endif>{{$routeArr[$i]}}</td>
                                <td>{{number_format((float)$kmsArr[$i],2, '.', '')}}</td>
                                <td>{{number_format((float)$rateArr[$i],2, '.', '')}}</td>
                                <td>{{number_format((float)$amountArr[$i],2, '.', '')}}</td>

                                <td>{{$remarkArr[$i]}}</td>
                            </tr>
                        @endfor
                        <tr>
                            <td style="padding:8px;"></td>
                            <td></td>
                            <td></td>
							<td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b class="small-font">Total</b></td>
                            <td>{{ number_format((float)array_sum($kmsArr),2, '.', '')}}</td>
                            <td></td>
                            <td>{{number_format((float)array_sum($amountArr),2, '.', '') }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b class="small-font">In Word</b></td>
                            <td colspan="5">{{ decimal_to_words(number_format((int)array_sum($amountArr),1, '.', '')) }}</td>
                        </tr>
                </table>

                <table  width="100%" style="margin-top:20px;">
		   			<tr>
		   				<td class="small-font"><b>PAN NO:</b> {{ $vendors['pan_no'] }}</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td class="small-font"><b>GST NO:</b> {{ $vendors['gst_no'] }}</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
		   				<td class="small-font"><b >BANK NAME: </b> {{ $vendors['bank_name'] }}</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
		   				<td class="small-font"><b>AC NUMBER:</b> {{ $vendors['account_no'] }}</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
		   				<td style="width:70%;" class="small-font"><b>IFSC CODE </b>{{ $vendors['ifsc_code'] }}</td>
						<td><b>Authorized Signature</b></td>
					</tr>

                </table>
        </div>
    </body>
</html>