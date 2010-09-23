<?php

class IndexController
	extends AppLib_Controller_Action
{
    public function indexAction()
	{
		$this->view->headTitle('Accueil', 'PREPEND');
    }

    public function presentationAction()
	{
		$this->view->headTitle('Présentation', 'PREPEND');
    }

    public function informationsAction()
    {
        $this->view->headTitle('Informations personnelles', 'PREPEND');
    }
}



