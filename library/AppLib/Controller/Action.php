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

		$this->_initNavigation();
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
	private function _initNavigation() {
		$pages = array(
			array(
				'type'		=> 'mvc',
				'label'		=> 'Accueil',
				'route'		=> 'default'
			),
			array(
				'type'		=> 'mvc',
				'label'		=> 'Blog',
				'route'		=> 'blog'
			),
			array(
				'type'		=> 'mvc',
				'label'		=> 'Catalogue',
				'route'		=> 'catalogue'
			),
			array(
				'type'		=> 'mvc',
				'label'		=> 'Panel membre',
				'route'		=> 'member'
			),

		);

		if ($this->_tryAuth()) {
			$loggedInMenu =	array(
				array(
					'type' 		=> 'mvc',
					'label' 	=> 'Me déconnecter',
					'route' 	=> 'member/logout',
					'class' 	=> 'sub'
				),
            	array(
	        		'type'		=> 'mvc',
	    			'label'		=> 'Mon profil',
	    			'route'		=> 'member/profile',
					'class' 	=> 'sub'
		    	),
	            array(
		        	'type'		=> 'mvc',
	    			'label'		=> 'Ajout de billet',
	    			'route'		=> 'blog/write',
	                'class'     => 'sub'
		    	),
            	array(
		        	'type'		=> 'mvc',
	    			'label'		=> 'Gestion des billets',
	    			'route'		=> 'blog/admin',
	                'class'     => 'sub'
		    	),
			);
           
			$pages = array_merge($pages, $loggedInMenu);
		}

		$this->_navigation = new Zend_Navigation($pages);
		$this->view->navigation($this->_navigation);
	}
	
	protected function _getNavigation() {
		if (! isset($this->_navigation)) {
			return false;
		}

		return $this->_navigation;
	}
}
