<?php

class AppLib_Service
{

	private $_dbParams = array(
		'host'		=> 'localhost',
		'username'  => 'postgres',
		'password'  => 'xaJae7uu',
		'dbname'	=> 'evias'
	);

	/**
	 *	Db Adapter, if not set the service
	 *	returns empty values.
	 *
	 * @var Zend_Db_Adapter_*
	 * @access static protected
	 */
	static protected $_db = null;

	public function __construct() {
		if (! isset(self::$_db)) {
			try {
				self::$_db = new Zend_Db_Adapter_Pdo_Pgsql($this->_dbParams);

				self::setDefaultAdapter(self::$_db);
			}
			catch (Exception $e) {
				// driver not installed
			}
		}
	}

	static public function setDefaultAdapter(Zend_Db_Adapter_Abstract $adapter) {
		if (! isset(self::$_db)) {
			self::$_db = $adapter;
		}
	}

	static public function getDefaultAdapter() {
		if (! isset(self::$_db)) {
			throw new AppLib_Service_Exception('I guess you haven\'t set up this database adapter yet..');
		}

		return self::$_db;
	}
}
