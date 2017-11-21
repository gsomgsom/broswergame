<?php

class PlayerEffects extends CWidget {
    public function run() {
		$data = [];
		$data['effects'] = [];
		foreach (Yii::app()->getController()->user->player->states as $player_state) {
			if ($player_state->state_text == 'aura') {
				$aura_class = new $player_state->alias;
				$effect_entry = [];
				$effect_entry['name'] = $aura_class->auraName();
				$effect_entry['icon'] = $aura_class->auraIcon();
				$effect_entry['type'] = 'aura';
				$effect_entry['title'] = $aura_class->auraTitle();
				$effect_entry['description'] = Funcs::applyCodes($aura_class->auraDescription());
				$effect_entry['cooldown'] = strtotime($player_state->cooldown);
				if ($effect_entry['title']) {
					$data['effects'][] = $effect_entry;
				}
			}
			if (($player_state->state_text == 'spell') && (strtotime($player_state->cooldown) > time())) {
				$aura_class = new $player_state->alias;
				$effect_entry = [];
				$effect_entry['name'] = $aura_class->auraName();
				$effect_entry['icon'] = $aura_class->auraIcon();
				$effect_entry['type'] = 'spell';
				$effect_entry['title'] = $aura_class->auraTitle();
				$effect_entry['description'] = Funcs::applyCodes($aura_class->auraDescription());
				$effect_entry['cooldown'] = strtotime($player_state->cooldown);
				if ($effect_entry['title']) {
					$data['effects'][] = $effect_entry;
				}
			}
		}
		

		echo $this->render('/playereffects', $data);
    }
}