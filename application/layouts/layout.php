<?php
    $refUrl      = $_SERVER['REQUEST_URI'];
    $scheme      = $_SERVER['HTTPS'] ? 'https' : 'http';

    $frenchLink  = $scheme . '://web.evias.be/?lang=fr&ref=' . $refUrl;
    $englishLink = $scheme . '://web.evias.be/?lang=en&ref=' . $refUrl;
    $germanLink  = $scheme . '://web.evias.be/?lang=de&ref=' . $refUrl;
?>

<?php echo $this->doctype(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<?php echo $this->headMeta(); ?>
		<?php echo $this->headTitle(); ?>
        <?php echo $this->headScript()->appendFile('/js/prototype.js'); ?>
		<?php echo $this->headLink()->prependStylesheet($this->baseUrl() . '/styles/default.css'); ?>
		<?php echo $this->headLink()->prependStylesheet($this->baseUrl() . '/styles/twitter.css'); ?>
	</head>
	<body>
		<div id="page">
			<div id="header">
			    <div id="eviaslogo">eVias Development</div>
                <div id="menu">
                    <?php echo $this->navigation(); ?>
                </div>
                <div class="clear"></div>
			</div>
            <div id="subMenu">
                <?php echo $this->subNavigation($this->subPages, true); ?>
            </div>
            <div class="clear"></div>
			<div id="content">
                <?php echo $this->myHistory(); ?>
				<?php echo $this->layout()->content; ?>
			</div>
            <div id="rightPanel">
                <?php echo $this->rightPanel(); ?>
            </div>
            <div class="clear"></div>
			<div id="footer">
				<span><?php echo __('__PLATFORM_FOOTER_TEXT__'); ?></span>
			</div>
		</div>
	</body>
</html>
