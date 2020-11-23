<?php $servername = "52.35.2.63";
$username = "lotus_care";
$password = "9818442666";

$conn = mysql_connect($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
$excelData = [];
$selected = mysql_select_db("lotus_health",$conn) 
or die("Could not select examples");
$pccList = mysql_query("select id,pcc_name from labs where id='1'");

while($pcc = mysql_fetch_array($pccList))
{ 
	$pccData = mysql_query("SELECT id,discount_id,discount_amount, total_amount + discount_amount  as test_amount, total_amount as net_payable_amount, created_by FROM  `healths` WHERE created_by= ".$pcc['id']." and book_date >  '2017-11-01 00:00:00' AND book_date <  '2017-11-30 23:59:59' AND requ_status in ('5','6','7')");

	$no_of_request=0;
	$total_test_amount=0;
	$net_payable_amount=0;
	$no_of_test=0;
	$discount_amount = 0;
	$testing_amount = 0;
	if(mysql_num_rows($pccData)!=0)
	{
		while ($test = mysql_fetch_array($pccData)) 
		{ 
			$no_test = 0;
			$test_amount=0;
			$no_of_request++;
			$total_test_amount +=$test['test_amount'];
			$profit_conf = 0;
			$net_payable_amount += $test['net_payable_amount'];
			$testData = mysql_query("SELECT * FROM  `request_test` WHERE health_id ='".$test['id']."'");
			while($tests=mysql_fetch_array($testData))
			{
				$testResult='';
				$new_mrp = 0;
				$profit = mysql_query("SELECT * FROM  `profit_share_conf` WHERE lab_id ='".$pcc['id']."'");
				$percent = mysql_fetch_array($profit);
				
				if($tests['type']=='PA')
				{
					$testDetail = mysql_query("SELECT * FROM  `packages` WHERE id ='".$tests['test_id']."'");
					$testResult = mysql_fetch_array($testDetail);
					$new_mrp = ($testResult['package_mrp'] * $percent["bb_".$testResult['profit_margin_category']])/100;
echo $test['id']."----".$testResult['package_code']."-----".$test['test_amount']."--------".$new_mrp."<br>";
				}
				elseif($tests['type']=='OF')
				{
					$testDetail = mysql_query("SELECT * FROM  `banners` WHERE id ='".$tests['test_id']."'");
					$testResult = mysql_fetch_array($testDetail);
					$new_mrp = ($testResult['banner_mrp'] * $percent["bb_".$testResult['profit_margin_category']])/100;
echo $test['id']."----".$testResult['banner_code']."-----".$test['test_amount']."--------".$new_mrp."<br>";
				}
				else
				{
					$testDetail = mysql_query("SELECT * FROM  `tests` WHERE id ='".$tests['test_id']."'");
					$testResult = mysql_fetch_array($testDetail);
					$new_mrp = ($testResult['mrp'] * $percent["bb_".$testResult['profit_margin_category']])/100;
echo $test['id']."----".$testResult['testcode']."-----".$test['test_amount']."--------".$new_mrp."<br>";
				}

				$profit_conf += $new_mrp;
				$no_test++;

			}

			/*if($test['discount_id']!=0)
			{
				$discount = mysql_query("SELECT * FROM  `discounts` WHERE discount_id ='".$test['discount_id']."'");
				$discountType = mysql_fetch_array($discount);
				if($discountType['type'] == 'Percent')
				{
					$discount_amount = ($testResult['mrp'] * $discountType['amount'])/100;
				}
				else
				{
					$discount_amount = $discountType['amount'];
				}	
			}
			else
				$discount_amount = $test['discount_amount'];
			
			$totaldis = $profit_conf - $discount_amount;*/
// echo $test['id']."----".$test['test_amount']."--------".$profit_conf."----".$totaldis."<br>";
			$no_of_test += $no_test;
			$testing_amount += $profit_conf;
		}
		$excelData[$pcc['id']]['name'] = $pcc['pcc_name'];
		$excelData[$pcc['id']]['no_of_request'] = $no_of_request;
		$excelData[$pcc['id']]['no_of_test'] = $no_of_test;		
		$excelData[$pcc['id']]['total_test_amount'] = $total_test_amount;
		$excelData[$pcc['id']]['net_payable_amount'] = $net_payable_amount;
		$excelData[$pcc['id']]['net_testing_charges_billed'] = $total_test_amount - $testing_amount;
//		print_R($testing_amount);
print_R($excelData);
		die;
	}
}
//print_R($excelData);
$file = fopen('exceloutput.csv', 'w');
 
// save the column headers
fputcsv($file, array('Lab Name', 'No. of Request', 'No. of Test', 'Total Test Amount', 'Net Payable Amount','Net Testing Charges Billed'));
 

// save each row of the data
foreach ($excelData as $row)
{
    fputcsv($file, $row);
}
 
// Close the file
fclose($file);
