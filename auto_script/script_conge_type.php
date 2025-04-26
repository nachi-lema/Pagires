<?php
	require ('../admin/s/o/f/t/connexion.php');

	$typeconge =   $_POST['cat_data'];

	$result = $bd->query("SELECT id,categorie,nature FROM cat_conge_tb WHERE categorie = '" . $typeconge . "' ");


	// $output="";
	while ($des_row = $result->fetch_array()){
	    $output .= '<option value="' . $des_row['nature'] . '">' . $des_row['nature'] . '</option>';
	}
	echo $output;
?>