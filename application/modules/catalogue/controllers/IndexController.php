<?php

class Catalogue_IndexController
	extends AppLib_Controller_Action_Catalogue
{
    public function init() {
        parent::init();
    }

	public function indexAction()
	{
		$this->view->headTitle('Catalogue', 'PREPEND');

		$this->view->catalogueList = $this->_dataModel->getAll();
	}

    public function categoryListAction() {
        $this->view->headTitle('Catégories du catalogue', 'PREPEND');

        $categoryModel = new eVias_Service_Catalogue_Category;
        $this->view->categoryList = $categoryModel->getAll();
    }

    public function articleListAction() {
        $this->view->headTitle('Articles du catalogue', 'PREPEND');

        $articleModel = new eVias_Service_Catalogue_Article;
        $this->view->articleList = $articleModel->getAll();
    }

}
