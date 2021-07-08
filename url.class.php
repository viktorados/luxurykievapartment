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

class Url
{	

	private $_aParams = array();
	public $_aParamsRequest = array();
	private $_bError = 0;
	private $_bTransl = 0; //whether the pages where translated and have url suffix
	public $_sPageTplName;
	public $_sPageApartmentName = false;
	public $_sLanguage;
	public function __construct()
	{
		$this->parseUrl();
	}


    /** Parses url parameters 
     * @return void
     */

    public function parseUrl()
    {

        $sParams = $_GET["do"];
        $aList = explode('/', trim($sParams,'/ '));
        for ($i = 0, $n=count($aList); $i < $n; ++$i)
        {
            $aPair = explode('_', $aList[$i], 2);
            if (isset($aPair[1]))
            {
                $this->_aParamsRequest[$aPair[0]] = urldecode($aPair[1]);
            }
            else
            {
                $this->_aParams[$i] = urldecode($aPair[0]);
            }
		}
		//print_r($this->_aParamsRequest);
    }


    /** Check for language url-suffix  
     * @return void
     */

    public function getLanguage()
    {
		//print_r($this->_aParams); echo '<br />';
        if (count($this->_aParams) >= 1 && $this->_aParams[0] != '') 
		{ 
			//SET TRANSLATION LANGUAGE
			foreach (Dream::getParam('url_languages') as $key => $value){
        		if ($this->_aParams[0] == $key) {
					//SET LANGUAGE
					$this->_sLanguage = $key;
						if ($key == Dream::getParam('main_language')){$this->_bTransl = 0;}else{$this->_bTransl = 1;}
					break;
				} else { 
					//SET DEFAULT LANGUAGE
					$this->_sLanguage = Dream::getParam('main_language'); 
					$this->_bTransl = 0;
				}
			}
        }
		else
		{
			//SET DEFAULT LANGUAGE
			$this->_sLanguage = Dream::getParam('main_language');
			$this->_bTransl = 0;
		}
		//echo $this->_bTransl;
    }


    /** Decides what to do with the first url node & where to redirect 
     * @return void
     */

    public function getPageTplName()
    {
		//print_r($this->_aParams); echo '<br />';
		//CASE: MAIN LANGUAGE
        if (count($this->_aParams) == 1 && $this->_aParams[0] != '' && $this->_bTransl == 0) 
		{ 
			//SET TEMPLATE
			foreach (Dream::getParam('url_rooter') as $key => $value){
				//CASE: MAIN LANGUAGE + SUB PAGES
        		//echo $value."<br />";
				if ($this->_aParams[0] == $value) {
					$this->_sPageTplName = $key;
					$this->_bError = 0; //correct routing
					break;
				} else { $this->_bError = 1; }
				
			}
			//SET TEMPLATE FOR APARTMENT PAGES
			foreach (Dream::getParam('apartment_rooter') as $key => $value){
				//CASE: MAIN LANGUAGE + SUB PAGES
        		//echo $value."<br />";
				if ($this->_aParams[0] == $value) {
					$this->_sPageTplName = 'apartment';
					$this->_sPageApartmentName = $value;
					$this->_bError = 0; //correct routing
					break;
				} 
				
			}
        }
		elseif ($this->_bTransl == 0)
		{
			//CASE: MAIN LANGUAGE + INDEX PAGE
			$this->_sPageTplName = 'index';
		}

		//CASE: TRANSLATION
        if (count($this->_aParams) == 2 && $this->_aParams[1] != '' && $this->_bTransl == 1) 
		{ 
			//SET TEMPLATE
			foreach (Dream::getParam('url_rooter') as $key => $value){
				//CASE: TRANSLATION + SUB PAGES
        		//echo $value."<br />";
        		if ($this->_aParams[1] == $value) {
					// if translation language
					$this->_sPageTplName = $key;
					$this->_bError = 0; //correct routing
					break;
				} else {$this->_bError = 1; }
			}
			//SET TEMPLATE FOR APARTMENT PAGES
			foreach (Dream::getParam('apartment_rooter') as $key => $value){
				//CASE: MAIN LANGUAGE + SUB PAGES
        		//echo $value."<br />";
				if ($this->_aParams[1] == $value) {
					$this->_sPageTplName = 'apartment';
					$this->_sPageApartmentName = $value;
					$this->_bError = 0; //correct routing
					break;
				} 
				
			}
        }
		elseif ($this->_bTransl == 1)
		{
			//CASE: INDEX PAGE
			$this->_sPageTplName = 'index'; 
		}


		//in case of error - redirect to error message page		
        if ($this->_bError == 1) { 
			$this->_sPageTplName = 'error';
        }
		

    }



}//class



?>