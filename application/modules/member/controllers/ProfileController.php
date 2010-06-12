<?php

class Member_ProfileController
    extends AppLib_Controller_Action_Member
{
    public function init() {
        parent::init();
    }

    public function indexAction() {
        $this->view->headTitle('Mon profil', 'PREPEND');
    }
}
