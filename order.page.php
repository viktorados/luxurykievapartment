<?php

defined('IN_DREAM') or exit('NO DICE!');

global $_CONF, $_LANG, $oUrl;
$sPage = "order"; 
$to_email 			= Dream::getparam('email');	// viktorstef@yahoo.com
$to_email_p 		= Dream::getparam('emailp');	// luxurykievapartment@gmail.com p
$to_email_backup 	= Dream::getparam('email_backup');	// viktorstef@yahoo.com



function ValidEmail($addr){
	if(substr_count($addr,"@")!=1)
		return false;
	list($local, $domain) = explode("@", $addr);
	
	$pattern_local = '%^([0-9a-z]*([-|_]?[0-9a-z]+)*)(([-|_]?)\.([-|_]?)[0-9a-z]*([-|_]?[0-9a-z]+)+)*([-|_]?)$%i';
	$pattern_domain = '%^([0-9a-z]+([-]?[0-9a-z]+)*)(([-]?)\.([-]?)[0-9a-z]*([-]?[0-9a-z]+)+)*\.[a-z]{2,4}$%i';

	$match_local = preg_match($pattern_local, $local);
	$match_domain = preg_match($pattern_domain, $domain);
	
	return ($match_local && $match_domain && gethostbyname($domain));
}



if ($_SERVER['REQUEST_METHOD']=="POST" && $_POST['v_services']==1){
	//FOR SERVICES SUBMITION
	$v_city_tour 		= $_POST['v_city_tour'];
	
	$v_info		 		= $_POST['v_info'];
	$v_info_first_name	= $_POST['v_info_first_name'];
	$v_info_email 		= $_POST['v_info_email'];
	
	$v_city_tour 		= $_POST['v_city_tour'];
	$v_street_photo 	= $_POST['v_street_photo'];
	$v_private_chef 	= $_POST['v_private_chef'];
	$v_food_delivery 	= $_POST['v_food_delivery'];
	$v_english_driver 	= $_POST['v_english_driver'];
	$v_limousine 		= $_POST['v_limousine'];
	$v_free_airport 	= $_POST['v_free_airport'];

	$body = 'The following services were ordered for "'. $v_info .'"
<br />
<br />SERVICES SUMMARY:
<br />1) Three hour Kiev city tour by car    => '.(($v_city_tour==1)?('YES'):('NO')).'
<br />2) Professional photo session          => '.(($v_street_photo==1)?('YES'):('NO')).'
<br />3) Private ChefPovar		             => '.(($v_private_chef==1)?('YES'):('NO')).'
<br />4) Food/Grocery delivery               => '.(($v_food_delivery==1)?('YES'):('NO')).'
<br />5) Private English speaking driver     => '.(($v_english_driver==1)?('YES'):('NO')).'
<br />6) Limousine service                   => '.(($v_limousine==1)?('YES'):('NO')).'
<br />7) Free airport pickup (>5nights)      => '.(($v_free_airport==1)?('YES'):('NO')).'
	';
	
	
	
//===== BEGIN EMAIL ======//

		// Import PHPMailer classes into the global namespace
		// These must be at the top of your script, not inside a function
		$_sBasePath = Dream::getParam('path');
		require $_sBasePath.'include/classes/phpmailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		
		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = $to_email;     						// SMTP username
		$mail->Password = $to_email_p;                           // SMTP password
		
		//Recipients
		sleep(5);
		$mail->ClearAllRecipients();
		$mail->setFrom($to_email, "Luxury Apartments");
		$mail->addReplyTo($v_info_email, $v_info_first_name); // Add a recipient
		$mail->addAddress($to_email);     					// Add a recipient
		$mail->addBCC($to_email_backup);              		 // Name is optional
	
		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = "Fwd: ".$v_info;
		$mail->Body    = $body;
		
		//send the message, check for errors
		if (!$mail->send()) {
			//error
			$sSendingResult = $_LANG['error_msg'];
			//echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			//success
			$sSendingResult = $_LANG['success_msg'];
			//Section 2: IMAP
			//Uncomment these to save your message in the 'Sent Mail' folder.
			#if (save_mail($mail)) {
			#    echo "Message saved!";
			#}
		}
//===== END EMAIL ======//
	
	
//	if (@mail("$to_email", "FW: ".$v_info, $body, "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nFrom: $v_info_first_name <$v_info_email>\r\n")){
		//success
//		$sSendingResult = $_LANG['success_msg'];
//	} else {
		//error
//		$sSendingResult = $_LANG['error_msg'];
//	}




} elseif ($_SERVER['REQUEST_METHOD']=="POST" && $_POST['v_services']!=1){
	//FOR BOOKING SUBMITION
	$secret 		= $_POST['s_secret'];
	
	$s_apartment 	= $_POST['s_apartment'];
	$s_from_date 	= $_POST['s_from_date'];
	$s_to_date 		= $_POST['s_to_date'];
	$s_count_man 	= $_POST['s_count_man'];
	$s_count_child 	= $_POST['s_count_child'];
	$s_time 		= $_POST['s_time'];
	$s_mr_ms 		= $_POST['s_mr_ms'];
	$s_first_name 	= $_POST['s_first_name'];
	$s_last_name 	= $_POST['s_last_name'];
	$s_country 		= $_POST['s_country'];
	$s_mobile_phone = $_POST['s_mobile_phone'];
	$s_email 		= $_POST['s_email'];
	$s_comments 	= $_POST['s_comments'];
    $s_pickup1 		= intval($_POST['s_pickup1']);
	$s_pickup2 		= intval($_POST['s_pickup2']);
	$s_excursions 	= intval($_POST['s_excursions']);
		
			// check for keyword cookie
			$sCookie = Dream::getParam('cookie');
			$s_search_keyword = '';
			if (isset($_COOKIE[$sCookie])) {
				$s_search_keyword = $_COOKIE[$sCookie];
			}

	if (!is_numeric($s_apartment)){exit("Page Error! Please contact us per email...");}


	//get price
	if (!isset($oDb)){ $oDb = Dream::loadClass('Database'); }
	$sTblDatabase 		= Dream::getParam('tbl','database');
	$sTblDatabaseLang 	= Dream::getParam('tbl','database_lang');

	//get from database
	$aItem = array();
	$aItems = $oDb->getRows("SELECT *
		FROM ".$sTblDatabase." d
		INNER JOIN ".$sTblDatabaseLang." l ON d.code = l.code
		WHERE d.code = '".$s_apartment."'
		LIMIT 1"
	);
	foreach($aItems as $sItem)
	{
		$sCode 			= $sItem['code'];
		$sRooms 		= $sItem['rooms'];
		$sName 			= $sItem['name'];
		$sNameUrl		= $sItem['url'];
		$sAddress		= $sItem['address'];
		$sPrice 		= $sItem['price'];
		$sPriceUAH		= $sItem['priceuah'];
		$nPopular 		= $sItem['popular'];
	}

	$s_nights 			= (strtotime($s_to_date)-strtotime($s_from_date))/(60*60*24);
	$s_total_price  	= $sPrice*$s_nights;
	$s_total_price_UAH  = $sPriceUAH*$s_nights;
	if ($s_nights==1){$plural='';}else{$plural='s';}
	
	$site_email = Dream::getparam('from_email'); // info@apartments.com
	
	$from_ip	= $_SERVER['REMOTE_ADDR'];
	
	
	$body = 'Apartment #'.$s_apartment.' "'. $sName .' Apartment" on '.$sAddress.'
<br />Details: <a href="'.$_CONF['url'].$sNameUrl.'/">'.$_CONF['url'].$sNameUrl.'/</a>
<br />From: '.$s_from_date.'
<br />To: '.$s_to_date.'
<br />Price per night: '.$sPrice.' USD ('.$sPriceUAH.' UAH)
<br />Nights: '.$s_nights.' night'.$plural.'
<br />Total price for apartment for '.$s_nights.' night'.$plural.': '.$s_total_price.' USD ('.$s_total_price_UAH.' UAH)
<br />
<br />Arrival time: '.$s_time.':00 
<br />Nr of Adults: '.$s_count_man.' + '.$s_count_child.'
<br />Name: '.(($s_mr_ms==1)?('Mr'):('Ms')).' '.$s_first_name.' '.$s_last_name.'
<br />Country: '.$s_country.'
<br />
<br />Mobile: '.$s_mobile_phone.'
<br />Email: '.$s_email.'
<br />
<br />Comments: '.$s_comments.'
<br />
<br />Ordered additional services:
<br />1) Meet in Boryspil 			=> '.(($s_pickup1==1)?('YES'):('NO')).'
<br />2) Meet at train or bus station => '.(($s_pickup2==1)?('YES'):('NO')).'
<br />3) Order a guided tour 			=> '.(($s_excursions==1)?('YES'):('NO')).'
<br />
<br />Search Keyword: '.$s_search_keyword.' 
<br />Language: '.$oUrl->_sLanguage.' 
<br />IP Address: '.$from_ip.' 
'.$_CONF['email_signature'];


	$body_instructions = ( ($s_mr_ms==1)?($_LANG['dear_mr']):($_LANG['dear_ms']) ) . $s_first_name . $_LANG['body_instructions_p2'].'
<br /><br />	
<br />===========================
<br />	
YOUR BOOKING SUMMARY:
<br />
<br />Apartment: #'.$s_apartment.' "'. $sName .' Apartment" on '.$sAddress.'
<br />Details: <a href="'.$_CONF['url'].$sNameUrl.'/">'.$_CONF['url'].$sNameUrl.'/</a>
<br />From: '.$s_from_date.'
<br />To: '.$s_to_date.'
<br />Price per night: '.$sPrice.' USD ('.$sPriceUAH.' UAH)
<br />Nights: '.$s_nights.' night'.$plural.'
<br />Total price for apartment for '.$s_nights.' night'.$plural.': '.$s_total_price.' USD ('.$s_total_price_UAH.' UAH)
<br />
<br />Arrival time: '.$s_time.':00 
<br />Nr of Adults: '.$s_count_man.' + '.$s_count_child.'
<br />Name: '.(($s_mr_ms==1)?('Mr'):('Ms')).' '.$s_first_name.' '.$s_last_name.'
<br />Country: '.$s_country.'
<br />
<br />Phone: '.$s_phone.'
<br />Mobile: '.$s_mobile_phone.'
<br />Email: '.$s_email.'
'.$_CONF['email_signature'];

	$aBot_Check = explode(".",$s_from_date);

	$errs="";	
	if ($secret != '')
		$errs.="&nbsp;&bull;&nbsp;Bot error! If you are not a bot, please contact the site administration at ".$site_email."<br />\n";
	if (!is_numeric($aBot_Check[0]))
		$errs.="&nbsp;&bull;&nbsp;Bot error! If you are not a bot, please contact the site administration at ".$site_email."<br>\n";
	if ($s_pickup1==1 && $s_pickup2==1)
		$errs.="&nbsp;&bull;&nbsp;Bot error! If you are not a bot, please contact the site administration at ".$site_email."<br>\n";
	if (!$s_first_name)
		$errs.="&nbsp;&bull;&nbsp;No first name specified<br />\n";
	if (!$s_last_name)
		$errs.="&nbsp;&bull;&nbsp;No last name specified<br />\n";
	if (!$s_mobile_phone)
		$errs.="&nbsp;&bull;&nbsp;No mobile phone number specified<br />\n";
	if (!$s_country)
		$errs.="&nbsp;&bull;&nbsp;No country specified<br />\n";
	if (strpos($s_country, 'http') !== false || strpos($s_country, '.ru') !== false)
		$errs.="&nbsp;&bull;&nbsp;Bot error! If you are not a bot, please contact the site administration at ".$site_email."<br>\n";
	if (!$s_email)
		$errs.="&nbsp;&bull;&nbsp;No email specified<br />\n";
	elseif (!ValidEmail($s_email))
		$errs.="&nbsp;&bull;&nbsp;The e-mail address \"$s_email\" is not valid<br />\n";
	if ($errs)
		$sSendingResult = "Could not send your message because of the following error(s):<br /><br />\n
		$errs
		";
	else {
		
	

//===== BEGIN EMAIL ======//

		// Import PHPMailer classes into the global namespace
		// These must be at the top of your script, not inside a function
		$_sBasePath = Dream::getParam('path');
		require $_sBasePath.'include/classes/phpmailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;
		$mail->CharSet = 'UTF-8';
		$mail->isSMTP();
		
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		
		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = $to_email;     						// SMTP username
		$mail->Password = $to_email_p;                           // SMTP password
		
		//Recipients
		sleep(5);
		$mail->ClearAllRecipients();
		$mail->setFrom($to_email, "Luxury Apartments");
		$mail->addReplyTo($s_email, $s_first_name); 		// Add a recipient
		$mail->addAddress($to_email, "Luxury Apartments"); 	// Add a recipient
		$mail->addBCC($to_email_backup);              		 // Name is optional
	
		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = "LA: ". $sName ." Apartment, ".$s_from_date."-".$s_to_date.", " . $s_first_name . ' ' . $s_last_name;
		$mail->Body    = $body;
		
		//send the message, check for errors
		if ($mail->send()) {
			//success
			//send confirmation
			//Recipients
			sleep(5);
			$mail->ClearAllRecipients();
			$mail->setFrom($site_email, "Luxury Apartments");
			$mail->addAddress($s_email);     					// Add a recipient
			$mail->addBCC($to_email_backup);              		 // Name is optional
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $_LANG['your_order']."Luxury Apartments: ". $sName ." Apartment, ".$s_from_date."-".$s_to_date;
			$mail->Body    = $body_instructions;
			$mail->send();

//===== END EMAIL ======//
//		if (
//			@mail("$to_email", "LA: ". $sName ." Apartment, ".$s_from_date."-".$s_to_date.", " . $s_first_name . ' ' . $s_last_name, $body, "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nFrom: $s_first_name <$s_email>\r\nBcc: $to_email\r\n")
//			){
			//send confirmation
//			mail("$s_email",$_LANG['your_order']."Luxury Apartments: ". $sName ." Apartment, ".$s_from_date."-".$s_to_date, $body_instructions, "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nFrom: Luxury Apartments <$site_email>\r\nBcc: $to_email_backup\r\n");




			// check for keyword cookie
			$sCookie = Dream::getParam('cookie');
			$s_search_keyword = '';
			if (isset($_COOKIE[$sCookie])) {
				$s_search_keyword = $_COOKIE[$sCookie];
			}






            //connect to db
			if (!isset($oDb)){ $oDb = Dream::loadClass('Database'); }
			$sTblApplications = Dream::getParam('tbl','orders');
			$sTblPopular = Dream::getParam('tbl','popular');
			//add to database
			$aResult = $oDb->insert($sTblApplications, array(
						'apartment'		=> $s_apartment,
						'from_date'		=> $s_from_date,
						'to_date'		=> $s_to_date,
						'night_price'	=> $sPrice,
						'nights'		=> $s_nights,
						'total_price'	=> $s_total_price,
						'count_man'		=> $s_count_man,
						'count_child'	=> $s_count_child,
						'arr_time'		=> $s_time,
						'mr_ms'			=> $s_mr_ms,
						'first_name'	=> $s_first_name,
						'last_name'		=> $s_last_name,
						'country'		=> $s_country,
						'mobile_phone'	=> $s_mobile_phone,
						'email'			=> $s_email,
						'comments'		=> $s_comments,
						'pickup1'		=> $s_pickup1,
						'pickup2'		=> $s_pickup2,
						'excursions'	=> $s_excursions,
						'time' 			=> time(),
						'ip' 			=> $from_ip,
						'search_keyword'=> $s_search_keyword,
						'language'		=> $oUrl->_sLanguage,
						'crm'			=> "0",
						'status'		=> "0",
						));
			if (!$aResult) {exit($_LANG['error_mysql']);}
			//add counter to database
			// update counter
			$nPopular = $nPopular + 1; 
			//add new
			$aResult = $oDb->update($sTblPopular, array('popular' => $nPopular), "code = '". $s_apartment ."'");
			if (!$aResult) {exit($_LANG['error_mysql']);}







			/**  
			 * TurboSMS
			 */
			//DATABASE TurboSMS
			$_CONF['db']['hostTurbo'] 	= '94.249.xxx.xxx';
			$_CONF['db']['userTurbo'] 	= 'vixxxxxx';
			$_CONF['db']['passTurbo'] 	= 'FD?xxxxxx';
			$_CONF['db']['nameTurbo'] 	= 'users';	 
			$_CONF['tbl']['sms'] 		= 'vikxxxxxx';
			$_CONF['TurboSMSPhone'] 	= '380xxxxxxx'; // Ivan 380631484015
		 
			$hLinkTurboSMS = mysqli_connect(Dream::getParam('db','hostTurbo'), Dream::getParam('db','userTurbo'), Dream::getParam('db','passTurbo'), Dream::getParam('db','nameTurbo'));
				//if (!$hLinkTurboSMS){ exit ('Unable to connect to TurboSMS database'); }
            if (!$hLinkTurboSMS){
                echo ('Unable to connect and select TurboSMS database');
            } else {
                mysqli_query($hLinkTurboSMS, "SET NAMES utf8");

                $sTblSms = $_CONF['tbl']['sms'];
                $sSMSMessage = $sName.' '.$sPrice.'$: '.$s_from_date.'-'.$s_to_date.'. '.$s_first_name.' '.$s_mobile_phone.'. Free?';

                //add to database
                $TurboSMSquery = "INSERT INTO `".$sTblSms."` (number,sign,message) VALUES ('".$_CONF['TurboSMSPhone']."', 'LuxuryApts', '".$sSMSMessage."')";
                $aResult = mysqli_query($hLinkTurboSMS, $TurboSMSquery);
                if (!$aResult) {exit('Error_mysql');}
                //add to database 2nd phone
                //	$TurboSMSquery = "INSERT INTO `".$sTblSms."` (number,sign,message) VALUES ('".$_CONF['TurboSMSPhone2']."', 'LuxuryApts', '".$sSMSMessage."')";
                //	$aResult = mysql_query($TurboSMSquery,$hLinkTurboSMS);
                //	if (!$aResult) {exit('Error_mysql');}
                //print_r($aResult);

                //CLOSE CONNECTION
                mysqli_close($hLinkTurboSMS);
            }








			//$sSendingResult = $_LANG['success_msg'];

			$v_info = '
			    <input type="hidden" name="v_info" value="LA: '. $sName .' Apartment, '.$s_from_date.'-'.$s_to_date.', ' . $s_first_name . ' ' . $s_last_name . '">
        		<input type="hidden" name="v_info_first_name" value="'.$s_first_name.'">
        		<input type="hidden" name="v_info_email" value="'.$s_email.'">';
			$sSendingResult = str_replace('<!-- INFO_STRING -->', $v_info, ((Dream::getParam('mobile') == true)?($_LANG['services_form_m']):($_LANG['services_form'])) );
			
		}else{
			$sSendingResult = $_LANG['error_msg'];
		}
	}
}



$sObjectCode = '
    	<img src="{BASEURL}modules/media/header_4.jpg">
';



//GENERATE THE PAGE

$oTpl = Dream::loadClass('Template');
$oTpl->insertContents(array(

	'{SENDING_RESULT}'		=> $sSendingResult,
	
	'{OBJECT_CODE}'			=> $sObjectCode,

	'{HTMLPAGETITLE}'		=> Dream::getLang($sPage,'HTMLPAGETITLE'),
	'{HTMLMETADESCRIPTION}' => Dream::getLang($sPage,'HTMLMETADESCRIPTION'),
	'{HTMLMETAKEYWORDS}' 	=> Dream::getLang($sPage,'HTMLMETAKEYWORDS'),
	'{HTMLHEADER}' 			=> '',

));

echo $oTpl->output();





?>
