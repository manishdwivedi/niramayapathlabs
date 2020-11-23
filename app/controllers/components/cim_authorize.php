<?php 

/***************************************************

* File Component

*

* Manages uploaded files to be saved to the file system.

*

*/

class CimAuthorizeComponent extends Object{
	
		
		var $g_apihost = "apitest.authorize.net";
		var $g_apipath = "/xml/v1/request.api";
			//function to send xml request to Api.
			
	//There is more than one way to send https requests in PHP.
	function send_xml_request($content)
	{
		global $g_apihost, $g_apipath;
		//echo $g_apihost;die;
		//echo $content;die;
		return $this->send_request_via_curl('apitest.authorize.net','/xml/v1/request.api',$content);
	}
	
	//function to send xml request via fsockopen
	//It is a good idea to check the http status code.
	function send_request_via_fsockopen($host,$path,$content)
	{
		$posturl = "ssl://" . $host;
		$header = "Host: $host\r\n";
		$header .= "User-Agent: PHP Script\r\n";
		$header .= "Content-Type: text/xml\r\n";
		$header .= "Content-Length: ".strlen($content)."\r\n";
		$header .= "Connection: close\r\n\r\n";
		$fp = fsockopen($posturl, 443, $errno, $errstr, 30);
		if (!$fp)
		{
			$body = false;
		}
		else
		{
			error_reporting(E_ERROR);
			fputs($fp, "POST $path  HTTP/1.1\r\n");
			fputs($fp, $header.$content);
			fwrite($fp, $out);
			$response = "";
			while (!feof($fp))
			{
				$response = $response . fgets($fp, 128);
			}
			fclose($fp);
			error_reporting(E_ALL ^ E_NOTICE);
			
			$len = strlen($response);
			$bodypos = strpos($response, "\r\n\r\n");
			if ($bodypos <= 0)
			{
				$bodypos = strpos($response, "\n\n");
			}
			while ($bodypos < $len && $response[$bodypos] != '<')
			{
				$bodypos++;
			}
			$body = substr($response, $bodypos);
		}
		return $body;
	}
	
	//function to send xml request via curl
	function send_request_via_curl($host,$path,$content)
	{
		//echo $host;
		$posturl = "https://" . $host . $path;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $posturl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		//print_r($content);
		//print_r($response);
		//echo "Gooddddddddddd";
		return $response;
	}
	
	
	//function to parse the api response
	//The code uses SimpleXML. http://us.php.net/manual/en/book.simplexml.php 
	//There are also other ways to parse xml in PHP depending on the version and what is installed.
	
		function parse_api_response($content)
		{
			$parsedresponse = simplexml_load_string($content);
			//echo "<pre>";print_r($parsedresponse);
			/*if ("Ok" != $parsedresponse->messages->resultCode) {
				//echo "The operation failed with the following errors:<br>";
				foreach ($parsedresponse->messages->message as $msg) {
					//echo "[" . htmlspecialchars($msg->code) . "] " . htmlspecialchars($msg->text) . "<br>";
					echo htmlspecialchars($msg->text) . "<br>";
				}
				//echo "<br>";
			}*/
			return $parsedresponse;
		}


	
	function MerchantAuthenticationBlock() {
		//global $g_loginname, $g_transactionkey;
		$g_loginname = "6kXdSZW65JtL"; // Keep this secure.
		$g_transactionkey = "2GJa8Xe33av372Lq"; // Keep this secure.
		return
			"<merchantAuthentication>".
			"<name>" . $g_loginname . "</name>".
			"<transactionKey>" . $g_transactionkey . "</transactionKey>".
			"</merchantAuthentication>";
	}
	
	
}

?>