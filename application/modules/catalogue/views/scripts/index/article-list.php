<h1>Articles</h1>
<p><?php $this->text("Ci-dessous la liste des articles enregistrés"); ?></p>
<?php
$i = 0;
if (! empty($this->articleList)) {
	foreach ($this->articleList as $article) {
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
    $this->text("Aucun article enregistré.");
}
?>
