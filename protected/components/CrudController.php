<?php

/**
 * CrudController
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Базовый CRUD-контроллер
 */

class CrudController extends LoggedController {

	public $modelClass = 'Model'; // Класс модели для CRUD

	/**
	 * Список записей
	 */
	public function actionIndex() {
		$dataProvider = new CActiveDataProvider($this->modelClass);
		$this->render('list', [
			'dataProvider'=>$dataProvider,
		]);
	}

	/**
	 * Просмотр полей модели по ID.
	 * @param integer $id
	 */
	public function actionView($id) {
		$this->render('view', [
			'model' => $this->loadModel($id),
		]);
	}

	/**
	 * Создание модели
	 * При успешном создании, перенаправит на редактирование.
	 */
	public function actionCreate() {
		$model = new $this->modelClass;
		$model->attachBehavior('formBehavior', ['class' => 'EFormBehavior']);

		if ($model->saved()) {
			$this->redirect([
				'update', 'id' => $model->id,
			]);
		}

		$this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * Редактирование модели.
	 * При упешном редактировании перенаправляет на страницу редактирования.
	 * @param integer $id
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel($id);

		if(isset($_POST[$this->modelClass])) {
			$model->attributes = $_POST[$this->modelClass];
			if($model->save())
				$this->redirect([
					'update', 'id' => $model->id,
				]);
		}

		$this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Удаляет модель.
	 * При успешном удалении перенаправит на страницу 'index'.
	 * @param integer $id
	 */
	public function actionDelete($id) {
		$this->loadModel($id)->delete();

		// если AJAX запрос (задействованный grid view), не перенаправлять
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['index']);
	}

	/**
	 * Возвращает модель по ID, полученному из переменной GET.
	 * Если не найдено, вызовет исключение HTTP - 404.
	 * @param integer $id
	 * @return {$this->modelClass}
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model = $this->modelClass;
		$model::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Производит AJAX валидацию.
	 * @param {$this->modelClass} $model
	 */
	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax']==='item-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
