<?php echo $this->doctype(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<?php echo $this->headMeta(); ?>
		<?php echo $this->headTitle(); ?>
        <?php echo $this->headScript()->appendFile('/js/prototype.js'); ?>
        <?php echo $this->headScript()->appendFile('/js/lib/eVias/BlogArticle.js'); /* @todo: include only in blog module */ ?>
		<?php echo $this->headLink()->prependStylesheet($this->baseUrl() . '/styles/default.css'); ?>
	</head>
	<body>
		<div id="page">
			<div id="header">
				<span>eViasWeb Application - Development Platform</span>
                <div id="lang-selector">
                    <ul>
                        <li><a href="<?php echo $this->url (array(), 'language'); ?>?lang=fr"><img src="storage/images/french.jpg" /></a></li>
                        <li><a href="<?php echo $this->url (array(), 'language'); ?>?lang=en"><img src="storage/images/english.jpg" /></a></li>
                        <li><a href="<?php echo $this->url (array(), 'language'); ?>?lang=de"><img src="storage/images/german.jpg" /></a></li>
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
                <?php echo $this->myHistory->display(); ?>
				<?php echo $this->layout()->content; ?>
			</div>
            <div class="clear"></div>
			<div id="footer">
				<span>Open Source web platform by <a href="mailto:evias.services@gmail.com">Grégory Saive</a></span>
			</div>
		</div>
        <div>
        <pre>
        <?php
            var_dump($_SESSION);
        ?>
        </pre>
        </div>
	</body>
</html>
