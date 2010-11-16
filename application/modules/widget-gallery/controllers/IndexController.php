<?php

class WidgetGallery_IndexController
	extends AppLib_Controller_Action_Catalogue
{
    public function init() {
        parent::init();
    }

	public function indexAction()
	{
		$this->view->headTitle('Widgets', 'PREPEND');
	}
}
