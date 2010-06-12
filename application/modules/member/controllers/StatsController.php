<?php

class Member_StatsController
    extends AppLib_Controller_Action_Member
{
    public function init() {
        parent::init();
        
        $this->view->headTitle('Membre', 'PREPEND');
    }

    public function indexAction() {
        $this->view->headTitle('Statistiques du membre', 'PREPEND');
    }
}
