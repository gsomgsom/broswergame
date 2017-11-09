<?php

class PlayerEquippedItem extends CWidget {
	public $player_item;		// экземпляр предмета
	public $look = false;		// только просмотр

    public function run() {
		$data = [
			'player_item' => $this->player_item,
			'look' => $this->look,
		];
		echo $this->render('/player_equipped_item', $data);
    }
}