<?php
	require ('../admin/s/o/f/t/connexion.php');

	$article =   $_POST['cat_data'];

	$result = $bd->query("SELECT id,groupe,article,ref_article,categorie FROM appro_stocks WHERE article = '" . $article . "' ORDER BY groupe ASC");


	// $output="";
	//$output = '<option value="">Selectionnez une Ref_article</option>';
	while ($des_row = $result->fetch_array()){
	    $output .= '<option value="' . $des_row['ref_article'] . '">' . $des_row['ref_article'] . '</option>';
	}
	echo $output;
?>