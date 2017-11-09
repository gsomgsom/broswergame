<?php

class SectionsController extends LoggedController
{
	public function actionIndex()
	{

		//отслеживаем нажатие кнопок
		$submit = $_POST ? Funcs::get($_POST, 'submit', 'save') : null;

		// если был нажат "Применить"
		if($submit === 'save')
		{
			//массив id элементов над которыми надо провести действия
			$ids = Funcs::get($_POST, 'id', []);

			if(isset($_POST['action']) & !empty($ids))
			{
				foreach($ids as $id)
				{
					//находим категорию(раздел) по id
					$section = SectionsForum::model()->findByPk($id);

					if($_POST['action'] === 'hide')
					{
						$section->visible = 0;
						if ($section->save())
							Yii::app()->user->setFlash('success', Yii::t('success', 'Сохранено'));
						else
							Yii::app()->user->setFlash('error', CHtml::errorSummary($section, '', ''));
					}
					elseif($_POST['action'] === 'show')
					{
						$section->visible = 1;
						if ($section->save())
							Yii::app()->user->setFlash('success', Yii::t('success', 'Сохранено'));
						else
							Yii::app()->user->setFlash('error', CHtml::errorSummary($section, '', ''));
					}
					elseif($_POST['action'] === 'delete')
					{
						//TO DO
						//$product->delete();
						//$this->message = 'Удалено';
					}
				}
			}
		}


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