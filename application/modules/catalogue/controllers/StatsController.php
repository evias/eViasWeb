<?php

class Catalogue_StatsController
	extends AppLib_Controller_Action_Catalogue
{
    public function init() {
        parent::init();
    }

	public function indexAction()
	{
		$this->view->headTitle('Statistiques', 'PREPEND');

		$this->view->catalogueList = $this->_dataModel->getAll();
	}


}
