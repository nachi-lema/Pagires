<?php

	require ('../admin/s/o/f/t/connexion.php');

	$groupe =   $_POST['cat_data'];

	$result = $bd->query("SELECT id,compte,nom_complet,descriptions FROM combo_od WHERE groupe = '" . $groupe . "'");


	// $output="";
	$output = '<option value="">Selectionnez un compte</option>';
	while ($des_row = $result->fetch_array()){
	    $output .= '<option value="' . $des_row['nom_complet'] . '">' . $des_row['descriptions'] . '</option>';
	}
	echo $output;