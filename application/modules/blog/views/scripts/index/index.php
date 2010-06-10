<h1>Derniers articles du blog</h1>

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
    foreach ($this->blogEntries as $article) {
        $datePublication = new Zend_Date($article->date_creation, 'fr_FR');
        $datePublication = $datePublication->toString('dd MMMM yyyy');
        $countComments = $article->countComments();
        $commentText = $countComments > 1 ? 'Commentaires' : 'Commentaire';
		$articleId = $article->article_id;
echo <<<HTML
    <div class="article" id="$article->article_id">
        <p>
            <span>
                $article->titre - [$datePublication]
            </span>
            <img id="$article->article_id-hide" class="hide-article" style="display:none" src="$baseUrl/images/hide-article.png" alt="Cacher" height="16px" width="16px"/>
        </p>
        <p class="user-actions">
            <a href="#" id="$articleId-like" class="like">J'aime</a>
            <a href="#" id="$articleId-dontlike"class="dontlike">Je n'aime pas</a>
            <a href="#" id="$articleId-comment" class="comment">
                $countComments $commentText
            </a>
            <p class="comment-add" id="$articleId-addcomment" style="display:none">
                <label for="name">Nom</label>
                <input type="text" id="comment-name-$articleId" name="name" value="" class="comment-add" />
                <label for="mail">Mail</label>
                <input type="text" id="comment-mail-$articleId" name="mail" value="" class="comment-add" /><br />
                <label for="text">Commentaire</label><br />
                <textarea name="text" id="comment-text-$articleId" class="comment-add"></textarea><br />
                <a href="#" class="post-comment" id="$article->article_id-postcomment">Commenter</a>
            </p>
        </p>
        <p id="$article->article_id-small" class="small-contenu">$article->small_contenu ...</p>
        <pre id="$article->article_id-full" style="display:none">$article->contenu</pre>
    </div>
HTML;
    }
}
else {
    echo <<<HTML
    <div class="empty">
        <p>Il n'y pas encore d'entrées dans le blog.</p>
    </div>
HTML;
}

?>

<script type="text/javascript">
    eVias.BlogArticle.init();
</script>

