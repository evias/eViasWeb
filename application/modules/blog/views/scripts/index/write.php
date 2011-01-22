<h1>Rédaction de billet</h1>

<?php

// categories generation
if (! empty($this->blogCategories)) {
    $categoryXhtml = '<select name="category">';
    foreach ($this->blogCategories as $category) {
        $categoryXhtml .= '<option value="' . $category->category_id . '">' . $category->libelle . '</option>';
    }
    $categoryXhtml .= '</select>';
}
else {
    $categoryXhtml = '<span>' . 'Catégorisation non disponible' . '</span>';
}

echo <<<HTML_CODE
<form action="" method="post">
    <p>
        <h3>Renseignez les champs obligatoire (*)</h3>
    </p>
    <p>
        <label for="titre">Titre du billet</label>
        <input type="text" size="256" value="" class="title" name="titre"/>
    </p>
    <p>
        <label for="contenu">Contenu du billet</label><br />
        <textarea class="text-content" name="contenu"></textarea>
    </p>
    <p>
        <label for="category">Catégorie</label>
        $categoryXhtml
    </p>
    <p>
        <label for="status">Statut de publication</label>
        <select name="status">
            <option value="1">Mise en attente</option>
            <option selected value="2">Publication</option>
        </select>
    </p>
    <p>
        <input type="submit" value="Publier" />
    </p>
</form>
HTML_CODE;
?>
