<?php
	require ('../admin/s/o/f/t/connexion.php');

	$groupe =   $_POST['cat_data'];

	$result = $bd->query("SELECT id,compte,nom_complet FROM compta_eleve WHERE statut ='Actif' AND groupe = '" . $groupe . "' ORDER BY nom_complet ASC");


	// $output="";
	$output = '<option value="">Selectionnez une groupe</option>';
	while ($des_row = $result->fetch_array()){
	    $output .= '<option value="' . $des_row['compte'] . '">' . $des_row['nom_complet'] . '</option>';
	}
	echo $output;