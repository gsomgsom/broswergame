<?php

class Title extends CWidget {
    public function run() {
		if (Yii::app()->params['pageTitle']) {
			echo Yii::app()->params['pageTitle']." :: «".Yii::app()->params['title']."»";
		}
		else {
			echo "«".Yii::app()->params['title']."»";
		}
    }
}