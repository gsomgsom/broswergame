<?
/**
 * Почтальон Печкин
 */
class MailMan {

	/**
	 * Подготовка SMTP
	 */
	public static function initSMTP()
	{
		Yii::app()->mailer->ClearAddresses();
		Yii::app()->mailer->IsSMTP();
		Yii::app()->mailer->Host = "smtp.yandex.ru";
		Yii::app()->mailer->Port = "465";
		Yii::app()->mailer->SMTPAuth = true;
		Yii::app()->mailer->SMTPSecure = 'ssl';
		Yii::app()->mailer->Username = Yii::app()->params['senderUser'];
		Yii::app()->mailer->Password = Yii::app()->params['senderPass'];
		Yii::app()->mailer->IsHTML();
		Yii::app()->mailer->FromName = Yii::app()->params['title'];
		Yii::app()->mailer->From = Yii::app()->params['senderEmail'];
		Yii::app()->mailer->CharSet = "UTF-8";
		//Yii::app()->mailer->AddAddress('zhelneen@yandex.ru'); // DEBUG EMAIL
		//Yii::app()->mailer->SMTPDebug = true;
	}

	/**
	 * Подготовка Mail
	 */
	public static function initMail()
	{
		Yii::app()->mailer->ClearAddresses();
		Yii::app()->mailer->Host = $_SERVER['HTTP_HOST'];
		Yii::app()->mailer->IsMail();
		Yii::app()->mailer->IsHTML();
		Yii::app()->mailer->FromName = Yii::app()->params['title'];
		Yii::app()->mailer->From = KUseful::cnf('mailsender');
		Yii::app()->mailer->CharSet = "UTF-8";
		//Yii::app()->mailer->AddAddress('zhelneen@yandex.ru'); // DEBUG EMAIL
	}

	/**
	 * Шлём письмо
	 * @param   string  $email адрес e-mail, кому
	 * @param   string  $subject тема письма
	 * @param   string  $message сообщение
	 * @param   string  $method служба (smtp, mail)
	 */
	public static function send($email, $subject, $message, $method = 'smtp')
	{
		if ($method == 'smtp') {
			self::initSMTP();
			Yii::app()->mailer->AddAddress($email);
			Yii::app()->mailer->Subject = $subject;
			Yii::app()->mailer->Body = $message;
			Yii::app()->mailer->Send();
		}
		elseif ($method == 'mail') {
			self::initMail();
			Yii::app()->mailer->AddAddress($email);
			Yii::app()->mailer->Subject = $subject;
			Yii::app()->mailer->Body = $message;
			Yii::app()->mailer->Send();
		}
	}

}
