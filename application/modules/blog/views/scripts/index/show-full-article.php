<div id="article-container">
    <div>
        <h2 id="article-title"><?php echo stripslashes($this->articleTitle); ?></h2>
    </div>
    <div id="article-content">
        <?php echo $this->article->getArticleHtml(); ?>
    </div>
</div>
