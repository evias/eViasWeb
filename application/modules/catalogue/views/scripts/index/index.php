<h1>Portfolio</h1>
<p><?php $this->text("Bienvenu sur la page d'accueil de mon portfolio"); ?></p>
<p><?php $this->text("Ci-dessous une liste de mes projets accomplis: "); ?></p>
<?php
$i = 0;
if (! empty($this->projectsList)) {
	foreach ($this->projectsList as $catalogue) {
		if ($i == 0) {
			$table = '<table cellpadding="4px" cellspacing="5px" border="0px">';
			$table .= '
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date created</th>
                    <th>Date last update</th>
                </tr>
            ';
		}
		$table .= '<tr>';
		$table .=	'<td>' . $catalogue->catalogue_id . '</td>';
		$table .=	'<td>' . $catalogue->title. '</td>';
		$table .=	'<td>' . $catalogue->description . '</td>';
		$table .=	'<td>' . $catalogue->date_creation . '</td>';
		$table .=	'<td>' . $catalogue->date_updated . '</td>';
		$table .= '</tr>';
		$i++;
	}
	$table .= '</table>';

	$this->text($table);
}
else {
	echo '<p>No catalogue in DB yet.</p>';
}
?>
