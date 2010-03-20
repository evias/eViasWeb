<?php

class AppLib_Menu
	extends AppLib_Menu_Abstract
{

	protected $_menuId = null;
	protected $_elements = array();
	protected $_countElements = 0;

	public function __construct($menuId = 'default-menu') {
		$this->_menuId = $menuId;
	}

	public function getElements() {
		return $this->_elements;
	}

	public function setActive($element = null) {
		if (empty($this->_elements)) {
			throw new AppLib_Menu_Exception('Trying to set an active element, without elements..');
		}

		if (! isset($element)) {
			// set default activated.. first one.
			$this->_elements[0]->activate();

			if ($this->_countElements > 1) {
				// shutdown all others			
				for ($i = 1; $i < $this->_countElements; $i++) {
					$this->_elements[$i]->shutdown();
				}
			}
		}
		
		$findOn = '';

		if ($element instanceof AppLib_Menu_Element) {
			$findOn = null;
		}
		elseif (is_integer($element)) {
			$findOn = '_id';
		}
		else {
			throw new AppLib_Menu_Exception('The value you gave as argument for setting an active element is of wrong type.');
		}

		foreach ($this->_elements as $elm) {
			// condition differs from type of activating argument
			$condition = (
				! empty($findOn) ? 
					($elm->getId() == $element) : 
					($elm == $element)
			);

			if ($condition) {
				$elm->activate();
			}
			else {
				$element->shutdown();
			}
		}

		return $this;
	}

	public function hasElements() {
		return $this->_countElements > 0;
	}

	public function addElement(AppLib_Menu_Element $element) {
		if (! $element->isValidForAdd()) {
			throw new AppLib_Menu_Exception(implode(', ', $element->getValidNeeds()) . ' should not be empty.');
		}

		if (empty($this->_elements)) {
			$this->_elements = array();
		}
		
		$this->_elements[] = $element;	
		$this->_countElements++;

		return $this;
	}

	public function addElements(array $elements) {
		$valids = array();
		$warnings = array();
		foreach ($elements as $elm) {
			$warnings[$elm->getId()] = array();
			if (! $elm instanceof AppLib_Menu_Element) {
				$warnings['ARGS'] = 'Elements in array should all be AppLib_Menu_Element instances.';
				continue;
			}

			if (! $elm->isValidForAdd()) {
				$warnings[$elm->getId()] = implode(', ', array_keys($elm->getValidNeeds())) . ' should not be empty.';
				continue;
			}

			$this->_elements[] = $elm;
			$this->_countElements++;
		}

		return $this;
	}

	// STATIC

	static public function nextId() {
		return count($this->_elements) + 1;
	}
}
