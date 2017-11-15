<?php

class ForumFilterBlock extends CWidget {

    public function run()
	{
		$user = User::model()->findByPk(Yii::app()->user->id);

		//если администратор выводим и скрытые разделы
		if($user->role == 'admin')
		{
			$sections = SectionsForum::model()->sorted()->findAll();
		}
		else
		{
			$sections = SectionsForum::model()->sorted()->visibled()->findAll();
		}

		$data = [
			'sections' => $sections,
		];

		$this->render('/forumfilterblock', $data);
    }
}