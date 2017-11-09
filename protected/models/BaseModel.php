<?php

/**
 * Модель "Item"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Предмет. Всё что связано с предметами и действиями над ним.
 */

class BaseModel extends CActiveRecord {

	/**
	 * Эффект ауры
	 */
	public function auraEffect() {
		// Применяется, если в списке статусов есть алиас класса со значением "aura"
	}

	/**
	 * Название ауры
	 * @return string
	 */
	public function auraName() {
		return get_class($this);
	}

	/**
	 * Иконка ауры
	 * @return string
	 */
	public function auraIcon() {
		return 'energy';
	}

	/**
	 * Заголовок ауры
	 * @return string
	 */
	public function auraTitle() {
		return false;
	}

	/**
	 * Описание ауры
	 * @return string
	 */
	public function auraDescription() {
		return false;
	}

}