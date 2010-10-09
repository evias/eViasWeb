<?php
    $refUrl      = $_SERVER['REQUEST_URI'];
    $frenchLink  = $this->url (array(), 'language') . '?lang=fr&ref=' . $refUrl;
    $englishLink = $this->url (array(), 'language') . '?lang=en&ref=' . $refUrl;
    $germanLink  = $this->url (array(), 'language') . '?lang=de&ref=' . $refUrl;
?>

<?php echo $this->doctype(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<?php echo $this->headMeta(); ?>
		<?php echo $this->headTitle(); ?>
        <?php echo $this->headScript()->appendFile('/js/prototype.js'); ?>
        <?php echo $this->headScript()->appendFile('/js/lib/eVias/Blog.js'); ?>
		<?php echo $this->headLink()->prependStylesheet($this->baseUrl() . '/styles/default.css'); ?>
		<?php echo $this->headLink()->prependStylesheet($this->baseUrl() . '/styles/blog.css'); ?>
	</head>
	<body>
		<div id="page">
			<div id="header">
				<span><?php echo __('__PLATFORM_HEADER_TEXT__'); ?></span>
                <div id="lang-selector">
                    <ul>
                        <li><a href="<?php echo $frenchLink; ?>"><img src="storage/images/french.jpg" /></a></li>
                        <li><a href="<?php echo $englishLink; ?>"><img src="storage/images/english.jpg" /></a></li>
                        <li><a href="<?php echo $germanLink; ?>"><img src="storage/images/german.jpg" /></a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
			</div>
			<div id="menu">
				<?php echo $this->navigation(); ?>
			</div>
            <div class="clear"></div>
            <?php if ($this->subNavigation->countPages()) { ?>
            <div id="subMenu">
                <?php echo $this->subNavigation->subNavigation(array(), true); ?>
            </div>
            <div class="clear"></div>
            <?php } ?>
			<div id="content">

                <!-- breadcrumb -->
                <?php echo $this->myHistory->display(); ?>

                <!-- show article list -->
                <?php
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
                        $id = $line['id'];
                        $url= $line['url'];
                        $title=$line['title'];
                        echo "
                            <li>
                                <a  onclick='return false;'
                                    id='show-article-$id'
                                    rel='$id'
                                    href='$url'
                                    alt='$title'
                                >
                                $title
                                </a>
                            </li>
                        ";
                    }
                    ?>
                    </ul>
                    </div>
				<?php
                    echo $this->layout()->content;
                    echo '<div class="clear"></div>';
                }
                else {
                    // blog is empty

                    echo <<<HTML
    <div class="empty">
        <p>Il n'y pas encore d'entrées dans le blog.</p>
    </div>
HTML;
                }
                ?>
			</div>
            <div class="clear"></div>
			<div id="footer">
				<span><?php echo __('__PLATFORM_FOOTER_TEXT__'); ?></span>
			</div>
		</div>
	</body>
<
