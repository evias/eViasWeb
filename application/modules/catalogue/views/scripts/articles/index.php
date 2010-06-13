<h1>Article</h1>
<?php
    echo $this->toolBar->display();
?>
<p><?php $this->text("Bienvenu sur la page d'accueil du module article"); ?></p>
<?php
$i = 0;
if (! empty($this->articles)) {
	foreach ($this->articles as $article) {
		if ($i == 0) {
			$table = '<table cellpadding="4px" cellspacing="5px" border="0px">';
			$table .= '	<tr><th>ID</th><th>Title</th><th>Description</th><th>Date created</th><th>Date last update</th></tr>';
		}
		$table .= '<tr>';
		$table .=	'<td>' . $article->article_id . '</td>';
		$table .=	'<td>' . $article->title. '</td>';
		$table .=	'<td>' . $article->description . '</td>';
		$table .=	'<td>' . $article->date_creation . '</td>';
		$table .=	'<td>' . $article->date_updated . '</td>';
		$table .= '</tr>';
		$i++;
	}
	$table .= '</table>';

	$this->text($table);
}
else {
	echo '<p>No article in DB yet.</p>';
}
?>
