<?php

if (! function_exists ('__')) {
    function __($key)
    {
        $langSession = new Zend_Session_Namespace('language');

        return AppLib_Bootstrap::langAdapter()->_($key, empty($langSession->lang) ? "fr" : $langSession->lang);
    }
}

class AppLib_Bootstrap
	extends Zend_Application_Bootstrap_Bootstrap
{
	public static $_authAdapter = null;
    public static $_langAdapter = null;

	public function _initAutoloader() {
		// register default namespace
		$moduleAutoloader = new Zend_Application_Module_Autoloader(array(
			'namespace' => '',
			'basePath'  => APPLICATION_PATH));

        // register namespace for Application Library
		// register namespace for eVias Framework
		$libAutoloader = Zend_Loader_Autoloader::getInstance();
		$libAutoloader->registerNamespace('AppLib_');
		$libAutoloader->registerNamespace('eVias_');

		return $moduleAutoloader;
	}

	/**
	 * Create connection
	 *
	 */
	protected function _initDatabaseConnection() {
        // @FIXME: do not initialize, not needed. Models do the work
		$args = array(
			'host'		=> 'localhost',
			'username'	=> 'dev',
			'password'  => 'opendev',
			'dbname'	=> 'evias'
		);

		eVias_ArrayObject_Db::setDefaultAdapter(new Zend_Db_Adapter_Pdo_Pgsql($args));
	 }

	public function _initViewHelpers() {
		$this->bootstrap('layout');
		$layout = $this->getResource('layout');
		$layout->setInflectorTarget(':script.:suffix');
		$layout->setViewSuffix('php');

		$view = new eVias_View();

		$view->doctype('XHTML1_STRICT');
		$view->headMeta()->appendHttpEquiv('Content-type', 'text/html;charset=utf-8');
		$view->headTitle()->setSeparator(' - ');
		$view->headTitle('eViasWeb Application');

		$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
		$viewRenderer->setView($view)
					 ->setViewSuffix('php');

        $subNav = new AppLib_View_Helper_subNavigation;
        $subNav->setView($view)
               ->addCssAttr(array('class' => 'sub'));

        $view->subNavigation = $subNav;

        $toolBar = new AppLib_View_Helper_toolBar;
        $toolBar->setView($view);

        $view->toolBar = $toolBar;

        $myHistory = new AppLib_View_Helper_myHistory;
        $myHistory->setView($view);

        $view->myHistory = $myHistory;

		Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
	}


	/**
	 * _initRouter
	 * initiliazes default routes to several modules,
	 * controllers and actions.
	 *
	 * @todo : read from configuration
	 *
	 * @return void
	 */
	protected function _initRouter() {
		$frontCtl 	= Zend_Controller_Front::getInstance();
		$router 	= $frontCtl->getRouter();

		foreach ($this->_getRoutes() as $routeTitle => $route) {
			$router->addRoute($routeTitle, $route);
		}
	}

	/**
	 * _initAuth
	 * initializes user authentication through db
	 *
	 * @return void
	 *
	 */
	protected function _initAuth() {
		$db = eVias_ArrayObject_Db::getDefaultAdapter();

		if (is_null($db)) {
			return false;
		}

		$authAdapter = new Zend_Auth_Adapter_DbTable($db);
		$authAdapter->setTableName('evias_users')
					->setIdentityColumn('access_name')
					->setCredentialColumn('access_pass');

		self::$_authAdapter = $authAdapter;
	}

	public static function authAdapter() {
		if (! isset(self::$_authAdapter)) {
			return false;
		}

		return self::$_authAdapter;
	}

    public static function langAdapter() {
        if (! isset(self::$_langAdapter)) {
            self::initializeLocales();
        }

        return self::$_langAdapter;
    }

    private static function initializeLocales()
    {
        self::$_langAdapter = new Zend_Translate ('gettext', APPLICATION_PATH . "/locales/fr/LC_MESSAGES/messages.mo", "fr");
        self::$_langAdapter->addTranslation (APPLICATION_PATH . '/locales/en/LC_MESSAGES/messages.mo', "en");
        self::$_langAdapter->addTranslation (APPLICATION_PATH . '/locales/de/LC_MESSAGES/messages.mo', "de");
    }

	private function _getRoutes() {
		return AppLib_Routes::fetch();
	}

}
