<?php

class AppLib_Controller_Action_Blog
    extends AppLib_Controller_Action
{
    public function init() {
        parent::init();

        $this->_initBlogNav();
    }

    protected function _initBlogNav() {
        $pages = array(
            array(
                'type'  => 'uri',
                'label' => 'Membres',
                'uri'   => '/blog/members/index',
                'class' => 'sub',
            ),
        );

        $loggedPages = array();
        if ($this->_tryAuth()) {
            $loggedPages = array(
	            array(
		        	'type'		=> 'uri',
	    			'label'		=> 'Ajout de billet',
	    			'uri'		=> '/blog/index/write',
	                'class'     => 'sub'),
            	array(
		        	'type'		=> 'uri',
	    			'label'		=> 'Gestion des billets',
	    			'uri'		=> '/blog/index/admin',
	                'class'     => 'sub'),
            );
        }

        $this->view->subPages = array_merge($pages, $loggedPages);
    }
}
