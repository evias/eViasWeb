<?php

class Catalogue_ArticlesController
    extends AppLib_Controller_Action_Catalogue
{
    public function init() {
        parent::init();

        $elements = array();
        if ($this->_tryAuth()) {
            $elements = array(
                'Ajouter article'   => $this->view->url(array(), 'catalogue/articles/form/add'),
            );
        }

        $this->view->toolBar->addElements($elements);
    }

    public function indexAction() {
        $articleModel = new eVias_Service_Catalogue_Article;
        $this->view->articles = $articleModel->getAll();

        $this->view->myHistory->addHistory(array('Accueil des articles' => $this->view->url(array(), 'catalogue/articles/manage')));
    }

    public function addAction() {

    }
}
