<?php

class AppLib_View_Helper_myHistory
    extends Zend_View_Helper_Abstract
{
    protected $_view = null;
    protected $_histories = array();

    public function display() {
        $xHtml = '';

        if (! empty($this->_histories)) {
            $xHtml .= '<div id="myHistory">';

            $xHtml .= '<ul>';
            $xHtml .= '<li class="title">Historique: </li>';
            foreach ($this->_histories as $label => $url) {
                $xHtml .= '<li>';
                $xHtml .= '<a href="' . $url . '">&gt;' . $label . '</a>';
                $xHtml .= '</li>';
            }
            $xHtml .= '</ul>';

            $xHtml .= '</div>';
            $xHtml .= '<div class="clear"></div>';
        }

        return $xHtml;
    }

    public function setView(Zend_View_Interface $view) {
        $this->_view = $view;

        return $this;
    }

    public function countHistories() {
        return count($this->_Histories);
    }

    public function addHistory(array $history = array()) {
        // format to 'label' => 'link'
        $this->_histories = array_merge ($this->_histories, $history);

        return $this;
    }
}
