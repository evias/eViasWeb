<h1>Member Panel Login</h1>

<?php
if (! empty($this->eViasMessage)) {
echo <<<HTML_END
<h2>$this->eViasMessage</h2>
HTML_END;
}
?>

<p>
<?php
    echo $this->form;
?>
</p>
