<?php

class Catalogue_ArticlesController
    extends AppLib_Controller_Action_Catalogue
{
    public function init() {
        parent::init();
    }

    public function indexAction() {
        $articleModel = new eVias_Service_Catalogue_Article;
        $this->view->articles = $articleModel->getAll();
    }

    public function addAction() {

    }
}
