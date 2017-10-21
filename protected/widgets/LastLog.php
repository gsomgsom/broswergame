<?php

class LastLog extends CWidget {
    public function run() {
		$data = [];
		// @TODO
		echo $this->render('/lastlog', $data);
    }
}