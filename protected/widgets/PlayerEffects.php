<?php

class PlayerEffects extends CWidget {
    public function run() {
		$data = [];
		$data['effects'] = [];
		foreach (Yii::app()->getController()->user->player->states as $player_state) {
			if ($player_state->state_text == 'aura') {
				$aura_class = new $player_state->alias;
				$aura_class->auraEffect();
				$effect_entry = [];
				$effect_entry['name'] = $aura_class->auraName();
				$data['effects'][] = $effect_entry;
				$aura_class->auraName();
			}
		}
		

		echo $this->render('/playereffects', $data);
    }
}