<?php
	require ('../admin/s/o/f/t/connexion.php');

	$nomagent =   $_POST['cat_data'];

	$result = $bd->query("SELECT id,departement,fonction,date_debut FROM peragent_tb WHERE nom_complet = '" . $nomagent . "' ");


	// $output="";
	while ($des_row = $result->fetch_array()){
	    $output .= '<option value="' . $des_row['fonction'] . '">' . $des_row['fonction'] . '</option>';
	}
	echo $output;
?>