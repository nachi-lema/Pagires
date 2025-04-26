<?php

	require ('../admin/s/o/f/t/connexion.php');

	$Classe =   $_POST['cat_data'];

	$result = $bd->query("SELECT id,codeSoc,nom_complet,departement FROM peragent_tb WHERE departement = '$Classe'");


	// $output="";
	while ($des_row = $result->fetch_array()){
	    $output .= '<option value="' . $des_row['nom_complet'] . '">' . $des_row['nom_complet'] . '</option>';
	}
	echo $output;
	
?>