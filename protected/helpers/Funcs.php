<?php
/**
 * Вспомогательные методы
 */
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

	/*
    * Путь к корню
    */
    static function base()
    {
        return Yii::app()->getBaseUrl(true);
    }

	/**
	 * Retrieve a single key from an array. If the key does not exist in the
	 * array, the default value will be returned instead.
	 *
	 *     // Get the value "username" from $_POST, if it exists
	 *     $username = Funcs::get($_POST, 'username');
	 *
	 *     // Get the value "sorting" from $_GET, if it exists
	 *     $sorting = Funcs::get($_GET, 'sorting');
	 *
	 * @param   array   $array      array to extract from
	 * @param   string  $key        key name
	 * @param   mixed   $default    default value
	 * @return  mixed
	 */
	public static function get($array, $key, $default = NULL)
	{
		return isset($array[$key]) ? $array[$key] : $default;
	}

	/*
	 * ПАРСИМ И ОБРЕЗАЕМ ТЕКСТ
	 * $text - текст
	 * $length - длина требуемого текста (в количестве символов)
	 * $points - точки на границе обреза
	 */
	public static function cropLongText($text, $length, $points = true)
	{
		//убираем все html теги
		$text = strip_tags($text);
		//проверяем длину текста и если она больше $length - обрезаем
		$lengthString = strlen($text);

		if($lengthString > $length)
		{
			//обрезаем текст
			$text = substr($text, 0, $length);
			//проверяем на что оканчивается оставшийся текст - удаляем воскл.знак, точку. тире, запятую
			$text = rtrim($text, "!,.-");
			//находим последний пробел и ставим ...
			$text = substr($text, 0, strrpos($text, ' '));
			$text = $text.'...';
		}
		
		return $text;
	}

	/**
	 * Отладочное сообщение в лог
	 *
	 * @param string Сообщение
	 * @return void
	 */
	public static function logMessage($message, $type = 'debug', $player_id = 0) {
		$logType = LogType::model()->findByAttributes(['alias' => $type]);
		$logEntry = new PlayerLog();
		$logEntry->dt = date('Y-m-d H:i:s', time());
		if (!empty($logType))
			$logEntry->type_id = $logType->id;
		$logEntry->player_id = $player_id ? $player_id : Yii::app()->getController()->user->player->id;
		$logEntry->html = $message;
		$logEntry->save();
	}

	/**
	 * Замена {кодов} разметки игры на HTML
	 *
	 * @param string Исходная строка
	 * @return string Строка с HTML
	 */
	public static function applyCodes($s) {
		$s = str_replace("{coins}", "<img src=\"/assets/img/coins16.png\" title=\"монеты\" alt=\"\"><span class=\"inv\">{coins}</span>", $s);
		$s = str_replace("{nuts}", "<img src=\"/assets/img/nuts16.png\" title=\"жёлуди\" alt=\"\"><span class=\"inv\">{nuts}</span>", $s);
		$s = str_replace("{mushrooms}", "<img src=\"/assets/img/mushrooms16.png\" title=\"волшебные грибы\" alt=\"\"><span class=\"inv\">{mushrooms}</span>", $s);
		$s = str_replace("{exp}", "<img src=\"/assets/img/exp16.png\" title=\"опыт\" alt=\"\"><span class=\"inv\">{exp}</span>", $s);
		$s = str_replace("{lvl}", "<img src=\"/assets/img/lvl16.png\" title=\"уровень\" alt=\"\"><span class=\"inv\">{lvl}</span>", $s);
		$s = str_replace("{might}", "<img src=\"/assets/img/top16.png\" title=\"влияние\"><span class=\"inv\" alt=\"\">{might}</span>", $s);
		$s = str_replace("{carma}", "<img src=\"/assets/img/yinyang16.png\" title=\"карма\"><span class=\"inv\" alt=\"\">{carma}</span>", $s);
		$s = str_replace("{hp}", "<img src=\"/assets/img/hp16.png\" title=\"здоровье\"><span class=\"inv\" alt=\"\">{hp}</span>", $s);
		$s = str_replace("{clock}", "<img src=\"/assets/img/clock16.png\" title=\"время\"><span class=\"inv\" alt=\"\">{clock}</span>", $s);
		$s = str_replace("{achievment}", "<img src=\"/assets/img/achievment16.png\" title=\"достижение\" alt=\"\"><span class=\"inv\">{achievment}</span>", $s);
		$s = str_replace("{leaves}", "<img src=\"/assets/img/leaves16.png\" title=\"листья\" alt=\"\"><span class=\"inv\">{leaves}</span>", $s);
		$s = str_replace("{leaf1}", "<img src=\"/assets/img/leaf16.png\" title=\"зелёный лист\" alt=\"\"><span class=\"inv\">{leaf1}</span>", $s);
		$s = str_replace("{leaf2}", "<img src=\"/assets/img/leaf_red16.png\" title=\"красный лист\" alt=\"\"><span class=\"inv\">{leaf2}</span>", $s);
		$s = str_replace("{leaf3}", "<img src=\"/assets/img/leaf_gold16.png\" title=\"золотой лист\" alt=\"\"><span class=\"inv\">{leaf3}</span>", $s);
		$s = str_replace("{leaf4}", "<img src=\"/assets/img/leaf_dead16.png\" title=\"мёртвый лист\" alt=\"\"><span class=\"inv\">{leaf4}</span>", $s);
		if (!isset(Yii::app()->params['applyingCodes'])) {
			Yii::app()->params['applyingCodes'] = true;
			$items = Item::model()->findAll();
			foreach ($items as $i) {
				$s = str_replace("{item".$i->id."}", "<img src=\"/assets/img/".$i->img."16.png\" alt=\"\" title=\"".$i->name."\"><span class=\"inv\">{item".$i->id."}</span> <strong>".$i->name."</strong>", $s);
			}
			unset(Yii::app()->params['applyingCodes']);
		}
		return $s;
	}

}