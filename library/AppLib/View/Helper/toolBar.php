<?php

class AppLib_View_Helper_toolBar
    extends Zend_View_Helper_Abstract
{
    protected $_view = null;
    protected $_elements = array();

    public function display() {
        $xHtml = '';

        $xHtml .= '<div id="toolbar">';

        if (! empty($this->_elements)) {
            $xHtml .= '<fieldset>';
            $xHtml .= '<legend>Actions</legend>';
            $xHtml .= '<ul>';
            foreach ($this->_elements as $label => $url) {
                $xHtml .= '<li>';
                $xHtml .= '<a href="' . $url . '">';
                $xHtml .= $label;
                $xHtml .= '</a>';
                $xHTml .= '</li>';
            }
            $xHtml .= '</ul>';
        }
        else
            $xHtml .= '<span>Aucune action disponible</span>';

        $xHtml .= '</div>';

        return $xHtml;
    }

    public function setView(Zend_View_Interface $view) {
        $this->_view = $view;

        return $this;
    }

    public function countElements() {
        return count($this->_elements);
    }

    public function addElements(array $elements) {
        $this->_elements = array_merge($this->_elements, $elements);

        return $this;
    }
}
