<?php

	require ('../admin/s/o/f/t/connexion.php');

	$Agent =   $_POST['cat_data'];

	$result = $bd->query("SELECT id,codeSoc,nom_complet,departement FROM peragent_tb WHERE nom_complet = '$Agent'");


	// $output="";
	while ($des_row = $result->fetch_array()){
	    $output .= '<option value="' . $des_row['departement'] . '">' . $des_row['departement'] . '</option>';
	}
	echo $output;
	
?>