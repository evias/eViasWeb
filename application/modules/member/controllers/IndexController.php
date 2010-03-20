<?php

class Member_IndexController 
	extends AppLib_Controller_Action
{

    public function init() {
        parent::init();
        if (false === $this->_tryAuth()) {
            $this->_forward('login');
        }
        else {
            $session = $this->_getSession();
            $this->view->userName = 'Visiteur';
            if (false !== $session) {
                $this->view->userName = $session->memberObject['realname'];
            }
        }
    }

	public function indexAction()
    {
		$this->view->headTitle('Panel membre', 'PREPEND');

    }

    public function loginAction() {
        $this->view->form = $this->_getLoginForm();
        
        $flash = $this->_helper->FlashMessenger->getMessages();
        if (! empty($flash[0])) {
            $this->view->eViasMessage = $flash[0];
        }

        if ($this->_request->isPost()) {
            $form = $this->_getLoginForm();

            // wrong data
            if (! $form->isValid($this->_request->getPost())) {
                $this->view->form = $this->_getLoginForm();
                $this->render('login');
            }
            
            $authResult = $this->_tryAuth($form->getValues());
            
            if (false === $authResult) {
                // auth data not valid
                $form->setDescription('Invalid credentials provided');
                $this->view->form = $form;
                return $this->render('login');
            }
            // success authentication
            $this->_redirect($this->view->url(array(), 'member'));
        } 
    }

    public function logoutAction() {
        $exit = $this->_stopAuth();

//        $flash = $this->_helper->FlashMessenger();    
        if (false === $exit) {
            $this->_helper->FlashMessenger('You have lost your session, please reconnect');
        }
        else {
            $this->_helper->FlashMessenger('You have been disconnected succesfully.');
        } 

        $this->_redirect($this->view->url(array(), 'member/login'));
    }

    public function profileAction() {
        $this->view->headTitle('Mon profil', 'PREPEND');
    }
}

