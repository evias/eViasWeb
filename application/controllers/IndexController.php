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

    public function languageAction ()
    {
        if (isset($_GET['lang'])) {
            $lang = $this->_getParam('lang');

            if( ! in_array($lang, array('fr', 'en', 'de')) )
                $lang = 'fr';

            $langSession = new Zend_Session_Namespace ('language');
            $langSession->lang = $lang;
        }

        $this->_redirect($this->view->url(array(), 'default'));
    }
}



