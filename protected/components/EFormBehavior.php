<?php

class EFormBehavior extends CBehavior {
	public function submitted($button='yt0', $method='POST') {
		$args = $method =='POST' ? $_POST : $_GET;
		if (isset($args[get_class($this->getOwner())]) && isset($args[$button])) {
			$this->getOwner()->attributes = $args[get_class($this->getOwner())];
			return true;
		}
		return false;
	}

	public function validated($button='yt0', $method='POST') {
		return $this->submitted($button,$method) && $this->getOwner()->validate();
	}

	public function saved($button='yt0', $method='POST') {
		return $this->submitted($button,$method) && $this->getOwner()->save();
	}
 
}