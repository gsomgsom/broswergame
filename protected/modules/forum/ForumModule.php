<?php

class ForumModule extends CWebModule
{
	public $defaultController = 'forum';

	public function init()
	{
            $this->layoutPath = Yii::getPathOfAlias('application.views.layouts');
            $this->layout = 'default';
            // this method is called when the module is being created
            // you may place code here to customize the module or the application;
            // import the module-level models and components
            $this->setImport([
                'application.models.*',
                'forum.models.*',
                'forum.components.*',
                'forum.controllers.*',
            ]);
	}
}
