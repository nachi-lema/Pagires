<?php
	require ('../admin/s/o/f/t/connexion.php');

	$Classe =   $_POST['cat_data'];

	$result = $bd->query("SELECT id,description,salbase_usd,tranp,alFam,classe FROM perbaremsal_tb WHERE classe = '" . $Classe . "' ");


	// $output="";
	while ($des_row = $result->fetch_array()){
	    $output .= '<option value="' . $des_row['tranp'] . '">' . $des_row['tranp'] . '</option>';
	}
	echo $output;
?>