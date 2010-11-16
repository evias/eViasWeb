<?php

class eViasWeb_View_Helper_RightPanel extends Zend_View_Helper_Abstract
{
    private $_articles = array();

    public function rightPanel()
    {
        $html = "";

        $html .= "<h3>Derniers articles</h3>";

        $html .= $this->_getBlogLatest();

        // render twitterPanel
        $html .= $this->view->widgetTwitter(false);

        return $html;
    }

    private function _getBlogLatest()
    {
        if (empty($this->_articles)) {
            $articles = eVias_Blog_Article::loadAllPublished();

            $this->_articles = $articles;
        }

        $html = "";

        if (! empty($this->_articles)) {

            $html .= "<ul>";
            for ($ix = 0, $cntArticles = count($this->_articles);
                 $ix < 3 && $ix < $cntArticles;
                 $ix++
            ) {
                $articleTitle = $this->_articles[$ix]->titre;
                $articleLink  = "/blog/index/show-full-article/?article_id=" . $this->_articles[$ix]->article_id;

                $html .= "
                    <li class='article'>
                        <a href='$articleLink'>
                        - $articleTitle
                        </a>
                    </li>
                ";
            }
            $html .= "</ul>";

        }

        return $html;
    }

}

