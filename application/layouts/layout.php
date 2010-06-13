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
			</div>
			<div id="menu">
				<?php echo $this->navigation(); ?>
			</div>
            <div class="clear"></div>
            <?php if ($this->subNavigation->countPages()) { ?>
            <div id="subMenu">
                <?php echo $this->subNavigation->subNavigation(array(), true); ?>
            </div>
            <?php } ?>
			<div id="content">
				<?php echo $this->layout()->content; ?>
			</div>
            <div class="clear"></div>
			<div id="footer">
				<span>Open Source web platform by <a href="mailto:evias.services@gmail.com">Grégory Saive</a></span>
			</div>
		</div>
	</body>
</html>
