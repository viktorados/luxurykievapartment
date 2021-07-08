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
class Template
{	

	private $_sTemplateHTML = '';
	private $_sTemplateHTMLbody = '';
	private $_sTemplateApplicationForm = '';
	private $_sBasePath = '';
	
	// load template
	public function __construct ()
	{
		$this->_sBasePath = Dream::getParam('path');
	}

 	// replace place holders in the template
	public function insertContents($contentArray)
	{
		//read custom page template
		global $oUrl;
		
		//check for mobile or desctop version & select template
		$this->_bIsMobile = Dream::getParam('mobile');
		if ($this->_bIsMobile == true){		
			$sPath = $this->_sBasePath.'modules/templates/'.$oUrl->_sLanguage.'/tpl_'.$oUrl->_sPageTplName.'_m.html';
		}else{
			$sPath = $this->_sBasePath.'modules/templates/'.$oUrl->_sLanguage.'/tpl_'.$oUrl->_sPageTplName.'.html';
		}
		if ( file_exists($sPath) ) { $this->_sTemplateHTML = file_get_contents($sPath); } else { exit('Template file error!'); }

		//read main body template & insert sub_template into it
		if ($this->_bIsMobile == true){		
			$this->_sTemplateHTMLbody = file_get_contents($this->_sBasePath.'modules/templates/'.$oUrl->_sLanguage.'/tpl_main_m.html');
		}else{
			$this->_sTemplateHTMLbody = file_get_contents($this->_sBasePath.'modules/templates/'.$oUrl->_sLanguage.'/tpl_main.html');
		}
		$this->_sTemplateHTML = str_replace("{CONTENT}", $this->_sTemplateHTML, $this->_sTemplateHTMLbody);

		//replace counters for localhost
		if (Dream::getParam('location') == "LHOST") {
			$this->_sTemplateHTML = preg_replace('#<!-- GOOGLE ANALYTICS -->.*?<!-- GOOGLE ANALYTICS -->#is', '', $this->_sTemplateHTML);
		}
		
		//proceed with replacement of place holders
		$this->_sTemplateHTML = str_replace(array_keys($contentArray), array_values($contentArray), $this->_sTemplateHTML);

		//proceed with replacement of global variables
		//ADVERT 
		$AdvertLimit = 9;
		$aBestApartments = Dream::bestApartments($AdvertLimit);
		$i = 1;
		foreach($aBestApartments as $sItem)
		{
			$sAdvert .= '
                 <tr>
				  <td border="0" style="padding:10px 5px 10px 20px;">
            		'.$sItem.'
                  </td>
				 </tr>
			';
			
			$i = $i + 1;
			if ($i > $AdvertLimit){break;}
		}

		//read articles data
		if ($oUrl->_sLanguage == "ru") {
			$filename = dirname(__FILE__)."/../../w/_kr_recentposts_cache";
		}else{
			$filename = dirname(__FILE__)."/../../z/_kr_recentposts_cache";
		}
		$handle = fopen($filename, "r");
		$sArticles = fread($handle, filesize($filename));
		fclose($handle);

		$aGlobalArray = array(
			'{ARTICLELINKS}'	=> $sArticles,
			
			'{ADVERT}'			=> $sAdvert,
			'{CALENDAR}'		=> Dream::getParam('calendar_file'),

			'{OPTIONS_SMALL}'	=> Dream::bookingFormSmall(),
			'{FROM_DATE}'		=> date( "d.m.Y" ),
			'{TO_DATE}'			=> date( "d.m.Y", mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")) ),
			
			'{MAIN_PHONE}'		=> Dream::getParam('main_phone'),
			'{SECOND_PHONE}'	=> Dream::getParam('second_phone'),
			'{VIBER_PHONE}'		=> Dream::getParam('viber_phone'),
			'{TRANSFER_PRICE}'	=> Dream::getParam('airport_pickup_price'),
			'{MAIN_EMAIL}'		=> Dream::getParam('from_email'),
			'{LOCAL_TIME}'		=> "<!-- LOCAL_TIME1 -->".date("H:i")."<!-- LOCAL_TIME2 -->",
			'{CURRENT_YEAR}'	=> (int)date("Y"),
			'{FEEDBACK_YEAR-1}'	=> ((int)date("Y") - 1),
			'{FEEDBACK_YEAR-2}'	=> ((int)date("Y") - 2),
			'{WELCOME_MSG}'		=> Dream::getLang('main_welcome'),
		);
		$this->_sTemplateHTML = str_replace(array_keys($aGlobalArray), array_values($aGlobalArray), $this->_sTemplateHTML);
		
		//proceed with replacement of URL place holders
		$sBaseUrl 	= Dream::getParam('base_url');
		$sUrl 		= Dream::getParam('url');
		$aUrlArray 	= array(
			'{U_rent}'			=> $sUrl.Dream::getParam('url_rooter', 'rent').'/',
			'{U_1room}'			=> $sUrl.Dream::getParam('url_rooter', '1room').'/',
			'{U_2room}'			=> $sUrl.Dream::getParam('url_rooter', '2room').'/',
			'{U_3room}'			=> $sUrl.Dream::getParam('url_rooter', '3room').'/',
			'{U_4room}'			=> $sUrl.Dream::getParam('url_rooter', '4room').'/',
			'{U_catalogue}'		=> $sUrl.Dream::getParam('url_rooter', 'catalogue').'/',
			'{U_best}'			=> $sUrl.Dream::getParam('url_rooter', 'best').'/',
			
			'{U_services}'		=> $sUrl.Dream::getParam('url_rooter', 'services').'/',
			'{U_airport}'		=> $sUrl.Dream::getParam('url_rooter', 'airport').'/',
			'{U_excursions}'	=> $sUrl.Dream::getParam('url_rooter', 'excursions').'/',
			'{U_otherservice}'	=> $sUrl.Dream::getParam('url_rooter', 'otherservice').'/',

			'{U_aboutus}'		=> $sUrl.Dream::getParam('url_rooter', 'aboutus').'/',
			'{U_feedback}'		=> $sUrl.Dream::getParam('url_rooter', 'feedback').'/',
			'{U_book}'			=> $sUrl.Dream::getParam('url_rooter', 'book').'/',
			'{U_bookform}'		=> $sUrl.Dream::getParam('url_rooter', 'bookform').'/',
			'{U_order}'			=> $sUrl.Dream::getParam('url_rooter', 'order').'/',

			'{U_articles}'		=> $sUrl.Dream::getParam('url_rooter', 'articles').'/',

			'{LANG}'			=> $oUrl->_sLanguage,
			'{BASEURL}'			=> $sBaseUrl,
			'{URL}'				=> $sUrl,
		);
		$this->_sTemplateHTML = str_replace(array_keys($aUrlArray), array_values($aUrlArray), $this->_sTemplateHTML);
		
	}


	// output the HTML code
	public function output()
	{	
		global $oUrl;
		Dream::saveCache ($oUrl->_sPageTplName, $oUrl->_sLanguage, $this->_sTemplateHTML);
		return $this->_sTemplateHTML;
	}	












}//class

?>