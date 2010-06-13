<?php

class Catalogue_IndexController
	extends AppLib_Controller_Action_Catalogue
{
    public function init() {
        parent::init();
    }

	public function indexAction()
	{
		$this->view->headTitle('Catalogue', 'PREPEND');

		$this->view->catalogueList = $this->_dataModel->getAll();
	}
}
