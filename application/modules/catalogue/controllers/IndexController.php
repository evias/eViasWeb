<?php

class Catalogue_IndexController 
	extends AppLib_Controller_Action
{

	public function indexAction()
	{
		$this->view->headTitle('Catalogue', 'PREPEND');

		$this->view->catalogueList = eVias_Catalogue::fetchAll('eVias_Catalogue');
	}


}

