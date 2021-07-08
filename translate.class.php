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

class Translate
{	

	public function __construct()
	{
		
	}


    /** Load translation by name
     */

    public static function &loadTranslation ($sPageTplName)
    {
		global $_CONF, $oUrl;
		$sFromLang = Dream::getparam('translation_baselang');
		$sBaseLang_Prefix = Dream::getparam('url_baselang_prefix');
		$sBaseLang_Prefix_Part = ($sBaseLang_Prefix == '') ? ('') : ($sBaseLang_Prefix.'/');
		$sToLang = $oUrl->_sLanguage;
		$aParamsRequest = $oUrl->_aParamsRequest;

		//check for cache & output cache if present
    	Dream::outputCacheIfPresent ($sPageTplName, $sToLang);

		//read source webpage & translate it


		//TRANSLATE URLS
		$aUrlReplace = array();
		if (strtolower($sPageTplName) == 'apartment'){ 
			$aUrlReplace['apartment'] = $oUrl->_sPageApartmentName;
		}else{
			foreach (Dream::getParam('url_base_rooter') as $key => $value){
				$aUrlReplace[$key] = $value;
			}
		}
		
		//case best.page.php with parameters
		if (count($aParamsRequest)>0){
			$sBestParams = '/';
			foreach ($aParamsRequest as $key => $value)
			{
				$sBestParams .= $key.'_'.$value.'/';
			}
		} else {
			$sBestParams = '';
		}
		
		//echo $sPageTplName;
		//print_r($aUrlReGoogleFixupplace);
		//print_r($aParamsRequest);
		//echo "<br><br><br>";

		$sSourceUrl = Dream::getparam('base_url') . $sBaseLang_Prefix_Part . $aUrlReplace[strtolower($sPageTplName)] . $sBestParams;
		//echo "<br><br><br>";

		$sTranslatedPage = self::translate($sSourceUrl, $sFromLang, $sToLang);
		
		//output page
		echo $sTranslatedPage;

	}
 
    /** Translate page
     */

	public static function &translate($sSourceUrl, $sFromLang, $sToLang)
	{
		global $_CONF, $oUrl;
		if (($sToLang || $sFromLang || $sText) == ("" || null)) die ("Please set language to, language from, and the text to be translated");
		if ($sToLang == 'cn') {$sToLang = 'zh-CN';}

		//define basic vars
        $sGoogle_url = "http://translate.google.com/translate?hl=en&sl=".$sFromLang."&tl=".$sToLang."&u=".$sSourceUrl."&prev=hp";
		$sUserAgent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
		$nTimeOut = 15;
		$max_redir = 3;
		$resource = $sGoogle_url;

		@set_time_limit($max_redir * $nTimeOut + 5);  //limit script exec time

		//////////////////////////////////////////////////////////////////
		//Loop to handle redirections
		//////////////////////////////////////////////////////////////////
		$get_url = 1;
		while ($get_url) {
			$get_url = 0;	//don't loop unless we are processing a redirect
	
			$rval['code'] = 0;
			$rval['redirects'] = array();
			$rval['content'] = '';
		
			//submit the translation request
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $resource);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // Return into a variable
			curl_setopt($ch, CURLOPT_TIMEOUT, $nTimeOut); 
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, $sUserAgent); 
	
			$content = curl_exec($ch);
	
			$req_status = curl_getinfo($ch,CURLINFO_HTTP_CODE);
			
			if ($content === false)
			{
				$rval['code'] = -10;
				$rval['error'] = "curl_exec failed: stat: $req_status error: " . curl_error($ch);
	
				curl_close($ch);
				return $rval;
			}
			
			curl_close($ch);
			
			
			//Return on error
			if ( $req_status != '200' )
			{
				$rval['code'] = -2;
				$rval['error'] = "Translator returned status '$req_status' (req=$resource)";
				return $rval;
			} 
			else
			{

			    //echo "GoogleCheck!<br>";

                $chk_status = self::GoogleCheck($content,$params);
				$chk_result = $chk_status['result'];

				//print_r($chk_status);
		
				if ($chk_result == "OK") {
					break;
				}
				elseif ($chk_result == "REDIRECT") {
					$redir_count++;
					$resource = $chk_status['redirect'];
					$message = $chk_status['message'];
					array_push($rval['redirects'],"$message: $resource");  
					
					if ($redir_count > $max_redir) {
						$rval['code'] = -4;
						$rval['error'] = "max_redir exceeded (max=$max_redir,req=$resource)";
						return $rval;
					}
					$get_url=1;
				}
				else {
					$rval['code'] = -5;
					$rval['error'] = "Failed GoogleCheck (result=$chk_result,req=$resource)";
					return $rval;
				}	
			}
			

		}

        //print_r ($chk_status);
        //echo '<br>';
        //echo $sGoogle_url;
        //echo '<br>';
     	//print_r($rval);
        //echo '<br>';

		//redefine vars
		$sOutput = $content;

		//$sOutput = preg_replace("/<!-- SOCIAL1 -->.*?<!-- SOCIAL2 -->/", '', $sOutput);

		$filename = "_translation.html";


		//$handle = fopen($filename, "w+");
		//fwrite($handle, $sOutput);
		//fclose($handle);

		//$handle = fopen($filename, "r");
		//$sOutput = fread($handle, filesize($filename));
		//fclose($handle);


		//////////////////////////////////////////////////////////////////
		//fixup social buttons
		$sOutput = preg_replace('/<!-- SOCIAL1 -->[\s\S]*?<!-- SOCIAL2 -->/', '', $sOutput);

		//////////////////////////////////////////////////////////////////
		//fixup translated page content
		$sTranslatedPage = self::GoogleFixup($sOutput);
		//////////////////////////////////////////////////////////////////

		/*
		$handle = fopen('translation_page.html', "w+");
		fwrite($handle, $sTranslatedPage);
		fclose($handle);
		*/

		/*
		$handle = fopen('translation_page2.html', "w+");
		fwrite($handle, $sTranslatedPage);
		fclose($handle);
		*/


		//replace other details
		$aCustomGoogleReplace = Dream::getparam('CustomGoogleReplace');
		$sTranslatedPage = str_replace(array_keys($aCustomGoogleReplace), array_values($aCustomGoogleReplace), $sTranslatedPage);


		//////////////////////////////////////////////////////////////////
		//replace urls
		$sToLang = $oUrl->_sLanguage;
		$aUrlReplace = array();
		$aUrlRooter = Dream::getParam('url_rooter');
		$sBaseLang_Prefix = Dream::getparam('url_baselang_prefix');
		$sBaseLang_Prefix_Part = ($sBaseLang_Prefix == '') ? ('/') : ($sBaseLang_Prefix.'/');
		$sToLang_Prefix_Part = ($sBaseLang_Prefix == '') ? ('/'.$sToLang.'/') : ($sToLang.'/');
		
		foreach (Dream::getParam('url_base_rooter') as $key => $value){
			$aUrlReplace[$sBaseLang_Prefix_Part.$value] = $sToLang_Prefix_Part.$aUrlRooter[$key];
		}
		foreach (Dream::getParam('apartment_rooter') as $key => $value){
			$aUrlReplace[$sBaseLang_Prefix_Part.$value] = $sToLang_Prefix_Part.$value;
		}
		$aUrlReplace['"'.Dream::getparam('base_url').'"'] = '"'.Dream::getparam('base_url').$sToLang.'/"';
		$aUrlReplace['modules/media/'.$sToLang.'/'] = 'modules/media/'; //protect media content links
		$aUrlReplace[$sToLang.'/paypal/'] = 'en/paypal/'; //protect paypal
		$sTranslatedPage = str_replace(array_keys($aUrlReplace), array_values($aUrlReplace), $sTranslatedPage);

		//replace /uk/zajavka/ with /zajavka/
		//echo '<br>'.$sToLang_Prefix_Part.$_CONF['url_rooter']['order'] . '   '.$sBaseLang_Prefix_Part.$_CONF['url_base_rooter']['order'].'<br>';
		$sTranslatedPage = str_replace($sToLang_Prefix_Part.$_CONF['url_rooter']['order'], $sBaseLang_Prefix_Part.$_CONF['url_base_rooter']['order'], $sTranslatedPage);


		//replace other details GLOBAL CUSTOM REPLACE
		$mstr = '#<span class=oldprice>.*?</span>#is';
		$rstr = '';
		$sTranslatedPage = preg_replace($mstr,$rstr,$sTranslatedPage);
		$mstr = '#<span class=uahprice>.*?</span>#is';
		$rstr = '';
		$sTranslatedPage = preg_replace($mstr,$rstr,$sTranslatedPage);
		$mstr = '#<span class=newprice>(.*?)</span>#is';
		$rstr = '<strong>$1</strong>';
		$sTranslatedPage = preg_replace($mstr,$rstr,$sTranslatedPage);


		//store cache
		Dream::saveCache ($oUrl->_sPageTplName, $sToLang, $sTranslatedPage);

		return $sTranslatedPage;
	}













///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
//	GoogleCheck is called by translate to validate the returned
//  contents, and detect redirect conditions.
// 
public static function GoogleCheck($content,$params)
{
 	$rval = array('result'	=>	'OK');
 	
	//Check for indications of errors
	if (strpos($content,'<title>403 Forbidden'))
	{
		$rval['result']='ERROR';
		$rval['error']='Google content indicates error. (Title: 403)';
		return $rval;
	}

	//Check for redirects
//	if (preg_match('|<iframe src="(/translate_p\?[^"]+)|',$content,$matches)) {
	if (preg_match('|<iframe sandbox="allow-same-origin allow-forms allow-scripts allow-popups" src="http:\/\/translate.googleusercontent.com(\/translate_p\?[^"]+)|',$content,$matches)) {
		$rval['result']='REDIRECT';
		$match = $matches[1];
		$match = preg_replace('|&amp;|','&',$match);
		$match = 'http://translate.googleusercontent.com' . $match;
		$rval['redirect']=$match;
		$rval['message']='translate_p_Frame';
		return $rval;
	}

	//<meta http-equiv="refresh" content="0;URL=http://74.125.67.132/translate_c?hl=en&amp;langpair=en%7Ces&amp;u=http://www.netbuilders.org/domaining/&amp;usg=ALkJrhhi9fkZqUuKk20-wQjgounHOH45PQ">
	
	//get the content redirect
	if (preg_match('|<meta http-equiv="refresh" content="0;URL=([^"]+)|',$content,$matches)) {
		$rval['result']='REDIRECT';
		$match = $matches[1];
		$match = preg_replace('|&amp;|','&',$match);
		$rval['redirect']=$match;
		$rval['message']='MetaRefresh';
		return $rval;
	}

	if ($params['validation_tag'] and !strpos($content,$params['validation_tag']))
	{
		$rval['result']='ERROR';
		$rval['error']="GoogleCheck failed to match validation_tag '{$params['validation_tag']}'";
		return $rval;
	}
	
	return $rval;
}

///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
//	Tag operations: work on each tag individually 
//  (e.g. content between each < >)
// 
public static function GoogleRemoveOnLoad($content)
{
	$rstr = '|onload="[^"]*?"|i';
	$content = preg_replace($rstr,'',$content);

	return $content;
}

//Fixup the url parameters returned by Google
// This is the part after the "translate_c?"
// We assume the "&amp;prev" always follows the "u" paramater.  This could change at any time...
public static function GoogleExtractOrigUrl($u)
{ 

	//which form of translate link
	if (strpos($u,'translate_c'))
	{
		$u = preg_replace('|.*u=|i','',$u);	//remove preceeding parameters
		preg_match('|#[^ ">]*|',$u,$anchor_match);	//get page anchor
		$u = preg_replace('|\&amp;.*|i','',$u); //remove any following parameters
	}
	elseif (strpos($u,'translate_un'))
	{
		$u = preg_replace('|.*u=|i','',$u);	//remove preceeding parameters
		preg_match('|#[^ ">]*|',$u,$anchor_match);	//get page anchor
		$u = preg_replace('|\&prev.*|i','',$u); //remove any following parameters  (TODO: this is not test as of v9.9.11)

	}

	//append page anchor, if any
	if ($anchor_match)
		$u = $u . $anchor_match[0];
	
	$u = rawurldecode($u);
	return $u;
}

public static function fix_link_cb($m) { return self::GoogleExtractOrigUrl($m[1]) . $m[2]; }

public static function GoogleFixupTagLinks($content)
{
	//echo "GoogleFixupTagLinks called with: $content\n";
	
	$rstr = '|(http://.+?/translate_.*?)([ ">])|i';		//FIXME: matching spaces may break things, but google is sending unquoted tag attributes...
	$content = preg_replace_callback($rstr,array('self','fix_link_cb'),$content);
	return $content;
}

///////////////////////////////////////////////////////////////////
//	GoogleTagFixup is called by translate for every tag
// 
public static function GoogleTagFixup($content)
{
	$content = self::GoogleRemoveOnLoad($content);
	$content = self::GoogleFixupTagLinks($content);

	return $content;
}

///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
//	Bulk operations (work on the entire page content
// 
public static function GoogleRemoveIFrame($content)
{

	$mstr = '#<iframe.*?translate\.google\.com.*?</iframe>#is';
	$rstr = '';
	$content = preg_replace($mstr,$rstr,$content);

	return $content;
}

public static function GoogleRemoveSpanWrappers($content)
{
	$mstr = '#<span class="google-src-text".*?' . '>(.*?)</span>#is';
	//$mstr = '#<span class="google-src-text".*?' . '>(.*?)</span>#is';
	$rstr = '';
	$content = preg_replace($mstr,$rstr,$content);
	
	$mstr = '#<span class="notranslate" onmouseover="_tipon\(this\)" onmouseout="_tipoff\(\)">(.*?)</span>#is';
	//$mstr = '#<span onmouseover="_tipon\(this\)" onmouseout="_tipoff\(\)">(.*?)</span>#is';
	$rstr = '$1';
	$content = preg_replace($mstr,$rstr,$content);


	return $content;
}

public static function GoogleRemoveScripts($content)
{
	// remove google translate scripts
	$rstr = '|<script src="http://(\S.*?)translate_c[^<]*?</script>|is';
	$content = preg_replace($rstr,'',$content);

	$rstr = '|<script>.*?_intlStrings[^<]*?</script>|is';
	$content = preg_replace($rstr,'',$content);

	$rstr = '|<script>.*?function ti_\(\)[^<]*?</script>|is';
	$content = preg_replace($rstr,'',$content);

	$rstr = '|<script>.*?_setupIW\(\)[^<]*?</script>|is';
	$content = preg_replace($rstr,'',$content);

	return $content;
}

public static function GoogleRemoveCss($content)
{
	// remove google css
	//$rstr = '|<style.*?type="text/css">\.google-src-text.*?</style>|is';
	$rstr = '|<style type="text/css">\.google-src-text[^<]*?</style>|is';
	$content = preg_replace($rstr,'',$content);

	return $content;
}

///////////////////////////////////////////////////////////////////
//	Google Fixup is called by translate for bulk fixup
//
public static function GoogleFixup($content)
{
	global $params;

	//Work on entire content (required for fixups that work on content between tags)
	$content = self::GoogleRemoveIFrame($content);
	$content = self::GoogleRemoveOnLoad($content);
	$content = self::GoogleRemoveCss($content);	
	$content = self::GoogleRemoveScripts($content);
	$content = self::GoogleRemoveSpanWrappers($content);
	
	//default fixups (tags, translated url mapping, etc)
	$content = self::DefaultFixup($content);

	return $content;
}



public static function PurtyNewlines($content)
{
	$content = preg_replace('#(<!doctype.*?' . '>)([^\n])#i',	"\\1\n\\2", $content);
	$content = preg_replace('#(</?html>)([^\n])#i',				"\\1\n\\2", $content);
	$content = preg_replace('#(</?head>)([^\n])#i',				"\\1\n\\2", $content);
	$content = preg_replace('#(</?body>)([^\n])#i',				"\\1\n\\2", $content);
	$content = preg_replace('#(</?div.*?' . '>)([^\n])#i',		"\\1\n\\2", $content);
	$content = preg_replace('#(</li>)([^\n])#i',				"\\1\n\\2", $content);
	$content = preg_replace('#(</p>)([^\n])#i',					"\\1\n\\2", $content);
	$content = preg_replace('#(<br.*?' . '>)([^\n])#i',			"\\1\n\\2", $content);
	$content = preg_replace('#(</h.>)([^\n])#i',				"\\1\n\\2", $content);
	$content = preg_replace('#(-->)([^\n])#i',					"\\1\n\\2", $content);
	$content = preg_replace('#(</script>)([^\n])#i',			"\\1\n\\2", $content);

	return $content;
}

/*
//FIXME: this will break attrs with embedded spaces, rework.  split on =
function QuoteTagAttrs($content)  
{
	$mstr = '#=\s*"?([^ >"]*)"?#is';
	$rstr = '="$1"';
	$content = preg_replace($mstr,$rstr,$content);

	return $content;
}
*/

//Rewrite our host URLs to the proper translated namespace (subdomain or subdirectory)
public static function FixupHostUrls($content)	//TODO: rename FixupSiteUrl
{
	global $params, $url_rewrite_style;

	$rstr = '|(' . $params['site_url'] . '/?)([^">\r\n]*)|i';
//	$rstr = '|href\s*=\s*"?(' . $params['site_url'] . '/?)([^">\r\n]*)"|i';
	

	if ($url_rewrite_style == 'ABSOLUTE')
	{
		$rplstr = $params['translated_base_href'] . '/$2';	
		
		//absolute urls from original href
		//$rplstr = '$1/' . $params['trans_dir'] . '/$2"';	
	}	
	//elseif ($url_rewrite_style == 'RELATIVE')
	else //default
	{
		$rplstr = '$2';	
	}

	$content = preg_replace($rstr,$rplstr,$content);

	return $content;
}

public static function TagFixup($content)
{
	global $params;

	//TODO: should we remove any embedded new lines first?
	
	$content = self::GoogleTagFixup($content);
		
	$content = self::FixupHostUrls($content);

	return $content;
}

public static function TagCallback($m)
{ 
	//echo "tag : " . $m[1] . "\n"; 	
	$content = self::TagFixup($m[1]);
	
	return $content; 
}

public static function ProcessTags($input)
{
	$mstr = '#(<.*?' . '>)#s';
	$output = preg_replace_callback($mstr,array('self', 'TagCallback'),$input);
	return $output;
}

public static function ProcessComment($input)
{ 
	//echo "comment: " . $input . "\n"; 

	//TODO: allow per engine comment processing
	
//	return "";  //remove all comments
	return $input;
}

public static function CommentCallback($m)
{ 
	//echo "before : " . $m[1] . "\n"; 
	//echo "comment: " . $m[2] . "\n"; 
	//echo "rest   : " . $m[3] . "\n"; 
	
	$r1 = self::ProcessTags($m[1]);
	$r2 = self::ProcessComment($m[2]);
	$r3 = self::ProcessCommentGroups($m[3]);	//Recursive
	
	if (! $r3)
		$r3 = self::ProcessTags($m[3]);
			
	return $r1 . $r2 . $r3; 
}

public static function ProcessCommentGroups($input)  //TODO: rename
{
	$mstr = '#(.*?)(<!--.*?-->)(.*)#s';
	$output = preg_replace_callback($mstr,array('self', 'CommentCallback'),$input);
	return $output;
}

public static function DefaultFixup($content)
{
	global $params;

	// Get rid of <base href>
	$content = preg_replace('|<base href=[^\>]*\>|i','',$content,1);

/*
	// Add our own <base href> after <head>
	$rplstr = '<head><base href="' . $params['translated_base_href'] . '"/>';
	$content = preg_replace('|<\s*head\s*>|i',$rplstr,$content);
*/		

	//Process all the tags
	$content = self::ProcessCommentGroups($content);

	//Beautify output
	$content = self::PurtyNewlines($content);

	return $content;
}



}//class



?>