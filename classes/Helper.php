<?php
class Helper {


	public static function string2hash($string = null) {

      if (!empty($string)) {
        return hash('sha512', $string);
      }
    }

	public static function getActive($page = null) {
		if (!empty($page)) {
			if(is_array($page)) {
				$error = array();
				foreach ($page as $key => $value) {
					if (Url::getParam($key) != $value) {
						array_push($error, $key);
					}
				}
				return empty($error) ? "act" : null;
			}
		}
		return $page == Url::currentPage() ? "act" : null;
	}

	public static function getImgdetails($image, $case) {
		if (is_file($image)) {
			// 0 - width, 1 - height, 2 - type, 3 - attribute
			$size = getimagesize($image);
			return $size[$case];
		}
	}



	public static function findImageFiles($dir, $id) {

		$valid_ext = array("jpg", "png", "jpeg", "svg", "bmp");
		$files = array();

		foreach (new DirectoryIterator($dir) as $fileInfo) { // interator
		    if (in_array(pathinfo($fileInfo->getFilename(), PATHINFO_EXTENSION), $valid_ext) ) { // in $valid_ext
					$filename = $fileInfo->getFilename();
					if (preg_match('/^'.$id.'-/',$filename)) {

		        $files[] = $fileInfo->getFilename();
					}
		    }
		}
		return $files;

	}

	public static function formatString($str = null, $case = null, $ccy = 'USD') {

		if(!empty($str) && !empty($case)) {

			switch ($case) {
				case 'ccy':

					return $ccy.'. '. number_format($str, 2);
					break;

				case 'phone':

					$tmp = explode('|', $str);
					return implode(' / ', $tmp);

					break;
				
				default:
					# code...
					break;
			}		
		}


	}
	 	


	public static function formatCurrency($value, $curr) {
		return $curr.'. '. number_format($value, 2);
	}

	public static function encodeHTML($string, $case = 2) {
		switch($case) {
			case 1:
			return htmlentities($string, ENT_NOQUOTES, 'UTF-8', false);
			break;
			case 2:
			$pattern = '<([a-zA-Z0-9\.\, "\'_\/\-\+~=;:\(\)?&#%![\]@]+)>';
			// put text only, devided with html tags into array
			$textMatches = preg_split('/' . $pattern . '/', $string);
			// array for sanitised output
			$textSanitised = array();
			foreach($textMatches as $key => $value) {
				$textSanitised[$key] = htmlentities(html_entity_decode($value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
			}
			foreach($textMatches as $key => $value) {
				$string = str_replace($value, $textSanitised[$key], $string);
			}
			return $string;
			break;
		}
	}

	public static function redirect($url) {
		if (!empty($url)) {
			header("Location: {$url}");
			exit;
		}
	}


	public static function setDate($case = null, $date = null) {

		$date = empty($date) ? time() : strtotime($date);

		switch($case) {
			case 1:
				return date('d/m/Y', $date);
			break;

			case 2:
				return date('l, jS F Y, H:i:s', $date);
			break;

			case 3:
				return date('Y-m-d-H-i-s', $date);
			break;

			default:
				return date('Y-m-d H:i:s', $date);
		}
	}


	public static function shortenString($str = null, $len = 150) {
		if (!empty($str)) {
			return mb_strimwidth($str, 0, $len, "...");
		}
	}


	public static function getAllImages($strImg = null) {

		if (!empty($strImg)) {
			$array = explode(",", $strImg);
			return $array;
		}
	}


	public static function generateHash($len = 35) {
		$key = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
		$strkey = implode('', $key);
		$hash = '';
		for ($i=1; $i <= $len; $i++) {
		  $hash .= substr($strkey, rand(0, 61), 1);
		}
		return $hash;

	}


// Find how much time has elapsed since now()
//
	function timeElapsedSinceNow( $datetime, $full = false )
	{
		$now = new DateTime;
		$then = new DateTime( $datetime );
		$diff = (array) $now->diff( $then );

		$diff['w']  = floor( $diff['d'] / 7 );
		$diff['d'] -= $diff['w'] * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);

		foreach( $string as $k => & $v )
		{
			if ( $diff[$k] )
			{
				$v = $diff[$k] . ' ' . $v .( $diff[$k] > 1 ? 's' : '' );
			}
			else
			{
				unset( $string[$k] );
			}
		}

		if ( ! $full ) $string = array_slice( $string, 0, 1 );
		return $string ? implode( ', ', $string ) . ' ago' : 'just now';
	}





}
