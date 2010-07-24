<h1>Ajouter une catégorie</h1>

<?php
if (! empty($this->messages)) {
    foreach ($this->messages as $message) {
        echo '<span class="error">'.$message.'</span>';
    }
}
?>

<?php
    echo $this->toolBar->display();
?>

<form action="<?php echo $this->url(array(), 'catalogue/categories/form/process'); ?>" method="post">
    <?php
        echo $this->formHtml;
    ?>

    <input type="submit" value="Enregistrer" />
    <input type="hidden" name="category_id" value="<?php echo $this->params['category_id']; ?>" />
    <input type="hidden" name="is_edit" value="<?php echo ($this->isEdit ? '1' : '0'); ?>" />
    <input type="hidden" name="data_sent" value="1" />
</form>
