<?php

/**
 * Модель "Player"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Персонаж. Всё что связано с персонажем и действиями над ним.
 */

class Player extends CActiveRecord {
	// Пол персонажа
	const GENDER_FEMALE            = 0;
	const GENDER_MALE              = 1;

	private $__old_lvl;
	public $bag_slots              = 30; // количество слотов в сумке

	/**
	 * Название таблицы в БД
	 * @return string
	 */
	public function tableName() {
		return '{{players}}';
	}

	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules() {
		return [
			['nickname', 'required'],
			['nickname', 'unique'],
			['gender', 'in', 'range' => [0,1], 'message' => Yii::t('error', '__player__validate_unknown_gender')],
			['lvl, exp, hp, coins, nuts, mushrooms, str, def, dex, sta, int, might, carma', 'numerical'],
			['nickname, last_action', 'safe'],
		];
	}

	/**
	 * Связи и отношения с другими моделями
	 * @return array
	 */
	public function relations() {
		return [
			'user'               => [self::BELONGS_TO, 'User', 'user_id'],
			'log'                => [self::HAS_MANY, 'PlayerLog', ['player_id' => 'id']],
			'states'             => [self::HAS_MANY, 'PlayerState', ['player_id' => 'id']],
			'player_items'       => [self::HAS_MANY, 'PlayerItems', 'player_id', 'order' => 'item_id'],
			'items'              => [self::HAS_MANY, 'Item', ['item_id' => 'id'], 'through' => 'player_items'],
			'player_achievments' => [self::HAS_MANY, 'PlayerAchievments', 'player_id', 'order' => 'achievment_id'],
			'achievments'        => [self::HAS_MANY, 'Achievment', ['achievment_id' => 'id'], 'through' => 'player_achievments'],
		];
	}

	/**
	 * Возвращает экземпляр себя
	 * @return CActiveRecord объект модели
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * Описывает скоупы (scopes), сокращения предустановок выборки
	 * @return array
	 */
	public function scopes() {
		return [
			'sorted' => ['order' => 't.id DESC'],
			'sortedByMight' => ['order' => 't.might DESC, t.id DESC'],
		];
	}

	/**
	 * После загрузки записи из БД
	 */
	protected function afterFind()
	{
		// Пересчитаем уровень персонажа
		$this->__old_lvl = $this->lvl;
		$this->lvl = Formulas::getPlayerLevelByExp($this->exp);

		parent::afterFind();
	}

	/**
	 * Действие перед сохранением в БД
	 * @return bool
	 */
	public function beforeSave() {
		if (parent::beforeSave()) {

			// Обновим последнее действие
			$this->last_action = date('Y-m-d H:i:s');

			// Обновим уровень персонажа
			$this->lvl = Formulas::getPlayerLevelByExp($this->exp);

			// Уровень поменялся? Делаем запись в логе и проверяем достижение
			if ($this->lvl != $this->__old_lvl) {
				Funcs::logMessage(Yii::t('success', '__player__level_up', [
					'{lvl}' => $this->lvl,
				]), 'level');

				// Проверяем достижение
				$this->checkAchievment('lvl', $this->lvl);
			}

			return true;
		}
		else
			return false;
	}

	/**
	 * Опыта на следующий уровень
	 * @return integer
	 */
	public function expNext()
	{
		return Formulas::getNextLevelExp($this->exp);
	}

	/**
	 * Опыта на текущем уровне до следующего
	 * @return integer
	 */
	public function expToLevelMax()
	{
		return $this->expNext() - Formulas::getPlayerExpByLevel($this->lvl);
	}

	/**
	 * Опыта до следующего уровня
	 * @return integer
	 */
	public function expToLevel()
	{
		return $this->expNext() - $this->exp;
	}

	/**
	 * Опыта на этом уровне
	 * @return integer
	 */
	public function expAtLevel()
	{
		return $this->expToLevelMax() - $this->expToLevel();
	}

	/**
	 * Возвращает время до конца таймера статуса с именем $alias
	 * @alias string Название статуса
	 * @return timestamp Время до конца таймера статуса
	 */
	public function getStateCooldown($alias) {
		$stateEntry = PlayerState::model()->findByAttributes(['player_id'=> $this->id, 'alias' => $alias]);
		if (!empty($stateEntry)) {
			return strtotime($stateEntry->cooldown);
		}
		return time()-10; // время из прошлого
	}

	/**
	 * Возвращает время до конца таймера глобального статуса (занятость персонажа охотой и другими делами)
	 * @return timestamp Время до конца таймера глобального статуса
	 */
	public function getGlobalStateCooldown() {
		$stateEntry = PlayerState::model()->findByAttributes([
				'player_id'=> $this->id,
				'is_global' => 1
			], [
				'condition' => 'cooldown >= :date and state_text is not null',
				'params' => [
					'date' => date('Y-m-d H:i:s', time()),
				],
		]);
		if (!empty($stateEntry)) {
			return strtotime($stateEntry->cooldown);
		}
		return time()-10; // время из прошлого
	}

	/**
	 * Возвращает true, если персонаж занят на глобальной работе, и false если нет
	 * @return bool На работе?
	 */
	public function isWorking() {
		return $this->getGlobalStateCooldown() >= time();
	}

	/**
	 * Возвращает значение статуса с именем $alias
	 * @alias string Название статуса
	 * @return string Состояние статуса, например "fast" для быстого поиска желудей
	 */
	public function getStateVal($alias) {
		$stateEntry = PlayerState::model()->findByAttributes(['player_id'=> $this->id, 'alias' => $alias]);
		if (!empty($stateEntry)) {
			return $stateEntry->state_text;
		}
		return null;
	}

	/**
	 * Возвращает числовое значение статуса с именем $alias
	 * @alias string Название статуса
	 * @return int Чистовое состояние статуса
	 */
	public function getStateIntVal($alias) {
		$stateEntry = PlayerState::model()->findByAttributes(['player_id'=> $this->id, 'alias' => $alias]);
		if (!empty($stateEntry)) {
			return $stateEntry->state_int;
		}
		return 0;
	}

	/**
	 * Устанавлиает параметры статуса с именем $alias
	 * @alias string Название статуса
	 * @params array Массив с параметрами статуса в формате 'key' => 'value'
	 * @return bool Результат сохранения статуса. Должно быть true если всё прошло удачно
	 */
	public function setStateParams($alias, $params = []) {
		$stateEntry = PlayerState::model()->findByAttributes(['player_id'=> $this->id, 'alias' => $alias]);
		if (empty($stateEntry)) {
			$stateEntry = new PlayerState;
			$stateEntry->player_id = $this->id;
			$stateEntry->alias = $alias;
		}
		if (in_array('is_global', array_keys($params))) {
			$stateEntry->is_global = (int)$params['is_global'];
		}
		if (in_array('state_int', array_keys($params))) {
			$stateEntry->state_int = (int)$params['state_int'];
		}
		if (in_array('state_text', array_keys($params))) {
			$stateEntry->state_text = $params['state_text'];
		}
		if (in_array('cooldown', array_keys($params))) {
			if (!is_null($params['cooldown'])) {
				$stateEntry->cooldown = date('Y-m-d H:i:s', $params['cooldown']);
			}
			else {
				$stateEntry->cooldown = null;
			}
		}
		$result = $stateEntry->save();
		return $result;
	}

	/**
	 * Устанавлиает время $time до конца таймера статуса с именем $alias
	 * @alias string Название статуса
	 * @time timestamp Время до конца таймера статуса
	 * @return bool Результат сохранения статуса. Должно быть true если всё прошло удачно
	 */
	public function setStateCooldown($alias, $time = null) {
		return $this->setStateParams($alias, [
			'cooldown' => $time
		]);
	}

	/**
	 * Устанавлиает значение $val статуса с именем $alias
	 * @alias string Название статуса
	 * @val string Значение статуса
	 * @global bool Глобальный
	 * @return bool Результат сохранения статуса. Должно быть true если всё прошло удачно
	 */
	public function setStateVal($alias, $val = null, $global = false) {
		return $this->setStateParams($alias, [
			'state_text' => $val,
			'is_global' => $global ? 1 : 0
		]);
	}

	/**
	 * Устанавлиает числовое значение $val статуса с именем $alias
	 * @alias string Название статуса
	 * @val int Значение статуса
	 * @global bool Глобальный
	 * @return bool Результат сохранения статуса. Должно быть true если всё прошло удачно
	 */
	public function setStateIntVal($alias, $val = 0, $global = false) {
		return $this->setStateParams($alias, [
			'state_int' => (int)$val,
			'is_global' => $global ? 1 : 0
		]);
	}

	/**
	 * Количество монет у персонажа, форматированное
	 * @return string
	 */
	public function getCoinsText() {
		return number_format($this->coins, 0, ' ', ' ');
	}

	/**
	 * Количество желудей у персонажа, форматированное
	 * @return string
	 */
	public function getNutsText() {
		return number_format($this->nuts, 0, ' ', ' ');
	}

	/**
	 * Количество грибов у персонажа, форматированное
	 * @return string
	 */
	public function getMushroomsText() {
		return number_format($this->mushrooms, 0, ' ', ' ');
	}

	/**
	 * Добавляет $amount штук предмета с id = $item_id в рюкзак
	 * @item_id integer ID предмета
	 * @amount integer Количество штук
	 * @return bool Результат добавления. Должно быть true если всё прошло удачно
	 */
	public function addItem($item_id, $amount = 1) {
		$item = Item::model()->findByPk($item_id);
		if (!empty($item)) {
			if ($item->bag_limit) {
				$old_amount = 0;
				$player_items = PlayerItems::model()->findByAttributes(['player_id' => $this->id, 'item_id' => $item_id]);
				if (!empty($player_items)) {
					$old_amount = $player_items->amount;
					$player_items->delete();
				}
				$player_items = new PlayerItems;
				$player_items->player_id = $this->id;
				$player_items->item_id = $item_id;
				$player_items->quality = $item->quality;
				$player_items->amount = $amount + $old_amount;
				if ($player_items->amount > $item->bag_limit) {
					$player_items->amount = $item->bag_limit;
					Yii::app()->user->setFlash('error', Yii::t('error', '__player__add_item_no_free_space'));

					// Пишем в лог и в сайдбар, что не вошло
					Funcs::logMessage('Ошибка добавления предмета id='.$item_id.', превышен лимит.');
				}
				return $player_items->save();
			}
			else {
				// @TODO - проверка на свободность слотов
				$player_items = new PlayerItems;
				$player_items->player_id = $this->id;
				$player_items->item_id = $item_id;
				$player_items->quality = $item->quality;
				$player_items->amount = 1;
				return $player_items->save();
			}
			return true;
		}
		else {
			return false;
		}
	}

	/**
	 * Удаляет $amount штук предмета с id = $item_id из рюкзака
	 * @item_id integer ID предмета
	 * @amount integer Количество штук
	 * @return bool Результат удаления. Должно быть true если всё прошло удачно
	 */
	public function removeItem($item_id, $amount = 1) {
		$item = Item::model()->findByPk($item_id);
		if (!empty($item)) {
			$player_item = PlayerItems::model()->findByAttributes(['player_id' => $this->id, 'item_id' => $item_id]);
			if (!empty($player_item)) {
				$player_item->amount -= $amount;
				if (!$player_item->amount) {
					return $player_item->delete();
				}
				else {
					return $player_item->save();
				}
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}

	/**
	 * Проверяет, может ли игрок использовать Item предмет player.
	 * @item Item предмет
	 * @return bool true, если может
	 */
	function canUseItem($item = null) {
		if (empty($item)) {
			return false;
		}
		return (
			($item->required_lvl <= $this->lvl) // проверка на требуемый уровень
		);
	}

	/**
	 * Проверяет, может ли игрок использовать PlayerItem предмет player_item.
	 * @player_item PlayerItem экземпляр предмета
	 * @return bool true, если может
	 */
	function canUsePlayerItem($player_item = null) {
		if (empty($player_item)) {
			return false;
		}
		return $this->canUseItem($player_item->item);
	}

	/**
	 * Проверяет наличие достижения $alias с требуемым значением $val и при необходимости выдаёт
	 * @alias string алиас достижения
	 * @val string значение достижения
	 */
	function checkAchievment($alias, $val = null) {
		$tested_achievments = Achievment::model()->findAllByAttributes(['alias' => $alias]);
		foreach ($tested_achievments as $tested_achievment) {
			if ($tested_achievment->val == $val) {
				$has_achievment = false;
				foreach ($this->achievments as $achievment) {
					if (($tested_achievment->rank == $achievment->rank) && ($achievment->alias == $alias))
						$has_achievment = true;
				}
				if (!$has_achievment) {
					$pa = new PlayerAchievments;
					$pa->player_id = $this->id;
					$pa->achievment_id = $tested_achievment->id;
					$pa->dt = date('Y-m-d H:i:s');
					$pa->save();

					Funcs::logMessage(Yii::t('success', '__player__new_achievment', [
						'{title}' => $tested_achievment->title,
						'{rank}' => $tested_achievment->rank,
					]), 'achievments');
				}
			}
		}
	}

	/**
	 * Применяет активные ауры игрока
	 */
	function applyAuras() {
		foreach ($this->states as $player_state) {
			if ($player_state->state_text == 'aura') {
				$aura_class = new $player_state->alias;
				$aura_class->user = $player_state->player->user;
				$aura_class->auraEffect();
			}
			if (($player_state->state_text == 'spell') && (strtotime($player_state->cooldown) > time())) {
				$aura_class = new $player_state->alias;
				$aura_class->user = $player_state->player->user;
				$aura_class->auraEffect();
			}
		}
	}

}
