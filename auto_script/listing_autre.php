<?php
	require ('../admin/s/o/f/t/connexion.php');

	$groupe =   $_POST['cat_data'];

	$result = $bd->query("SELECT id,compte,description FROM compta_autres WHERE groupe = '" . $groupe . "' ORDER BY description ASC");


	// $output="";
	$output = '<option value="">Selectionnez une groupe</option>';
	while ($des_row = $result->fetch_array()){
	    $output .= '<option value="' . $des_row['compte'] . '">' . $des_row['compte'].'_'.$des_row['description']. '</option>';
	}
	echo $output;
