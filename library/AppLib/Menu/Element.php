<?php
// implement abstract class
// add Element_Resource (image, video...)
class AppLib_Menu_Element
{
	protected $_id			= null;
	protected $_title		= null;
	protected $_route		= null;
	protected $_routeArgs	= null;
	protected $_cssAttr		= null;
	protected $_jsEvents	= null;
	protected $_url			= null;
	protected $_children	= null;
	protected $_countChildren = 0;

	protected $_isUrl		= false;
	protected $_isRoute		= true;

	protected $_isActive	= true;

	public function __construct() {
		$this->_id = AppLib_Menu::nextId();
	}

	// instant binding

	public function bind(array $data) {
		foreach ($data as $varName => $value) {
			$var = '_' . $varName;

			// @todo : add offset validator
			// @todo : add value validator

			$this->$var = $value;

			// if binding children array, count should be updated
			if ($varName == 'children') {
				$this->_countChildren = count((array) $value);
			}
		}

		return $this;
	}

	// SETTERS

	public function activate() {
		$this->_isActive = true;
	}

	public function shutdown() {
		$this->_isActive = false;
	}

	public function setTitle($title) {
		if (! is_string($title)) {
			throw new AppLib_Menu_Exception('Title should be a string value.');
		}

		$this->_title = $title;

		return $this;
	}

	public function setRoute($route, array $args=array()) {
		if (! is_string($route)) {
			throw new AppLib_Menu_Exception('Route should be a string value.');
		}

		$this->_url = null;
		$this->_isUrl = false;
		$this->_isRoute = true;

		if (! empty($args)) {
			$this->_routeArgs = $args;
		}
		
		$this->_route = $route;

		return $this;
	}

	public function setUrl($url) {
		if (! is_string($url)) {
			throw new AppLib_Menu_Exception('Url should be a string value.');
		}

		$this->_route = null;
		$this->_routeArgs = null;
		$this->_isUrl = true;
		$this->_isRoute = false;

		$this->_url = $url;

		return $this;
	}

	public function setCssAttributes(array $css) {
		// @todo : add css validator

		$this->_cssAttr = $css;

		return $this;
	}

	public function setJsEvents(array $js) {
		// @todo : add js validator

		$this->_jsEvents = $js;

		return $this;
	}

	public function setChildren(array $children) {
		$this->_children = $children;
		$this->_countChildren = count($children);

		return $this;
	}

	public function addChildren(array $children) {
		$valids = array();
		$warnings = array();
		foreach ($children as $elm) {
			$warnings[$elm->getId()] = array();
			if (! $elm instanceof AppLib_Menu_Element) {
				$warnings['ARGS'] = 'Elements in array should all be AppLib_Menu_Element instances.';
				continue;
			}

			if (! $elm->isValidForAdd()) {
				$warnings[$elm->getId()] = implode(', ', array_keys($elm->getValidNeeds())) . ' should not be empty.';
				continue;
			}

			$this->_children[] = $elm;
			$this->_countChildren++;
		}

		return $this;
	}

	public function addChild(AppLib_Menu_Element $elm) {
		if (! $elm->isValidForAdd()) {
			throw new AppLib_Menu_Exception(implode(', ', array_keys($elm->getValidNeeds())) . ' should not be empty.');
		}

		if (empty($this->_children)) {
			$this->_children = array();
		}

		$this->_children[] = $elm;

		return $this;
	}

	// DATA VALIDATION

	public function isValidForAdd() {
		$conditions = (
			(! empty($this->_id)) && (! empty($this->_title)) &&
			(
				(! empty($this->_route)) ||
				(! empty($this->_url))
			)
		);

		return $conditions;
	}

	public function getValidNeeds() {
		$conditions = array(
			'title' => false,
			'route' => ($this->_isUrl ? true : false),
			'url'   => ($this->_isUrl ? false : true),
		);

		$copy = $conditions;

		foreach ($conditions as $var => $valid) {
			$varName = '_' . $var;
			if (! empty($this->$varName)) {
				// data is valid 
				unset($copy[$var]);
			}
			else {
				$copy[$var] = false;
			}
		}

		return $copy;
	}

	// GETTERS
	
	public function hasChildren() {
		return $this->_countChildren > 0;
	}

	public function getId() {
		return $this->_id;
	}

	public function getTitle() {
		return $this->_title;
	}

	public function getRoute() {
		return $this->_route;
	}

	public function getRouteArgs() {
		return $this->_routeArgs;
	}

	public function getUrl() {
		return $this->_url;
	}

	public function getCss() {
		return $this->_cssAttr;
	}

	public function getJs() {
		return $this->_jsEvents;
	}

	public function getChildren() {
		return $this->_children;
	}

	public function isUrl() {
		return $this->_isUrl;
	}

	public function isRoute() {
		return $this->_isRoute;
	}

	public function isActive() {
		return $this->_isActive;
	}
}
