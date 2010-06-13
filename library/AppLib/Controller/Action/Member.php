<?php

class AppLib_Controller_Action_Member
    extends AppLib_Controller_Action
{
    public function init() {
        parent::init();

        $this->_initMemberNav();

        if (false === $this->_tryAuth()) {
            $this->_forward('login', 'index', 'member');
        }
        else {
            $session = $this->_getSession();
            $this->view->userName = 'Visiteur';
            if (false !== $session) {
                $this->view->userName = $session->memberObject['realname'];
            }
        }

        $this->view->headTitle('Membre', 'PREPEND');
    }

    protected function _initMemberNav() {
        $pages = array();
        if ($this->_tryAuth()) {
            $pages = array(
                array(
                    'type'  => 'mvc',
                    'label' => 'Statistiques',
                    'route' => 'member/stats',
                ),
            );
        }

        $loggedPages = array();
        if ($this->_tryAuth()) {
            $loggedPages = array(
				array(
					'type' 		=> 'mvc',
					'label' 	=> 'Me déconnecter',
					'route' 	=> 'member/logout'),
            	array(
	        		'type'		=> 'mvc',
	    			'label'		=> 'Mon profil',
	    			'route'		=> 'member/profile'),
            );
        }

        $this->view->subNavigation->subNavigation(array_merge($pages, $loggedPages));
    }
}
