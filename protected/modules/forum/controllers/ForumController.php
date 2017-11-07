<?php

class ForumController extends LoggedController
{
	public function actionIndex()
	{
		//echo Debug::vars($_POST); die;
		//если администратор выводим и скрытые разделы
		if($this->user->role == 'admin')
		{
			$sections = SectionsForum::model()->sorted()->findAll();
		}
		else
		{
			$sections = SectionsForum::model()->sorted()->visibled()->findAll();
		}		

		$params = [
			'sections' => $sections,
		];

		$this->render('index', $params);
	}
}