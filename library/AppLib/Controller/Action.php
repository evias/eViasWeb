<?php

class AppLib_Controller_Action
	extends eVias_Controller_Action
{

	protected $_session 	= null;
	protected $_navigation  = null;

	public function init() {
		$this->_session = new Zend_Session_Namespace('eviasweb_user');

		if (! isset($this->_session->isAuth)) {
			// initialize session if not existing
			$this->_session->isAuth = false;
			$this->_session->memberObject = null;
		}

        $this->_navigation = new Zend_Navigation;

		$this->_initDefaultNav();
	}

    public function postDispatch() {
        $this->view->navigation($this->_navigation);
    }

	/**
	 * @return boolean [auth'ed || auth success]
	 */
	protected function _tryAuth(array $loginData=array()) {
		if ($this->_session->isAuth) {
			return true;
		}

		if (empty($loginData)) {
			return false;
		}

		$login = $loginData['access_name'];
		$password = $loginData['access_pass'];
		$user = eVias_Users::loadByLogin($login);

		if (false !== $user && $password === $user->access_pass) {
			$this->_session->isAuth = true;
			$this->_session->memberObject = $user;
			return true;
		}

		return false;
	}

	/**
	 * clear session
	 */
	protected function _stopAuth() {
		if (! isset($this->_session)) {
			return false;
		}

		$this->_session->isAuth = false;
		$this->_session->memberObject = null;

		return true;
	}

	protected function _getSession() {
		if (! isset($this->_session)) {
			return false;
		}

		return $this->_session;
	}

	protected function _getLoginForm() {
		$form = new eVias_LoginForm();
		$form->setAction($this->view->url(array(), 'member/login'));
		return $form;
	}

    // @todo : read configuration
    // @todo : ACL configuration

    protected function _getNavigation() {
		if (! isset($this->_navigation)) {
			return false;
		}

		return $this->_navigation;
	}



    /*
     * PRIVATE API
     */

    private function _initDefaultNav() {
        $this->_initHomeNav();
    }

    private function _initHomeNav() {
        $pages = array(
            array(
				'type'		=> 'mvc',
				'label'		=> 'Accueil',
				'route'		=> 'default'),
            array(
				'type'		=> 'mvc',
				'label'		=> 'Blog',
				'route'		=> 'blog'),
            array(
				'type'		=> 'mvc',
				'label'		=> 'Catalogue',
				'route'		=> 'catalogue'),
 			array(
				'type'		=> 'mvc',
				'label'		=> 'Panel membre',
				'route'		=> 'member'),
        );
/****************************************************
@ todo : split into correct module initialisation..
*/
        $loggedPages = array();
        if ($this->_tryAuth()) {
            $loggedPages = array(
				array(
					'type' 		=> 'mvc',
					'label' 	=> 'Me déconnecter',
					'route' 	=> 'member/logout',
					'class' 	=> 'sub'),
            	array(
	        		'type'		=> 'mvc',
	    			'label'		=> 'Mon profil',
	    			'route'		=> 'member/profile',
					'class' 	=> 'sub'),
	            array(
		        	'type'		=> 'mvc',
	    			'label'		=> 'Ajout de billet',
	    			'route'		=> 'blog/write',
	                'class'     => 'sub'),
            	array(
		        	'type'		=> 'mvc',
	    			'label'		=> 'Gestion des billets',
	    			'route'		=> 'blog/admin',
	                'class'     => 'sub'),
            );
        }

        foreach (array_merge($pages, $loggedPages) as $page) {
            $this->_navigation->addPage($page);
        }
    }

}
