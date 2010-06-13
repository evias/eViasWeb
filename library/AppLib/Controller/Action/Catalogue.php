<?php

class AppLib_Controller_Action_Catalogue
    extends AppLib_Controller_Action
{
    // used in catalogue module for fetching data
    protected $_dataModel;

    public function init() {
        parent::init(); // init user session + navigation

        $this->_initCatalogueNav();

        $this->_dataModel = new eVias_Service_Catalogue;

        $this->_initCatalogueToolBar();
    }

    protected function _initCatalogueNav() {
        $pages = array(
            array(
                'type'  => 'mvc',
                'label' => 'Statistiques',
                'route' => 'catalogue/stats',
            ),
        );

        $loggedPages = array();
        if ($this->_tryAuth()) {
            $loggedPages = array(
                array(
                    'type'  => 'mvc',
                    'label' => 'Gérer les catégories',
                    'route' => 'catalogue/categories/manage'
                ),
                array(
                    'type'  => 'mvc',
                    'label' => 'Gérer les articles',
                    'route' => 'catalogue/articles/manage'
                ),
            );
        }

        $this->view->subNavigation->subNavigation(array_merge($pages,$loggedPages));
    }

    protected function _initCatalogueToolBar() {
        $elements = array();
        if ($this->_tryAuth()) {
            $elements = array(
                'Ajouter catégorie' => $this->view->url(array(), 'catalogue/categories/form/add'),
                'Ajouter article'   => $this->view->url(array(), 'catalogue/articles/form/add'),
            );
        }

        $this->view->toolBar->addElements($elements);
    }
}
