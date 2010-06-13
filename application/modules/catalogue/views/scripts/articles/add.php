<h1>Ajouter un article</h1>

<?php
    echo $this->toolBar->display();
?>

<form action="" method="post">
    <label for="title">Titre</label>
    <input type="text" value="" />

    <input type="submit" value="Enregistrer" />
    <input type="hidden" name="data_sent" value="1" />
</form>
