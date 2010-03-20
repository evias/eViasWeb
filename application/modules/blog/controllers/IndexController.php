<?php

class Blog_IndexController 
	extends AppLib_Controller_Action
{

    public function init() {
        parent::init();
        if (false === $this->_tryAuth()) {
            $this->_forward('index');
			// ajax queries may need more privilegies
        }
        else {
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

        try {
            $blogEntries = eVias_Blog_Article::fetchAll('eVias_Blog_Article');
            $publishedEntries = eVias_Blog_Article::loadAllPublished();
        }
        catch (eVias_Exception $e) {
            $blogEntries = array();
            if (isset($publishedEntries) && false === $publishedEntries) {
                $publishedEntries = array();
            }
        }

        $countEntries = count($blogEntries);
        $countPublished = count($publishedEntries);

        $this->view->countEntries   = $countEntries;
        $this->view->countPublished = $countPublished;
        $this->view->countHidden    = $countEntries - $countPublished;

        $this->view->blogEntries    = $publishedEntries;
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
            $article->small_contenu = substr($content, 1, 75);
            $article->category_id = $category_id;
            $article->status_type_id = $status_id;
            $article->date_updated = date('Y-M-d');
            $article->save();

            $this->_helper->FlashMessenger('Your article has been succesfully saved');
            $this->_redirect($this->view->url(array(), 'blog'));
        }
    }

	public function postCommentAction() 
	{
		if (! $this->_hasParam('id')) {
			echo 'HMMMM';
			return ;
		}

		$articleId = $this->_getParam('id');
		$guestName = $this->_getParam('name');
		$guestMail = $this->_getParam('mail');
		$guestText = $this->_getParam('text');

		$this->text($guestText);
		$this->_helper->viewRenderer->setNoRender(true);
		exit(0);
	}

	public function adminAction()
    {
		$this->view->headTitle('Gestion', 'PREPEND');
    }

}

