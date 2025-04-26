<?php
	require ('../admin/s/o/f/t/connexion.php');

	$article =   $_POST['cat_data'];

	$result = $bd->query("SELECT id,groupe,article,facture,ref_article FROM appro_stocks WHERE article = '" . $article . "' ORDER BY groupe ASC");


	// $output="";
	while ($des_row = $result->fetch_array()){
	    $output .= '<option value="' . $des_row['facture'] . '">' . $des_row['facture'] . '</option>';
	}
	echo $output;
?>