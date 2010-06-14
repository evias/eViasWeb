<?php

class Catalogue_CategoriesController
    extends AppLib_Controller_Action_Catalogue
{
    public function init() {
        parent::init();

        $elements = array();
        if ($this->_tryAuth()) {
            $elements = array(
                'Ajouter catégorie' => $this->view->url(array(), 'catalogue/categories/form/add'),
            );
        }

        $this->view->toolBar->addElements($elements);
    }

    public function indexAction() {
        $categoryModel = new eVias_Service_Catalogue_Category;
        $this->view->categories = $categoryModel->getAll();

        $this->view->myHistory->addHistory(array('Accueil Catégories' => $this->view->url(array(), 'catalogue/categories/manage')));
    }

    public function addAction() {
        $this->view->headTitle('Ajouter une catégorie', 'PREPEND');
    }
}
