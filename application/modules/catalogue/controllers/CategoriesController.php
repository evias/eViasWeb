<?php

class Catalogue_CategoriesController
    extends AppLib_Controller_Action_Catalogue
{
    protected $_categoryModel = null;

    public function init() {
        parent::init();

        $elements = array();
        if ($this->_tryAuth()) {
            $elements = array(
                'simple_link_1' => array('Ajouter catégorie' => $this->view->url(array(), 'catalogue/categories/form/add')),
            );
        }

        $this->view->toolBar->addElements($elements);
        $this->view->myHistory->addHistory(array('Gestion des catégories' => $this->view->url(array(), 'catalogue/categories/manage')));

        $this->_categoryModel = new eVias_Service_Catalogue_Category;
        $this->view->headScript()->appendFile($this->view->baseUrl() . '/js/lib/eVias/toolBar.js');
    }

    public function indexAction() {
        if ($this->_tryAuth()) {
            $elements = array(
                'selector_js_1' => array(
                    'Ordre du listing'  => '',
                    'Ordonné par ID'    => $this->view->url(array('order' => 'id'), 'catalogue/categories/sort'),
                    'Ordonné par Nom'   => $this->view->url(array('order' => 'name'), 'catalogue/categories/sort'),
                    'Ordonné par Niveau'=> $this->view->url(array('order' => 'level'), 'catalogue/categories/sort'),
                ),
            );
            $this->view->toolBar->addElements($elements);
        }
        $categoryModel = new eVias_Service_Catalogue_Category;
        $this->view->categories = $categoryModel->getAll(true);

        $flash = $this->_helper->FlashMessenger;
        $this->view->messages = $flash->hasMessages() ? $flash->getMessages() : null;

        $this->view->myHistory->addHistory(array('Accueil Catégories' => $this->view->url(array(), 'catalogue/categories/manage')));
    }

    public function addAction() {
        $this->view->headTitle('Ajouter une catégorie', 'PREPEND');
        $this->view->myHistory->addHistory(array('Ajouter une catégorie' => $this->view->url(array(), 'catalogue/categories/form/add')));

        $this->view->isEdit = false;

        $flash = $this->_helper->FlashMessenger;
        $this->view->messages = $flash->getMessages();

        $fields = eVias_Service_Catalogue_Category::getFields();

        $this->view->params = $this->_paramsFromFields($fields);

        $this->view->formHtml = $this->_categoryModel->formFields($fields);

        $this->render('form');
    }

    public function editAction() {
        if (! $this->_hasParam('id'))
            $this->redirect($this->view->url(array(), 'catalogue/categories/form/add'));

        $id = $this->_getParam('id');
        $this->view->headTitle('Modifier une catégorie', 'PREPEND');
        $this->view->myHistory->addHistory(array('Modifier une catégorie [' . $id . ']' => $this->view->url(array('id' => $id), 'catalogue/categories/form/edit')));

        $this->view->isEdit = true;

        $flash = $this->_helper->FlashMessenger;
        $this->view->messages = $flash->getMessages();

        $fields = eVias_Service_Catalogue_Category::getFields();

        $category = $this->_categoryModel->getById($id);

        $this->view->params = $category->toArray();

        $this->view->formHtml = $this->_categoryModel->formFields($this->view->params);

        $this->render('form');
    }

    // allows same behaviour add / edit
    public function processAction() {
        if ($this->_hasParam('data_sent')) {
            $category_id = null;
            $isEdit = $this->_hasParam('is_edit') ? $this->_getParam('is_edit') : false;
            if (! is_bool($isEdit))
                $isEdit = $isEdit == '1';

            $fields = eVias_Service_Catalogue_Category::getFields();
            $userParams = $this->_paramsFromFields($fields, false);

            $ret = $this->_categoryModel->save($userParams);

            $redirectUrl = $this->view->url(array(), 'catalogue/categories/manage');
            $errorUrl = $this->view->url(array(), 'catalogue/categories/form/add');

            $flashMsg = $ret === true ? 'La catégorie a été sauvegardée.' : $ret;
            $flash = $this->_helper->FlashMessenger;
            $flash->direct($flashMsg);

            if ($ret)
                $this->_redirect($redirectUrl);
            else
                $this->_redirect($errorUrl);

        }
        else {
            $this->_redirect($this->view->myHistory->lastUrl());
        }
    }

    public function sortAction() {
        if (! $this->_hasParam('order')) {
            return ;
        }

        $order = $this->_getParam('order');

        $categoryModel = new eVias_Service_Catalogue_Category;
        $this->view->categories = $categoryModel->getAll(true, $order);

    }
}
