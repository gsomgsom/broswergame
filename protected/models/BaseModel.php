<?php

/**
 * Модель "BaseModel"
 *
 * @author Желнин Евгений <zhelneen@yandex.ru>
 * @description Базовая модель для предметов и всего остального, что может иметь ауру.
 */

class BaseModel extends CActiveRecord {
	public $user = null;

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