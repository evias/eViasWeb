<h1><?php echo __('__ARTICLES_PAGE_TITLE__'); ?></h1>

<?php

if (! empty($this->eViasMessage)) {
    echo <<<HTML
    <h2>$this->eViasMessage</h2>
HTML;
}


if (! empty($this->blogEntries)) {

    // iterate blog entries to fill view data arrays
    $historyLines   = array();
    $activeBlogEntry= null;
    foreach ($this->blogEntries as $article) {
        $showFullUrl = $this->url (array('id' => $article->article_id), 'blog/article/show-full');

        $historyLines[] = array(
            'id'    => $article->article_id,
            'title' => $article->titre,
            'url'   => $showFullUrl
        );
    }
    ?>
    <div id="blog-history">
        <ul>
        <?php
        foreach ($historyLines as $idx => $line) {
            echo '<li><a onclick="return false;" id="show-article-' . $line['id'] . '" rel="' . $line['id'] . '" href="' . $line['url'] . '" alt="' . $line['title'] . '">' . $line['title'] . '</a></li>';
        }
        ?>
        </ul>
    </div>

    <?php echo $this->render ('index/show-full-article.php'); ?>

    <div class="clear"></div>

<?php
}
else {
    // no entries available

    echo <<<HTML
    <div class="empty">
        <p>Il n'y pas encore d'entrées dans le blog.</p>
    </div>
HTML;
}
?>

<script type="text/javascript">
    $$('#blog-history ul li').each (function (elm) {
        var linkElm = elm.down ('a');

        var articleId = linkElm.readAttribute('rel');

        var showFullUrl = linkElm.readAttribute('href');

        var linkId = 'show-article-' + articleId;

        var linkDomElm = document.getElementById (linkId);

        linkDomElm.addEventListener('click', function (event) {
            new Ajax.Request (
                showFullUrl,
                {
                    asynchronous: false,
                    parameters : '',
                    onSuccess : function (transport) {
                        var articleContent = transport.responseText;
                        var articleTitle = document.getElementById (linkId).innerHTML;

                        $('article-title').update(articleTitle);
                        $('article-content').update (articleContent);

                        return false;
                    }
                }
            );
        }, false);

    });
</script>
