<?php
	require ('../admin/s/o/f/t/connexion.php');

	$Classe =   $_POST['cat_data'];

	$result = $bd->query("SELECT id,categ,description,classe FROM classe_tb WHERE classe = '" . $Classe . "' ");


	// $output="";
	while ($des_row = $result->fetch_array()){
	    $output .= '<option value="' . $des_row['description'] . '">' . $des_row['description'] . '</option>';
	}
	echo $output;
?>