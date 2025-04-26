<?php
	require ('../admin/s/o/f/t/connexion.php');

	$groupe =   $_POST['cat_data'];

	$result = $bd->query("SELECT id,groupe,article,ref_article FROM appro_stocks WHERE groupe = '".$groupe."' ORDER BY article ASC");


	// $output="";
	$output = '<option value="">Selectionnez une Article</option>';
	while ($des_row = $result->fetch_array()){
	    $output .= '<option value="' . $des_row['article'] . '">' . $des_row['article'] . '</option>';
	}
	echo $output;
?>