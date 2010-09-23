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

    public function preDispatch() {

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

    protected function _paramsFromFields(array $fields, $returnEmpty = true) {
        $params = array();

        foreach ($fields as $index => $fieldName) {
            $params[$fieldName] = '';
            if ($this->_hasParam($fieldName)) {
                $paramVal = $this->_getParam($fieldName);
                $params[$fieldName] = $paramVal;

                if (! $returnEmpty && (empty($paramVal) || is_null($paramVal)))
                    unset($params[$fieldName]);
            }
            else
                if (! $returnEmpty)
                    unset($params[$fieldName]);
        }

        return $params;
    }

    protected function _initToolBar() {
        $elements = array(
            'Mes accès' => $this->view->url(array(), 'toolbar/myaccess'),
            'Ma page'   => $this->view->url(array(), 'toolbar/mypage'),
        );

        $this->view->toolBar->addElements($elements);
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
				'label'		=> 'Informations personnelles',
				'route'		=> 'informations'),
            array(
				'type'		=> 'mvc',
				'label'		=> 'Présentation',
				'route'		=> 'presentation'),
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

        foreach ($pages as $page) {
            $this->_navigation->addPage($page);
        }
    }

}
