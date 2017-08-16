<?php 

class Captcha {

	private static $secret = '6LeCHgoUAAAAALyDtpnwsX_pJwrScc9qEqrB45RY';
	public static $sitekey = '6LeCHgoUAAAAAETgKz8jhBGYCXlrNMi07KisHdhz';
	private static $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';


	public static function verify() {
		$url = file_get_contents(self::$recaptcha_url.'?secret='.self::$secret.'&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR']);
		$result = json_decode($url, TRUE);
		return $result;

	}

}

?>