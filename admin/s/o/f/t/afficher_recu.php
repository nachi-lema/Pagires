<?php
function link_reciPaie_tiers()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['ref_doc'])) {
        echo '';
      } else {
        $ref_doc = $_GET['ref_doc'];
        $req = "SELECT * FROM comptes_tiers WHERE ref_doc = '$ref_doc'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            $num_reference = $row['ref_doc'];

            echo '<li><a href="../prints/recu_tiers.php?ref_doc=' . $num_reference . '" target="_blank">Reçu de paiement</a></li>';
          }
        } else {
          echo '';
        }
      }
    }
  } else {
    echo '';
  }
}

//reci_tiers
function reci_paie_tiers()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $statut_fin = "en cours";
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
      $resultats = $bd->query($requete);

      if ($resultats->num_rows > 0) { // verification du compte administratif
        while ($row = $resultats->fetch_assoc()) {
          $code_admin = $row['code_admin'];
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) { // verification de droit administratif

          if (empty($_GET['ref_doc'])) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Parametre introuvable" . '</div>';
          } else {
            $ref_doc = $_GET['ref_doc'];
            $req = "SELECT * FROM comptes_tiers WHERE ref_doc = '$ref_doc' AND statut = '$statut_fin'";
            $resultats = $bd->query($req);

            if ($resultats->num_rows > 0) {

              while ($row = $resultats->fetch_assoc()) {
                $ref_doc = $row['ref_doc'];
                $num_ordre = $row['id'];
                $compte_credit = $row['compte_credit'];
                $montant = $row['montant'];
                $devise = $row['devise'];
                $motif = $row['libelle'];
                $customer = $row['customer'];
                $date_doc = $row['date_crea'];
                $nature = $row['nature_operation'];
              }

              //recuperation information eleve
              $req2 = "SELECT * FROM compta_tiers WHERE compte = '$compte_credit' AND statut = 'Actif'";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {

                while ($row2 = $res2->fetch_assoc()) {
                  $description = $row2['description'];
                }
                //Impression reci eleve
                echo'<div class="w-100 d-flex justify-content-end mb-2">
                      <div class="col-4 d-flex w-max-100"></div>
                      <div class="col-5 d-flex w-max-100">
                          <h4 class="text-center" style="font-size: 16px"><b>RECU CAISSE / N° ' . $num_ordre . ' / <span style="text-transform:uppercase!important;">' . $nature . '</span></b></h4>
                      </div>
                      <div class="col-3 d-flex w-max-100"></div>
                    </div>
                    <div class="border border-dark px-2 py-2" id="print_out">
                      <table class="table">
                        <tr class="boder-0">
                          <td width="60%" class="boder-0 align-bottom">
                            <div class="row w-100">
                                <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-100"></fieldset>
                                  
                            </div><br>
                            <div class="row w-100">
                              <fieldset class="col-lg-1 col-md-1 col-sm-12>
                                      <label class="float-left w-auto whitespace-nowrap">REF:</label>
                              </fieldset>
                              <fieldset class="col-lg-3 col-md-4 col-sm-12 d-flex">
                                      <p class="col-md-auto border-bottom border-dark w-50">' . $ref_doc . '<b></b></p>
                              </fieldset>
                              <fieldset class="col-lg-1 col-md-1 col-sm-12">
                                      <label class="float-left w-auto whitespace-nowrap">NOMS:</label>
                              </fieldset>
                              <fieldset class="col-lg-7 col-md-8 col-sm-12 d-flex w-max-100">
                                      <p class="col-md-auto border-bottom border-dark" style="width: 70%">' . $description . '<b></b></p>
                              </fieldset>
                            </div><br>
                            <div class="row w-100">
                                <fieldset class="col-lg-1 col-md-1 col-sm-12">
                                      <label class="float-left w-auto whitespace-nowrap">COMPTE:</label>
                                  </fieldset>
                                  <fieldset class="col-lg-5 col-md-5 col-sm-12">
                                      <p class="col-md-auto border-bottom border-dark">' . $compte_credit . '<b></b></p>
                                  </fieldset>
                                  <fieldset class="col-lg-1 col-md-1 col-sm-12">
                                      <label class="float-left w-auto whitespace-nowrap">MONTANT:</label>
                                  </fieldset>
                                  <fieldset class="col-lg-4 col-md-4 col-sm-12 ">
                                      <p class="col-md-auto border-bottom border-dark"">' . number_format($montant, 2) . '<b>  ' . $devise . '</b></p>
                                  </fieldset>
                            </div><br>
                            <div class="row w-100">
                                  <fieldset class="col-lg-1 col-md-1 col-sm-12 d-flex w-max-100">
                                      <label class="float-left w-auto whitespace-nowrap">Motif:</label>
                                  </fieldset>
                                  <fieldset class="col-lg-7 col-md-7 col-sm-12 d-flex w-max-100">
                                      <p class="col-md-auto border-bottom border-dark w-100">' . $motif . '<b></b></p>
                                  </fieldset>
                            </div>
                          </td>
                        </tr>
                      </table>
                      <table class="table table-stripped px-4">
                        <tbody>
                          <tr>
                              <td>
                                  <div class="row w-100">
                                      <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-80"></fieldset>
                                      <fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-80">
                                          <label class="float-left w-auto whitespace-nowrap">PREPARE PAR</label>
                                      </fieldset>
                                      <fieldset class="col-lg-6 col-md-4 col-sm-12 d-flex w-max-80">
                                          <label class="float-left w-auto whitespace-nowrap" style="font-size: 13px">
                                              PAYE A / RECU PAR / VERSE PAR
                                        </label>
                                      </fieldset>
                                  </div>
                                  <div class="row w-100">
                                      <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-80">
                                        <label class="float-left w-auto whitespace-nowrap">Noms :</label>
                                      </fieldset>
                                      <fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-80">
                                        <p class="col-md-auto border-bottom border-dark"  style="width: 85%">' . $customer . '<b></b></p>
                                      </fieldset>
                                      <fieldset class="col-lg-6 col-md-6 col-sm-12 d-flex w-max-80">
                                        <p class="col-md-auto border-bottom border-dark"  style="width: 85%"><b>.</b></p>
                                      </fieldset>
                                  </div>
                                  <div class="row w-100">
                                      <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-80">
                                          <label class="float-left w-auto whitespace-nowrap">DATE :</label>
                                      </fieldset>
                                      <fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-80">
                                          <p class="col-md-auto border-bottom border-dark"  style="width: 85%">' . $date_doc . '<b></b></p>
                                      </fieldset>
                                      <fieldset class="col-lg-6 col-md-6 col-sm-12 d-flex w-max-80">
                                          <p class="col-md-auto border-bottom border-dark"  style="width: 85%"><b>.</b></p>
                                      </fieldset>
                                  </div><br>
                                  <div class="row w-100">
                                      <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-80">
                                          <label class="float-left w-auto whitespace-nowrap">SIGNATURE</label>
                                      </fieldset>
                                  </div>
                              </td>
                          </tr>
                        </tbody>
                      </table>
                    </div><br> ';
                //Impression reci eleve
              } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Compte tiers introuvable." . '</div>';
              }
            } else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
            }
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Violation d'accès" . '</div>';
        }
      } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
      }
    }
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue" . '</div>';
  }
}

//---- reçu autre----
function link_reciPaie_autre()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['ref_doc'])) {
        echo '';
      } else {
        $ref_doc = $_GET['ref_doc'];
        $req = "SELECT * FROM comptes_autres WHERE ref_doc = '$ref_doc'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            $num_reference = $row['ref_doc'];

            echo '<li><a href="../prints/recu_autre.php?ref_doc=' . $num_reference . '" target="_blank">Reçu de paiement</a></li>';
          }
        } else {
          echo '';
        }
      }
    }
  } else {
    echo '';
  }
}

//reci_autre
function reci_paie_autre()
  {
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $statut_fin = "en cours";
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
      $resultats = $bd->query($requete);

      if ($resultats->num_rows > 0) { // verification du compte administratif
        while ($row = $resultats->fetch_assoc()) {
          $code_admin = $row['code_admin'];
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) { // verification de droit administratif
          if (empty($_GET['ref_doc'])) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Parametre introuvable" . '</div>';
          } else {
            $ref_doc = $_GET['ref_doc'];
            $req = "SELECT * FROM comptes_autres WHERE ref_doc = '$ref_doc' AND statut = '$statut_fin'";
            $resultats = $bd->query($req);

            if ($resultats->num_rows > 0) {
              while ($row = $resultats->fetch_assoc()) {
                $ref_doc = $row['ref_doc'];
                $num_ordre = $row['id'];
                $compte_credit = $row['compte_credit'];
                $montant = $row['montant'];
                $devise = $row['devise'];
                $motif = $row['libelle'];
                $customer = $row['customer'];
                $date_doc = $row['date_crea'];
                $nature = $row['nature_operation'];
              }

              //recuperation information eleve
              $req2 = "SELECT * FROM compta_autres WHERE compte = '$compte_credit' AND statut = 'Actif'";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row2 = $res2->fetch_assoc()) {
                  $description = $row2['description'];
                }

                //Impression reci eleve
                echo'<div class="w-100 d-flex justify-content-end mb-2">
                      <div class="col-4 d-flex w-max-100"></div>
                      <div class="col-5 d-flex w-max-100">
                        <h4 class="text-center" style="font-size: 16px"><b>RECU CAISSE / N° ' . $num_ordre . ' / <span style="text-transform:uppercase!important;">' . $nature . '</span></b></h4>
                      </div>
                      <div class="col-3 d-flex w-max-100"></div>
                    </div>
                    <div class="border border-dark px-2 py-2" id="print_out">
                      <table class="table">
                        <tr class="boder-0">
                          <td width="60%" class="boder-0 align-bottom">
                            <div class="row w-100">
                                
                            </div><br>
                            <div class="row w-100">
                              <fieldset class="col-lg-3 col-md-3 col-sm-12 d-flex w-max-100">
                                      <label class="float-left w-auto whitespace-nowrap">REF: ' . $ref_doc . '</label>
                              </fieldset>
                              <fieldset class="col-lg-8 col-md-8 col-sm-12 d-flex w-max-100">
                                      <label class="float-left w-auto whitespace-nowrap">NOMS: <b>'.$description.'</b></label>
                              </fieldset>
                            </div><br>
                            <div class="row w-100">
                                <fieldset class="col-lg-1 col-md-1 col-sm-12 d-flex w-max-100">
                                      <label class="float-left w-auto whitespace-nowrap">COMPTE:</label>
                                  </fieldset>
                                  <fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-100">
                                      <p class="col-md-auto border-bottom border-dark" style="width: 70%">' . $compte_credit . '<b></b></p>
                                  </fieldset>
                                  <fieldset class="col-lg-1 col-md-1 col-sm-12 d-flex w-max-80">
                                      <label class="float-left w-auto whitespace-nowrap">MONTANT:</label>
                                  </fieldset>
                                  <fieldset class="col-lg-6 col-md-6 col-sm-12 d-flex w-max-80">
                                      <p class="col-md-auto border-bottom border-dark" style="width: 35%">' . number_format($montant, 2) . '<b>' . $devise . '</b></p>
                                  </fieldset>
                            </div><br>
                            <div class="row w-100">
                                  <fieldset class="col-lg-1 col-md-1 col-sm-12 d-flex w-max-80">
                                      <label class="float-left w-auto whitespace-nowrap">Motif:</label>
                                  </fieldset>
                                  <fieldset class="col-lg-8 col-md-8 col-sm-12 d-flex w-max-80">
                                      <p class="col-md-auto border-bottom border-dark w-100">' . $motif . '<b></b></p>
                                  </fieldset>
                            </div>
                          </td>
                        </tr>
                      </table>
                      <table class="table table-stripped px-4">
                        <tbody>
                          <tr>
                            <td>
                                  <div class="row w-100">
                                      <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-80"></fieldset>
                                      <fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-80">
                                          <label class="float-left w-auto whitespace-nowrap">PREPARE PAR</label>
                                      </fieldset>
                                      <fieldset class="col-lg-6 col-md-4 col-sm-12 d-flex w-max-80">
                                          <label class="float-left w-auto whitespace-nowrap" style="font-size: 13px">PAYE A / RECU PAR / VERSE PAR </label>
                                      </fieldset>
                                  </div>
                                  <div class="row w-100">
                                      <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-80">
                                          <label class="float-left w-auto whitespace-nowrap">Noms :</label>
                                      </fieldset>
                                      <fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-80">
                                          <p class="col-md-auto border-bottom border-dark"  style="width: 85%">' . $customer . '<b></b></p>
                                      </fieldset>
                                      <fieldset class="col-lg-6 col-md-6 col-sm-12 d-flex w-max-80">
                                          <p class="col-md-auto border-bottom border-dark"  style="width: 85%"><b></b></p>
                                      </fieldset>
                                  </div>
                                  <div class="row w-100">
                                      <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-80">
                                        <label class="float-left w-auto whitespace-nowrap">DATE :</label>
                                      </fieldset>
                                      <fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-80">
                                          <p class="col-md-auto border-bottom border-dark"  style="width: 85%">' . $date_doc . '<b></b></p>
                                      </fieldset>
                                      <fieldset class="col-lg-6 col-md-6 col-sm-12 d-flex w-max-80">
                                          <p class="col-md-auto border-bottom border-dark"  style="width: 85%"><b></b></p>
                                      </fieldset>
                                  </div><br>
                                  <div class="row w-100">
                                      <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-80">
                                          <label class="float-left w-auto whitespace-nowrap">SIGNATURE</label>
                                      </fieldset>
                                  </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div><br>
                
                
                ';
                //Impression reci eleve
              } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Compte élève introuvable." . '</div>';
              }
            } else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
            }
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Violation d'accès" . '</div>';
        }
      } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
      }
    }
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue" . '</div>';
  }
}

function link_reciPaie_pers(){
	if (isset($_SESSION['pseudo'])) {
		include("connexion.php");
		if ($bd->connect_error) {
			die('Impossible de se connecter à la BD:' . $bd->connect_error);
		} else { // fin base de données
			if (empty($_GET['ref_doc'])) {
				echo '';
			} else {
				$ref_doc = $_GET['ref_doc'];
				$req = "SELECT * FROM comptes_pers WHERE ref_doc = '$ref_doc'";
				$resultats = $bd->query($req);

				if ($resultats->num_rows > 0) {
					while ($row = $resultats->fetch_assoc()) {
						$num_reference = $row['ref_doc'];

						echo '<li><a href="../prints/recu_pers.php?ref_doc='.$num_reference.'" target="_blank">Reçu de paiement</a></li>';
					}
				} else {
					echo '';
				}
			}
		}
	} else {
		echo '';
	}
}

//reci_personnel
function reci_paie_pers(){
	if (isset($_SESSION['pseudo'])) {
		include("connexion.php");
		if ($bd->connect_error) {
			die('Impossible de se connecter à la BD:' . $bd->connect_error);
		} else { // fin base de données
			$admin = $_SESSION['pseudo'];
			$params = 1;
			$statut_fin = "en cours";
			$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
			$resultats = $bd->query($requete);

			if ($resultats->num_rows > 0) { // verification du compte administratif
				while ($row = $resultats->fetch_assoc()) {
					$code_admin = $row['code_admin'];
				}
				$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
				$res1 = $bd->query($req1);

				if ($res1->num_rows > 0) { // verification de droit administratif

					if (empty($_GET['ref_doc'])) {
						echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Parametre introuvable".'</div>';
					} else {
						$ref_doc = $_GET['ref_doc'];
						$req = "SELECT * FROM comptes_pers WHERE ref_doc = '$ref_doc' AND statut ='$statut_fin'";
						$resultats = $bd->query($req);

						if ($resultats->num_rows > 0) {
							while ($row = $resultats->fetch_assoc()) {
								$ref_doc = $row['ref_doc'];
								$num_ordre = $row['id'];
								$compte_credit = $row['compte_credit'];
								$montant = $row['montant'];
								$devise = $row['devise'];
								$motif = $row['libelle'];
								$customer = $row['customer'];
								$date_doc = $row['date_crea'];
                $nature = $row['nature_operation'];
							}

							//recuperation information personnel
							$req2 = "SELECT * FROM compta_pers WHERE compte = '$compte_credit' AND statut ='Actif'";
							$res2 = $bd->query($req2);

							if ($res2->num_rows > 0) {
								while ($row2 = $res2->fetch_assoc()) {
									$nom_complet = $row2['nom_complet'];
									$fonction = $row2['fonction'];
								}
								//Impression reci personnel
								echo'<div class="w-100 d-flex justify-content-end mb-2">
                      <div class="col-4 d-flex w-max-100"></div>
                      <div class="col-5 d-flex w-max-100">
                        <h4 class="justify-content-end" style="font-size: 16px"><b>RECU CAISSE / N° ' . $num_ordre . ' / <span style="text-transform:uppercase!important;">'.$nature. '</span></b></h4>
                      </div>
                      <div class="col-3 d-flex w-max-100"></div>
                    </div>
                    <div class="border border-dark px-2 py-2" id="print_out">
                      <table class="table border">
                        <tr class="border-dark">
                          <td class="border-1 align-bottom">
                          </td>
                          <td class="border-1 align-bottom">
                            <p class="col-md-auto"><label class="">REF : '.$ref_doc. '</label></p>
                          </td>
                        </tr>
                        <tr class="border-1">
                          <td class="">
                            <label class="">
                              <p class="col-md-auto">NOMS : ' . $nom_complet . '<b></b></p>
                            </label>
                          </td>
                          <td class="text-left">
                            <label class="d-flex w-max-100">
                              <p class="col-md-auto">COMPTE : ' . $compte_credit . '<b></b></p>
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <label class="d-flex">
                              <p class="col-md-auto">Fonction : '.$fonction.'<b></b></p>
                            </label>
                          </td>
                          <td>
                            <label class="cd-flex">
                              <p class="col-md-auto">MONTANT : '.number_format($montant, 2).'<b>'.$devise. '</b></p>
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <label class="d-flex">
                              <p class="col-md-auto">Motif : '.$motif.'<b></b></p>
                            </label>
                          </td>
                        </tr>
                      </table>
                      <table class="table table-stripped px-4">
                        <tbody>
                          <tr>
                              <td>
                                  <div class="row w-100">
                                      <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-80"> </fieldset>
                                      <fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-80">
                                          <label class="float-left w-auto whitespace-nowrap">PREPARE PAR</label>
                                      </fieldset>
                                      <fieldset class="col-lg-6 col-md-4 col-sm-12 d-flex w-max-80">
                                          <label class="float-left w-auto whitespace-nowrap" style="font-size: 13px">
                                              PAYE A / RECU PAR / VERSE PAR
                                        </label>
                                      </fieldset>
                                  </div>
                                  <div class="row w-100">
                                      <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-80">
                                          <label class="float-left w-auto whitespace-nowrap">Noms :</label>
                                      </fieldset>
                                      <fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-80">
                                          <p class="col-md-auto border-bottom border-dark"  style="width: 85%">' . $customer . '<b></b></p>
                                      </fieldset>
                                      <fieldset class="col-lg-6 col-md-6 col-sm-12 d-flex w-max-80">
                                          <p class="col-md-auto border-bottom border-dark"  style="width: 85%"><b>.</b></p>
                                      </fieldset>
                                  </div>
                                  <div class="row w-100">
                                      <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-80">
                                          <label class="float-left w-auto whitespace-nowrap">DATE :</label>
                                      </fieldset>
                                      <fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-80">
                                          <p class="col-md-auto border-bottom border-dark"  style="width: 85%">' . $date_doc . '<b></b></p>
                                      </fieldset>
                                      <fieldset class="col-lg-6 col-md-6 col-sm-12 d-flex w-max-80">
                                          <p class="col-md-auto border-bottom border-dark"  style="width: 85%"><b>.</b></p>
                                      </fieldset>
                                  </div><br>
                                  <div class="row w-100">
                                      <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-80">
                                          <label class="float-left w-auto whitespace-nowrap">SIGNATURE</label>
                                      </fieldset>
                                  </div>
                              </td>
                          </tr>
                        </tbody>
                      </table>
                    </div><br>';
								//Impression reci eleve
							} else {
								echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Compte Personnel introuvable." . '</div>';
							}
						} else {
							echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
						}
					}
				} else {
					echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Violation d'accès" . '</div>';
				}
			} else {
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
			}
		}
	} else {
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue" . '</div>';
	}
}