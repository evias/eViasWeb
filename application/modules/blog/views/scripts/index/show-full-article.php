<div class="article-content">
    <div class="article-title">
        <h2><?php echo stripslashes($this->articleTitle); ?></h2>
    </div>
    <div class="content">
        <?php echo str_replace(PHP_EOL, '<br />', stripslashes($this->articleText)); ?>
    </div>
</div>
