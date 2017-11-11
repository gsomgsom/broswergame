<?php

class WheelItem extends CWidget {
	public $id = 1;			// id предмета
	public $top = 0;		// смещение сверху
	public $left = 0;		// смещение слева
	public $amount = 1;		// кол-во

    public function run() {
		$item = Item::model()->findByPk($this->id);
		$player_item = new PlayerItems;
		$player_item->item = $item;
		$player_item->amount = $this->amount;
		$player_item->quality = $item->quality;
		$data = [
			'player_item' => $player_item,
			'top' => $this->top,
			'left' => $this->left,
		];
		echo $this->render('/wheel_item', $data);
    }
}