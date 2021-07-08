<?php


defined('IN_DREAM') or exit('NO DICE!');


/**
 * start
 */
 
global $oUrl, $_LANG, $_CONF;
$sPage = ''; 
$sMainKey = md5('luxury-kiev-apartmento'.date("d W Y m"));
$body_instructions = $_CONF['url']."price/key_$sMainKey/";
$to_email 			= Dream::getparam('email');	// luxurykievapartment@gmail.com
$to_email_p 		= Dream::getparam('emailp');	// luxurykievapartment@gmail.com p
$to_email_backup 	= Dream::getparam('email_backup');	// viktorstef@yahoo.com

//get language var
$sKey 			= $oUrl->_aParamsRequest['key'];
$nCode		 	= $_POST['id'];
$sPostPrice 	= $_POST['price'];
$sPostFXrate 	= $_POST['fxrate'];


//1. check for right password
if ($sKey != $sMainKey) {


//===== BEGIN EMAIL ======//

		// Import PHPMailer classes into the global namespace
		// These must be at the top of your script, not inside a function
		$_sBasePath = Dream::getParam('path');
		require $_sBasePath.'include/classes/phpmailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->CharSet = 'UTF-8';
		
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
		//$mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = $to_email;     						// SMTP username
		$mail->Password = $to_email_p;                           // SMTP password
		
		//Recipients
		$mail->setFrom($to_email, 'Luxury Kiev Apartments');
		$mail->addAddress($to_email);     					// Add a recipient
		$mail->addBCC($to_email_backup);              		 // Name is optional
	
		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Price Change Key';
		$mail->Body    = $body_instructions;
		$mail->AltBody = $body_instructions;
		
		//send the message, check for errors
		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "Message sent!";
			//Section 2: IMAP
			//Uncomment these to save your message in the 'Sent Mail' folder.
			#if (save_mail($mail)) {
			#    echo "Message saved!";
			#}
		}
//===== END EMAIL ======//


	//mail("$to_email","Price Change Key", $body_instructions, "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nFrom: Luxury Kiev Apartments <$to_email>\r\nBcc: $to_email_backup\r\n");
	exit;

}


//2. update data
$sUpdateResult = '';

if ( is_numeric($nCode) && is_numeric($sPostPrice) && is_numeric($sPostFXrate) && $nCode!='' && $sPostPrice!='' && $sPostFXrate!='') {

	$sUpdateResult = Dream::allPriceUpdate($nCode,$sPostPrice,$sPostFXrate);
	
	//clear cache
	$dir = './cache/';
    foreach(glob($dir.'*.*') as $file_to_delete){
		if ($file_to_delete != "./cache/index.html"){
			chmod($file_to_delete, 0666);
    		unlink($file_to_delete);
		}
    }
	

}//endif

//UPDATE FX RATE & ALL UAH PRICES
if ( ($nCode=="FXrate") && is_numeric($sPostFXrate) && $nCode!='' && $sPostFXrate!='') {

	$sUpdateResult = Dream::FXrateANDallPriceUpdate($sPostFXrate);
	
	//clear cache
	$dir = './cache/';
    foreach(glob($dir.'*.*') as $file_to_delete){
		if ($file_to_delete != "./cache/index.html"){
			chmod($file_to_delete, 0666);
    		unlink($file_to_delete);
		}
    }
	

}//endif




//3. output page contents
$aContents	= Dream::allPriceApartments();
$sFXrate    = $aContents[0];
$sContents  = $aContents[1];




echo '
<style type="text/css">
	body {font:normal 12px Arial, Helvetica, sans-serif;}
	h1 {font:bold 16px Arial, Helvetica, sans-serif;text-align:center;padding:20px;}
	.price_block {height:20px;clear:both}
	.price_block div.price_id {float:left;width:50px;}
	.price_block div.price_name {float:left;width:110px;}
	.price_block form input.price {width:70px;}
	.price_block form div.price_price {float:left;width:150px;}
	.price_block form div.price_priceuah {float:left;width:150px;}
	.price_block form input.submit {float:left;width:80px;}
	.fx_block {font:bold 14px Arial, Helvetica, sans-serif; height:20px;clear:both}
	.fx_block form {padding-left:100px;}
	.fx_block form input.price {width:70px;}
	.fx_block form div.fxrate {float:left;width:250px;}



</style>

<div style="width:550px;margin:0 auto;">

	<h1>Price Update Page</h1>
	
	<strong>'.$sUpdateResult.'</strong><hr>
	
    <div class="fx_block">
		<form name="input" action="" method="post">
			<div class="fxrate"><strong>>>>>> FX rate:</strong> <input type="text" class="price" name="fxrate" value="'.$sFXrate.'" /> UAH/USD</div>
			<input type="hidden" name="id" value="FXrate" />
			<input class="submit" type="submit" value="Submit" />  <strong><<<<<</strong>
		</form>
    </div>
	<hr>
	
	'.$sContents.'
	
	<hr>
	
</div>
';
exit;


















?>