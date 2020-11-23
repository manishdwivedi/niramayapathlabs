<?php  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "/var/www/html/vendor/autoload.php"; 

class DevController extends AppController
{
	var $name = "Dev";
	var $breadcrumb = array();
	var $uses=array();
	
	function index()
	{
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->setFrom('info@niramayapathlabs.com', 'NirAmaya PathLabs');
		$mail->addAddress('nk@itcombine.com', $lab_info['Lab']['pcc_name']);
		$mail->Username = 'AKIAJQO367UVOHAOKLTA';
		$mail->Password = 'AiikEB5AYOsA2lPSqP8z8UISPkq4f4EJuEpJiy9foODK';
		$mail->Host = 'email-smtp.us-west-2.amazonaws.com';
		$mail->Subject = "Partial Report of ".$req_info['Health']['name'].' MRN-'.$req_info['Health']['reference'];
		$mail->addAttachment('report_mail.pdf','report.pdf');
		$mail->Body = "<table width='600' border='0' cellspacing='0' cellpadding='0' align='left'>
							<tr>
								<td>
									Dear ".$lab_info['Lab']['pcc_name']."
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									Bill Date: ".date('d M Y',strtotime($health_data['Health']['s_date'])).' T'.date('H:i:s',strtotime($health_data['Health']['s_date']))."
								</td>
							</tr>
							<tr>
								<td>
									Bill Number: ";
									$mail->Body .= 'NPL'.!empty($health_data['Health']['ref_num'])?$health_data['Health']['ref_num'] : $order_id;
									$mail->Body .="
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
							<td>
								Completed Tests:
								<ul style='list-style:none; margin:0px; padding:0px;'>";
								 
									$pending_test_count = 0;
									foreach($test_status as $key=>$value)
									{
										if($value['reporting_status'] == 1)
										{
											$mail->Body .= "<li style='margin:0px;'>*".$value['test_name']."</li>";
										}
										else
										{
											$pending_test_count++;
										}
									}
								$mail->Body .="
								</ul>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>";
								if($pending_test_count == 0){
								$mail->Body .= "No Pending Tests.";
								} else {
								$mail->Body .= "Pending Tests: 
								<ul style='list-style:none; margin:0px; padding:0px;'>";
								
									foreach($test_status as $key=>$value)
									{
										if($value['reporting_status'] == 0)
										{
											$mail->Body .= "<li style='margin:0px;'>*".$value['test_name']."</li>";
										}
									}
								
								$mail->Body .= "</ul>";
								 }
							$mail->Body .= "</td>
						</tr>
						<tr>
							<td>
								&nbsp;
							</td>
						</tr>
						
						<tr>
							<td>
								Thank you for choosing NirAmaya PathLabs. 
								<br/>
								<br/>
								"; 
								if(!empty($health_data['Health']['partial_reason']) && $email_stage =='partial'){
									$mail->Body .= "Note:- ".$health_data['Health']['partial_reason'];
								}
								
								$mail->Body .= "<br/>
								Please do not reply to this message. Replies to this message are routed to an unmonitored mailbox.
								<br/>
								kindly write back to helpline@niramayapathlabs.com or You may also call us at +91-7042191851
								<br/><br/>
								Best Regards,
								<br/>
								Lab Director
								<br/>
								Niramaya Pathlabs
							</td>
						</tr>
					</table>
						";

		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->isHTML(true);

		/*$mail->AltBody = "Email Test\r\nThis email was sent through the 
			Amazon SES SMTP interface using the PHPMailer class.";
		*/
		if(!$mail->send()) {
			echo "Email not sent. " , $mail->ErrorInfo , PHP_EOL;
		} else {
			echo "Email sent!" , PHP_EOL;
		}


		$this->render(false);
	}

		
}
?>
