<h1>Catégories</h1>
<?php
if (! empty($this->messages)) {
    foreach ($this->messages as $message) {
        echo '<span class="error">'.$message.'</span>';
    }
}
?>
<?php
    // BO Toolbar
    echo $this->toolBar->display();
?>
<p><?php $this->text("Ci-dessous la liste des catégories enregistrées"); ?></p>
<?php
$i = 0;
if (! empty($this->categories)) {
	foreach ($this->categories as $category) {
        $parent = ! empty($category->parent_category_id) ? $category->parent_category_id : '/';
        $url = $this->url(array('id' => $category->category_id), 'catalogue/categories/form/edit');

		if ($i == 0) {
			$table = '<table cellpadding="4px" cellspacing="5px" border="0px">';
			$table .= '	<tr><th>ID</th><th>Parent ID</th><th>Title</th><th>Description</th><th>Date created</th><th>Date last update</th></tr>';
		}
		$table .= '<tr>';
		$table .=	'<td>' . $category->category_id . '</td>';
        $table .=   '<td>' . $parent . '</td>';
		$table .=	'<td><a href="' . $url . '">' . $category->title . '</a></td>';
		$table .=	'<td>' . $category->description . '</td>';
		$table .=	'<td>' . $category->date_creation . '</td>';
		$table .=	'<td>' . $category->date_updated . '</td>';
		$table .= '</tr>';
		$i++;
	}
	$table .= '</table>';

	$this->text($table);
}
else {
	$this->text("Aucune catégorie enregistrée.");
}
?>
