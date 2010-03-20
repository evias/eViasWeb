<?php

class IndexController 
	extends AppLib_Controller_Action
{
    public function indexAction()
	{
		$this->view->headTitle('Accueil', 'PREPEND');
    }
}



