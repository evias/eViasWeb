<?php

if (! function_exists ('__')) {
    function __($key)
    {
        $langSession = new Zend_Session_Namespace('language');

        return AppLib_Bootstrap::langAdapter()->_($key, empty($langSession->lang) ? "fr" : $langSession->lang);
    }
}

defined('WWW_LIBRARY') ||
    define ('WWW_LIBRARY', '/srv/srv_eviasdev/www/library');

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
		$args = array(
			'host'		=> 'localhost',
			'username'	=> 'dev',
			'password'  => 'opendev',
			'dbname'	=> 'evias'
		);

		eVias_ArrayObject_Db::setDefaultAdapter(new Zend_Db_Adapter_Pdo_Pgsql($args));
	}

    public function _initTranslator() {
		if (! isset($this->_translateAdapter)) {

			$this->_translateAdapter = new Zend_Translate('tmx', APPLICATION_PATH . '/configs/translations.tmx', 'fr');
		}
    }

	public function _initViewHelpers() {
		$this->bootstrap('layout');
		$this->bootstrap('view');
		$layout = $this->getResource('layout');
		$layout->setInflectorTarget(':script.:suffix');
		$layout->setViewSuffix('php');

		$view = $this->getResource('view');

		$view->doctype('XHTML1_STRICT');
		$view->headMeta()->appendHttpEquiv('Content-type', 'text/html;charset=utf-8');
		$view->headTitle()->setSeparator(' - ');
		$view->headTitle('eViasWeb Application');

		$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
		$viewRenderer->setView($view);
        $viewRenderer->setViewSuffix('php');

        $twitterHelper = new AppLib_Controller_Action_Helper_Twitter();

		Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
        Zend_Controller_Action_HelperBroker::addHelper($twitterHelper);
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

}
