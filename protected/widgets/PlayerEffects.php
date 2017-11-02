<?php

class PlayerEffects extends CWidget {
    public function run() {
		$data = [];
		echo $this->render('/playereffects', $data);
    }
}