<?php

class Blog_IndexController
	extends AppLib_Controller_Action_Blog
{
    private function _initNavigation ()
    {
        $blogEntries = array();
        try {
            // get all blog entries

            $blogEntries = eVias_Blog_Article::loadAllPublished();
        }
        catch (eVias_Exception $e) {
        }

        $this->view->blogEntries    = $blogEntries;
    }

    public function init() {
        parent::init();
        if (true === $this->_tryAuth()) {
            $session = $this->_getSession();
            $this->view->userName = 'Visiteur';
            if (false !== $session) {
                $this->view->userName = $session->memberObject['realname'];
            }
        }

        $this->view->headTitle('Blog', 'PREPEND');

        $this->_initNavigation();
    }

	public function indexAction()
    {
		$this->view->headTitle('Flux', 'PREPEND');

        $flash = $this->_helper->FlashMessenger->getMessages();
        if (! empty($flash[0])) {
            $this->view->eViasMessage = $flash[0];
        }

        $activeId = 0;
        if ($this->_hasParam('id')) {
            $activeId = $this->_getParam('id');
        }

        $publishedEntries = array();
        $activeEntry = null;
        try {
            $publishedEntries = eVias_Blog_Article::loadAllPublished();

            if (empty($publishedEntries)) {
                throw new eVias_Exception ('no entries in evias_blog_article.');
            }

            $activeEntry = $activeId == 0 ? $publishedEntries[0] : eVias_Blog_Article::loadById ($activeId);
        }
        catch (eVias_Exception $e) {

            if (isset($publishedEntries) && false === $publishedEntries) {
                $publishedEntries = array();
            }
            $activeEntry = new eVias_Blog_Article;
        }

        // simple render of action

        $countPublished = count($publishedEntries);

        $this->_helper->layout()->setLayout('blog');

        $this->view->article = $activeEntry;
        $this->view->articleTitle   = $activeEntry->titre;
    }

    public function showFullArticleAction ()
    {
        if (! $this->_hasParam('article_id')) {
            exit(0);
        }

        $articleId = $this->_getParam('article_id');

        $article = eVias_Blog_Article::loadById($articleId);
        $articleText = str_replace (array('[code]','[/code]', PHP_EOL),
                                    array('<div class="code">', '</div>', '<br />'),
                                    stripslashes($article->contenu));
        $articleTitle= $article->titre;

        if (! $this->_request->isXmlHttpRequest()) {
            $this->view->article = $article;
            $this->view->articleText = $articleText;
            $this->view->articleTitle = $articleTitle;
            $this->render();
            return;
        }

        $this->_helper->layout->disableLayout();

        echo $article->getArticleHtml();
        exit(0);
    }

    public function writeAction()
    {
		$this->view->headTitle('Redaction', 'PREPEND');

        try {
            $this->view->blogCategories = eVias_Blog_Category::fetchAll('eVias_Blog_Category');
        }
        catch (eVias_Exception $e) {
            $this->view->blogCategories = array();
        }

        if ($this->_request->isPost()) {
            $titre = $this->_getParam('titre');
            $content = $this->_getParam('contenu');
            $category_id = $this->_getParam('category');
            $status_id = $this->_getParam('status');

            $article = new eVias_Blog_Article();
            $article->titre = $titre;
            $article->contenu = $content;
            $article->small_contenu = substr($content, 1, 200);
            $article->category_id = $category_id;
            $article->status_type_id = $status_id;
            $article->date_updated = date('Y-M-d');
            $article->save();

            $this->_helper->FlashMessenger('Your article has been succesfully saved');
            $this->_redirect('/blog/index/index');
        }
    }



	public function postCommentAction()
	{
		if (! $this->_hasParam('id')) {
			echo 'HMMMM';
			exit(0);
		}

		$articleId = $this->_getParam('id');
		$guestName = $this->_getParam('name');
		$guestMail = $this->_getParam('mail');
		$guestText = $this->_getParam('text');

		$this->text($guestText);
		$this->_helper->viewRenderer->setNoRender(true);
		exit(0);
	}

    public function likeArticleAction ()
    {
        if (! $this->_hasParam('id')) {
            die('error..');
        }
    }

	public function adminAction()
    {
		$this->view->headTitle('Gestion', 'PREPEND');
    }

}

