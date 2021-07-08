<?php

defined('IN_DREAM') or exit('NO DICE!');

//MAIN SETTINGS
global $_CONF;
global $_LANG;

//URL
$_CONF['base_url']   		=  $_CONF['http'].$_CONF['host'];
$_CONF['url']   			=  $_CONF['http'].$_CONF['host'].'en/';
  
//APARTMENT DATABASE
$_CONF['tbl']['database_lang'] 	=  $_CONF['tbl']['database_en'];

//SEO
$_CONF['main_title'] 		= 'Rent Kiev apartment from Luxury Kiev Apartments today. VIP and Luxury apartments on Khreshchatyk';
//$_CONF['main_title'] 		= 'Rent Kiev apartment from Luxury Kiev Apartments today. VIP and Luxury class Kiev apartments for rent';
$_CONF['main_metakeywords'] = 'rent kiev apartment, rent apartments kiev, kiev rent, apartment in kiev, kiev apartments for rent, rent apartment in kiev, rent apartments in kiev, kiev apartment rental, kiev apartments for rent';

$_CONF['calendar_file']		= 'calendar_en.js';

//RESERVED NAMES
$_CONF['url_rooter'] = array
(

	'rent'			=> 'rent-luxury-apartment-in-kiev-center',
	'1room'			=> 'rent-studio-one-room-apartment-in-kiev',
	'2room'			=> 'rent-luxury-two-room-apartment-in-kiev',
	'3room'			=> 'rent-luxury-three-room-apartment-in-kiev',
	'4room'			=> 'rent-luxury-four-room-apartment-in-kiev',

	'services'		=> 'additional-services',
	'airport'		=> 'airport-pickup',
	'excursions'	=> 'excursions',
	'otherservice'	=> 'other-service',

	'aboutus'		=> 'about-luxury-apartment',
	'feedback'		=> 'client-feedback',

	'book'			=> 'book-apartment-kiev',
	'catalogue' 	=> 'catalogue',
	'best'			=> 'best',

	'order' 		=> 'order',
	'paypal' 		=> 'paypal',
	'liqpay' 		=> 'liqpay',
	'crm' 			=> 'crm',
	'price' 		=> 'price',
	'bookform'		=> 'bookform',

	'articles' 		=> 'articles',
	'adw' 			=> 'adw',

);


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //


$_LANG['uah_sign'] = 'UAH';

//BASIC LANG ITEMS
$_LANG['index'] = array
(

	'HTMLPAGETITLE'			=> $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['1room'] = array
(

	'HTMLPAGETITLE'			=> 'Rent Studio Luxury Apartment in Kiev center on Malaya Zhitomirskaya Str., 20 &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['2room'] = array
(

	'HTMLPAGETITLE'			=> 'Rent One Bedroom Luxury Apartment in Kiev center on Baseinaya Str., 3b &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['3room'] = array
(

	'HTMLPAGETITLE'			=> 'Rent Two Bedroom Luxury Apartment in Kiev center on Malaya Zhitomirskaya Str., 20g &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['4room'] = array
(

	'HTMLPAGETITLE'			=> 'Rent Three Bedroom Luxury Apartment in Kiev center on Vladimirskaya Str., 51/53 &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['catalogue'] = array
(

	'HTMLPAGETITLE'			=> 'Catalogue of Luxury and VIP Apartments in Kiev center, Khreshchatyk, Independence Square &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['aboutus'] = array
(

	'HTMLPAGETITLE'			=> 'About Luxury Apartments &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['airport'] = array
(

	'HTMLPAGETITLE'			=> 'Airport Pick-Up Kiev &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['book'] = array
(

	'HTMLPAGETITLE'			=> 'Book Apartment In Kiev Center &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['otherservice'] = array
(

	'HTMLPAGETITLE'			=> 'Other Services &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['error'] = array
(

	'HTMLPAGETITLE'			=> 'Error &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['excursions'] = array
(

	'HTMLPAGETITLE'			=> 'Excursions in Kiev &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['feedback'] = array
(

	'HTMLPAGETITLE'			=> 'What Guests Say &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['order'] = array
(

	'HTMLPAGETITLE'			=> 'Book Apartment In Kiev Center &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['rent'] = array
(

	'HTMLPAGETITLE'			=> 'Rent Luxury Apartment In Kiev Center &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['services'] = array
(

	'HTMLPAGETITLE'			=> 'Additional Services &raquo; ' . $_CONF['main_title'],
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['best'] = array
(

	'HTMLPAGETITLE'			=> 'Rent Luxury Apartment In Kiev Center',
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);

$_LANG['articles'] = array
(

	'HTMLPAGETITLE'			=> 'Articles About Luxury Apartment For Rent In Kiev Center',
	'HTMLMETADESCRIPTION'	=> '',
	'HTMLMETAKEYWORDS'		=> $_CONF['main_metakeywords'],

);


//for rent.page.php
$_LANG['sleeping_places1'] 	= 'sleeps';
$_LANG['sleeping_places2'] 	= 'sleeps';
$_LANG['bath'] 				= 'bathroom';
$_LANG['baths'] 			= 'bathrooms';
$_LANG['price'] 			= 'price';
$_LANG['per_night'] 		= 'per night';
$_LANG['details'] 			= 'read more';

//bedroom issue
$_LANG['studio_text']		= 'studio';
$_LANG['bedroom_text']		= 'bedroom';
$_LANG['bedrooms_text']		= 'bedrooms';

//for xroom.page.php
$_LANG['apartment_title'] 	= ' luxury apartment in Kiev center for daily and short term rent';
$_LANG['apartment_keyword']	= ' Luxury Apartment in Kiev center for daily and short term rent on';
$_LANG['1room_text']		= 'Studio';
$_LANG['2room_text']		= 'One bedroom';
$_LANG['3room_text']		= 'Two bedroom';
$_LANG['4room_text']		= 'Three bedroom';
$_LANG['5room_text']		= 'Four bedroom';
$_LANG['rent_act1']			= 'What can I do now?';
$_LANG['rent_act2']			= 'Book this apartment for myself NOW!';
$_LANG['close_to']			= 'Nearby apartments and locations:';
$_LANG['close_to_part1']	= '<b> - apartment for daily rent</b>';
$_LANG['close_to_part2']	= ' Kiev';
$_LANG['map_location']		= 'Location on the map:';
$_LANG['offer'] 			= 'We can offer you these apartments:';
$_LANG['top_line']			= ' room apartments in Kiev for daily rent:';

//for catalogue.page.php
$_LANG['txt_catalogue']		= 'Catalogue of apartments';

$_LANG['tab_name']			= 'Name';
$_LANG['tab_address']		= 'Address';
$_LANG['tab_address_title']	= 'See on the map...';
$_LANG['tab_rooms']			= 'Bedrooms';
$_LANG['tab_sleeps']		= 'Sleeping places';
$_LANG['tab_price']			= 'Price per night';
$_LANG['tab_special']		= 'Specialties';
$_LANG['tab_details']		= 'Details &amp; Fotos';
$_LANG['tab_book']			= 'Book';

$_LANG['txt_details']		= 'Details Fotos ...';
$_LANG['txt_book']			= 'Book ...';
$_LANG['txt_book_title']	= 'Book this apartment now ...';
$_LANG['txt_watch']			= 'More details and fotos...';

//for best.page.php
$_LANG['apartments_keyword']= ' room luxury apartments'; 
$_LANG['nothing_found_text']= 'No results. Please try again with different parameters...'; 
//key match for specialties
$_LANG['item_cond']	= 'conditioner'; 
$_LANG['item_pla']	= 'plasma'; 
$_LANG['item_hid']	= 'hidromassage'; 
$_LANG['item_kam']	= 'fireplace'; 
$_LANG['item_jak']	= 'jacuzzi'; 
$_LANG['item_ter']	= 'home theater'; 
$_LANG['item_sau']	= 'sauna'; 
//key match for area
$_LANG['item_kre']	= 'Khreshchatyk'; 
$_LANG['item_maj']	= 'Independence Square'; 
$_LANG['item_are']	= 'Arena City'; 

//for price msg
$_LANG['price_per_night']	= 'Price per night:';

//for main page
$_LANG['alt_text']			= 'kiev apartments for rent';
$_LANG['rooms_text']		= 'rooms';
$_LANG['room_text']			= 'room';

//for apartment page
$_LANG['meta_text_1']		= 'Apartment for daily rent';
$_LANG['meta_text_2']		= 'in Kiev Center for Daily Rent';


//MAIN WELCOME MESSAGE

$_LANG['main_welcome'] 	= '
          <h2>Providing you a comfortable stay</h2>
         	<div style="float:left; width:350px;">
                <p style="margin-top: 0px;">
                    We are here to assist you in every way while visiting the beautiful and ancient city of Kiev or generally during your stay in Ukraine, and see our mission in making everything possible so that you\'ll have only <b>the most pleasant and enjoyable memories</b> from your stay in Kiev.
                </p>
                <p><a href="{U_aboutus}#contacts">Contact us</a></p>
            </div>
            <div style="float:left;">
                <img src="{BASEURL}modules/media/team.jpg" alt="квартиры в Киеве посуточно" />
            </div>
          <br clear="all" />
';


//ORDER PROCESSING
$_LANG['dear_mr'] = 'Dear ';
$_LANG['dear_ms'] = 'Dear ';
$_LANG['your_order'] = 'Your booking confirmation from ';

$_LANG['error_mysql'] = 'Error sending your message (MySql)! Please try once more or contact us by phone';
$_LANG['success_msg'] = 'Your message was sent. Our manager will contact you soon ;)';
$_LANG['error_msg'] = 'Error sending your message! Please try once more or contact us by phone';

$_LANG ['body_instructions_p2'] = ',

<br><br>Thank you for your message.
<br>We will contact you soon.

<br><br>We usually reply to the booking requests within 1-6 hours after we receive them, depending on the time of the day.
<br>If you\'d like to have an instant answer, you can call us now at +38-066-2668922.

<br><br>Wishing you a comfortable stay in Kiev,
<br>Luxury Apartments';


//BOOKING FORM

$_LANG['booking_form_room']	= 'r.';
$_LANG['booking_form_options1']	= '
					<select class="sel" name="s_apartment" style="width: 100%;">
                        <option value="0">Select an apartment</option>
						{OPTIONS}
                    </select>
';
$_LANG['booking_form_options2']	= '
					{HIDDEN}
					<select class="sel" name="s_apartment_dummy" style="width:100%; color:#3a1d00; background-color:#fff;" disabled>
						{OPTIONS}
                    </select>
';
$_LANG['booking_form']		= '


        <!-- Book Apartment Form BEGIN -->    
		<script language = "Javascript">
            // Declaring required variables
            var digits = "0123456789";
            // non-digit characters which are allowed in phone numbers
            var phoneNumberDelimiters = "()- ";
            // characters which are allowed in international phone numbers
            // (a leading + is OK)
            var validWorldPhoneChars = phoneNumberDelimiters + "+";
            // Minimum no of digits in an international phone no.
            var minDigitsInIPhoneNumber = 7;
            
            function isInteger(s)
            {   var i;
                for (i = 0; i < s.length; i++)
                {   
                    // Check that current character is number.
                    var c = s.charAt(i);
                    if (((c < "0") || (c > "9"))) return false;
                }
                // All characters are numbers.
                return true;
            }
            function trim(s)
            {   var i;
                var returnString = "";
                // Search through string\'s characters one by one.
                // If character is not a whitespace, append to returnString.
                for (i = 0; i < s.length; i++)
                {   
                    // Check that current character isn\'t whitespace.
                    var c = s.charAt(i);
                    if (c != " ") returnString += c;
                }
                return returnString;
            }
            function stripCharsInBag(s, bag)
            {   var i;
                var returnString = "";
                // Search through string\'s characters one by one.
                // If character is not in bag, append to returnString.
                for (i = 0; i < s.length; i++)
                {   
                    // Check that current character isn\'t whitespace.
                    var c = s.charAt(i);
                    if (bag.indexOf(c) == -1) returnString += c;
                }
                return returnString;
            }
            
            function checkInternationalPhone(strPhone){
                var bracket=3
                strPhone=trim(strPhone)
                if(strPhone.indexOf("+")>1) return false
                if(strPhone.indexOf("-")!=-1)bracket=bracket+1
                if(strPhone.indexOf("(")!=-1 && strPhone.indexOf("(")>bracket)return false
                if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)return false
                s=stripCharsInBag(strPhone,validWorldPhoneChars);
                return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
            }
            
            function ValidateForm(){
                var Apartment=document.bookForm.s_apartment
                if ((Apartment.value==null)||(Apartment.value==0)){
                    alert("Please choose the apartment")
                    Apartment.focus()
                    return false
                }
        
                var First_Name=document.bookForm.s_first_name
                if ((First_Name.value==null)||(First_Name.value=="")){
                    alert("Minimal length of the name is 3 symbols")
                    First_Name.focus()
                    return false
                }
        
                var Last_Name=document.bookForm.s_last_name
                if ((Last_Name.value==null)||(Last_Name.value=="")){
                    alert("Minimal length of the surname is 3 symbols")
                    Last_Name.focus()
                    return false
                }
        
                var Country=document.bookForm.s_country
                if ((Country.value==null)||(Country.value=="")){
                    alert("Minimal length of the country is 3 symbols")
                    Country.focus()
                    return false
                }
        
                var Mobile_Phone=document.bookForm.s_mobile_phone
                if ((Mobile_Phone.value==null)||(Mobile_Phone.value=="")){
                    alert("Minimal length of the phone (mob.) is 7 symbols")
                    Mobile_Phone.focus()
                    return false
                }
                if (checkInternationalPhone(Mobile_Phone.value)==false){
                    alert("Minimal length of the phone (mob.) is 7 symbols")
                    Mobile_Phone.value=""
                    Mobile_Phone.focus()
                    return false
                }
        
                var Email=document.bookForm.s_email
                if ((Email.value==null)||(Email.value=="")){
                    alert("Please enter the correct email")
                    Email.focus()
                    return false
                }
                
                return true
             }
        </script>
          
        <div style="padding: 0px 10px 20px 20px;">
          Please fill out the form and we will contact you shortly. Items highlighted with an asterisk are required.
          <br />
          <br />
          <form method="post" action="{URL}order/" name="bookForm" id="bookForm" onSubmit="return ValidateForm()">
			<input style="width:1px; height:1px; position:absolute; left:-300px;" value="" maxlength="60" name="s_secret" type="text" />
            <table border="0" width="520">
              <tbody>
                <tr>
                  <td valign="top" width="40%">Apartments<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%">
                    {OPTIONS_PLACE}
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Arrival<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%"><input class="inp" onclick="displayCalendar(document.forms[\'bookForm\'].s_from_date,\'dd.mm.yyyy\',this)" readonly="readonly" name="s_from_date" size="32" value="{FROM_DATE}" style="width: 37%;" type="text">
                    &nbsp;<img src="{BASEURL}modules/media/ic_cal.gif" alt="" onclick="displayCalendar(document.forms[\'bookForm\'].s_from_date,\'dd.mm.yyyy\',this)" align="absmiddle" height="18" width="18">
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Departure<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%"><input class="inp" onclick="displayCalendar(document.forms[\'bookForm\'].s_to_date,\'dd.mm.yyyy\',this)" readonly="readonly" name="s_to_date" size="32" value="{TO_DATE}" style="width: 37%;" type="text">
                    &nbsp;<img src="{BASEURL}modules/media/ic_cal.gif" alt="" onclick="displayCalendar(document.forms[\'bookForm\'].s_to_date,\'dd.mm.yyyy\',this)" style="" align="absmiddle" height="18" width="18">
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Adults&nbsp;:&nbsp;</td>
                  <td width="60%">
                    <select class="sel" width="20%" name="s_count_man">
                      <option value="0">0</option>
                      {ADULTS}
                    </select>
                    <img src="{BASEURL}modules/media/space.gif" alt="" border="0" height="1" width="115">Children&nbsp;:&nbsp;
                    <select class="sel" width="20%" name="s_count_child">
                      <option value="0">0</option>
                      {KIDS}
                    </select>
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Expected arrival time&nbsp;:&nbsp;</td>
                  <td width="60%">
                    <select class="sel" style="width: 40%;" name="s_time">
                      <option value="1">01:00</option>
                      <option value="2">02:00</option>
                      <option value="3">03:00</option>
                      <option value="4">04:00</option>
                      <option value="5">05:00</option>
                      <option value="6">06:00</option>
                      <option value="7">07:00</option>
                      <option value="8">08:00</option>
                      <option value="9">09:00</option>
                      <option value="10">10:00</option>
                      <option value="11">11:00</option>
                      <option value="12">12:00</option>
                      <option value="13">13:00</option>
                      <option value="14" selected="selected">14:00</option>
                      <option value="15">15:00</option>
                      <option value="16">16:00</option>
                      <option value="17">17:00</option>
                      <option value="18">18:00</option>
                      <option value="19">19:00</option>
                      <option value="20">20:00</option>
                      <option value="21">21:00</option>
                      <option value="22">22:00</option>
                      <option value="23">23:00</option>
                      <option value="24">24:00</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">To address&nbsp;:&nbsp;</td>
                  <td width="60%">
                    <select class="sel" style="width: 40%;" name="s_mr_ms">
                      <option value="1" selected="selected">Mr.</option>
                      <option value="0">Ms.</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">First name<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%"><input class="inp" name="s_first_name" size="52" style="width: 100%;" type="text"></td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Second name<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%"><input class="inp" name="s_last_name" size="52" style="width: 100%;" type="text"></td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Country<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%"><input class="inp" name="s_country" size="52" style="width: 100%;" type="text"></td>
                </tr>
                <tr>
                  <td valign="top">Mobile Phone<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td><input class="inp" name="s_mobile_phone" size="52" style="width: 100%;" type="text" value="+"></td>
                </tr>
                <tr>
                  <td valign="top">E-mail<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td><input class="inp" name="s_email" size="52" style="width: 100%;" type="text"></td>
                </tr>
                <tr>
                  <td valign="top">Comments and wishes&nbsp;:&nbsp;</td>
                  <td><textarea class="t_inp" name="s_comments" cols="41" rows="3" style="width: 100%;"></textarea></td>
                </tr>
                
                <tr>
                  <td colspan="2" valign="top" style="padding:7px 0px; line-height:20px;">
                    <b>Ordering additional services&nbsp;:&nbsp;</b>
                    <div style="padding-left:10px; font-size:12px;">
                    <input class="inp" name="s_pickup1" type="checkbox" value="1"> Borispol airport pick-up and transfer to the apartment ({TRANSFER_PRICE} USD)
                    <br /><input class="inp" name="s_pickup2" type="checkbox" value="1"> Railway or bus station pickup and transfer to the apartment (15 USD)
                    <br /><input class="inp" name="s_excursions" type="checkbox" value="1"> Booking of excursion (0 USD)
                    </div>
                  </td>
                </tr>
                
                <tr>
                  <td colspan="2" align="center">
                    <div style="color: #FF0000; padding-bottom: 14px;">* Required fields</div>
                    <input class="button" value="Submit" type="submit">
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        <p class="clear" style=" padding-left:120px;"><img alt="rent apartments in kiev" src="{BASEURL}modules/media/underline.gif" height="32" width="310"></p>    
        </div>
        <!-- Book Apartment Form END -->    
          


';
$_LANG['booking_form_m']		= '


        <!-- Book Apartment Form BEGIN -->    
		<script language = "Javascript">
            // Declaring required variables
            var digits = "0123456789";
            // non-digit characters which are allowed in phone numbers
            var phoneNumberDelimiters = "()- ";
            // characters which are allowed in international phone numbers
            // (a leading + is OK)
            var validWorldPhoneChars = phoneNumberDelimiters + "+";
            // Minimum no of digits in an international phone no.
            var minDigitsInIPhoneNumber = 7;
            
            function isInteger(s)
            {   var i;
                for (i = 0; i < s.length; i++)
                {   
                    // Check that current character is number.
                    var c = s.charAt(i);
                    if (((c < "0") || (c > "9"))) return false;
                }
                // All characters are numbers.
                return true;
            }
            function trim(s)
            {   var i;
                var returnString = "";
                // Search through string\'s characters one by one.
                // If character is not a whitespace, append to returnString.
                for (i = 0; i < s.length; i++)
                {   
                    // Check that current character isn\'t whitespace.
                    var c = s.charAt(i);
                    if (c != " ") returnString += c;
                }
                return returnString;
            }
            function stripCharsInBag(s, bag)
            {   var i;
                var returnString = "";
                // Search through string\'s characters one by one.
                // If character is not in bag, append to returnString.
                for (i = 0; i < s.length; i++)
                {   
                    // Check that current character isn\'t whitespace.
                    var c = s.charAt(i);
                    if (bag.indexOf(c) == -1) returnString += c;
                }
                return returnString;
            }
            
            function checkInternationalPhone(strPhone){
                var bracket=3
                strPhone=trim(strPhone)
                if(strPhone.indexOf("+")>1) return false
                if(strPhone.indexOf("-")!=-1)bracket=bracket+1
                if(strPhone.indexOf("(")!=-1 && strPhone.indexOf("(")>bracket)return false
                if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)return false
                s=stripCharsInBag(strPhone,validWorldPhoneChars);
                return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
            }
            
            function ValidateForm(){
                var Apartment=document.bookForm.s_apartment
                if ((Apartment.value==null)||(Apartment.value==0)){
                    alert("Please choose the apartment")
                    Apartment.focus()
                    return false
                }
        
                var First_Name=document.bookForm.s_first_name
                if ((First_Name.value==null)||(First_Name.value=="")){
                    alert("Minimal length of the name is 3 symbols")
                    First_Name.focus()
                    return false
                }
        
                var Last_Name=document.bookForm.s_last_name
                if ((Last_Name.value==null)||(Last_Name.value=="")){
                    alert("Minimal length of the surname is 3 symbols")
                    Last_Name.focus()
                    return false
                }
        
                var Country=document.bookForm.s_country
                if ((Country.value==null)||(Country.value=="")){
                    alert("Minimal length of the country is 3 symbols")
                    Country.focus()
                    return false
                }
        
                var Mobile_Phone=document.bookForm.s_mobile_phone
                if ((Mobile_Phone.value==null)||(Mobile_Phone.value=="")){
                    alert("Minimal length of the phone (mob.) is 7 symbols")
                    Mobile_Phone.focus()
                    return false
                }
                if (checkInternationalPhone(Mobile_Phone.value)==false){
                    alert("Minimal length of the phone (mob.) is 7 symbols")
                    Mobile_Phone.value=""
                    Mobile_Phone.focus()
                    return false
                }
        
                var Email=document.bookForm.s_email
                if ((Email.value==null)||(Email.value=="")){
                    alert("Please enter the correct email")
                    Email.focus()
                    return false
                }
                
                return true
             }
        </script>
          
        <div style="padding: 0px 10px 20px 20px;">
          Please fill out the form and we will contact you shortly. Items highlighted with an asterisk are required.
          <br />
          <br />
          <form method="post" action="{URL}order/" name="bookForm" id="bookForm" onSubmit="return ValidateForm()">
			<input style="width:1px; height:1px; position:absolute; left:-300px;" value="" maxlength="60" name="s_secret" type="text" />
            <table border="0" width="100%">
              <tbody>
                <tr>
                  <td valign="top" width="40%">Apartments<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="100%">
                    {OPTIONS_PLACE}
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Arrival<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%"><input class="inp" readonly="readonly" name="s_from_date" size="32" value="{FROM_DATE}" style="width: 100%;" type="text">
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Departure<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%"><input class="inp" readonly="readonly" name="s_to_date" size="32" value="{TO_DATE}" style="width: 100%;" type="text">
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Adults&nbsp;:&nbsp;</td>
                  <td width="60%">
                    <select class="sel" width="100%" name="s_count_man">
                      <option value="0">0</option>
                      {ADULTS}
                    </select>
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Children&nbsp;:&nbsp;</td>
                  <td width="60%">
                    <select class="sel" width="100%" name="s_count_child">
                      <option value="0">0</option>
                      {KIDS}
                    </select>
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Expected arrival time&nbsp;:&nbsp;</td>
                  <td width="60%">
                    <select class="sel" style="width: 100%;" name="s_time">
                      <option value="1">01:00</option>
                      <option value="2">02:00</option>
                      <option value="3">03:00</option>
                      <option value="4">04:00</option>
                      <option value="5">05:00</option>
                      <option value="6">06:00</option>
                      <option value="7">07:00</option>
                      <option value="8">08:00</option>
                      <option value="9">09:00</option>
                      <option value="10">10:00</option>
                      <option value="11">11:00</option>
                      <option value="12">12:00</option>
                      <option value="13">13:00</option>
                      <option value="14" selected="selected">14:00</option>
                      <option value="15">15:00</option>
                      <option value="16">16:00</option>
                      <option value="17">17:00</option>
                      <option value="18">18:00</option>
                      <option value="19">19:00</option>
                      <option value="20">20:00</option>
                      <option value="21">21:00</option>
                      <option value="22">22:00</option>
                      <option value="23">23:00</option>
                      <option value="24">24:00</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">To address&nbsp;:&nbsp;</td>
                  <td width="60%">
                    <select class="sel" style="width: 40%;" name="s_mr_ms">
                      <option value="1" selected="selected">Mr.</option>
                      <option value="0">Ms.</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">First name<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%"><input class="inp" name="s_first_name" size="52" style="width: 100%;" type="text"></td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Second name<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%"><input class="inp" name="s_last_name" size="52" style="width: 100%;" type="text"></td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Country<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%"><input class="inp" name="s_country" size="52" style="width: 100%;" type="text"></td>
                </tr>
                <tr>
                  <td valign="top">Mobile Phone<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td><input class="inp" name="s_mobile_phone" size="52" style="width: 100%;" type="text" value="+"></td>
                </tr>
                <tr>
                  <td valign="top">E-mail<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td><input class="inp" name="s_email" size="52" style="width: 100%;" type="text"></td>
                </tr>
                <tr>
                  <td valign="top">Comments and wishes&nbsp;:&nbsp;</td>
                  <td><textarea class="t_inp" name="s_comments" cols="41" rows="3" style="width: 100%;"></textarea></td>
                </tr>
                
                <tr>
                  <td colspan="2" valign="top" style="padding:7px 0px; line-height:20px;">
                    <b>Ordering additional services&nbsp;:&nbsp;</b>
                    <div style="padding-left:10px; font-size:16px;">
                    <input class="inp" name="s_pickup1" type="checkbox" value="1"> Borispol airport pick-up and transfer to the apartment ({TRANSFER_PRICE} USD)
                    <br /><input class="inp" name="s_pickup2" type="checkbox" value="1"> Railway or bus station pickup and transfer to the apartment (15 USD)
                    <br /><input class="inp" name="s_excursions" type="checkbox" value="1"> Booking of excursion (0 USD)
                    </div>
                  </td>
                </tr>
                
                <tr>
                  <td colspan="2" align="center">
                    <div style="color: #FF0000; padding-bottom: 14px;">* Required fields</div>
                    <input class="button" value="Submit" type="submit">
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        <p class="clear" style="text-align:center;"><img alt="rent apartments in kiev" src="{BASEURL}modules/media/underline.gif" width="250"></p>    
        </div>
        <!-- Book Apartment Form END -->    
          


';



//desktop version
$_LANG['services_form']		= '
        <!-- Services Form BEGIN -->    
          
		<strong>Your apartment and arrival preferences were sent to us. 
		<br>Our manager will contact you soon ;)</strong>
		<br>
		<br>
          
          
		<h2 style="margin-top:0px; margin-bottom:15px;">
			<span style="color: #ec0606;">STOP! Don\'t miss your chance to SAVE 50%!</span>
		</h2>
		<h4>
			Make your stay more comfortable by using our additional services and SAVE BIG!
		</h4>
       

        <form method="post" action="{URL}order/" name="servicesForm" id="servicesForm">
        <input type="hidden" name="v_services" value="1">
		<!-- INFO_STRING -->
        <div style="margin-bottom:10px;">
            <div style="float:left; padding-left:20px; padding-top:2px;">
                <input name="v_city_tour" type="checkbox" value="1">
            </div>
            <div style="float:left; padding-left:10px; width:550px">
                <strong style="font-size:20px; background-color: #FF0;">Three hour old and modern Kiev city tour by car with our professional English speaking tour guide</strong>
                <img style="float:right; padding-left:10px; padding-top:5px;" src="{BASEURL}modules/media/services/1.jpg" width="160px" alt="" />
                <br>
                <b>WHY?</b> 
                <br>To see all interesting and exciting places of Kiev in just three hours in a company of our professional tour guide
                <br>
                <b>PRICE:</b>
                <br>
                <span class="newprice">50$/hour</span> <span class="oldprice">70$/hour</span> for a group of up to 3 people, min 3 hours of excursion and transportation by car
            </div>
            <br clear="all">
        </div>
    
        <div style="margin-bottom:10px;">
            <div style="float:left; padding-left:20px; padding-top:2px;">
                <input name="v_street_photo" type="checkbox" value="1">
            </div>
            <div style="float:left; padding-left:10px; width:550px">
                <strong style="font-size:20px; background-color: #FF0;">Professional photo session on streets of Kiev or in ancient buildings with photographer</strong>
                <img style="float:right; padding-left:10px; padding-top:5px;" src="{BASEURL}modules/media/services/2.jpg" width="160px" alt="" />
                <br>
                <b>WHY?</b> 
                <br>To keep really nice memories from time spent in Kiev;) for yourself and your family or friends
                <br>
                <b>PRICE:</b>
                <br>
                <span class="newprice">100$</span> <span class="oldprice">130$</span> for up to 2 hours photo session
            </div>
            <br clear="all">
        </div>
    
        <div style="margin-bottom:10px;">
            <div style="float:left; padding-left:20px; padding-top:2px;">
                <input name="v_private_chef" type="checkbox" value="1">
            </div>
            <div style="float:left; padding-left:10px; width:550px">
                <strong style="font-size:20px; background-color: #FF0;">Private Chef: tasty Ukrainian traditional dishes can be cooked in the apartment or at home and delivered fresh to your table by our chef Galyna</strong>
                <img style="float:right; padding-left:10px; padding-top:5px;" src="{BASEURL}modules/media/services/3.jpg" width="160px" alt="" />
                <br>
                <b>WHY?</b> 
                <br>To feel the real taste of Ukrainian traditional kitchen;)
                <br>
                <b>PRICE:</b>
                <br>
                <span class="newprice">40$</span> <span class="oldprice">50$</span> per cooking session + cost of products
            </div>
            <br clear="all">
        </div>
    
        <div style="margin-bottom:10px;">
            <div style="float:left; padding-left:20px; padding-top:2px;">
                <input name="v_food_delivery" type="checkbox" value="1">
            </div>
            <div style="float:left; padding-left:10px; width:550px">
                <strong style="font-size:20px; background-color: #FF0;">Food/Grocery delivery to your apartment</strong>
                <img style="float:right; padding-left:10px; padding-top:5px;" src="{BASEURL}modules/media/services/6.jpg" width="160px" alt="" />
                <br>
                <b>WHY?</b> 
                <br>If you want to use your time efficiently and enjoy your stay, you can email us your shopping list or call our manager to do the grocery shopping for you, and the food will be delivered directly to your apartment
                <br>
                <b>PRICE:</b>
                <br>
                <span class="newprice">15$</span> <span class="oldprice">20$</span> per delivery
            </div>
            <br clear="all">
        </div>
    
        <div style="margin-bottom:10px;">
            <div style="float:left; padding-left:20px; padding-top:2px;">
                <input name="v_english_driver" type="checkbox" value="1">
            </div>
            <div style="float:left; padding-left:10px; width:550px">
                <strong style="font-size:20px; background-color: #FF0;">Private English speaking driver</strong>
                <img style="float:right; padding-left:10px; padding-top:5px;" src="{BASEURL}modules/media/services/8.jpg" width="160px" alt="" />
                <br>
                <b>WHY?</b> 
                <br>To have a professional driver with a car who speaks English and can accompany you to make your business and travel plans real
                <br>
                <b>PRICE:</b>
                <br>
                <span class="newprice">30$</span> <span class="oldprice">45$</span> per hour
            </div>
            <br clear="all">
        </div>
        
        <div style="margin-bottom:10px;">
            <div style="float:left; padding-left:20px; padding-top:2px;">
                <input name="v_limousine" type="checkbox" value="1">
            </div>
            <div style="float:left; padding-left:10px; width:550px">
                <strong style="font-size:20px; background-color: #FF0;">Limousine service</strong>
                <img style="float:right; padding-left:10px; padding-top:5px;" src="{BASEURL}modules/media/services/7.jpg" width="160px" alt="" />
                <br>
                <b>WHY?</b> 
                <br>To impress your business partners or make your stay in Kiev not only enjoyable, but unforgettable!
                <br>
                <b>PRICE:</b>
                <br>
                <span class="newprice">99$</span> <span class="oldprice">120$</span> per hour or 249$ for transfer from the airport in a limousine
            </div>
            <br clear="all">
        </div>
    
        <div style="margin-bottom:20px;">
            <div style="float:left; padding-left:20px; padding-top:2px;">
                <input name="v_free_airport" type="checkbox" value="1">
            </div>
            <div style="float:left; padding-left:10px; width:550px">
                <strong style="font-size:20px; background-color: #FF0;">Free airport pickup, if apartment is booked for more than 5 days at a listed price</strong>
                <img style="float:right; padding-left:10px; padding-top:5px;" src="{BASEURL}modules/media/services/9.jpg" width="160px" alt="" />
                <br>
                <b>WHY?</b> 
                <br>We take care about our customers;)
                <br>
                <b>PRICE:</b>
                <br>
                <span class="newprice">0$</span> <span class="oldprice">30$</span> per transfer
            </div>
            <br clear="all">
        </div>
     
        <div style="margin:10px; text-align:center;">
              <input class="button" value=" Add services" name="submit" type="submit"><br><br>
              <a href="{BASEURL}" style="font-size:12px;">No, thanks</a>
        </div>
       
        </form>
        <!-- END Services Form -->    

';


//mobile version
$_LANG['services_form_m']		= '
        <!-- Services Form BEGIN -->    
          
		<strong>Your apartment and arrival preferences were sent to us. 
		<br>Our manager will contact you soon ;)</strong>
		<br>
		<br>
          
          
		<h2 style="margin-top:0px; margin-bottom:15px;">
			<span style="color: #ec0606;">STOP! Don\'t miss your chance to SAVE 50%!</span>
		</h2>
		<h4>
			Make your stay more comfortable by using our additional services and SAVE BIG!
		</h4>
       

        <form method="post" action="{URL}order/" name="servicesForm" id="servicesForm">
        <input type="hidden" name="v_services" value="1">
		<!-- INFO_STRING -->
        <div style="margin-bottom:10px;">
            <div style="float:left; padding-left:20px; padding-top:2px;">
                <input name="v_city_tour" type="checkbox" value="1">
            </div>
            <div style="float:left; padding-left:10px; width:250px">
                <strong style="font-size:20px; background-color: #FF0;">Three hour old and modern Kiev city tour by car with our professional English speaking tour guide</strong>
                <img style="float:right; padding-left:10px; padding-top:5px;" src="{BASEURL}modules/media/services/1.jpg" width="160px" alt="" />
                <br>
                <b>WHY?</b> 
                <br>To see all interesting and exciting places of Kiev in just three hours in a company of our professional tour guide
                <br>
                <b>PRICE:</b>
                <br>
                <span class="newprice">50$/hour</span> <span class="oldprice">70$/hour</span> for a group of up to 3 people, min 3 hours of excursion and transportation by car
            </div>
            <br clear="all">
        </div>
    
        <div style="margin-bottom:10px;">
            <div style="float:left; padding-left:20px; padding-top:2px;">
                <input name="v_street_photo" type="checkbox" value="1">
            </div>
            <div style="float:left; padding-left:10px; width:250px">
                <strong style="font-size:20px; background-color: #FF0;">Professional photo session on streets of Kiev or in ancient buildings with photographer</strong>
                <img style="float:right; padding-left:10px; padding-top:5px;" src="{BASEURL}modules/media/services/2.jpg" width="160px" alt="" />
                <br>
                <b>WHY?</b> 
                <br>To keep really nice memories from time spent in Kiev;) for yourself and your family or friends
                <br>
                <b>PRICE:</b>
                <br>
                <span class="newprice">100$</span> <span class="oldprice">130$</span> for up to 2 hours photo session
            </div>
            <br clear="all">
        </div>
    
        <div style="margin-bottom:10px;">
            <div style="float:left; padding-left:20px; padding-top:2px;">
                <input name="v_private_chef" type="checkbox" value="1">
            </div>
            <div style="float:left; padding-left:10px; width:250px">
                <strong style="font-size:20px; background-color: #FF0;">Private Chef: tasty Ukrainian traditional dishes can be cooked in the apartment or at home and delivered fresh to your table by our chef Galyna</strong>
                <img style="float:right; padding-left:10px; padding-top:5px;" src="{BASEURL}modules/media/services/3.jpg" width="160px" alt="" />
                <br>
                <b>WHY?</b> 
                <br>To feel the real taste of Ukrainian traditional kitchen;)
                <br>
                <b>PRICE:</b>
                <br>
                <span class="newprice">40$</span> <span class="oldprice">50$</span> per cooking session + cost of products
            </div>
            <br clear="all">
        </div>
    
        <div style="margin-bottom:10px;">
            <div style="float:left; padding-left:20px; padding-top:2px;">
                <input name="v_food_delivery" type="checkbox" value="1">
            </div>
            <div style="float:left; padding-left:10px; width:250px">
                <strong style="font-size:20px; background-color: #FF0;">Food/Grocery delivery to your apartment</strong>
                <img style="float:right; padding-left:10px; padding-top:5px;" src="{BASEURL}modules/media/services/6.jpg" width="160px" alt="" />
                <br>
                <b>WHY?</b> 
                <br>If you want to use your time efficiently and enjoy your stay, you can email us your shopping list or call our manager to do the grocery shopping for you, and the food will be delivered directly to your apartment
                <br>
                <b>PRICE:</b>
                <br>
                <span class="newprice">15$</span> <span class="oldprice">20$</span> per delivery
            </div>
            <br clear="all">
        </div>
    
        <div style="margin-bottom:10px;">
            <div style="float:left; padding-left:20px; padding-top:2px;">
                <input name="v_english_driver" type="checkbox" value="1">
            </div>
            <div style="float:left; padding-left:10px; width:250px">
                <strong style="font-size:20px; background-color: #FF0;">Private English speaking driver</strong>
                <img style="float:right; padding-left:10px; padding-top:5px;" src="{BASEURL}modules/media/services/8.jpg" width="160px" alt="" />
                <br>
                <b>WHY?</b> 
                <br>To have a professional driver with a car who speaks English and can accompany you to make your business and travel plans real
                <br>
                <b>PRICE:</b>
                <br>
                <span class="newprice">30$</span> <span class="oldprice">45$</span> per hour
            </div>
            <br clear="all">
        </div>
        
        <div style="margin-bottom:10px;">
            <div style="float:left; padding-left:20px; padding-top:2px;">
                <input name="v_limousine" type="checkbox" value="1">
            </div>
            <div style="float:left; padding-left:10px; width:250px">
                <strong style="font-size:20px; background-color: #FF0;">Limousine service</strong>
                <img style="float:right; padding-left:10px; padding-top:5px;" src="{BASEURL}modules/media/services/7.jpg" width="160px" alt="" />
                <br>
                <b>WHY?</b> 
                <br>To impress your business partners or make your stay in Kiev not only enjoyable, but unforgettable!
                <br>
                <b>PRICE:</b>
                <br>
                <span class="newprice">99$</span> <span class="oldprice">120$</span> per hour or 249$ for transfer from the airport in a limousine
            </div>
            <br clear="all">
        </div>
    
        <div style="margin-bottom:20px;">
            <div style="float:left; padding-left:20px; padding-top:2px;">
                <input name="v_free_airport" type="checkbox" value="1">
            </div>
            <div style="float:left; padding-left:10px; width:250px">
                <strong style="font-size:20px; background-color: #FF0;">Free airport pickup, if apartment is booked for more than 5 days at a listed price</strong>
                <img style="float:right; padding-left:10px; padding-top:5px;" src="{BASEURL}modules/media/services/9.jpg" width="160px" alt="" />
                <br>
                <b>WHY?</b> 
                <br>We take care about our customers;)
                <br>
                <b>PRICE:</b>
                <br>
                <span class="newprice">0$</span> <span class="oldprice">30$</span> per transfer
            </div>
            <br clear="all">
        </div>
     
        <div style="margin:10px; text-align:center;">
              <input class="button" value=" Add services" name="submit" type="submit"><br><br>
              <a href="{BASEURL}" style="font-size:12px;">No, thanks</a>
        </div>
       
        </form>
        <!-- END Services Form -->    

';




//desktop prepay form
$_LANG['prepay_form']		= '

        <!-- Prepay Form BEGIN -->    
 
          <script language = "Javascript">
	 
            function ValidatePrepForm1(){
        
                var Name=document.prepaymentForm1.amount
                if ((Name.value==null)||(Name.value==0)){
                    alert("Please select the apartment")
                    Name.focus()
                    return false
                }
                
                return true
             }
		 
            function ValidatePrepForm2(){
        
                var Name=document.prepaymentForm2.amount
                if ((Name.value==null)||(Name.value==0)){
                    alert("Please specify the amount")
                    Name.focus()
                    return false
                }
                
                return true
             }
		 
            function ValidatePrepForm3(){
        
                var Name=document.prepaymentForm3.amount
                if ((Name.value==null)||(Name.value==0)){
                    alert("Please select the apartment")
                    Name.focus()
                    return false
                }
                
                return true
             }
		 
            function ValidatePrepForm4(){
        
                var Name=document.prepaymentForm4.amount
                if ((Name.value==null)||(Name.value==0)){
                    alert("Please specify the amount")
                    Name.focus()
                    return false
                }
                
                return true
             }
		 
          </script>

 


          <a name="prepay"></a>
          <h2 style="margin-top:0px; margin-bottom:15px;">
              <a href="" name="book"></a>Prepayment
          </h2>
        
          After our managers have confirmed your reservation, you can prepay for the first day of your stay to guarantee the availability of your apartment. You may choose the most convenient payment option or you. 
		  <br />
		  <br />
		  We accept major credit cards, via PayPal, plus instant bank wire transfers, and other prepayment options. If you need any assistance while making the prepayment, feel free to send us an email or call our office at {SECOND_PHONE}. 
		  <br />
		  <br />
		  Please inform us right after the prepayment was done, so that we could check it and confirm the transaction.
		  <br /><br />
		  <br /><br />




		  <div><strong><u>Option #1: Prepay using your Visa or Master Card via Paypal payment gate</u></strong><br>
		  <em>Powered by SMV Foundation.</em></div>


          <div style="padding-bottom: 14px; padding-top:5px;">
                <img src="{BASEURL}modules/media/pay_pal.gif" alt="" border="0"> &nbsp;&nbsp;
                <img src="{BASEURL}modules/media/pay_pal_ver.gif" alt="" border="0"> &nbsp;&nbsp;
          </div>


		  <form name="prepaymentForm1" action="{URL}paypal/" onsubmit="return ValidatePrepForm1()" method="post" enctype="application/x-www-form-urlencoded" accept-charset="utf-8">
		  
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="selfmadevip@gmail.com">
			<input type="hidden" name="item_name" value="Prepayment for the first night at Luxury Kiev Apartment (processed via the account of our partner SelfMadeVIP Foundation)">
			<input type="hidden" name="return" value="{URL}">
			<input type="hidden" name="no_shipping" value="1">
 
 			<input style="width:1px; height:1px; position:absolute; left:-300px;" value="" maxlength="60" name="s_secret" type="text" />
            <table border="0" width="520">
              <tbody>

                <tr>
                  <td valign="top" width="40%">Booked apartment<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%">
                    <select class="sel" id="amount" name="amount" style="width: 100%;">

                        <option value="0" selected="selected">Select an apartment</option>
                        {PREPAY_FORM_OPTIONS}

                    </select>
                  </td>
                </tr>
				
<!--
				<tr>
                  <td valign="top" width="40%">Currency of payment<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%">
                    <select class="sel" id="currency_code" name="currency_code" style="width: 100%;">

						<option value="USD" selected="selected">USD&nbsp;&ndash;&nbsp;$</option>
						<option value="EUR">EUR&nbsp;&ndash;&nbsp;&euro;</option>

                    </select>
                  </td>
                </tr>
-->				
				
                <tr>
                  <td colspan="2" align="center">
	                <br />
                    <input class="button" value="Prepay..." type="submit">
                  </td>
                </tr>

              </tbody>

            </table>
            
          </form>
		  <br />
		  
		  
		  <form name="prepaymentForm2" action="{URL}paypal/" onsubmit="return ValidatePrepForm2()" method="post" enctype="application/x-www-form-urlencoded" accept-charset="utf-8">
		  
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="selfmadevip@gmail.com">
			<input type="hidden" name="item_name" value="Prepayment for the first night at Luxury Kiev Apartment (processed via the account of our partner SelfMadeVIP Foundation)">
			<input type="hidden" name="return" value="{URL}">
			<input type="hidden" name="no_shipping" value="1">

            <input style="width:1px; height:1px; position:absolute; left:-300px;" value="" maxlength="60" name="s_secret" type="text" />
            <table border="0" width="520">
              <tbody>

                <tr>
                  <td valign="top" width="40%"><b>...or specify the amount</b><span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%">
                  	<input class="inp" id="amount" name="amount" size="52" style="width: 20%;" type="text">&nbsp;&nbsp;</td>
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Currency of payment<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%">
                    <select class="sel" id="currency_code" name="currency_code" style="width: 100%;">

						<option value="USD" selected="selected">USD&nbsp;&ndash;&nbsp;$</option>
						<option value="EUR">EUR&nbsp;&ndash;&nbsp;&euro;</option>

                    </select>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" align="center">
	                <br />
                    <input class="button" value="Prepay..." type="submit">
                  </td>
                </tr>

              </tbody>

            </table>
            
          </form>
	
		  <br /><br />
		  <br />






          <div style="font-style:italic; text-align:left; padding-top:12px;">You can also prepay with:
		  <br /><br />
		  
            &ndash; instant money transfer with <strong>Western Union</strong> at any bank located nearby (details can be clarified with our managers)<br />
            <img src="{BASEURL}modules/media/pay_wu.gif" alt="" border="0" style="margin-top:5px;">
			<br /><br />

			&ndash; instant payment via <strong>Webmoney</strong> transferring the specified amount directly to the account of Luxury Apartments (details can be clarified with our managers)<br />
            <img src="{BASEURL}modules/media/pay_wm.gif" alt="" border="0" style="margin-top:5px;">
			<br /><br />
			
            &ndash; <strong>cash</strong> in Kiev<br />
            <img src="{BASEURL}modules/media/pay_cash.jpg" alt="" border="0" style="margin-top:5px;"><br /><br />
			
		  </div>
		  <br />
		  
		  <br />
		  <br />
          <div style="font-style:italic; text-align:left; padding-top:12px;">
		  
            Prepayment serves for the company as a guarantee that the client will arrive and will pay for the booked period in full, and for the client as a guarantee that he or she will receive the agreed apartment for the agreed booked period. If the client does not show up on the booked day of arrival, the prepayment is kept by the company to cover the costs connected with this booking, and the booking is cancelled.
			
		  </div>

        <!-- Prepay Form END -->    
';




//mobile prepay form
$_LANG['prepay_form_m']		= '

        <!-- Prepay Form BEGIN -->    
 
          <script language = "Javascript">
	 
            function ValidatePrepForm1(){
        
                var Name=document.prepaymentForm1.amount
                if ((Name.value==null)||(Name.value==0)){
                    alert("Please select the apartment")
                    Name.focus()
                    return false
                }
                
                return true
             }
		 
            function ValidatePrepForm2(){
        
                var Name=document.prepaymentForm2.amount
                if ((Name.value==null)||(Name.value==0)){
                    alert("Please specify the amount")
                    Name.focus()
                    return false
                }
                
                return true
             }
		 
            function ValidatePrepForm3(){
        
                var Name=document.prepaymentForm3.amount
                if ((Name.value==null)||(Name.value==0)){
                    alert("Please select the apartment")
                    Name.focus()
                    return false
                }
                
                return true
             }
		 
            function ValidatePrepForm4(){
        
                var Name=document.prepaymentForm4.amount
                if ((Name.value==null)||(Name.value==0)){
                    alert("Please specify the amount")
                    Name.focus()
                    return false
                }
                
                return true
             }
		 
          </script>

 


          <a name="prepay"></a>
          <h2 style="margin-top:0px; margin-bottom:15px;">
              <a href="" name="book"></a>Prepayment
          </h2>
        
          After our managers have confirmed your reservation, you can prepay for the first day of your stay to guarantee the availability of your apartment. You may choose the most convenient payment option or you. 
		  <br />
		  <br />
		  We accept major credit cards, via PayPal, plus instant bank wire transfers, and other prepayment options. If you need any assistance while making the prepayment, feel free to send us an email or call our office at {SECOND_PHONE}. 
		  <br />
		  <br />
		  Please inform us right after the prepayment was done, so that we could check it and confirm the transaction.
		  <br /><br />
		  <br /><br />




		  <div><strong><u>Option #1: Prepay using your Visa or Master Card via Paypal payment gate</u></strong><br>
		  <em>Powered by SMV Foundation.</em></div>


          <div style="padding-bottom: 14px; padding-top:5px;">
                <img src="{BASEURL}modules/media/pay_pal.gif" alt="" border="0"> &nbsp;&nbsp;
                <img src="{BASEURL}modules/media/pay_pal_ver.gif" alt="" border="0"> &nbsp;&nbsp;
          </div>


		  <form name="prepaymentForm1" action="{URL}paypal/" onsubmit="return ValidatePrepForm1()" method="post" enctype="application/x-www-form-urlencoded" accept-charset="utf-8">
		  
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="selfmadevip@gmail.com">
			<input type="hidden" name="item_name" value="Prepayment for the first night at Luxury Kiev Apartment (processed via the account of our partner SelfMadeVIP Foundation)">
			<input type="hidden" name="return" value="{URL}">
			<input type="hidden" name="no_shipping" value="1">
 
 			<input style="width:1px; height:1px; position:absolute; left:-300px;" value="" maxlength="60" name="s_secret" type="text" />
            <table border="0" width="100%">
              <tbody>

                <tr>
                  <td valign="top" width="40%">Booked apartment<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%">
                    <select class="sel" id="amount" name="amount" style="width: 100%;">

                        <option value="0" selected="selected">Select an apartment</option>
                        {PREPAY_FORM_OPTIONS}

                    </select>
                  </td>
                </tr>
				
<!--
				<tr>
                  <td valign="top" width="40%">Currency of payment<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%">
                    <select class="sel" id="currency_code" name="currency_code" style="width: 100%;">

						<option value="USD" selected="selected">USD&nbsp;&ndash;&nbsp;$</option>
						<option value="EUR">EUR&nbsp;&ndash;&nbsp;&euro;</option>

                    </select>
                  </td>
                </tr>
-->				
				
                <tr>
                  <td colspan="2" align="center">
	                <br />
                    <input class="button" value="Prepay..." type="submit">
                  </td>
                </tr>

              </tbody>

            </table>
            
          </form>
		  <br />
		  
		  
		  <form name="prepaymentForm2" action="{URL}paypal/" onsubmit="return ValidatePrepForm2()" method="post" enctype="application/x-www-form-urlencoded" accept-charset="utf-8">
		  
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="selfmadevip@gmail.com">
			<input type="hidden" name="item_name" value="Prepayment for the first night at Luxury Kiev Apartment (processed via the account of our partner SelfMadeVIP Foundation)">
			<input type="hidden" name="return" value="{URL}">
			<input type="hidden" name="no_shipping" value="1">

            <input style="width:1px; height:1px; position:absolute; left:-300px;" value="" maxlength="60" name="s_secret" type="text" />
            <table border="0" width="100%">
              <tbody>

                <tr>
                  <td valign="top" width="40%"><b>...or specify the amount</b><span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%">
                  	<input class="inp" id="amount" name="amount" size="52" style="width: 100%;" type="text">&nbsp;&nbsp;</td>
                  </td>
                </tr>
                <tr>
                  <td valign="top" width="40%">Currency of payment<span style="color: #FF0000;">*</span>&nbsp;:&nbsp;</td>
                  <td width="60%">
                    <select class="sel" id="currency_code" name="currency_code" style="width: 100%;">

						<option value="USD" selected="selected">USD&nbsp;&ndash;&nbsp;$</option>
						<option value="EUR">EUR&nbsp;&ndash;&nbsp;&euro;</option>

                    </select>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" align="center">
	                <br />
                    <input class="button" value="Prepay..." type="submit">
                  </td>
                </tr>

              </tbody>

            </table>
            
          </form>
	
		  <br /><br />
		  <br />






          <div style="font-style:italic; text-align:left; padding-top:12px;">You can also prepay with:
		  <br /><br />
		  
            &ndash; instant money transfer with <strong>Western Union</strong> at any bank located nearby (details can be clarified with our managers)<br />
            <img src="{BASEURL}modules/media/pay_wu.gif" alt="" border="0" style="margin-top:5px;">
			<br /><br />

			&ndash; instant payment via <strong>Webmoney</strong> transferring the specified amount directly to the account of Luxury Apartments (details can be clarified with our managers)<br />
            <img src="{BASEURL}modules/media/pay_wm.gif" alt="" border="0" style="margin-top:5px;">
			<br /><br />
			
            &ndash; <strong>cash</strong> in Kiev<br />
            <img src="{BASEURL}modules/media/pay_cash.jpg" alt="" border="0" style="margin-top:5px;"><br /><br />
			
		  </div>
		  <br />
		  
		  <br />
		  <br />
          <div style="font-style:italic; text-align:left; padding-top:12px;">
		  
            Prepayment serves for the company as a guarantee that the client will arrive and will pay for the booked period in full, and for the client as a guarantee that he or she will receive the agreed apartment for the agreed booked period. If the client does not show up on the booked day of arrival, the prepayment is kept by the company to cover the costs connected with this booking, and the booking is cancelled.
			
		  </div>

        <!-- Prepay Form END -->    
';





//desktop version
$_LANG['search_form']		= '

        <!-- Search Apartment Form BEGIN -->
        
		<script language="Javascript">
            function SearchFormRedirect(){
                var UrlStringMain="{URL}best/"
                var UrlString=UrlStringMain
 
 				var s_mk=document.SearchForm.mk
                if (s_mk.checked != false){ UrlString += "mk_" + s_mk.value + "/"	}
 				var s_mm=document.SearchForm.mm
                if (s_mm.checked != false){ UrlString += "mm_" + s_mm.value + "/"	}
 				var s_ma=document.SearchForm.ma
                if (s_ma.checked != false){ UrlString += "ma_" + s_ma.value + "/"	}
				
				var s_r1=document.SearchForm.r1
                if (s_r1.checked != false){ UrlString += "r1_" + s_r1.value + "/"	}
 				var s_r2=document.SearchForm.r2
                if (s_r2.checked != false){ UrlString += "r2_" + s_r2.value + "/"	}
 				var s_r3=document.SearchForm.r3
                if (s_r3.checked != false){ UrlString += "r3_" + s_r3.value + "/"	}
 				var s_r4=document.SearchForm.r4
                if (s_r4.checked != false){ UrlString += "r4_" + s_r4.value + "/"	}

				var s_p=document.SearchForm.p
                if ((s_p.value!=null)&&(s_p.value!=0)&&(s_p.value!=1)){ UrlString += "p_" + s_p.value + "/"	}
				
				var s_s4=document.SearchForm.s4
                if (s_s4.checked != false){ UrlString += "s4_" + s_s4.value + "/"	}
				var s_s5=document.SearchForm.s5
                if (s_s5.checked != false){ UrlString += "s5_" + s_s5.value + "/"	}
				var s_s6=document.SearchForm.s6
                if (s_s6.checked != false){ UrlString += "s6_" + s_s6.value + "/"	}
				
				var s_pf=document.SearchForm.pf
                if ((s_pf.value!=null)&&(s_pf.value!=0)){ UrlString += "pf_" + s_pf.value + "/"	}
				var s_pt=document.SearchForm.pt
                if ((s_pt.value!=null)&&(s_pt.value!=0)){ UrlString += "pt_" + s_pt.value + "/"	}
				
				var s_spc=document.SearchForm.spc
                if (s_spc.checked != false){ UrlString += "spc_" + s_spc.value + "/"	}
				var s_spp=document.SearchForm.spp
                if (s_spp.checked != false){ UrlString += "spp_" + s_spp.value + "/"	}
				var s_spk=document.SearchForm.spk
                if (s_spk.checked != false){ UrlString += "spk_" + s_spk.value + "/"	}
				var s_sph=document.SearchForm.sph
                if (s_sph.checked != false){ UrlString += "sph_" + s_sph.value + "/"	}
				var s_spj=document.SearchForm.spj
                if (s_spj.checked != false){ UrlString += "spj_" + s_spj.value + "/"	}
				var s_spt=document.SearchForm.spt
                if (s_spt.checked != false){ UrlString += "spt_" + s_spt.value + "/"	}
				var s_sps=document.SearchForm.sps
                if (s_sps.checked != false){ UrlString += "sps_" + s_sps.value + "/"	}
				
 				var s_aptid=document.SearchForm.aptid
                if ((s_aptid.value!=null)&&(s_aptid.value!=0)){ UrlString = UrlStringMain + "aptid_" + s_aptid.value + "/"	}

				//alert(UrlString)

				document.SearchForm.action = UrlString
                return true
             }
        </script>
        
            
		<h3 id="menu_clear">Search form:</h3>
        <div style="padding: 0px 10px 0px 20px;">
					<form method="post" name="SearchForm" action="" onsubmit="return SearchFormRedirect()">
					<table cellpadding="5" cellspacing="0" class="catalogue" width="100%">
						<tbody style="background-color:#fdf8ea;">
                        <tr>
							<td width="33%">
								<div style="padding-bottom:4px;"><strong>Located in the very center of Kyiv and is closer to:</strong></div>
									<input name="mk" value="1" type="checkbox"{mk_CHECKED}> Khreshchatyk<br>
									<input name="mm" value="1" type="checkbox"{mm_CHECKED}> Independence Square<br>
									<input name="ma" value="1" type="checkbox"{ma_CHECKED}> Arena City<br>
									
                           		<br />
								<div style="padding-bottom:1px; padding-top:6px;"><strong>Search <u>by apartment ID#</u>:</strong></div>
                                <input class="inp" name="aptid" size="10" style="width: 98%;" type="text" value="{nu_NUMBER}">

							</td>
							<td width="33%">
                            	<div style="padding-bottom:3px;"><strong>Number of bedrooms:</strong></div>
									<input name="r1" value="1" type="checkbox"{rl_CHECKED}> Studio<br>
									<input name="r2" value="1" type="checkbox"{r2_CHECKED}> 1 bedroom<br>
									<input name="r3" value="1" type="checkbox"{r3_CHECKED}> 2 bedrooms<br>
									<input name="r4" value="1" type="checkbox"{r4_CHECKED}> 3 bedrooms<br>

                          		<br />
                            	<div style="padding-bottom:3px;">Sleeping places:</div>
                                <select class="sel" style="width: 53px;" name="p">
                                  <option value="1"{p1_SELECTED}>&gt;1</option>
                                  <option value="2"{p2_SELECTED}>&gt;2</option>
                                  <option value="3"{p3_SELECTED}>&gt;3</option>
                                  <option value="4"{p4_SELECTED}>&gt;4</option>
                                  <option value="5"{p5_SELECTED}>&gt;5</option>
                                  <option value="6"{p6_SELECTED}>&gt;6</option>
                                  <option value="7"{p7_SELECTED}>&gt;7</option>
                                  <option value="8"{p8_SELECTED}>&gt;8</option>
                                </select>

							</td>
							<td width="33%">
								<div style="padding-bottom:3px;"><strong>Our stars ;)</strong></div>
									<input name="s6" value="1" type="checkbox"{s6_CHECKED}> VIP class &nbsp;{STARS_6}<br>
									<input name="s5" value="1" type="checkbox"{s5_CHECKED}> Luxury class &nbsp;&nbsp;{STARS_5}<br>
									<input name="s4" value="1" type="checkbox"{s4_CHECKED}> Business class &nbsp;{STARS_4}<br>

                           		<br />
                            	<div style="padding-bottom:1px;">Price from, $:</div>
                                <input class="inp" name="pf" size="10" style="width: 98%;" type="text" value="{pf_VALUE}">

                           		<br />
								<div style="padding-bottom:1px; padding-top:5px;">Price to, $:</div>
                                <input class="inp" name="pt" size="10" style="width: 98%;" type="text" value="{pt_VALUE}">

							</td>
						</tr>
						<tr>
							<td colspan="3">
                            	<div style="padding-bottom:1px;">Our Features:</div>
                                <div style="font-size:10px;padding-bottom:1px;">
									<input name="spc" value="1" type="checkbox"{spc_CHECKED}> Air conditioning
									<input name="spp" value="1" type="checkbox"{spp_CHECKED}> Plasma TV
									<input name="spk" value="1" type="checkbox"{spk_CHECKED}> Fireplace
									<input name="sph" value="1" type="checkbox"{sph_CHECKED}> Hidromassage
									<input name="spj" value="1" type="checkbox"{spj_CHECKED}> Jacuzzi
									<input name="spt" value="1" type="checkbox"{spt_CHECKED}> Home Theater
									<input name="sps" value="1" type="checkbox"{sps_CHECKED}> Sauna
                                </div>
							</td>
						</tr>
					</tbody>
                </table>
                <div style="float:left; padding-top:5px; font-size:11px;"><em>* please choose one or more options</em></div>
                <div style="float:right; padding-top:5px;"><input class="button" value="Search" type="submit"></div>
               	<div style="float:right; padding-top:5px; padding-right:10px;"><input class="button" value="Reset" type="reset" onclick="document.location.href = \'{URL}best/\'"></div>
                <br clear="all"/>
				</form>

        </div>  
        <!-- Search Apartment Form END -->    
';


//mobile version
$_LANG['search_form_m']		= '

        <!-- Search Apartment Form BEGIN -->
        
		<script language="Javascript">
            function SearchFormRedirect(){
                var UrlStringMain="{URL}best/"
                var UrlString=UrlStringMain
 
 				var s_mk=document.SearchForm.mk
                if (s_mk.checked != false){ UrlString += "mk_" + s_mk.value + "/"	}
 				var s_mm=document.SearchForm.mm
                if (s_mm.checked != false){ UrlString += "mm_" + s_mm.value + "/"	}
 				var s_ma=document.SearchForm.ma
                if (s_ma.checked != false){ UrlString += "ma_" + s_ma.value + "/"	}
				
				var s_r1=document.SearchForm.r1
                if (s_r1.checked != false){ UrlString += "r1_" + s_r1.value + "/"	}
 				var s_r2=document.SearchForm.r2
                if (s_r2.checked != false){ UrlString += "r2_" + s_r2.value + "/"	}
 				var s_r3=document.SearchForm.r3
                if (s_r3.checked != false){ UrlString += "r3_" + s_r3.value + "/"	}
 				var s_r4=document.SearchForm.r4
                if (s_r4.checked != false){ UrlString += "r4_" + s_r4.value + "/"	}

				var s_p=document.SearchForm.p
                if ((s_p.value!=null)&&(s_p.value!=0)&&(s_p.value!=1)){ UrlString += "p_" + s_p.value + "/"	}
				
				var s_s4=document.SearchForm.s4
                if (s_s4.checked != false){ UrlString += "s4_" + s_s4.value + "/"	}
				var s_s5=document.SearchForm.s5
                if (s_s5.checked != false){ UrlString += "s5_" + s_s5.value + "/"	}
				var s_s6=document.SearchForm.s6
                if (s_s6.checked != false){ UrlString += "s6_" + s_s6.value + "/"	}
				
				var s_pf=document.SearchForm.pf
                if ((s_pf.value!=null)&&(s_pf.value!=0)){ UrlString += "pf_" + s_pf.value + "/"	}
				var s_pt=document.SearchForm.pt
                if ((s_pt.value!=null)&&(s_pt.value!=0)){ UrlString += "pt_" + s_pt.value + "/"	}

 				var s_aptid=document.SearchForm.aptid
                if ((s_aptid.value!=null)&&(s_aptid.value!=0)){ UrlString = UrlStringMain + "aptid_" + s_aptid.value + "/"	}

 				//alert(UrlString)

				document.SearchForm.action = UrlString
                return true
             }
        </script>
        
            
		<h3 id="menu_clear">Search form:</h3>
        <div style="padding: 0px 10px 0px 20px;">
					<form method="post" name="SearchForm" action="" onsubmit="return SearchFormRedirect()">
					<table cellpadding="5" cellspacing="0" class="catalogue" width="100%">
						<tbody style="background-color:#fdf8ea;">
                        <tr>
							<td width="33%">
								<div style="padding-bottom:4px;"><strong>Located in the very center of Kyiv and is closer to:</strong></div>
									<input name="mk" value="1" type="checkbox"{mk_CHECKED}> Khreshchatyk<br>
									<input name="mm" value="1" type="checkbox"{mm_CHECKED}> Independence Square<br>
									<input name="ma" value="1" type="checkbox"{ma_CHECKED}> Arena City<br>
									
                           		<br />
								<div style="padding-bottom:1px; padding-top:6px;"><strong>Search <u>by apartment ID#</u>:</strong></div>
                                <input class="inp" name="aptid" size="10" style="width: 98%;" type="text" value="{nu_NUMBER}">

							</td>
							<td width="33%">
                            	<div style="padding-bottom:3px;"><strong>Number of bedrooms:</strong></div>
									<input name="r1" value="1" type="checkbox"{rl_CHECKED}> Studio<br>
									<input name="r2" value="1" type="checkbox"{r2_CHECKED}> 1 bedroom<br>
									<input name="r3" value="1" type="checkbox"{r3_CHECKED}> 2 bedrooms<br>
									<input name="r4" value="1" type="checkbox"{r4_CHECKED}> 3 bedrooms<br>

                          		<br />
                            	<div style="padding-bottom:3px;">Sleeping places:</div>
                                <select class="sel" style="width: 53px;" name="p">
                                  <option value="1"{p1_SELECTED}>&gt;1</option>
                                  <option value="2"{p2_SELECTED}>&gt;2</option>
                                  <option value="3"{p3_SELECTED}>&gt;3</option>
                                  <option value="4"{p4_SELECTED}>&gt;4</option>
                                  <option value="5"{p5_SELECTED}>&gt;5</option>
                                  <option value="6"{p6_SELECTED}>&gt;6</option>
                                  <option value="7"{p7_SELECTED}>&gt;7</option>
                                  <option value="8"{p8_SELECTED}>&gt;8</option>
                                </select>

							</td>
							<td width="33%">
								<div style="padding-bottom:3px;"><strong>Our stars ;)</strong></div>
									<input name="s6" value="1" type="checkbox"{s6_CHECKED}> VIP class <br>
									<input name="s5" value="1" type="checkbox"{s5_CHECKED}> Luxury class<br>
									<input name="s4" value="1" type="checkbox"{s4_CHECKED}> Business class<br>

                           		<br />
                            	<div style="padding-bottom:1px;">Price from, $:</div>
                                <input class="inp" name="pf" size="10" style="width: 98%;" type="text" value="{pf_VALUE}">

                           		<br />
								<div style="padding-bottom:1px; padding-top:5px;">Price to, $:</div>
                                <input class="inp" name="pt" size="10" style="width: 98%;" type="text" value="{pt_VALUE}">

							</td>
						</tr>
					</tbody>
                </table>
                <div style="text-align:left; padding-top:5px; font-size:14px;"><em>* please choose one or more options</em></div>
                <div style="float:right; padding-top:5px;"><input class="button" value="Search" type="submit"></div>
               	<div style="float:right; padding-top:5px; padding-right:10px;"><input class="button" value="Reset" type="reset" onclick="document.location.href = \'{URL}best/\'"></div>
                <br clear="all"/>
				</form>

        </div>  
        <!-- Search Apartment Form END -->    
';




// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //




?>