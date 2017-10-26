<?php
class Funcs {

	/**
	 * Склонение числа $num
	 */
	static function declination($num, $one, $ed, $mn) {
		if(($num == "0") or (($num >= "5") and ($num <= "20")) or preg_match("|[056789]$|",$num))
			return $mn;
		if(preg_match("|[1]$|",$num))
			return $one;
		if(preg_match("|[234]$|",$num))
			return $ed;
	}

	/**
	 * Чистим HTML и значения передаваемых пользователем переменных.
	 * Предпочтительно для текстовых значений, получаемых по _GET и _POST
	 * @param string Вход
	 * @return string Выход
	 */
	public static function parseCleanValue($val) {
		if ($val == '') {
			return '';
		}

		if (get_magic_quotes_gpc()) {
			$val = stripslashes($val);
			$val = preg_replace("/\\\(?!&amp;#|\?#)/", "&#092;", $val);
		}
		$val = str_replace("&#032;",      " ",            $val);
		$val = str_replace("&",           "&amp;",        $val);
		$val = str_replace("<!--",        "&#60;&#33;--", $val);
		$val = str_replace("-->",         "--&#62;",      $val);
		$val = preg_replace("/<script/i", "&#60;script",  $val);
		$val = str_replace(">",           "&gt;",         $val);
		$val = str_replace("<",           "&lt;",         $val);
		$val = str_replace('"',           "&quot;",       $val);
		$val = str_replace("$",           "&#036;",       $val);
		$val = str_replace("\r",          "",             $val); // Удаляем tab-ы
		$val = str_replace("!",           "&#33;",        $val);
		$val = str_replace("'",           "&#39;",        $val); // для борьбы с SQL-инъекциями

		// Восстановим Unicode
		$val = preg_replace("/&amp;#([0-9]+);/s", "&#\\1;", $val);
		// Поправим HTML сущности без ;
		$val = preg_replace("/&#(\d+?)([^\d;])/i", "&#\\1;\\2", $val);

		return $val;
	}

	/**
	 * чистит строку для безопасного вывода в JS
	 */
	static function jsspecialchars($string = '') {
		$string = preg_replace("/\r*\n/","\\n",$string);
		$string = preg_replace("/\//","\\\/",$string);
		$string = preg_replace("/\"/","\\\"",$string);
		$string = preg_replace("/'/"," ",$string);
		return $string;
	}

	/**
	 * кат
	 */
	static function cutted($string, $maxlen = 300)
	{
		$string = strip_tags($string);
		$len = (mb_strlen($string) > $maxlen) ? mb_strripos(mb_substr($string, 0, $maxlen), ' ') : $maxlen ;
		$cutStr = mb_substr($string, 0, $len);
		return (mb_strlen($string) > $maxlen) ? $cutStr . ' ...' : $cutStr ;
    }

	/**
	 * Set cookie
	 *
	 * @param string Name
	 * @param string Balue
	 * @param boolean delete?
	 * @return void
	 */
	public static function cookieSet($name, $value='', $delete=false) {
		$expires = ($delete) ? time()-86400 : time() + 2678400;
		setcookie($name, $value, $expires, '/', NULL);
	}

	/**
	 * Get cookie
	 * @param string	Имя
	 * @return mixed
	 */
	public static function cookieGet($name) {
		if (isset($_COOKIE[$name])) {
			return self::parseCleanValue(urldecode($_COOKIE[$name]));
		}
		return FALSE;
	}

}