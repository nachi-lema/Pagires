<?php

	require ('../admin/s/o/f/t/connexion.php');

	$Agent =   $_POST['cat_data'];

	$result = $bd->query("SELECT id,code_societe,nom_parent,nom_dependant FROM perenfant_tb WHERE nom_parent = '$Agent'");


	// $output="";
	while ($des_row = $result->fetch_array()){
	    $output .= '<option value="' . $des_row['nom_dependant'] . '">' . $des_row['nom_dependant'] . '</option>';
	}
	echo $output;
	
?>
