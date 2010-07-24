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
            $i = 0;
            $closeTag = '';
            foreach ($this->_elements as $type => $elements) {
                $cntElms = count($elements);
                switch ($type) {
                    case 'simple_link' :
                        foreach ($elements as $index => $elm) {
                            $label = implode(' ', array_keys($elm));
                            $url = implode(' ',array_values($elm));
                            if ($i == 0) {
                                $xHtml .= '<ul class="toolbar-list">';
                            }

                            $xHtml .= '<li>';
                            $xHtml .= '<a href="' . $url . '">';
                            $xHtml .= $label;
                            $xHtml .= '</a>';
                            $xHtml .= '</li>';
                            if ($i == $cntElms - 1)
                                $xHtml .= '</ul>';
                            $i++;
                        }
                        break;

                    case 'selector_js' :
                        $i = 0;
                        $cntElms = count($elements[0]); // works on options
                        foreach ($elements[0] as $label => $url) {
                            if ($i == 0) {
                                $xHtml .= '<select class="toolbar-select" id="selector_js_'.($i+1).'">';
                            }

                            $xHtml .= '<option value="'.$url.'">'.$label.'</option>';

                            if ($i == $cntElms - 1)
                                $xHtml .= '</select>';
                            $i++;
                        }
                        break;

                    default :
                        break;
                }
            }
            $xHtml .= $closeTag;
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
        foreach ($elements as $typeName => $elm) {
            $buffer = '';
            while (($pos = strpos($typeName, '_')) !== false) {
                $buffer .= substr($typeName, 0, $pos+1);
                $strposUnderScore = $pos;
                $typeName = substr($typeName, $pos+1);
            }
            // delete last underscore
            $buffer = substr($buffer, 0, strlen($buffer)-1);

            $type = $buffer;
            if (empty($this->_elements[$type]))
                $this->_elements[$type] = array();
            $this->_elements[$type][] = $elm;
        }

        return $this;
    }
}
