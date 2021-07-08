<?php


defined('IN_DREAM') or exit('NO DICE!');



//GET DATA FROM DB
global $_LANG;
$rooms = 1;
$sPage = $rooms."room";

//FORCE featured apartment
$fulldescr_limit = 0;
$featured_code = 0;
$sContents = Dream::detailedDescrApartment ($featured_code);
$aContents = Dream::briefDescrApartment(false,$rooms,$fulldescr_limit,$featured_code);

if ($aContents[$rooms] !='' || isset($aContents[$rooms])){
	$sContents .= '<div class="sub_title">'.$_LANG['offer'].'</div>';
	$sContents .= $aContents[$rooms].'<br/>';
}

//form sub menu links
$aApartmentLinks 	= Dream::apartmentLinks($rooms);
$sLinksTopLine 		= $aApartmentLinks['top_line'];
$sLinksLeftMenu 	= $aApartmentLinks['left_menu'];

//booking form
$sBookingForm		= Dream::bookingForm();





$sObjectCode = '
    	<img src="{BASEURL}modules/media/header_ap'.$rooms.'.jpg">
';

$sJS = '
 	<script type="text/javascript" src="{BASEURL}modules/media/js/mb/mootools-1.2.3-core-yc.js"></script>
 	<script type="text/javascript" src="{BASEURL}modules/media/js/mb/mootools-1.2.3.1-assets.js"></script> 
	<script type="text/javascript" src="{BASEURL}modules/media/js/mb/milkbox-yc.js"></script> 
	<link rel="stylesheet" href="{BASEURL}modules/media/js/mb/milkbox.css" type="text/css" media="screen" />
';


//GENERATE THE PAGE

$oTpl = Dream::loadClass('Template');
$oTpl->insertContents(array(
	'{PAGE_CONTENTS}'		=> $sContents,
	'{PAGE_LinksTopLine}'	=> $sLinksTopLine,
	'<!-- PAGE_LinksLeftMenu'.$rooms.' -->'	=> $sLinksLeftMenu,
	'{BOOKING_FORM}'		=> $sBookingForm,

	'{OBJECT_CODE}'			=> $sObjectCode,

	'{HTMLPAGETITLE}'		=> Dream::getLang($sPage,'HTMLPAGETITLE'),
	'{HTMLMETADESCRIPTION}' => Dream::getLang($sPage,'HTMLMETADESCRIPTION'),
	'{HTMLMETAKEYWORDS}' 	=> Dream::getLang($sPage,'HTMLMETAKEYWORDS'),
	'{HTMLHEADER}' 			=> $sJS,

));

echo $oTpl->output();




?>