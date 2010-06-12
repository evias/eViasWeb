<?php

class Blog_StatsController
    extends AppLib_Controller_Action_Blog
{
    public function init() {
        parent::init();
    }
    
    public function indexAction() {
        $this->view->headTitle('Accueil du Blog', 'PREPEND');
    }
} 
