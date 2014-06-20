<?php
define('MAGPIE_OUTPUT_ENCODING', "UTF-8");
define('MAGPIE_CACHE_ON', false);
include_once(dirname(__FILE__)."/magpie_0.72/rss_fetch.inc");
//include_once(dirname(__FILE__)."/fb/facebook.php");
//include_once(dirname(__FILE__)."/Swift-4.2.2/lib/swift_required.php");
//include_once(dirname(__FILE__)."/PHPMailer_5.2.2/class.phpmailer.php");
include_once(dirname(__FILE__)."/mailer/emailer/email.php");
include_once(dirname(__FILE__)."/mandrill-api-php/src/Mandrill.php");

function captcha(){
	?><img id='captchaimg' src='<?php echo site_url(); ?>media/startupkit/cool-php-captcha-0.3.1/captcha.php' ><?php
}
function arrDiff($arr1, $arr2){
	$str1 = trim(json_encode($arr1));
	$str2 = trim(json_encode($arr2));
	//echo $str1."<br><br>";
	//echo $str2."<br>";
	//echo "<hr>";
	//echo strcmp($str1,$str2);
	if(strcmp($str1,$str2)==0){
		return false;
	}
	else{
		return true;
	}
}
function fb(){
	$facebook = new Facebook(array(
	  'appId'  => '135632699922818',
	  'secret' => 'e63bc2737f673ba63dcd0ba797d3e67c',
	));
	return $facebook;
}


function microtime_float(){
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
function htmlentitiesX($str){
	return htmlentities($str, ENT_COMPAT, "UTF-8");
}
function word_limit($str, $limit){
    $str .= "";
    $str = trim($str);
    $l = strlen($str);
    $s = "";
    for($i=0; $i<$l; $i++)
    {
        $s .= $str[$i];
        if($limit>0&&(preg_match("/\s/", $str[$i])))
        {  
            if(!preg_match("/\s/", $str[$i+1]))
                $limit--;
            if(!$limit)
            {
                return $s."...";
                break;
            }
        }
    }
    return $s;
}

function amountIze($amount){
	if($amount>=1000000){
		if($amount%1000000){
			$amount = $amount / 1000000;
			$amount = trim(number_format($amount, 2), '0');
			$amount = trim($amount, '.');
			$amount = $amount."M";	
		}
		else{
			$amount = $amount / 1000000;
			$amount = number_format($amount, 0)."M";	
		}
	}
	else if($amount>=1000){
		if($amount%1000){
			$amount = $amount / 1000;
			$amount = trim(number_format($amount, 1), '0');
			$amount = trim($amount, '.');
			$amount = number_format($amount, 1)."K";	
		}
		else{
			$amount = $amount / 1000;
			$amount = number_format($amount, 0)."K";	
		}
	}
	else{
		$amount = trim(number_format($amount, 2), '0');
		$amount = trim($amount, '.');
	}
	return $amount;
}

function seoIze2($str){
	$str = str_replace(" ", "_", $str);
	return $str;
}
function unseoIze2($str){
	$str = str_replace("_", " ", $str);
	return $str;
}
function seoIze($str){
	//echo mb_detect_encoding ($str);
	$str = preg_replace("/[^a-zA-Z0-9]/iUs", "-", $str);
	$str = trim($str, "-");
	if(trim($str)==""){
		return substr(md5($str), 0, 4);
	}
	return $str;
}
/*
function site_url(){
	$host = $_SERVER['HTTP_HOST'];
	if($host=='localhost'){
		return "http://".$host."/pieceoftheworld.co/admin2/";
	}
	else{
		return "http://".$host."/admin2/";
	}
}
function site_url2(){
	$host = $_SERVER['HTTP_HOST'];
	if($host=='localhost'){
		return "http://".$host."/pieceoftheworld.co/";
	}
	else{
		return "http://".$host."/";
	}
}
function outlink($url){
	return site_url()."l?url=".urlencode($url);
}
function redirect_to($url){
	ob_end_clean();
	?>
	<script>
		self.location = "<?php echo htmlentities($url); ?>";
	</script>
	<?php
	exit();
}
*/
function sanitizeX($str){
	$str = addslashes($str);
	$str = str_replace("\n", "\\n", $str);
	$str = str_replace("\r", "\\r", $str);
	return $str;
}

function checkEmail($email, $mx=false) {
    if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/" , $email))
    {
        list($username,$domain)=explode('@',$email);
        if($mx){
			if(!getmxrr ($domain,$mxhosts)) {
				return false;
			}
		}
        return true;
    }
    return false;
}

function SureRemoveDir($dir, $DeleteMe=false) {
    if(!$dh = @opendir($dir)) return;
    while (false !== ($obj = readdir($dh))) {
        if($obj=='.' || $obj=='..') continue;
        if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
    }

    closedir($dh);
    if ($DeleteMe){
        @rmdir($dir);
    }
}

function safeExport($str){
	$str = trim($str);
	$str = str_replace(",", "", $str);
	$str = preg_replace("/[^a-zA-Z0-9]/iUs", " ", $str);
	return $str;
}

function getWebUser($web_user){
	if($web_user['fb_data']){
		$web_user['type'] = 'fb';
		$web_user['fb'] = json_decode($web_user['fb_data']);
		$web_user['name'] = $web_user['fb']->name;
		if(!trim($web_user['name'])){
			$web_user['name'] = $web_user['business_email'];
		}
		$web_user['img'] = "http://graph.facebook.com/".$web_user['fb']->id."/picture?type=large";
		$web_user['fb_email'] = $web_user['fb']->email;
		$web_user['business_email'] = $web_user['business_email'];
		$web_user['twitter'] = $web_user['twitter'];
		$web_user['homepage'] = $web_user['homepage'];
	}
	else if($web_user['in_data']){
		$web_user['type'] = 'in'; //linkedin
		$web_user['in'] = objectToArray(json_decode($web_user['in_data']));
		$web_user['name'] = $web_user['in']['first-name']." ".$web_user['in']['last-name'];
		if(!trim($web_user['name'])){
			$web_user['name'] = $web_user['business_email'];
		}
		$web_user['img'] = $web_user['in']['picture-url'];
		$web_user['business_email'] = $web_user['business_email'];
		$web_user['twitter'] = $web_user['twitter'];
		$web_user['homepage'] = $web_user['homepage'];
	}
	return $web_user;
}

function objectToArray($d) {
	if (is_object($d)) {
		// Gets the properties of the given object
		// with get_object_vars function
		$d = get_object_vars($d);
	}

	if (is_array($d)) {
		/*
		* Return array converted to object
		* Using __FUNCTION__ (Magic constant)
		* for recursive call
		*/
		return array_map(__FUNCTION__, $d);
	}
	else {
		// Return array
		return $d;
	}
}


function bubble_sort($arr, $key, $sort="asc", $string=false) {
	$sort = strtolower($sort);
    $size = count($arr);
    for ($i=0; $i<$size; $i++) {
        for ($j=0; $j<$size-1-$i; $j++) {
			if($string){
				if($sort=="asc"){
					if (strcmp($arr[$j+1][$key], $arr[$j][$key])<=0) {
						swap($arr, $j, $j+1);
					}
				}
				else{
					if (strcmp($arr[$j+1][$key], $arr[$j][$key])>=0) {
						swap($arr, $j, $j+1);
					}
				}
			}
			else{ //integer
				if($sort=="asc"){
					if ($arr[$j+1][$key] < $arr[$j][$key]) {
						swap($arr, $j, $j+1);
					}
				}
				else{
					if ($arr[$j+1][$key] > $arr[$j][$key]) {
						swap($arr, $j, $j+1);
					}
				}

			}
        }
    }
    return $arr;
}

function swap(&$arr, $a, $b) {
    $tmp = $arr[$a];
    $arr[$a] = $arr[$b];
    $arr[$b] = $tmp;
}

//mandrill
/*
$email = array();
$email['name'] = $name;
$email['email'] = $fb_email;
$emailtos[] = $email;

$from = "db@e27.co";
$fromname = "E27 DB";
$to = $user['email'];
if(!$to){
	$to = $user['business_email'];
}
$subject = "[e27 DB] Welcome to E27 DB (Beta)";
$template = array();
$template['data'] = array();
$template['data']['name'] = $toname;
$email_content = "Welcome to 27x

	Before you get started, here's a few things you should know:
	
	1. <b>This is Real Beta</b> - You're using a version of 27x that's still in it's infancy. You should be prepared to see incorrect data, links that are broken, and general stuff that just don't work. Fret not, we're here to build this for the long term. We value you feedback, so if you see something that needs to be fixed, or if you have a great idea on how something can be done, send us feedback at <a href='mailto:feedback@27x.co'>feedback@27x.co</a>.
	
	2. <b>We're small, but still growing</b> - Right now, we just have a handle of entries in the system. We're looking to build that base overtime through your support. Feel free to add in new entries and edit them, as you deem fit.
	
	3. We like criticism - As a new site, we're sure you can find lots to criticize. Remember though, constructive criticism will help make the site better.
	
	Thank you for using 27x. Let us know what you think!
	
	- 27x Team
	<a href='http://27x.co'>27x.co</a>
	";
$template['data']['content'] = $email_content;
$template['data']['content'] = nl2br($template['data']['content']);

//$template['data'] = json_encode($template['data']);
$template['slug'] = "startuplist-wrap"; 
*/
function send_email($from, $fromname, $emailtos, $subject, $message, $template, $debug=false){
	//$formvars['key'] ='00Zrp2gMZCMIA7OiTJFsHQ';
	return 0;
	$formvars['template_name'] =  $template['slug'];
	$formvars['template_content'] = array();
	foreach($template['data'] as $key=>$value){
		$content = array();
		$content['name'] = $key;
		$content['content'] = $value;
		$formvars['template_content'][] = $content;
	}
	$formvars['message'] = array();
	//$formvars['message']['html'] = "test email";
	//$formvars['message']['text'] = "test email";
	$formvars['message']['subject'] = $subject;
	$formvars['message']['from_email'] = $from;
	$formvars['message']['from_name'] = $fromname;
	/*
	$email = array();
	$email['email'] = $to;
	$email['name'] = $toname;
	$formvars['message']['to'][] = $emails;
	*/
	$formvars['message']['to'] = $emailtos;
	/*
	$formvars['message']['headers'] = array();
	$formvars['message']['headers']["X-MC-MergeVars"] = $template['data'];
	$formvars['message']['headers']["X-MC-Template"] = $template['slug'];
	*/
	$formvars['message']['track_opens'] = true;
	$formvars['message']['track_clicks'] = true;
	$formvars['message']['auto_text'] = true;
	$formvars['message']['async'] = true;

	$m = new Mandrill('00Zrp2gMZCMIA7OiTJFsHQ');
	//print_r($m->call("users/info", $formvars['message']));
	$r = $m->call("messages/send-template", $formvars);
	
	if(trim($r[0]['status'])!='sent'){
		print_r($formvars);
		print_r($r);
	}
	else if($debug){
		
		echo "<pre>";
		print_r($formvars['message']['to']);
		print_r($r);
	}
}

/*
	usage:
	$template = array();
	$template['data'] = array();
	$template['data']['name'] = "Jairus";
	$template['data']['passlink'] = "http://google.com";
	$template['data'] = json_encode($template['data']);
	$template['slug'] = "startuplist-forgot-password"; 
	$from = "mailer@startuplist.sg";
	$fromname = "E27 Startup List";
	$to = "jairus@nmgresources.ph";
	$subject = "Test Email";
	$message = "";
	send_email($from, $fromname, $to, $subject, $message, $template);	
*/
/*
function send_email_ci($from, $fromname, $to, $subject, $message, $template){
	if(!trim($from)){
		$from = "mailer@startuplist.sg";
	}
	if(!trim($fromname)){
		$fromname = $from;
	}
	$CI =& get_instance();
	
	$config = array();
	$config['protocol'] = 'smtp';
	$config['charset'] = 'utf-8';
	$config['wordwrap'] = TRUE;
	$config['smtp_host'] = "smtp.mandrillapp.com";
	$config['smtp_user'] = "e27sg";
	$config['smtp_pass'] = "ed3f246e-b16c-4ffb-8a19-e0c36c8877ea";
	$config['smtp_port'] = "587";
	$config['mailtype'] = "html";
	
	$CI->email->initialize($config);
	$CI->email->set_newline("\n");
	$CI->email->set_header("X-MC-MergeVars", $template['data']);
	$CI->email->set_header("X-MC-Template", $template['slug']);
	$CI->email->from($from, $fromname);
	$CI->email->to($to);
	$CI->email->subject($subject);
	$CI->email->message($message);
	$CI->email->send();
	echo $CI->email->print_debugger();
}
function send_email_swift($from, $fromname, $to, $subject, $message, $template){	
	$from = array($from =>$fromname);
	$to = array(
	 $to  => $to
	);
	
	$text = "Mandrill speaks plaintext";
	$html = "<em>Mandrill speaks <strong>HTML</strong></em>";
	
	$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
	$transport->setUsername('e27sg');
	$transport->setPassword('e6ea6154-ff86-44d2-b48b-f13042d68c39');
	//$transport->setPassword('coll3ctive@12');
	$swift = Swift_Mailer::newInstance($transport);
	
	
	
	$message = new Swift_Message($subject);
	
	//$headers = $message->getHeaders();
	//$headers->addTextHeader('X-MC-Track', 'opens, clicks_htmlonly');
	//$headers->addTextHeader('X-MC-GoogleAnalytics', 'yourdomain.com');
	
	
	$message->setFrom($from);
	$message->setBody($html, 'text/html');
	$message->setTo($to);
	$message->addPart($text, 'text/plain');
	
	if ($recipients = $swift->send($message, $failures)){
		echo 'Message successfully sent!';
	} 
	else {
		echo "There was an error:\n";
		print_r($failures);
	}
}


function send_email_php($from, $fromname, $to, $subject, $message, $template){	
	$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
	$mail->IsSMTP(); // telling the class to use SMTP
	try {
		$mail->Host       = "smtp.mandrillapp.com"; // SMTP server
		$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Host       = "smtp.mandrillapp.com"; // sets the SMTP server
		$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
		$mail->Username   = "e27sg"; // SMTP account username
		$mail->Password   = "e6ea6154-ff86-44d2-b48b-f13042d68c39";        // SMTP account password
		$mail->AddAddress($to, $to);
		$mail->SetFrom($from, $fromname);
		$mail->AddReplyTo($from, $fromname);
		$mail->Subject = $subject;
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
		$mail->MsgHTML("<b>Hello world</b>");
		//$mail->AddAttachment('images/phpmailer.gif');      // attachment
		//$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
		
		$mail->Send();
		echo "Message Sent OK</p>\n";
	} 
	catch (phpmailerException $e) {
		echo $e->errorMessage(); //Pretty error messages from PHPMailer
	} catch (Exception $e) {
		echo $e->getMessage(); //Boring error messages from anything else!
	}
}
*/
//used for linked in responseg
function getXMLtoArr($xml){
	$xmlobj = json_decode(json_encode((array) simplexml_load_string($xml)), 1);
	//$xmlobj = objectToArray($xmlobj);
	return $xmlobj;
}

function obfuscate($str){
	$str = str_replace("\n", "", $str);
	$str = str_replace("\n", "", $str);
	return $str;
}

class Cipher {
    private $securekey, $iv;
    function __construct($textkey) {
        $this->securekey = hash('sha256',$textkey,TRUE);
        $this->iv = mcrypt_create_iv(32);
    }
    function encrypt($input) {
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->securekey, $input, MCRYPT_MODE_ECB, $this->iv));
    }
    function decrypt($input) {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->securekey, base64_decode($input), MCRYPT_MODE_ECB, $this->iv));
    }
}

function SDEncrypt($str){
	return base_convert($str, 10, 26);
	$cipher = new Cipher("s3@d3xJ@iRu$"); //this passphrase will be replaced once in actual deployment
	return base64_encode($cipher->encrypt($str));
}

function SDDecrypt($str){
	return base_convert($str, 26, 10);
	$cipher = new Cipher("s3@d3xJ@iRu$"); //this passphrase will be replaced once in actual deployment
	return $cipher->decrypt(base64_decode($str));
}

function exchange_rate($curr1, $curr2){
	$curr1 = trim(strtoupper($curr1));
	$curr2 = trim(strtoupper($curr2));
	if($curr1==$curr2){
		return 1;
	}
	//get USD equiv of $curr1
	if($curr1!="USD"){
		$exchange_rate = file_get_contents("http://www.bloomberg.com/quote/".$curr1."USD:CUR");
		$matches = array();
		preg_match_all("/<meta itemprop=\"price\" content=\"(.*)\" \/>/iUs", $exchange_rate, $matches);
		$exchange_rate_usd = str_replace(",", "", $matches[1][0]);
		if($curr2=="USD"){
			return $exchange_rate_usd;
		}
	}
	else{
		$exchange_rate_usd = 1;
	}
	//get equiv in other currency
	$exchange_rate = file_get_contents("http://www.bloomberg.com/quote/USD".$curr2.":CUR");
	$matches = array();
	preg_match_all("/<meta itemprop=\"price\" content=\"(.*)\" \/>/iUs", $exchange_rate, $matches);
	$exchange_rate_x = str_replace(",", "", $matches[1][0]);
	$exchange_rate = $exchange_rate_usd * $exchange_rate_x;
	return $exchange_rate;
}

?>