<?php

class TopicsController extends LoggedController
{
	//$id - id категории
	public function actionView()
	{
		//echo Debug::vars($_POST); die;

		//отслеживаем нажатие кнопок
		$submit = $_POST ? Funcs::get($_POST, 'submit', 'save') : null;

		if($submit === 'save')
		{
			//массив id элементов над которыми надо провести действия
			$ids = Funcs::get($_POST, 'id', []);

			if(isset($_POST['action']) & !empty($ids))
			{
				foreach($ids as $id)
				{
					//находим категорию(раздел) по id
					$topic = TopicsForum::model()->findByPk($id);

					if($_POST['action'] === 'hide')
					{
						$topic->visible = 0;
						if ($topic->save())
							Yii::app()->user->setFlash('success', Yii::t('success', 'Сохранено'));
						else
							Yii::app()->user->setFlash('error', CHtml::errorSummary($topic, '', ''));
					}
					elseif($_POST['action'] === 'show')
					{
						$topic->visible = 1;
						if ($topic->save())
							Yii::app()->user->setFlash('success', Yii::t('success', 'Сохранено'));
						else
							Yii::app()->user->setFlash('error', CHtml::errorSummary($topic, '', ''));
					}
					elseif($_POST['action'] === 'consolidate')
					{
						$topic->fixed = 1;
						$topic->closed = 0;
						if ($topic->save())
							Yii::app()->user->setFlash('success', Yii::t('success', 'Сохранено'));
						else
							Yii::app()->user->setFlash('error', CHtml::errorSummary($topic, '', ''));
					}
					elseif($_POST['action'] === 'unfasten')
					{
						$topic->fixed = 0;
						if ($topic->save())
							Yii::app()->user->setFlash('success', Yii::t('success', 'Сохранено'));
						else
							Yii::app()->user->setFlash('error', CHtml::errorSummary($topic, '', ''));
					}
					elseif($_POST['action'] === 'open')
					{
						$topic->closed = 0;
						if ($topic->save())
							Yii::app()->user->setFlash('success', Yii::t('success', 'Сохранено'));
						else
							Yii::app()->user->setFlash('error', CHtml::errorSummary($topic, '', ''));
					}
					elseif($_POST['action'] === 'close')
					{
						$topic->closed = 1;
						$topic->fixed = 0;
						if ($topic->save())
							Yii::app()->user->setFlash('success', Yii::t('success', 'Сохранено'));
						else
							Yii::app()->user->setFlash('error', CHtml::errorSummary($topic, '', ''));
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

		$id = Funcs::get($_GET, 'id');

		//массив тем, входящих в категорию id которой пришел
		$criteria = new CDbCriteria;
		$criteria->condition = "t.section_id = :id";
		$criteria->params = [':id' => $id];
		if($this->user->role == 'admin')
		{
			$topics = TopicsForum::model()->sorted()->findAll($criteria);
		}
		else
		{
			$topics = TopicsForum::model()->sorted()->visibled()->findAll($criteria);
		}

		$section = SectionsForum::model()->findByPk($id);

		$data = [
			'topics'  => $topics,
			'section' => $section,
		];

		$this->render('topics', $data);
	}
}