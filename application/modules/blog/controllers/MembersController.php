<?php

class Blog_MembersController
    extends AppLib_Controller_Action_Blog
{
    public function init() {
        parent::init();
    }
    
    public function indexAction() {
        $this->view->headTitle('Membres du Blog', 'PREPEND');
    }
}
