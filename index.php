<?php
/**
 * Define the include directory
 */

define('IN_DREAM', true);
define('PATH_BASE', dirname(__FILE__).'/');
define('PATH_INCLUDE', dirname(__FILE__).'/include/');

/**
 * Load the core settings
 */
if (file_exists(PATH_INCLUDE . 'settings/server.sett.php'))
{
    require_once PATH_INCLUDE . 'settings/server.sett.php';
}
else
{
	exit('Missing config files');
}



/**
 * Load the core classes/functions
 */

require_once PATH_INCLUDE . 'classes/dream.class.php';

//parse url
$oUrl = Dream::loadClass('Url');
//set keyword cookie
Dream::setKeywordCookie();
//get language
$oUrl->getLanguage();
require_once PATH_INCLUDE . 'languages/'.$oUrl->_sLanguage.'.php';
//get template name
$oUrl->getPageTplName();




//load page
if ($oUrl->_sLanguage == 'en' || $oUrl->_sLanguage == 'ru'){
	
	//check for cache and output cache if present
	Dream::outputCacheIfPresent ($oUrl->_sPageTplName, $oUrl->_sLanguage);

	Dream::loadPage($oUrl->_sPageTplName);
	
} else {

	if(!$oTranslate){$oTranslate = Dream::loadClass('Translate');}
	Translate::loadTranslation($oUrl->_sPageTplName);

}

















?>