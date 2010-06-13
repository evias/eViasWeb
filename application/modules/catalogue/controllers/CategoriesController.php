<?php

class Catalogue_CategoriesController
    extends AppLib_Controller_Action_Catalogue
{
    public function init() {
        parent::init();
    }

    public function indexAction() {
        $categoryModel = new eVias_Service_Catalogue_Category;
        $this->view->categories = $categoryModel->getAll();
    }

    public function addAction() {
        $this->view->headTitle('Ajouter une catégorie', 'PREPEND');
    }
}
