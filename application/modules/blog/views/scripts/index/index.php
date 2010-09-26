<h1><?php echo __('__ARTICLES_PAGE_TITLE__'); ?></h1>

<?php

if (! empty($this->eViasMessage)) {
    echo <<<HTML
    <h2>$this->eViasMessage</h2>
HTML;
}

echo <<<HTML
    <p>
        <span>Nombre d'articles: $this->countEntries</span><br />
        <span>Nombre de publication: $this->countPublished</span><br />
        <span>Nombre d'articles cachés: $this->countHidden</span>
    </p>
HTML;

if (! empty($this->blogEntries)) {
    $baseUrl = $this->baseUrl();
    $i = 1;
    foreach ($this->blogEntries as $article) {
        $datePublication = new Zend_Date($article->date_creation, 'fr_FR');
        $datePublication = $datePublication->toString('dd MMMM yyyy');
        $countComments = $article->countComments();
        $commentText = $countComments > 1 ? 'Commentaires' : 'Commentaire';
		$articleId = $article->article_id;

        if ($i > 1 && $i % 3 == 1) {
            // end of articles row and begin of new one

            echo '</div>'; // div class article-row
            echo '<div class="clear"></div>';
            echo '<div class="article-row">';
        }
        elseif ($i == 1) {
            echo '<div class="article-row">';
        }

        $smallContenu = stripslashes($article->small_contenu);
        $urlShowFull  = $this->url (array('id' => $article->article_id), 'blog/article/show-full');

/* VIEW */
echo <<<HTML
    <div class="article" id="$article->article_id">
        <div class="title"><p>
            <span>
                <a href="$urlShowFull">$article->titre</a>
            </span>
        </p></div>
        <p id="$article->article_id-small" class="small-contenu"><span>$smallContenu...<span></p>
        <pre id="$article->article_id-full" style="display:none">$article->contenu</pre>
    </div>
HTML;

        $i++;
    }

    echo '</div>'; // end article-row
    echo '<div class="clear"></div>';
}
else {
    echo <<<HTML
    <div class="empty">
        <p>Il n'y pas encore d'entrées dans le blog.</p>
    </div>
HTML;
}

?>


<script type="javascript">
    $$('.title').each (function (titleDivElm) {
        titleDivElm.bindEventListener ('click', function (event) {
            new Ajax.Request (
                url : '/blog/article/show-full/' + titleDivElm.readAttribute ('rel'),
                params : '',
                {
                    onSuccess : function (transport, JSON) {
                        var lightbox = eVias.Lightbox.create ();

                        lightbox.setTitle ('Blog article');

                        lightbox.setContent (transport.responseText);

                        lightbox.render();

                        return false;
                    }
                }
            );
        }, false);
    });
</script>
