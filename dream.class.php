<?php

defined('IN_DREAM') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: phpfox.class.php 305 2009-03-24 21:09:57Z Raymond_Benc $
 */

class Dream
{	

	private static $_aObject 	= array();

	public static $_aErrors		= array(); // array for post form errors



// ====================================================================== //
// ===============================  BASIC  ============================== //
// ====================================================================== //

    /**  Gets value of configuration parameter
     *
     * @static
     * @param string $sName parameter name
     * @param string $sKey  key for array values
     * @return mixed parameter value: string or array
     */

    public static function getParam($sName, $sKey = '')
    {
        global $_CONF;

        if (!$sKey)
        {
            return $_CONF[$sName];
        }

        return $_CONF[$sName][$sKey];

        trigger_error('Parameter with synonim "'.$sName.'" and key "'.$sKey.'" not found!', E_USER_ERROR);
    }
	
    /**  Gets value of language
     *
     * @static
     * @param string $sName parameter name
     * @param string $sKey  key for array values
     * @return mixed parameter value: string or array
     */

    public static function getLang($sName, $sKey = '')
    {
        global $_LANG;

        if (!$sKey)
        {
            return $_LANG[$sName];
        }

        return $_LANG[$sName][$sKey];

        trigger_error('Language parameter with synonim "'.$sName.'" and key "'.$sKey.'" not found!', E_USER_ERROR);
    }


    /** Save param in memory
     *
     * @param string $sName param name
     * @param mixed $mValue param value
     * @return boolean
     */

    public static function setParam($sName, $mValue)
    {
        global $_CONF;
        $_CONF[$sName] = $mValue;
        return true;
    }


    /** Load object class by name
     *
     * @static
     * @param string $sClass full class file name (without '.class.php' suffix)
     * @return bool true - class successfully load, false - otherwise
     */

    public static function &loadClass($sClass, $aParams = array())
    {
		$sHash = md5($sClass . serialize($aParams));

		if (isset(self::$_aObject[$sHash]))
		{
			return self::$_aObject[$sHash];
		}
		else
		{
            $sPath = PATH_INCLUDE . 'classes/' . strtolower($sClass) . '.class.php';
			if (file_exists($sPath))
			{
				require_once $sPath;
			} else {
				exit('Class file error!');
			}
        }

		if ($aParams)
		{
			self::$_aObject[$sHash] = new $sClass($aParams);
		}
		else 
		{		
			self::$_aObject[$sHash] = new $sClass();
		}

		return self::$_aObject[$sHash];
    }


    /** Load page module by name
     *
     * @static
     * @param string $sClass full class file name (without '.class.php' suffix)
     * @return bool true - class successfully load, false - otherwise
     */

    public static function &loadPage($sPageTplName)
    {
   	    $sPath = Dream::getparam('path') . 'modules/' . strtolower($sPageTplName) . '.page.php';
		if (file_exists($sPath))
		{
			require_once $sPath;
		} else {
			exit('Page file error!');
		}
    }



// ====================================================================== //
// ===============================  CACHE  ============================== //
// ====================================================================== //

    /** check for cached translation
     */

    public static function &outputCacheIfPresent ($sPageTplName, $sLang)
    {
		global $oUrl;
		if (Dream::getparam('nocache')){return true;} //skip cache
		if ($sPageTplName == "order"){return true;} //skip non-cached items
		$bIsMobile = Dream::getParam('mobile');
		
		//best.page.php case
		$aParamsRequest = $oUrl->_aParamsRequest;
		if (count($aParamsRequest) > 0){
			$sParamsRequest = implode("_", array_keys($aParamsRequest)) . '_merged_' . implode("_", array_values($aParamsRequest));
			$sParamsRequestHash = md5($sParamsRequest);
		} else {
			$sParamsRequestHash = '';
		}

		//check for mobile verion or desktop
		if ($bIsMobile == true){		
			$filename = PATH_BASE.'cache/'.$sLang.'_'.$sPageTplName.(($oUrl->_sPageApartmentName)?('_'.$oUrl->_sPageApartmentName):('')).$sParamsRequestHash.'_m.html';
		}else{
			$filename = PATH_BASE.'cache/'.$sLang.'_'.$sPageTplName.(($oUrl->_sPageApartmentName)?('_'.$oUrl->_sPageApartmentName):('')).$sParamsRequestHash.'.html';
		}

		if (file_exists($filename) && filesize($filename)>0 ){ //check if exists
			$handle = fopen($filename, "r");
			$sOutput = fread($handle, filesize($filename));
			fclose($handle);

			//refresh time
			$sOutput = preg_replace('/<!-- LOCAL_TIME1 -->(.*?)<!-- LOCAL_TIME2 -->/', '<!-- LOCAL_TIME1 -->'.date("H:i").'<!-- LOCAL_TIME2 -->', $sOutput);

			echo $sOutput; //output cached page
			
			exit;
		}
	}
	
    /** save cache
     */

    public static function &saveCache ($sPageTplName, $sLang, $sContents)
    {
		global $oUrl;
		if (Dream::getparam('nocache')){return true;} //skip cache
		if ($sPageTplName == "order"){return true;} //skip non-cached items
		$bIsMobile = Dream::getParam('mobile');
	
		//best.page.php case
		$aParamsRequest = $oUrl->_aParamsRequest;
		if (count($aParamsRequest) > 0){
			$sParamsRequest = implode("_", array_keys($aParamsRequest)) . '_merged_' . implode("_", array_values($aParamsRequest));
			$sParamsRequestHash = md5($sParamsRequest);
		} else {
			$sParamsRequestHash = '';
		}
	

		//check for mobile verion or desktop
		if ($bIsMobile == true){		
			$filename = PATH_BASE.'cache/'.$sLang.'_'.$sPageTplName.(($oUrl->_sPageApartmentName)?('_'.$oUrl->_sPageApartmentName):('')).$sParamsRequestHash.'_m.html';
		}else{
			$filename = PATH_BASE.'cache/'.$sLang.'_'.$sPageTplName.(($oUrl->_sPageApartmentName)?('_'.$oUrl->_sPageApartmentName):('')).$sParamsRequestHash.'.html';
		}
		
		//check if directory exists
		if (!is_dir(PATH_BASE.'cache/')){mkdir(PATH_BASE.'cache/',0755);}
		
		//save data
		$handle = fopen($filename, "w+");
		fwrite($handle, $sContents);
		fclose($handle);

	}



// ====================================================================== //
// ===============================  URL, BOX etc  ======================= //
// ====================================================================== //


    /** form milkbox images
     */

    public static function &formMilkbox ($nImageNum, $nRoomID, $sKeyword)
    {
        global $_CONF;

		$sMilkbox = '
							<script type="text/javascript">
								window.addEvent(\'domready\', function(){
									milkbox.setAutoPlay([
										{ gallery:\'ap'.$nRoomID.'\', autoplay:true, delay:7 },
									]);
								});		
							</script>
		';
		
		for ($i = 1; $i <= $nImageNum; $i++) {
			$sINum = (($i<10) ? ('0'.$i) : ($i));
			$sMilkbox .= '
                            <a href="'.$_CONF['mediafolder'].$nRoomID.'/'.$sINum.'.jpg" title="'.$sKeyword.'" rel="milkbox[ap'.$nRoomID.']">
                            	<img src="'.$_CONF['mediafolder'].$nRoomID.'/'.$sINum.'.jpg" style="padding-top:3px;" alt="'.$sKeyword.'" width="118">
                            </a>
			';
		}

		return $sMilkbox;
	}
	
	
    /** get close to apartments
     */

    public static function &closeTo ($sToken, $sCode, $sRooms)
    {
		global $_LANG, $_CONF, $oDb, $oUrl;
		if (!isset($oDb)){ $oDb = Dream::loadClass('Database'); }
		$sTblPopular 		= Dream::getParam('tbl','popular');
		$sTblDatabase 		= Dream::getParam('tbl','database');
		$sTblDatabaseLang 	= Dream::getParam('tbl','database_lang');

		//define the rooms
		$sRoomsCode = '';
		if ($sRooms == 1){$sRoomsCode = " AND rooms = 1";}
		if ($sRooms == 2){$sRoomsCode = " AND rooms = 2";}
		if ($sRooms == 3){$sRoomsCode = " AND rooms = 3";}
		if ($sRooms == 4){$sRoomsCode = " AND rooms = 4";}

		//get from database
		$aItem = array();
		$aItems = $oDb->getRows("SELECT *
			FROM ".$sTblPopular." p
			INNER JOIN ".$sTblDatabase." d ON p.code = d.code
			INNER JOIN ".$sTblDatabaseLang." l ON p.code = l.code
			WHERE d.closeto = '".$sToken."' AND d.code <> '".$sCode."'".$sRoomsCode." AND ".$_CONF['mysql_condition']."
			ORDER BY p.popular DESC LIMIT 7"
		);
		foreach($aItems as $sItem)
		{
			$sCode 			= $sItem['code'];
			$sRooms 		= $sItem['rooms'];
			$sName 			= $sItem['name'];
			$sNameUrl		= $sItem['url'];
			$sAddress		= $sItem['address'];
			$sPrice			= $sItem['price'];
			$sPriceUAH		= $sItem['priceuah'];
			$sLocation		= $sItem['location'];
			$sLocationDescr	= $sItem['location_descr'];

			$sPrice			= ($sPriceUAH=='0') ? ('$'.$sPrice.'') : ('<span class="newprice">$'.$sPrice.'</span> <span class="uahprice">('.$sPriceUAH.' '.$_LANG['uah_sign'].')</span>');

			$sApartmentUrl	= '<a href="'.Dream::getParam("url").$sNameUrl.'/">';

			//bedrooms issue
			if ($oUrl->_sLanguage == "en") { //for english version
				if ($sRooms==1) {
					$sRoomsText = $_LANG['studio_text'];
				} else {
					$sRoomsText = (($sRooms>2)?(($sRooms-1).' '.$_LANG['bedrooms_text']):(($sRooms-1).' '.$_LANG['bedroom_text']));
				}
			} else { //for other versiona
				$sRoomsText = (($sRooms>1)?($sRooms.' '.$_LANG['rooms_text']):($sRooms.' '.$_LANG['room_text']));
			}

			$sContents .= '
			'.$sApartmentUrl.'<b>'.$sName.' apartment</b> '.$_LANG['close_to_part1'].'</a>, '.$sRoomsText.', <strong>'.$sPrice.' '.$_LANG['per_night'].'</strong>, '.$_LANG['close_to_part2'].', '.$sAddress.' '.((Dream::getParam('mobile') == true)?('<br />'):('('.$sLocation.')')).'<br />
			';
		}

		return $sContents;
	}



// ====================================================================== //
// ===============================  CONTENT  ============================ //
// ====================================================================== //

    /** get links for xroom apartments
     */

    public static function &apartmentLinks ($sRooms)
    {
		global $_LANG, $_CONF, $oDb;
		if (!isset($oDb)){ $oDb = Dream::loadClass('Database'); }
		$sTblPopular 		= Dream::getParam('tbl','popular');
		$sTblDatabase 		= Dream::getParam('tbl','database');
		$sTblDatabaseLang 	= Dream::getParam('tbl','database_lang');

		$aUrls['top_line'] 	= '
		<div id="small_menu">
	        '.$_LANG[$sRooms.'room_text'].$_LANG['top_line'].'
		';
		$aUrls['left_menu'] 	= '
		<div style="padding:7px 0px 7px 7px; font-weight:bold;">
		';

		$aItem = array();
		$aItems = $oDb->getRows("SELECT *
			FROM ".$sTblPopular." p
			INNER JOIN ".$sTblDatabase." d ON p.code = d.code
			INNER JOIN ".$sTblDatabaseLang." l ON p.code = l.code
			WHERE d.rooms = '".$sRooms."' AND ".$_CONF['mysql_condition']."
			ORDER BY d.stars DESC"
		);
		foreach($aItems as $sItem)
		{
			$sCode 			= $sItem['code'];
			$sName 			= $sItem['name'];
			$sNameUrl		= $sItem['url'];

			$sApartmentUrl = Dream::getParam('url').$sNameUrl."/";
			
			$aUrls['top_line'] 	.= '<a href="'.$sApartmentUrl.'">'.$sName.' apartment</a>, ';

			$aUrls['left_menu'] .= '&raquo; <a href="'.$sApartmentUrl.'">'.$sName.' apartment</a><br> ';
		}
		$aUrls['top_line'] = substr($aUrls['top_line'], 0, -2); //strip the last coma
		$aUrls['top_line'] 	.= '
        </div>
		';
		$aUrls['left_menu'] 	.= '
        </div>
		';

		return $aUrls;
	}
	

    /** get apartment ID
     */

    public static function &apartmentIDByName ($sName)
    {
		global $oDb, $_CONF;
		//connect to db
		if (!isset($oDb)){$oDb = Dream::loadClass('Database');}
		$sTblDatabase 		= Dream::getParam('tbl','database');
		$sTblDatabaseLang 	= Dream::getParam('tbl','database_lang');
		$sContents = '';
		$aContents = array();
		
		//get from database
		$aItem = array();
		$aItems = $oDb->getRows("SELECT d.code, d.rooms, d.name, l.address, l.location
			FROM ".$sTblDatabase." d
			INNER JOIN ".$sTblDatabaseLang." l ON d.code = l.code
			WHERE d.url = '".strtolower($sName)."'
			LIMIT 1"
		);
		foreach($aItems as $sItem)
		{
			$sOutput ['code'] 		= $sItem['code'];
			$sOutput ['rooms'] 		= $sItem['rooms'];
			$sOutput ['name'] 		= $sItem['name'];
			$sOutput ['address'] 	= $sItem['address'];
			$sOutput ['location'] 	= $sItem['location'];
		}
		
		return $sOutput;
	}
	

    /** form stars
     */

    public static function &formStars ($nStars)
    {

		if ($nStars == 6) {$nStars = 5; $sPremium = true;} else {$sPremium = false;}
		//add gold stars
		for ($i = 1; $i <= $nStars; $i++) {
			$sCode .= ' <img src="{BASEURL}modules/media/star.gif" style="padding-bottom:3px;"> ';
		}
		//add blank stars
		if ($nStars < 5) {
			for ($i = ($nStars+1); $i <= 5; $i++) {
				$sCode .= ' <img src="{BASEURL}modules/media/star2.gif" style="padding-bottom:3px;"> ';
			}
		}
		//add crown
		if ($sPremium == true) {$sCode .= ' <img src="{BASEURL}modules/media/star3.gif" style="padding-bottom:3px;"> ';}

		return $sCode;
	}
	

    /** form stars small
     */

    public static function &formStarsSmall ($nStars)
    {

		if ($nStars == 6) {$nStars = 5; $sPremium = true;} else {$sPremium = false;}
		//add gold stars
		for ($i = 1; $i <= $nStars; $i++) {
			$sCode .= ' <img src="{BASEURL}modules/media/star.gif" height="8" style="padding-bottom:2px;"> ';
		}
		//add blank stars
		if ($nStars < 5) {
			for ($i = ($nStars+1); $i <= 5; $i++) {
				$sCode .= ' <img src="{BASEURL}modules/media/star2.gif" height="8" style="padding-bottom:2px;"> ';
			}
		}
		//add crown
		if ($sPremium == true) {$sCode .= ' <img src="{BASEURL}modules/media/star3.gif" height="12" style="padding-bottom:2px;"> ';}

		return $sCode;
	}
	
	
    /** get 3 best apartments
     */

    public static function &bestApartments ($limit = 3)
    {
		global $_LANG, $_CONF, $oDb, $oUrl;
		//connect to db
		if (!isset($oDb)){$oDb = Dream::loadClass('Database');}
		$sTblDatabase 		= Dream::getParam('tbl','database');
		$sTblDatabaseLang 	= Dream::getParam('tbl','database_lang');
		$sTblPopular 		= Dream::getParam('tbl','popular');
		$sContents = '';
		$aContents = array();
		
		//get from database
		$aItem = array();
		$aItems1 = $oDb->getRows("SELECT *
			FROM ".$sTblPopular." p
			INNER JOIN ".$sTblDatabase." d ON p.code = d.code
			INNER JOIN ".$sTblDatabaseLang." l ON p.code = l.code
			WHERE p.featured <> '0' AND ".$_CONF['mysql_condition']."
			ORDER BY p.featured DESC LIMIT 0,".$limit
		);
		$aItems2 = $oDb->getRows("SELECT *
			FROM ".$sTblPopular." p
			INNER JOIN ".$sTblDatabase." d ON p.code = d.code
			INNER JOIN ".$sTblDatabaseLang." l ON p.code = l.code
			WHERE p.featured = '0' AND ".$_CONF['mysql_condition']."
			ORDER BY p.popular DESC LIMIT 0,".$limit
		);
		$aItems = array_merge((array)$aItems1, (array)$aItems2);
		$c = 1;
		foreach($aItems as $sItem)
		{
			$sCode 			= $sItem['code'];
			$sRooms 		= $sItem['rooms'];
			$sStars 		= $sItem['stars'];
			$sName 			= $sItem['name'];
			$sNameUrl		= $sItem['url'];
			$sAddress		= $sItem['address'];
			$sLocation		= $sItem['location'];
			$sDistance		= $sItem['distance'];
			$sPlaces		= $sItem['places'];
			$sPrice			= $sItem['price'];
			$sPriceUAH		= $sItem['priceuah'];

			$sKeyword 		= $_LANG[$sRooms.'room_text'] . $_LANG['apartment_keyword'] . ' ' . $sAddress . ' ' . "(" . $sLocation . ")";
			$sApartmentUrlRaw = Dream::getParam("url").$sNameUrl.'/';
			
			$sPrice			= ($sPriceUAH=='0') ? ('<strong>'.$sPrice.' $</strong>') : ('<span class="newprice">'.$sPrice.' $</span> <span class="uahprice">('.$sPriceUAH.' '.$_LANG['uah_sign'].')</span>');


			//bedrooms issue
			if ($oUrl->_sLanguage == "en") { //for english version
				if ($sRooms==1) {
					$sRoomsText = $_LANG['studio_text'];
				} else {
					$sRoomsText = (($sRooms>2)?(($sRooms-1).' '.$_LANG['bedrooms_text']):(($sRooms-1).' '.$_LANG['bedroom_text']));
				}
			} else { //for other versiona
				$sRoomsText = (($sRooms>1)?($sRooms.' '.$_LANG['rooms_text']):($sRooms.' '.$_LANG['room_text']));
			}


            $aContents[] 	= '<a href="'.$sApartmentUrlRaw.'"><img alt=" '.$_LANG['alt_text'].' " title="'.$sKeyword.'" src="'.$_CONF['mediafolder'].$sCode.'/icon.jpg" height="130" /></a>
            
			<div style="margin-left:4px;">
			<a href="'.$sApartmentUrlRaw.'" title="'.$sKeyword.'"><strong>'.$sName.' apartment</strong></a><br />
			<em>'.$sDistance.'</em> <br />
			'.$sRoomsText.',
			'.$sPlaces.' '.(($sPlaces<5)?($_LANG['sleeping_places1']):($_LANG['sleeping_places2'])).' <br />
			<strong>'.$_LANG['price'].'</strong> '.$sPrice.'
			</div>
			';
		
		
		}
		
		return $aContents;
	}


    /** get booking form
     */

    public static function &bookingForm ($apartmentID = false, $from = false, $to = false, $adults = false, $kids = false)
    {
		global $_LANG, $_CONF, $oDb, $oUrl;
		//connect to db
		if (!isset($oDb)){$oDb = Dream::loadClass('Database');}
		$sTblDatabase 		= Dream::getParam('tbl','database');
		$sTblDatabaseLang 	= Dream::getParam('tbl','database_lang');
		
		//check for mobile or desktop version & select template
		if (Dream::getParam('mobile') == true){		
			$sBookingForm 		= $_LANG['booking_form_m']; //get booking form for mobile
		}else{
			$sBookingForm 		= $_LANG['booking_form']; //get booking form
		}
		
		$sContents 			= '';
		$aContents 			= array();
		
		//get from database
		$aItem = array();
		$sOptionsH = '';

		//if we have apartment id -> get only info for this ID
		if ($apartmentID!=false){ //CASE: one apartment
			//form code
			$sCodeOutput = str_replace('{OPTIONS_PLACE}', $_LANG['booking_form_options2'], $sBookingForm);
			//get only info for this ID
			$aItems = $oDb->getRows("SELECT *
				FROM ".$sTblDatabase." d
				INNER JOIN ".$sTblDatabaseLang." l ON d.code = l.code
				WHERE d.code = '".$apartmentID."'
				LIMIT 1"
			);
			foreach($aItems as $sItem)
			{
				$sCode 			= $sItem['code'];
				$sRooms 		= $sItem['rooms'];
				$sName 			= $sItem['name'];
				$sAddress		= $sItem['address'];
				$sPrice			= $sItem['price'];
				
				//bedrooms issue
				if ($oUrl->_sLanguage == "en") { //for english version
					if ($sRooms==1) {
						$sRoomsText = $_LANG['studio_text'];
					} else {
						$sRoomsText = (($sRooms>2)?(($sRooms-1).' '.$_LANG['bedrooms_text']):(($sRooms-1).' '.$_LANG['bedroom_text']));
					}
				} else { //for other versiona
					$sRoomsText = $sRooms.' '.$_LANG['booking_form_room'];
				}
	
				$sOptions		='<option value="'.$sCode.'" selected="selected">'.$sName.', '.$sRoomsText.', $'.$sPrice.', '.$sAddress.'</option>'; //pass dummy
				$sOptionsH 		= '<input  type="hidden" value="'.$sCode.'" name="s_apartment" />'; //pass real value

			}
		} else { //CASE: all apartments
			//form code
			$sCodeOutput = str_replace('{OPTIONS_PLACE}', $_LANG['booking_form_options1'], $sBookingForm);
			//get info for all apartments
			$aItems = $oDb->getRows("SELECT *
				FROM ".$sTblDatabase." d
				INNER JOIN ".$sTblDatabaseLang." l ON d.code = l.code
				WHERE ".$_CONF['mysql_condition']."
				ORDER BY d.name ASC"
			);
			foreach($aItems as $sItem)
			{
				$sCode 			= $sItem['code'];
				$sRooms 		= $sItem['rooms'];
				$sName 			= $sItem['name'];
				$sAddress		= $sItem['address'];
				$sPrice			= $sItem['price'];
				
				//bedrooms issue
				if ($oUrl->_sLanguage == "en") { //for english version
					if ($sRooms==1) {
						$sRoomsText = $_LANG['studio_text'];
					} else {
						$sRoomsText = (($sRooms>2)?(($sRooms-1).' '.$_LANG['bedrooms_text']):(($sRooms-1).' '.$_LANG['bedroom_text']));
					}
				} else { //for other versiona
					$sRoomsText = $sRooms.' '.$_LANG['booking_form_room'];
				}
	
				$sOptions		.='<option value="'.$sCode.'">'.$sName.', '.$sRoomsText.', $'.$sPrice.', '.$sAddress.'</option>';
			}
		}//endif
		
		//options
		$sCodeOutput = str_replace('{OPTIONS}', $sOptions, $sCodeOutput);
		$sCodeOutput = str_replace('{HIDDEN}', $sOptionsH, $sCodeOutput);
		
		//from & to
		if ($from!=false && $to!=false){
			$sCodeOutput = str_replace('{FROM_DATE}', $from, $sCodeOutput);
			$sCodeOutput = str_replace('{TO_DATE}', $to, $sCodeOutput);
		}
		
		//adults
		$sAdultsCode = '';
		for ($i = 1; $i <= 10; $i++) {
			if ($adults!=false && $adults==$i){
				$sAdultsCode .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
			} else {
				$sAdultsCode .= '<option value="'.$i.'">'.$i.'</option>';
			}
		}
		$sCodeOutput = str_replace('{ADULTS}', $sAdultsCode, $sCodeOutput);
		
		//kids
		$sKidsCode = '';
		for ($i = 1; $i <= 6; $i++) {
			if ($kids!=false && $kids==$i){
				$sKidsCode .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
			} else {
				$sKidsCode .= '<option value="'.$i.'">'.$i.'</option>';
			}
		}
		$sCodeOutput = str_replace('{KIDS}', $sKidsCode, $sCodeOutput);
		
		
		return $sCodeOutput;
	}


    /** get booking form small
     */

    public static function &bookingFormSmall ()
    {
		global $_LANG, $_CONF, $oDb, $oUrl;
		//connect to db
		if (!isset($oDb)){$oDb = Dream::loadClass('Database');}
		$sTblDatabase 		= Dream::getParam('tbl','database');
		$sTblDatabaseLang 	= Dream::getParam('tbl','database_lang');
		$sContents 			= '';
		$aContents 			= array();
		
		//get from database
		$aItem = array();
		$aItems = $oDb->getRows("SELECT *
			FROM ".$sTblDatabase." d
			INNER JOIN ".$sTblDatabaseLang." l ON d.code = l.code
			WHERE ".$_CONF['mysql_condition']."
			ORDER BY d.name ASC"
		);
		foreach($aItems as $sItem)
		{
			$sCode 			= $sItem['code'];
			$sRooms 		= $sItem['rooms'];
			$sName 			= $sItem['name'];
			$sAddress		= $sItem['address'];
			$sPrice			= $sItem['price'];
				
			//bedrooms issue
			if ($oUrl->_sLanguage == "en") { //for english version
				if ($sRooms==1) {
					$sRoomsText = $_LANG['studio_text'];
				} else {
					$sRoomsText = (($sRooms>2)?(($sRooms-1).' '.$_LANG['bedrooms_text']):(($sRooms-1).' '.$_LANG['bedroom_text']));
				}
			} else { //for other versiona
				$sRoomsText = $sRooms.' '.$_LANG['booking_form_room'];
			}
	
			$sOptions		.='<option value="'.$sCode.'">'.$sName.', '.$sRoomsText.', $'.$sPrice.', '.$sAddress.'</option>';
		}
		
		return $sOptions;
	}
	

    /** get prepay form
     */

    public static function &prepayForm ()
    {
		global $_LANG, $_CONF, $oDb;
		//connect to db
		if (!isset($oDb)){$oDb = Dream::loadClass('Database');}
		$sTblPopular 		= Dream::getParam('tbl','popular');
		$sTblDatabase 		= Dream::getParam('tbl','database');
		$sTblDatabaseLang 	= Dream::getParam('tbl','database_lang');

		//get from database
		$aItem = array();
		$aItems = $oDb->getRows("SELECT *
			FROM ".$sTblPopular." p
			INNER JOIN ".$sTblDatabase." d ON p.code = d.code
			INNER JOIN ".$sTblDatabaseLang." l ON p.code = l.code
			WHERE ".$_CONF['mysql_condition']."
			ORDER BY d.name ASC"
		);
		foreach($aItems as $sItem)
		{
			$sCode 			= $sItem['code'];
			$sRooms 		= $sItem['rooms'];
			$sName 			= $sItem['name'];
			$sAddress		= $sItem['address'];
			$sPrice			= $sItem['price'];
			
			$sOptions		.='<option value="'.$sPrice.'">'.$sName.', '.$sRooms.' '.$_LANG['booking_form_room'].', $'.$sPrice.', '.$sAddress.'</option>';
		}
		
		//get main form contents
		//check for mobile or desktop version & select template
		if (Dream::getParam('mobile') == true){		
			$sCode = $_LANG['prepay_form_m']; //get prepay form for mobile
		}else{
			$sCode = $_LANG['prepay_form']; //get prepay form
		}

		$sCode = str_replace('{PREPAY_FORM_OPTIONS}', $sOptions, $sCode);
		
		return $sCode;
	}


    /** get brief descr of apartments
	$sCode = rooms numer or true (with bAll=true)
     */

    public static function &briefDescrApartment ($bAll = true, $sCode = true, $nLimit = 0, $bExclude = false)
    {
		global $_LANG, $_CONF, $oDb;

		//connect to db
		if (!isset($oDb)){$oDb = Dream::loadClass('Database');}
		$sTblPopular 		= Dream::getParam('tbl','popular');
		$sTblDatabase 		= Dream::getParam('tbl','database');
		$sTblDatabaseLang 	= Dream::getParam('tbl','database_lang');

		$sContents = '';
		$aContents = array();

		if ($bExclude) {
			$sExclude = " AND d.code <> '".$bExclude."'";
		} else {
			$sExclude = "";
		}
		
		//get from database
		$aItem = array();
		if ($bAll) {
			$aItems = $oDb->getRows("SELECT *
				FROM ".$sTblPopular." p
				INNER JOIN ".$sTblDatabase." d ON p.code = d.code
				INNER JOIN ".$sTblDatabaseLang." l ON p.code = l.code
				WHERE ".$_CONF['mysql_condition']."
				ORDER BY p.popular DESC, d.stars DESC"
			);
		}else{
			$aItems = $oDb->getRows("SELECT *
				FROM ".$sTblPopular." p
				INNER JOIN ".$sTblDatabase." d ON p.code = d.code
				INNER JOIN ".$sTblDatabaseLang." l ON p.code = l.code
				WHERE d.rooms = ".$sCode.$sExclude." AND ".$_CONF['mysql_condition']."
				ORDER BY p.popular DESC, d.stars DESC"
			);
		}
		foreach($aItems as $sItem)
		{
			$sCode 			= $sItem['code'];
			$sRooms 		= $sItem['rooms'];
			$sBath 			= $sItem['bath'];
			$sStars 		= $sItem['stars'];
			$sName 			= $sItem['name'];
			$sNameUrl		= $sItem['url'];
			$sAddress		= $sItem['address'];
			$sLocation		= $sItem['location'];
			$sDistance		= $sItem['distance'];
			$sPlaces		= $sItem['places'];
			$sPrice			= $sItem['price'];
			$sPriceUAH		= $sItem['priceuah'];
			$sDescr_Short 	= $sItem['descr_short'];
			$sSpecial 		= str_replace('conditioner', 'air conditioner', $sItem['special']);
			
			$sPrice			= ($sPriceUAH=='0') ? ('$'.$sPrice.'') : ('<span class="newprice">$'.$sPrice.'</span> <span class="uahprice">('.$sPriceUAH.' '.$_LANG['uah_sign'].')</span>');

			$sKeyword 		= $_LANG[$sRooms.'room_text'] . $_LANG['apartment_keyword'] . ' ' . $sAddress . ' ' . "(" . $sLocation . ")";
			$sSpecialCode	= (($sSpecial!='') ? ('<span><strong>!'.$sSpecial.'!</strong></span>') : (''));
			$sApartmentUrlRaw = Dream::getParam("url").$sNameUrl.'/';
			$sApartmentUrl	= '<a href="'.$sApartmentUrlRaw.'" target="_blank" title="'.$sName.' apartment..." style="text-decoration:none;">';
		
			$sDescr_Short 	= str_replace("[APARTMENT_URL]", $sApartmentUrl, $sDescr_Short);
		
			$sContents = '
					<div>
					   <table cellpadding="4" cellspacing="0">
						  <tbody>
							 <tr>
								<td valign="top" width="250">
		
									<p class="clear">
									<a href="'.$sApartmentUrlRaw.'" target="_blank" title="'.$sKeyword.'">
									<img src="'.$_CONF['mediafolder'].$sCode.'/icon.jpg" alt="'.$sKeyword.'" title="'.$sName.' apartment..." width="250">
									</a>
									</p>
		
								'.((Dream::getParam('mobile') == true)?(''):('</td>
								<td valign="top">')).'
								
									<p class="clear">
									<a href="'.$sApartmentUrlRaw.'" target="_blank" title="'.$sName.' apartment..." class="sub_title">#'.$sCode.' '.$sName.' apartment</a> &nbsp;&nbsp;'.Dream::formStars($sStars).'
									<br /><em>'.$sDistance.'</em>
									</p>
									
									<p class="clear">
									'.$sDescr_Short.'
									<br>
									'.$sPlaces.' '.(($sPlaces<5)?($_LANG['sleeping_places1']):($_LANG['sleeping_places2'])).' - '.$sBath.' '.(($sBath==1)?($_LANG['bath']):($_LANG['baths'])).'<br>'.$_LANG['price'].': <strong><span style="font-size:18px;">'.$sPrice .'</span> '.$_LANG['per_night'].'</strong><br />
									'.$sSpecialCode .'
									<a href="'.$sApartmentUrlRaw.'" target="_blank" title="'.$sName.' apartment...">'.$_LANG['details'].'...</a>
									</p>
		
								</td>
							 </tr>
						  </tbody>
					   </table>
					</div>
		';
		
		//assign to right room class
		$aContents[$sRooms] = $aContents[$sRooms].$sContents;
		
		}
		return $aContents;
	}


    /** get brief descr of apartments
	$sCode = rooms numer or true (with bAll=true)
     */

    public static function &briefDescrApartmentSearch ($bAll = true, $aParamsRequest = false)
    {
		global $_LANG, $_CONF, $oUrl, $oDb;

		//connect to db
		if (!isset($oDb)){$oDb = Dream::loadClass('Database');}
		$sTblPopular 		= Dream::getParam('tbl','popular');
		$sTblDatabase 		= Dream::getParam('tbl','database');
		$sTblDatabaseLang 	= Dream::getParam('tbl','database_lang');

		$sContents = '';
		$aContents = array();

		//set default replacements	
			$aCHECKED_Replace['{rl_CHECKED}'] ='';
			$aCHECKED_Replace['{r2_CHECKED}'] ='';
			$aCHECKED_Replace['{r3_CHECKED}'] ='';
			$aCHECKED_Replace['{r4_CHECKED}'] ='';
			$aCHECKED_Replace['{s4_CHECKED}'] ='';
			$aCHECKED_Replace['{s5_CHECKED}'] ='';
			$aCHECKED_Replace['{s6_CHECKED}'] ='';
			$aCHECKED_Replace['{spc_CHECKED}'] ='';
			$aCHECKED_Replace['{spp_CHECKED}'] ='';
			$aCHECKED_Replace['{sph_CHECKED}'] ='';
			$aCHECKED_Replace['{spk_CHECKED}'] ='';
			$aCHECKED_Replace['{spj_CHECKED}'] ='';
			$aCHECKED_Replace['{spt_CHECKED}'] ='';
			$aCHECKED_Replace['{sps_CHECKED}'] ='';
			$aCHECKED_Replace['{mk_CHECKED}'] ='';
			$aCHECKED_Replace['{mm_CHECKED}'] ='';
			$aCHECKED_Replace['{ma_CHECKED}'] ='';
			$aCHECKED_Replace['{nu_NUMBER}'] ='';
			$aCHECKED_Replace['{pt_VALUE}'] ='';
			$aCHECKED_Replace['{pf_VALUE}'] ='';
			$aCHECKED_Replace['{p1_SELECTED}'] ='';
			$aCHECKED_Replace['{p2_SELECTED}'] ='';
			$aCHECKED_Replace['{p3_SELECTED}'] ='';
			$aCHECKED_Replace['{p4_SELECTED}'] ='';
			$aCHECKED_Replace['{p5_SELECTED}'] ='';
			$aCHECKED_Replace['{p6_SELECTED}'] ='';
			$aCHECKED_Replace['{p7_SELECTED}'] ='';
			$aCHECKED_Replace['{p8_SELECTED}'] ='';

		//if parameters are received
		if (is_array($aParamsRequest) && $aParamsRequest != false) {
			//re-assign params
			$sRooms1 	= $aParamsRequest['r1'];
			$sRooms2 	= $aParamsRequest['r2'];
			$sRooms3 	= $aParamsRequest['r3'];
			$sRooms4 	= $aParamsRequest['r4'];
			
			$sStars4 	= $aParamsRequest['s4'];
			$sStars5 	= $aParamsRequest['s5'];
			$sStars6 	= $aParamsRequest['s6'];
			
			$sPlaces 	= $aParamsRequest['p'];
			
			$sPriceTo	= $aParamsRequest['pt'];
			$sPriceFrom	= $aParamsRequest['pf'];
			
			$sSpecial_c = $aParamsRequest['spc'];
			$sSpecial_p = $aParamsRequest['spp'];
			$sSpecial_h = $aParamsRequest['sph'];
			$sSpecial_k = $aParamsRequest['spk'];
			$sSpecial_j = $aParamsRequest['spj'];
			$sSpecial_t = $aParamsRequest['spt'];
			$sSpecial_s = $aParamsRequest['sps'];

			$sMetro_k 	= $aParamsRequest['mk'];
			$sMetro_m 	= $aParamsRequest['mm'];
			$sMetro_a 	= $aParamsRequest['ma'];

			$sCodeSearch= $aParamsRequest['aptid'];

			//process params
			$sParams = '';
			$aParams = array();

			//=========== ROOMS =========== 
			if ($sRooms1 == 1) {$aRooms[] = "rooms = '1'"; $aCHECKED_Replace['{rl_CHECKED}'] =' checked';}
			if ($sRooms2 == 1) {$aRooms[] = "rooms = '2'"; $aCHECKED_Replace['{r2_CHECKED}'] =' checked';}
			if ($sRooms3 == 1) {$aRooms[] = "rooms = '3'"; $aCHECKED_Replace['{r3_CHECKED}'] =' checked';}
			if ($sRooms4 == 1) {$aRooms[] = "rooms = '4'"; $aCHECKED_Replace['{r4_CHECKED}'] =' checked';}

			//build search by number query
			if (count($sCodeSearch) >0) {
				$sParams = '';
				$sParams = "d.code = '".$sCodeSearch."'";
				$aParams[] = $sParams; 
				$aCHECKED_Replace['{nu_NUMBER}'] = $sCodeSearch;
				$sParams = '';
			}
			
			//build OR query
			if (count($aRooms) >0) {
				$sParams = '';
				foreach($aRooms as $aRoom)
				{
					$sParams .= $aRoom . ' OR ';
				}
				$aParams[] = substr($sParams, 0, strlen($sParams)-4); 
				$sParams = '';
			}
			
			//=========== STARS =========== 
			if ($sStars4 == 1) {$aStars[] = "stars <= '4'"; $aCHECKED_Replace['{s4_CHECKED}'] =' checked';}
			if ($sStars5 == 1) {$aStars[] = "stars >= '5'"; $aCHECKED_Replace['{s5_CHECKED}'] =' checked';}
			if ($sStars6 == 1) {$aStars[] = "stars = '6'"; $aCHECKED_Replace['{s6_CHECKED}'] =' checked';}
			//build OR query
			if (count($aStars) >0) {
				$sParams = '';
				foreach($aStars as $aStar)
				{
					$sParams .= $aStar . ' OR ';
				}
				$aParams[] = substr($sParams, 0, strlen($sParams)-4); 
				$sParams = '';
			}

			//=========== PLACES =========== 
			if ($sPlaces != false && is_numeric($sPlaces)) {
				$aParams[] = "places >= '".$sPlaces."'"; 
				$aCHECKED_Replace['{p1_SELECTED}'] = '';
				$aCHECKED_Replace['{p'.$sPlaces.'_SELECTED}'] = ' selected="selected"';
			} else {
				$aCHECKED_Replace['{p1_SELECTED}'] = ' selected="selected"';
			}


			//=========== PRICE =========== 
			if ($sPriceTo != false && is_numeric($sPriceTo)) {$aParams[] = "price <= '".$sPriceTo."'"; $aCHECKED_Replace['{pt_VALUE}'] = $sPriceTo;}
			if ($sPriceFrom != false && is_numeric($sPriceFrom)) {$aParams[] = "price >= '".$sPriceFrom."'"; $aCHECKED_Replace['{pf_VALUE}'] = $sPriceFrom;}


			//=========== SPECIAL =========== 
			if ($sSpecial_c == 1) {$aSpecials[] = "special LIKE '%".$_LANG['item_cond']."%'"; $aCHECKED_Replace['{spc_CHECKED}'] =' checked';}
			if ($sSpecial_p == 1) {$aSpecials[] = "special LIKE '%".$_LANG['item_pla']."%'"; $aCHECKED_Replace['{spp_CHECKED}'] =' checked';}
			if ($sSpecial_h == 1) {$aSpecials[] = "special LIKE '%".$_LANG['item_hid']."%'"; $aCHECKED_Replace['{sph_CHECKED}'] =' checked';}
			if ($sSpecial_k == 1) {$aSpecials[] = "special LIKE '%".$_LANG['item_kam']."%'"; $aCHECKED_Replace['{spk_CHECKED}'] =' checked';}
			if ($sSpecial_j == 1) {$aSpecials[] = "special LIKE '%".$_LANG['item_jak']."%'"; $aCHECKED_Replace['{spj_CHECKED}'] =' checked';}
			if ($sSpecial_t == 1) {$aSpecials[] = "special LIKE '%".$_LANG['item_ter']."%'"; $aCHECKED_Replace['{spt_CHECKED}'] =' checked';}
			if ($sSpecial_s == 1) {$aSpecials[] = "special LIKE '%".$_LANG['item_sau']."%'"; $aCHECKED_Replace['{sps_CHECKED}'] =' checked';}
			//build OR query
			if (count($aSpecials) >0) {
				$sParams = '';
				foreach($aSpecials as $aSpecial)
				{
					$sParams .= $aSpecial . ' OR ';
				}
				$aParams[] = substr($sParams, 0, strlen($sParams)-4); 
				$sParams = '';
			}

			//=========== METRO =========== 
			if ($sMetro_k == 1) {$aMetros[] = "area LIKE '%".$_LANG['item_kre']."%'"; $aCHECKED_Replace['{mk_CHECKED}'] =' checked';}
			if ($sMetro_m == 1) {$aMetros[] = "area LIKE '%".$_LANG['item_maj']."%'"; $aCHECKED_Replace['{mm_CHECKED}'] =' checked';}
			if ($sMetro_a == 1) {$aMetros[] = "area LIKE '%".$_LANG['item_are']."%'"; $aCHECKED_Replace['{ma_CHECKED}'] =' checked';}
			//build OR query
			if (count($aMetros) >0) {
				$sParams = '';
				foreach($aMetros as $aMetro)
				{
					$sParams .= $aMetro . ' OR ';
				}
				$aParams[] = substr($sParams, 0, strlen($sParams)-4); 
				$sParams = '';
			}

			//build WHERE query
			foreach($aParams as $sParam)
			{
				$sParams .= '('.$sParam . ') AND ';
			}
			//cut off last ' AND '
			$sParams = substr($sParams, 0, strlen($sParams)-5);
		} 

		//get from database
		$aItem = array();
		if ($sParams == ''){$bAll=true;}
		if ($bAll) {
			$aItems = $oDb->getRows("SELECT *
				FROM ".$sTblPopular." p
				INNER JOIN ".$sTblDatabase." d ON p.code = d.code
				INNER JOIN ".$sTblDatabaseLang." l ON p.code = l.code
				WHERE ".$_CONF['mysql_condition']."
				ORDER BY d.stars DESC"
			);
		}else{
			$aItems = $oDb->getRows("SELECT *
				FROM ".$sTblPopular." p
				INNER JOIN ".$sTblDatabase." d ON p.code = d.code
				INNER JOIN ".$sTblDatabaseLang." l ON p.code = l.code
				WHERE ".$sParams." AND ".$_CONF['mysql_condition']."
				ORDER BY d.stars DESC"
			);
		}
		foreach($aItems as $sItem)
		{
			$sCode 			= $sItem['code'];
			$sRooms 		= $sItem['rooms'];
			$sBath 			= $sItem['bath'];
			$sStars 		= $sItem['stars'];
			$sName 			= $sItem['name'];
			$sNameUrl		= $sItem['url'];
			$sAddress		= $sItem['address'];
			$sLocation		= $sItem['location'];
			$sDistance		= $sItem['distance'];
			$sPlaces		= $sItem['places'];
			$sPrice			= $sItem['price'];
			$sPriceUAH		= $sItem['priceuah'];
			$sDescr_Short 	= $sItem['descr_short'];
			$sSpecial 		= str_replace('conditioner', 'air conditioner', $sItem['special']);
			
			$sPrice			= ($sPriceUAH=='0') ? ('$'.$sPrice.'') : ('<span class="newprice">'.$sPrice.'</span> <span class="uahprice">('.$sPriceUAH.' '.$_LANG['uah_sign'].')</span>');
			$sKeyword 		= $_LANG[$sRooms.'room_text'] . $_LANG['apartment_keyword'] . ' ' . $sAddress . ' ' ;
			
			$sSpecialCode	= (($sSpecial!='') ? ('<span><strong>!'.$sSpecial.'!</strong></span>') : (''));
			$sApartmentUrlRaw = Dream::getParam("url").$sNameUrl.'/';
			$sApartmentUrl	= '<a href="'.$sApartmentUrlRaw.'" target="_blank" title="'.$sName.' apartment..." style="text-decoration:none;">';
		
			$sDescr_Short 	= str_replace("[APARTMENT_URL]", $sApartmentUrl, $sDescr_Short);
		
			$sContents = '
					<div>
					   <table cellpadding="4" cellspacing="0">
						  <tbody>
							 <tr>
								<td valign="top" width="250">
		
									<p class="clear">
									<a href="'.$sApartmentUrlRaw.'" target="_blank" title="'.$sKeyword.'">
									<img src="'.$_CONF['mediafolder'].$sCode.'/icon.jpg" alt="'.$sKeyword.'" title="'.$sName.' apartment..." width="250">
									</a>
									</p>
		
								'.((Dream::getParam('mobile') == true)?(''):('</td>
								<td valign="top">')).'
								
									<p class="clear">
									<a href="'.$sApartmentUrlRaw.'" target="_blank" title="'.$sName.' apartment..." class="sub_title">#'.$sCode.' '.$sName.' apartment</a> &nbsp;&nbsp;'.Dream::formStars($sStars).'
									<br /><em>'.$sDistance.'</em>
									</p>
									
									<p class="clear">
									'.$sDescr_Short.'
									</p>
		
									<p class="clear">
									'.$sPlaces.' '.(($sPlaces<5)?($_LANG['sleeping_places1']):($_LANG['sleeping_places2'])).' - '.$sBath.' '.(($sBath==1)?($_LANG['bath']):($_LANG['baths'])).' - '.$_LANG['price'].': <strong><span style="font-size:18px;">'.$sPrice .'</span> '.$_LANG['per_night'].'</strong><br />
									'.$sSpecialCode .'
									<a href="'.$sApartmentUrlRaw.'" target="_blank" title="'.$sName.' apartment...">'.$_LANG['details'].'...</a>
									</p>
		
								</td>
							 </tr>
						  </tbody>
					   </table>
					</div>
		';
		
		//assign to right room class
		$aContents[$sRooms] = $aContents[$sRooms].$sContents;
		
		}
		
		
		//PARSE SEARCH FORM
		//check for mobile or desktop version
		if (Dream::getParam('mobile') == true){		
			$aContents['search_form'] = $_LANG['search_form_m'];
		}else{
			$aContents['search_form'] = $_LANG['search_form'];
		}

		
		//proceed with replacement of place holders
			$aCHECKED_Replace['{STARS_4}'] = self::formStars(4);
			$aCHECKED_Replace['{STARS_5}'] = self::formStars(5);
			$aCHECKED_Replace['{STARS_6}'] = self::formStars(6);
		$aContents['search_form'] = str_replace(array_keys($aCHECKED_Replace), array_values($aCHECKED_Replace), $aContents['search_form']);
		
		return $aContents;
	}



    /** get detaled descr of apartments
	$sCode = apartment code or rooms number (with bMultiple=true)
     */

    public static function &detailedDescrApartment ($sCode, $bMultiple = false, $nLimit = 3)
    {
		global $_LANG, $_CONF, $oUrl, $oDb;
		if ($sCode==0){return false;}
		
		//connect to db
		if (!isset($oDb)){$oDb = Dream::loadClass('Database');}
		$sTblPopular 		= Dream::getParam('tbl','popular');
		$sTblDatabase 		= Dream::getParam('tbl','database');
		$sTblDatabaseLang 	= Dream::getParam('tbl','database_lang');
		$sContents 			= '';
		$aContents 			= array();
		$sLang 				= $oUrl->_sLanguage;
		$bIsMobile 			= Dream::getParam('mobile');
		
		$sGMapCode = '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;language='.$sLang.'&amp;key=AIzaSyCWnM5RDigTFKqQK9TJVkFOdPm4fztjQcI"></script>
		
		<script type="text/javascript">
			window.onload = loadGmap;
			
			function loadGmap(){
		';


		//get from database
		$aItem = array();
		if ($bMultiple) {
			$aItems = $oDb->getRows("SELECT *
				FROM ".$sTblPopular." p
				INNER JOIN ".$sTblDatabase." d ON p.code = d.code
				INNER JOIN ".$sTblDatabaseLang." l ON p.code = l.code
				WHERE d.rooms = ".$sCode." AND ".$_CONF['mysql_condition']."
				ORDER BY d.stars DESC
				LIMIT 0,".$nLimit
			);
		}elseif ($sCode != ''){
			$aItems = $oDb->getRows("SELECT *
				FROM ".$sTblPopular." p
				INNER JOIN ".$sTblDatabase." d ON p.code = d.code
				INNER JOIN ".$sTblDatabaseLang." l ON p.code = l.code
				WHERE d.code = ".$sCode." AND ".$_CONF['mysql_condition']."
				ORDER BY d.stars DESC"
			);
		}
		foreach($aItems as $sItem)
		{
			$sCode 			= $sItem['code'];
			$sRooms 		= $sItem['rooms'];
			$sBath 			= $sItem['bath'];
			$sStars 		= $sItem['stars'];
			$sName 			= $sItem['name'];
			$sNameUrl		= $sItem['url'];
			$sAddress		= $sItem['address'];
			$sLocation		= $sItem['location'];
			$sLocationCoord	= $sItem['location_coord'];
			$sLocationDescr	= $sItem['location_descr'];
			$sDistance		= $sItem['distance'];
			$sPlaces		= $sItem['places'];
			$sPrice			= $sItem['price'];
			$sPriceUAH		= $sItem['priceuah'];
			$sDescr_Short 	= $sItem['descr_short'];
			$nImageNum 		= $sItem['images'];
			$sDescr_Full 	= $sItem['descr_full'];
			$sCloseTo 		= $sItem['closeto'];
			$sKeyword 		= $_LANG[$sRooms.'room_text'] . $_LANG['apartment_keyword'] . ' ' . $sAddress . ' ' . "(" . $sLocation . ")";
			$sSpecial 		= str_replace('conditioner', 'air conditioner', $sItem['special']);

			$sPrice			= ($sPriceUAH=='0') ? (''.$sPrice.' $') : ('<span class="newprice">'.$sPrice.' $</span> <span class="uahprice">('.$sPriceUAH.' '.$_LANG['uah_sign'].')</span>');
		
			$sMilkboxCode 	= Dream::formMilkbox ($nImageNum, $sCode, $sKeyword);
			$sCloseToCode	= Dream::closeTo ($sCloseTo, $sCode, $sRooms);
			$sSpecialCode	= (($sSpecial!='') ? ('<span style="font-size:18px;"><img src="{BASEURL}modules/media/star3.gif" style="padding-bottom:3px;"> '.$sSpecial.' <img src="{BASEURL}modules/media/star3.gif" style="padding-bottom:3px;"></span>') : (''));
		
			$sPrice_Msg = '
					<span style="font-size:18px;">'.$_LANG['price_per_night'].' <span style="font-size:38px;">'.$sPrice.'</span></span><br />
			';
		
		
		$sContents .= '
					<div style="margin-top: 0px; margin-bottom: 15px; font-size: 24px; font-weight: bold; text-align: center;">
						<a name="start" id="start"></a>#'.$sCode.'
											  
						<h1 style="margin-top: 0px; margin-bottom: 15px; display: inline;">'.$_LANG[$sRooms.'room_text'].$_LANG['apartment_title'].'<br />
						<u><a href="'.Dream::getParam("url").$sNameUrl.'/" title="'.$sName.' apartment...">'.$sName.' apartment</a></u>
						</h1>
						
						<br />
						'.Dream::formStars($sStars).'
					</div>
		
					<h3 id="menu_clear" style="text-align:center;">
						'.$sAddress.'<br />
						<span style="font-size:12px;">'.$sLocation.'</span><br />
						'.$sSpecialCode.'
					</h3>
		
					<div style="padding-bottom:20px;">
					   <table cellpadding="4" cellspacing="0">
						  <tbody>
							 <tr>
								<td valign="top" colspan="2" style="text-align:center;">
		
								   <p class="clear">
									'.$sMilkboxCode.'
								   </p>
		
								</td>
							 </tr>
							 <tr>
								<td valign="top" colspan="2">
								
									<div style="padding-left:20px;">
										<b>
		'.$sPrice_Msg.'
										</b>
									</div>
									<div style="padding-left:20px;">
										<b>
		<em>'.$sDistance.'</em>
										</b>
									</div>
									<p>
		'.$sDescr_Full.'
		'.( $sLang=="ru" ? ($_LANG['russian_bedrooms_remark'].( (($sRooms-1)==0)?("1"):($sRooms-1) ).".") : ('') ).'
									</p>
									<p>
									<strong>'.$_LANG['rent_act1'].'</strong> <a href="#book" style="color:#663300; font-weight:bold;">'.$_LANG['rent_act2'].'</a>
									</p>
								</td>
							 </tr>
							 <tr>
								<td valign="top">
								
									<p class="clear">
										<b>'.$_LANG['close_to'].'</b>
									</p>
									
									<p class="clear" style="margin-left:20px">
										'.(($bIsMobile == true)?(''):($sLocationDescr.'                   
										<br />    
										<img src="{BASEURL}modules/media/space.gif" height="3px" width="300px" style="display:block;">')).'
										'.$sCloseToCode.'
									</p>
									
									<p class="clear">
										<a name="map" id="map"></a><b>'.$_LANG['map_location'].'</b>
									</p>
									<p class="clear">
										<div align="center">
											<div id="map_'.$sCode.'" style="'.(($bIsMobile == true)?('width:300px; height:163px;'):('width:550px; height:300px;')).'"></div>
										</div>
									</p>
										
									<p>
										<strong>'.$_LANG['rent_act1'].'</strong> <a href="#book" style="color:#663300; font-weight:bold;">'.$_LANG['rent_act2'].'</a>
									</p>
		
								</td>
							 </tr>
						  </tbody>
					   </table>
					</div>
					
					<div align="center" style="font-size:35px;margin-bottom:20px;">***************</div>
		
		';
		
		
		
		$sGMapCode .= '
			var latlng'.$sCode.' = new google.maps.LatLng('.$sLocationCoord.');
			var myOptions'.$sCode.' = {
			  zoom: 15,
			  center: latlng'.$sCode.',
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var map'.$sCode.' = new google.maps.Map(document.getElementById(\'map_'.$sCode.'\'), myOptions'.$sCode.');
			var marker'.$sCode.' = new google.maps.Marker({
			  position: latlng'.$sCode.', 
			  map: map'.$sCode.', 
          	  title: "'.$sAddress.'"
			});
		';
		
		}
		
		
		$sGMapCode .= '
			}
		</script>
		';



		return $sGMapCode.$sContents;
	}


	

    /** get all apartments for price update page
     */

    public static function &allPriceApartments ()
    {
		global $_LANG, $_CONF, $oDb;
		//connect to db
		if (!isset($oDb)){$oDb = Dream::loadClass('Database');}
		$sTblDatabase 		= Dream::getParam('tbl','database');
		$sTblConfig 		= Dream::getParam('tbl','config');
		$sContents = '';
		$aContents = array();

		//get fxrate from database
		$aItem = array();
		$aItems = $oDb->getRows("SELECT *
			FROM ".$sTblConfig."
			WHERE name='fxrate'"
		);
		foreach($aItems as $sItem)
		{
			$sFXrate		= $sItem['value'];
		}
		$sContents1 = $sFXrate;
		
		//get price details from database
		$aItem = array();
		$aItems = $oDb->getRows("SELECT *
			FROM ".$sTblDatabase." 
			ORDER BY name ASC"
		);
		foreach($aItems as $sItem)
		{
			$sCode 			= $sItem['code'];
			$sRooms 		= $sItem['rooms'];
			$sName 			= $sItem['name'];
			$sNameUrl		= $sItem['url'];
			$sPrice			= $sItem['price'];
			$sPriceUAH		= $sItem['priceuah'];
			
			$sKeyword 		= $_LANG[$sRooms.'room_text'] . $_LANG['apartment_keyword'] . ' ' . $sAddress . ', ' . $sLocation;
			$sApartmentUrlRaw = Dream::getParam("url").$sNameUrl.'/';

            $sContents2		.= '
                <div class="price_block">
				
    	            <div class="price_id">'.$sCode.'</div>
    	            <div class="price_name"><a href="'.$sApartmentUrlRaw.'" target="_blank"><strong>'.$sName.'</strong></a></div>
    	            
    	            <form name="input" action="" method="post">
						<div class="price_price"><strong>Price:</strong> <input type="text" class="price" name="price" value="'.$sPrice.'" /></div>
						<div class="price_priceuah">Price UAH: '.$sPriceUAH.' </div>
						<!-- <div class="price_priceuah">PriceUAH: <input type="text" class="price" name="priceuah" value="'.$sPriceUAH.'" /></div> -->
						<input type="hidden" name="id" value="'.$sCode.'" />
						<input type="hidden" name="fxrate" value="'.$sFXrate.'" />
						<input class="submit" type="submit" value="Submit" />
					</form>
					
                </div>
			';
		}
		$aContents = array($sContents1,$sContents2);
		return $aContents;
	}


	

    /** make price update
     */

    public static function &allPriceUpdate ($nCode,$sPrice,$sFXrate)
    {
		global $_LANG, $_CONF, $oDb;
		//connect to db
		if (!isset($oDb)){$oDb = Dream::loadClass('Database');}
		$sTblDatabase 		= Dream::getParam('tbl','database');
		$sContents 			= '';
		$aContents 			= array();
		
		//get from database
			$aResult = $oDb->update($sTblDatabase, array('price' => $sPrice, 'priceuah' => round(($sFXrate*$sPrice), -2)), "code = '". $nCode ."'");
			if (!$aResult) {exit($_LANG['error_mysql']);}
		
		$sMessage = "Price Updated for Apartment with ID:".$nCode;
		
		return $sMessage;

	}


	

    /** make price update
     */

    public static function &FXrateANDallPriceUpdate ($sFXrate)
    {
		global $_LANG, $_CONF, $oDb;
		//connect to db
		if (!isset($oDb)){$oDb = Dream::loadClass('Database');}
		$sTblDatabase 		= Dream::getParam('tbl','database');
		$sTblConfig 		= Dream::getParam('tbl','config');
		$sMessage 			= '';
		
		//1. update fxrate
			$aResult = $oDb->update($sTblConfig, array('value' => $sFXrate), "name = 'fxrate'");
			if (!$aResult) {exit($_LANG['error_mysql']);}
		$sMessage .= "FX rate was updated to: ".$sFXrate." UAH/USD<br>";
		
		//2. update all uah prices
		//get price details from database
		$aItem = array();
		$aItems = $oDb->getRows("SELECT *
			FROM ".$sTblDatabase." 
			ORDER BY name ASC"
		);
		
		$sMessage .= "Price Updated for Apartment with ID:";

		foreach($aItems as $sItem)
		{
			$nCode 			= $sItem['code'];
			$nPrice			= $sItem['price'];
			
			$aResult = $oDb->update($sTblDatabase, array('priceuah' => round(($sFXrate*$nPrice), -2)), "code = '". $nCode ."'");
			if (!$aResult) {exit($_LANG['error_mysql']);}
		
			$sMessage .= $nCode.", ";

		}
		
		return $sMessage;
	}






	

    /** get all apartments for price update page
     */

    public static function &recentOrdersShow ($nAdmin)
    {
		global $_LANG, $_CONF, $oDb;
		//connect to db
		if (!isset($oDb)){$oDb = Dream::loadClass('Database');}
		$sTblOrders 		= Dream::getParam('tbl','orders');
		$sTblDatabase 		= Dream::getParam('tbl','database');
		$aContents = array();
		$sContents		= '
                <div class="order_block_top">
				
    	            <div class="order_id">Id</div>
    	            <div class="order_apt">Apartment</div>
    	            <div class="order_date">Dates</div>
    	            <div class="order_price">Price x Nights</div>
    	            <div class="order_ppl">Men</div>
    	            <div class="order_name">Name</div>
    	            <div class="order_country">Country</div>
    	            <div class="order_mobile">Mobile</div>
    	            <div class="order_email">Gmail</div>
    	            <div class="order_keyword" style="font-style:normal;">Keyword</div>
    	            <div class="order_comment">Comments</div>
					<div class="order_status">Status</div>

                </div>
			';
		
		//get from database
		$aItem = array();
		$aItems = $oDb->getRows("SELECT o.*, d.name, d.url
			FROM ".$sTblOrders." o
			LEFT JOIN ".$sTblDatabase." d ON o.apartment = d.code
			ORDER BY o.time DESC LIMIT 30"
		);
		foreach($aItems as $sItem)
		{
			$sId 			= $sItem['id'];
			$sCode 			= $sItem['apartment'];
			$sName 			= $sItem['name'];
			$sNameUrl 		= $sItem['url'];
			$sFromDate 		= $sItem['from_date'];
			$sToDate 		= $sItem['to_date'];
			$sPrice			= $sItem['night_price'];
			$sNights		= $sItem['nights'];
			$sMen			= $sItem['count_man'];
			$sChild			= $sItem['count_child'];
			$sFirstName		= $sItem['first_name'];
			$sLastName		= $sItem['last_name'];
			$sCountry		= $sItem['country'];
			$sMobile		= $sItem['mobile_phone'];
			$sEmail			= $sItem['email'];
			$sComments		= $sItem['comments'];
			$sKeyword		= urldecode($sItem['search_keyword']);
			$sStatus		= $sItem['status'];
			
			$sApartmentUrlRaw = Dream::getParam("url").$sNameUrl.'/';
			$sEmailUrl = "https://mail.google.com/mail/u/0/?shva=1#search/from%3A".urlencode($sEmail)."+OR+to%3A".urlencode($sEmail);
			
			$sContents		.= '
                <div class="order_block"'.( ($sStatus != 1) ? ('') : (' style="color:green;"') ).'>
				
    	            <div class="order_id">'.$sId.'</div>
    	            <div class="order_apt"><a href="'.$sApartmentUrlRaw.'" target="_blank"><strong>'.$sName.'</strong></a></div>
    	            <div class="order_date">'.$sFromDate.'-'.$sToDate.'</div>
    	            <div class="order_price">$'.$sPrice.' x '.$sNights.'</div>
    	            <div class="order_ppl">'.$sMen.'+'.$sChild.'</div>
    	            <div class="order_name">'.$sFirstName.' '.$sLastName.'</div>
    	            <div class="order_country">'.$sCountry.'</div>
    	            <div class="order_mobile">'.$sMobile.'</div>
    	            <div class="order_email"><a href="'.$sEmailUrl.'" target="_blank">Gmail</a></div>
    	            <div class="order_keyword">'.$sKeyword.'</div>
    	            <div class="order_comment">'.$sComments.'</div>

					<div class="order_status">
    	            '.( ($sStatus != 1) ? ('OPEN
					<form name="update" action="" method="post">
						<input type="hidden" name="id" value="'.$sId.'" />
						<input type="hidden" name="act" value="u" />
						<input class="submit" type="submit" value="Success" />
					</form>
					'.(($nAdmin == 1) ? ('
					<form name="remove" action="" method="post">
						<input type="hidden" name="id" value="'.$sId.'" />
						<input type="hidden" name="act" value="d" />
						<input class="submit" type="submit" value="Remove" />
					</form>'):('')).'					
					') : ('<b><font color="green">SUCCESS</font></b>') ).'
					</div>

				</div>
			';
		}
		
		return $sContents;
	}


    /** make order status update
     */

    public static function &recentOrdersShowUpdate ($nId, $sAction)
    {
		global $_LANG, $_CONF, $oDb;
		//connect to db
		if (!isset($oDb)){$oDb = Dream::loadClass('Database');}
		$sTblOrders 		= Dream::getParam('tbl','orders');
		$sContents = '';
		$aContents = array();
		
		//update
		if ($sAction == "u"){
			$aResult = $oDb->update($sTblOrders, array('status' => '1'), "id = '". $nId ."'");
			if (!$aResult) {exit($_LANG['error_mysql']);}
				
			$sMessage = "Status Updated for Order with ID:".$nId;
		}
		
		//remove
		if ($sAction == "d"){
			$aResult = $oDb->query("DELETE FROM ". $sTblOrders ." WHERE id='". $nId ."'");
			if (!$aResult) {exit($_LANG['error_mysql']);}
				
			$sMessage = "Order with ID ".$nId." was deleted!";
		}
		
		return $sMessage;
	}

	
	
	
	
	

    /** get keyword and set cookie
     */

    public static function &setKeywordCookie ()
    {
		$sDomain = Dream::getParam('domain');
		$sCookie = Dream::getParam('cookie');

		$sHttpReferer = getenv("HTTP_REFERER");
		//echo "Referer: ".getenv("HTTP_REFERER");

		//check for valid referrer and start the procedure
		if ((!preg_match("%".$sDomain."%i",$sHttpReferer)) and ($sHttpReferer!="")) {
		 $keywords = "";
		 $url = $sHttpReferer;
		
		 // Google, AllTheWeb, MSN, Freeserve, Altavista
		 if ((preg_match("%google%i",$url)) or (preg_match("%www.alltheweb%i",$url)) or (preg_match("%search.msn%i",$url)) or (preg_match("%ifind.freeserve%i",$url)) or (preg_match("%altavista.com%i",$url))) {
		  preg_match("'q=(.*?)(&| )'si", " $url ", $keywords);
		 }
		 // HotBot, Lycos, Netscape, AOL
		 if ((preg_match("%www.hotbot%i",$url)) or (preg_match("%search.lycos%i",$url)) or (preg_match("%search.netscape%i",$url)) or (preg_match("%aolsearch.aol%i",$url))) {
		  preg_match("'query=(.*?)(&| )'si", " $url ", $keywords);
		 }
		 // Yahoo
		 if ((preg_match("%yahoo.com%i",$url)) or (preg_match("%search.yahoo%i",$url))) {
		  preg_match("'p=(.*?)(&| )'si", " $url ", $keywords);
		 }
		 // Looksmart
		 if (preg_match("%looksmart.com%i",$url)) {
		  preg_match("'key=(.*?)(&| )'si", " $url ", $keywords);
		 }
		 // DMOZ
		 if (preg_match("%search.dmoz%i",$url)) {
		  preg_match("'search=(.*?)(&| )'si", " $url ", $keywords);
		 }
		 // Ask
		 if (preg_match("%ask.co%i",$url)) {
		  preg_match("'ask=(.*?)(&| )'si", " $url ", $keywords);
		 }
		 // Yandex
		 if ((preg_match("%yandex%i",$url)) or (preg_match("%ya.ru%i",$url))) {
		  preg_match("'text=(.*?)(&| )'si", " $url ", $keywords);
		 }
		 
		 //print_r($keywords);
		 
		 // If any keywords
		 if (($keywords[1]!="") and ($keywords[1]!=" ")) {
			  $keywords=$keywords[1];
			// clean up them
			  $keywords=str_replace("+", " ", $keywords);
			  $keywords=preg_replace("%2B"," ",$keywords);
			  $keywords=preg_replace("%2E",".",$keywords);
			  $keywords=trim(preg_replace("%22",'"',$keywords));
			  //echo $keywords;
		  	//set the cookie
			setcookie($sCookie, $keywords, time()+3600*24*7);  /* expire in 7 days */

		 }
		
		}




		return true;
	}







}//class



?>