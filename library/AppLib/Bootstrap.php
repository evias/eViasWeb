<?php

class AppLib_Bootstrap
	extends Zend_Application_Bootstrap_Bootstrap
{
	public static $_authAdapter = null;

	public function _initAutoloader() {
		// register default namespace
		$moduleAutoloader = new Zend_Application_Module_Autoloader(array(
			'namespace' => '',
			'basePath'  => APPLICATION_PATH));

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
		$args = array(
			'host'		=> 'localhost',
			'username'	=> 'gsaive',
			'password'  => 'xaJae7uu',
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
		$view->addHelperPath(dirname(__FILE__) . '/View/Helper/', 'AppLib_View_Helper');

		$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
		$viewRenderer->setView($view)
					 ->setViewSuffix('php');

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

		if (! isset($db) || $db === 1) {
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

	private function _getRoutes() {
		return AppLib_Routes::fetch();
	}

}
