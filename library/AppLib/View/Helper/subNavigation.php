<?php

class AppLib_View_Helper_subNavigation
    extends Zend_View_Helper_Abstract
{
    protected $_view = null;
    protected $_cssAttr = array(); // li css attributes
    protected $_pages = array();

    private $_multiAttr = array(
        'class'
    );

    public function subNavigation(array $subPages, $displayMe = false) {
        $setNoUrl = false;
        if (is_null($this->_view))
            $setNoUrl = true;

        if (! $displayMe) {
            // may be called to just add some pages
            $this->_pages = array_merge( $this->_pages, $subPages );
            return '';
        }

        $xHtml = '';
        if (count($this->_pages) > 0)
            $xHtml .= '<ul class="navigation">';
        else return $xHtml;

        $i = 0;
        foreach ($this->_pages as $page) {
            if (! is_array($page))
                continue;
            if (empty($page['label']) && empty($page['route']))
                continue; // does not have enough params

            if (empty($page['route']))
                $setNoUrl = true;

            if (empty($page['route_conf']))
                $page['route_conf'] = array();

            if (empty($page['label']))
                $page['label'] = 'Page ' . ($i + 1);

            $xHtml .= '<li>';
            $xHtml .= '<a class="' . $this->_cssAttr['class'] . '" href="' . ($setNoUrl ? '#' : $this->_view->url($page['route_conf'], $page['route'])) . '">';
            $xHtml .= $page['label'];
            $xHtml .= '</a>';
            $xHtml .= '</li>';

            $i++;
        }

        return $xHtml;
    }

    public function setView(Zend_View_Interface $view) {
        $this->_view = $view;

        return $this;
    }

    public function countPages() {
        return count($this->_pages);
    }

    public function addCssAttr(array $attr) {
        foreach ($attr as $attrName => $attrVal)
            if (in_array($attrName, $this->_multiAttr))
                $this->_cssAttr[$attrName] = $this->_cssAttr[$attrName] . ' ' . $attrVal;

        return $this;
    }
}
