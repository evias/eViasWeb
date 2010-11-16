<?php

class eViasWeb_View_Helper_WidgetViewer
    extends Zend_View_Helper_Abstract
{
    public function widgetViewer()
    {
        $html = "";

        $html .= "<div class='widget'>";
        $html .= $this->view->widgetTwitter();
        $html .= "</div>";

        return $html;
    }

}

