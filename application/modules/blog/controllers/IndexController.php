<?php

class Blog_IndexController
	extends AppLib_Controller_Action_Blog
{

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

        $blogEntries = array();
        $publishedEntries = array();
        $activeEntry = null;
        try {
            // get all blog entries
            // get active entry

            $blogEntries = eVias_Blog_Article::fetchAll('eVias_Blog_Article', 'date_creation', 'DESC');
            $publishedEntries = eVias_Blog_Article::loadAllPublished();

            $activeEntry = $activeId == 0 ? $publishedEntries[0] : eVias_Blog_Article::loadById ($activeId);
        }
        catch (eVias_Exception $e) {

            $blogEntries = array();
            if (isset($publishedEntries) && false === $publishedEntries) {
                $publishedEntries = array();
            }
            $activeEntry = new eVias_Blog_Article;
        }

        // simple render of action

        $countEntries = count($blogEntries);
        $countPublished = count($publishedEntries);

        $this->view->blogEntries    = $publishedEntries;

        $this->view->articleText    = $activeEntry->contenu;
        $this->view->articleTitle   = $activeEntry->titre;
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
            $this->_redirect($this->view->url(array(), 'blog'));
        }
    }

    public function showFullArticleAction ()
    {
        if (! $this->_hasParam('id')) {
            exit(0);
        }

        $articleId = $this->_getParam('id');

        $article = eVias_Blog_Article::loadById($articleId);
        $articleText = str_replace (PHP_EOL, '<br />', stripslashes($article->contenu));
        $articleTitle= $article->titre;

        if (! $this->_request->isXmlHttpRequest()) {
            $this->view->articleText = $articleText;
            $this->view->articleTitle = $articleTitle;
            $this->render();
            return;
        }

        $this->_helper->layout->disableLayout();

        echo $articleText;
        exit(0);
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

