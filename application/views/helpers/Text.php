<?php

class eViasWeb_View_Helper_Text
    extends Zend_View_Helper_Abstract
{
    public function text($str)
    {
		$encoding = mb_detect_encoding($str, array('UTF-8', 'ISO-8859-15'));
		if ($encoding != 'UTF-8') {
			$string = mb_convert_encoding($str, 'UTF-8', $encoding);
		}
		echo ($str);
    }
}

