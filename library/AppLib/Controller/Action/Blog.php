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
                'type'  => 'mvc',
                'label' => 'Statistiques',
                'route' => 'blog/stats',
            ),            
            array(
                'type'  => 'mvc',
                'label' => 'Membres',
                'route' => 'blog/members',
            ),            
        );

        $loggedPages = array();
        if ($this->_tryAuth()) {
            $loggedPages = array(
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
