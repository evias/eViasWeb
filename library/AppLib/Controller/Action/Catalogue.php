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
    }

    protected function _initCatalogueNav() {
        $pages = array(
            array(
                'type'  => 'mvc',
                'label' => 'Catégories',
                'route' => 'catalogue/categories/list'
            ),
            array(
                'type'  => 'mvc',
                'label' => 'Articles',
                'route' => 'catalogue/articles/list'
            ),
            array(
                'type'  => 'mvc',
                'label' => 'Statistiques',
                'route' => 'catalogue/stats'
            ),
        );

        foreach ($pages as $page) {
            $this->_navigation->addPage($page);
        }
    }
}
