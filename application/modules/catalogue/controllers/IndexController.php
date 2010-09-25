<?php

class Catalogue_IndexController
	extends AppLib_Controller_Action_Catalogue
{
    public function init() {
        parent::init();
    }

	public function indexAction()
	{
		$this->view->headTitle('Portfolio', 'PREPEND');

		$this->view->projectsList = $this->_dataModel->getAll();
	}
}
