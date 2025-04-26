<?php

//Afficher la liste de Tiers
function liste_tiers(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['description'])) {
      if (empty($_GET['compte'])) {
        $admin = $_SESSION['pseudo'];
        $params = 1;
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
        $resultats = $bd->query($requete);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            $code_admin = $row['code_admin'];
            $codesoc = $row['code_soc'];
            $societe = $row['societe'];
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
          $res1 = $bd->query($req1);

          if ($res1->num_rows > 0) {
            $req2 = "SELECT * FROM compta_tiers WHERE societe='$societe' AND statut ='Actif'";
            $res2 = $bd->query($req2);

            if ($res2->num_rows > 0) {
              while ($row = $res2->fetch_assoc()) {
                echo '<tr>' .
                '<td class="corp-table">' . $row['compte'] . '</td>' .
                '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">' . $row['description'] . '</td>' .
                '<td class="corp-table">' . $row['solde1_cdf'] . '</td>' .
                '<td class="corp-table">' . $row['usd'] . '</td>' .
                '<td class="corp-table">' . $row['credit1_usd'] . '</td>' .
                '<td class="corp-table">' . $row['credit1_cdf'] . '</td>' .
                '<td class="corp-table">' . $row['statut'] . '</td>' .
                '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="liste_tiers.php?compte='.$row['compte'].'&&Code='.$row['code_soc'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
                '</tr>';
              }
            } else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucune information trouvée" . '</div>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
        }
      } else {
        //filtrage tiers par compte
        $compte_tiers = $_GET['compte'];
        $params = 1;
        $admin = $_SESSION['pseudo'];
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
        $resultats = $bd->query($requete);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
          $res1 = $bd->query($req1);

          if ($res1->num_rows > 0) {
            $req2 = "SELECT * FROM compta_tiers WHERE compte LIKE '%$compte_tiers%' AND societe='$societe' AND statut ='Actif' ORDER BY id DESC";
            $res2 = $bd->query($req2);

            if ($res2->num_rows > 0) {
              while ($row = $res2->fetch_assoc()) {
                echo '<tr>' .
                '<td class="corp-table">' . $row['compte'] . '</td>' .
                '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">' . $row['description'] . '</td>' .
                '<td class="corp-table">' . $row['solde1_cdf'] . '</td>' .
                '<td class="corp-table">' . $row['usd'] . '</td>' .
                '<td class="corp-table">' . $row['credit1_usd'] . '</td>' .
                '<td class="corp-table">' . $row['credit1_cdf'] . '</td>' .
                '<td class="corp-table">' . $row['statut'] . '</td>' .
                '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="liste_tiers.php?compte=' . $row['compte'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
                '</tr>';
              }
            } else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
        }
        //filtrage eleve par option
      }
    } else {
      //filtrage eleve par classe
      $admin = $_SESSION['pseudo'];
      $description_tier = $_GET['description'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
      $resultats = $bd->query($requete);

      if ($resultats->num_rows > 0) {
        while ($row = $resultats->fetch_assoc()) {
          $code_admin = $row['code_admin'];
          $societe = $row['societe'];
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) {
          $req2 = "SELECT * FROM compta_tiers WHERE description LIKE '%$description_tier%' AND societe='$societe' AND statut ='Actif' ORDER BY id DESC";
          $res2 = $bd->query($req2);

          if ($res2->num_rows > 0) {
            while ($row = $res2->fetch_assoc()) {
              echo '<tr>' .
              '<td class="corp-table">' . $row['compte'] . '</td>' .
              '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">' . $row['description'] . '</td>' .
              '<td class="corp-table">' . $row['solde1_cdf'] . '</td>' .
              '<td class="corp-table">' . $row['usd'] . '</td>' .
              '<td class="corp-table">' . $row['credit1_usd'] . '</td>' .
              '<td class="corp-table">' . $row['credit1_cdf'] . '</td>' .
              '<td class="corp-table">' . $row['statut'] . '</td>' .
              '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="liste_tiers.php?compte=' . $row['compte'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
              '</tr>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
        }
      } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
      }
      //filtrage tiers par description
    }
  } else {
  }
}

// Mise à jour du compte Tiers
function update_tiers(){
  if (isset($_SESSION['pseudo'])) {
    if (empty($_GET['compte'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' .
        '<strong>' . 'Desolé!' . '</strong>' . '&nbsp;' . 'Aucun parametre trouvé' .
        '<span aria-hidden="true" data-dismiss="alert" aria-label="close">' . '&times;' . '</span>' .
        '</div>';
    } else {
      $compte_tier = $_GET['compte'];
      $Codesoc = $_GET['Code'];
      include("connexion.php");
      if ($bd->connect_error) {
        die('Impossible de se connecter à la BD:' . $bd->connect_error);
      } else {
        $req = "SELECT * FROM compta_tiers WHERE compte ='$compte_tier' AND code_soc='$Codesoc'";
        $resul = $bd->query($req);

        if ($resul->num_rows > 0) {
          while ($row = $resul->fetch_assoc()) {
            echo '<div class="row w-100 p-2">' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<label>' . 'Num compte:' . '</label>' .
              '<input type="text" name="compte_tier" readonly="auto" class="form-control" value="' . $row['compte'] . '" tabindex="10" required>' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<label>' . '<i class="fa fa-user">' . '</i>' . '&nbsp;' . 'Description:' . '</label>' .
              '<input type="text" name="description_tier" value="' . $row['description'] . '" class="form-control" tabindex="110" maxlength="50" required >' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<label class="control-label" for="solde1_cdf">Report CDF:</label>' .
              '<input type="text" class="form-control" name="solde1_cdf" value="' . $row['solde1_cdf'] . '" placeholder="report solde1 cdf">' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<label class="control-label" for="usd">Report USD:</label>' .
              '<input type="text" class="form-control" name="usd" value="' . $row['usd'] . '" placeholder="report solde usd">' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<input type="hidden" class="form-control" name="solde2_cdf" value="' . $row['solde2_cdf'] . '" placeholder="report solde cdf">' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
            '<input type="hidden" class="form-control" name="solde2_usd" value="' . $row['solde2_usd'] . '"placeholder="report solde usd">' .
              '<input type="hidden" name="statut_tiers" value="Actif">' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12">' .
              '<button type="reset"  class="btn btn-primary mt-4 col-sm-6" tabindex="170" style="background-color: #304c79">' . 'Annuler' . '</button>' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12">' .
              '<button type="submit" class="btn btn-primary mt-4 col-sm-6" name="cmd_edittier" tabindex="170" style="background-color: #304c79">' . 'Modifier' . '</button>' .
              '</fieldset>' .
              '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' .
            '<strong>' . 'Desolé!' . '</strong>' . '&nbsp;' . 'Aucune information trouvée.' .
            '<span aria-hidden="true" data-dismiss="alert" aria-label="close">' . '&times;' . '</span>' .
            '</div>';
        }
      }
      $bd->close();
    }
  }
}

//fonction d'attire la liste tiers à la BDD
function liste_tierActif(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
    $resultats = $bd->query($requete);

    if ($resultats->num_rows > 0) {
      while ($row = $resultats->fetch_assoc()) {
        $code_admin = $row['code_admin'];
        $codesoc = $row['code_soc'];
        $societe = $row['societe'];
      }
      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
      $res1 = $bd->query($req1);

      if ($res1->num_rows > 0) {

        $req2 = "SELECT * FROM compta_tiers WHERE societe='$societe' AND statut = 'Actif' ORDER BY description ASC ";
        $res2 = $bd->query($req2);

        if ($res2->num_rows > 0) {
          while ($row = $res2->fetch_assoc()) {
            echo '<option value="'.$row['compte'].'">'.$row['compte'].'-'.$row['description'].'</option>';
          }
        } else {
          echo '';
        }
      } else {
        echo '';
      }
    } else {
      echo '';
    }
  }
}

//Afficher la liste de paie tiers
function liste_paeifrais_tiers(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['ref_doc'])) {
      if (empty($_GET['nom_tiers'])) {
        if (empty($_GET['date_doc'])) {
          $admin = $_SESSION['pseudo'];
          $params = 1;
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
          $resultats = $bd->query($requete);

          if ($resultats->num_rows > 0) {
            while ($row = $resultats->fetch_assoc()) {
              $code_admin = $row['code_admin'];
              $societe = $row['societe'];
            }
            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
            $res1 = $bd->query($req1);

            if ($res1->num_rows > 0) {
              $req2 = "SELECT * FROM comptes_tiers WHERE societe='$societe' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  echo '<tr>' .
                    '<td class="corp-table">'.$row['id'] . '</td>' .
                    '<td class="corp-table">'.$row['ref_doc'] . '</td>' .
                    '<td class="corp-table">'.$row['compte_debit'] . '</td>' .
                    '<td class="corp-table">'.$row['nom_complet'] . '</td>' .
                    '<td class="corp-table">'.$row['nature_operation'] . '</td>' .
                    '<td class="corp-table">'.$row['libelle'] . '</td>' .
                    '<td class="corp-table">'.$row['montant'] . '</td>' .
                    '<td class="corp-table">'.$row['devise'] . '</td>' .
                    '<td class="corp-table">'.$row['taux'] . '</td>' .
                    '<td class="corp-table">'.$row['date_extract'] . '</td>' .
                    '<td class="corp-table">'.$row['statut'] . '</td>' .
                    '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="maj-encodage_tiers.php?ref_doc=' . $row['ref_doc'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
                    '</tr>';
                }
              } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucune information trouvée" . '</div>';
              }
            } else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
          }
        } else {
          //filtrage eleve par option
          $date_doc = $_GET['date_doc'];
          $params = 1;
          $admin = $_SESSION['pseudo'];
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
          $resultats = $bd->query($requete);

          if ($resultats->num_rows > 0) {
            while ($row = $resultats->fetch_assoc()) {
              $code_admin = $row['code_admin'];
              $societe = $row['societe'];
            }
            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
            $res1 = $bd->query($req1);

            if ($res1->num_rows > 0) {
              $req2 = "SELECT * FROM comptes_tiers WHERE date_extract LIKE '%$date_doc%' AND societe='$societe' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  echo '<tr>' .
                    '<td class="corp-table">'.$row['id'] . '</td>' .
                    '<td class="corp-table">'.$row['ref_doc'] . '</td>' .
                    '<td class="corp-table">'.$row['compte_debit'] . '</td>' .
                    '<td class="corp-table">'.$row['nom_complet'] . '</td>' .
                    '<td class="corp-table">'.$row['nature_operation'] . '</td>' .
                    '<td class="corp-table">'.$row['libelle'] . '</td>' .
                    '<td class="corp-table">'.$row['montant'] . '</td>' .
                    '<td class="corp-table">'.$row['devise'] . '</td>' .
                    '<td class="corp-table">'.$row['taux'] . '</td>' .
                    '<td class="corp-table">'.$row['date_extract'] . '</td>' .
                    '<td class="corp-table">'.$row['statut'] . '</td>' .
                    '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="maj-encodage_tiers.php?ref_doc=' . $row['ref_doc'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
                    '</tr>';
                }
              } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
              }
            } else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
          }
          //filtrage eleve par option
        }
      } else {
        //filtrage eleve par nom
       
        //filtrage eleve par nom
      }
    } else {
      //filtrage eleve par classe
      $admin = $_SESSION['pseudo'];
      $ref_doc = $_GET['ref_doc'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd->query($requete);

      if ($resultats->num_rows > 0) {
        while ($row = $resultats->fetch_assoc()) {
          $code_admin = $row['code_admin'];
          $societe = $row['societe'];
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) {
          $req2 = "SELECT * FROM comptes_tiers WHERE ref_doc LIKE '%$ref_doc%' AND societe='$societe' ORDER BY id DESC";
          $res2 = $bd->query($req2);

          if ($res2->num_rows > 0) {
            while ($row = $res2->fetch_assoc()) {
              echo '<tr>' .
                '<td class="corp-table">'.$row['id'] . '</td>' .
                '<td class="corp-table">'.$row['ref_doc'] . '</td>' .
                '<td class="corp-table">'.$row['compte_debit'] . '</td>' .
                '<td class="corp-table">'.$row['nom_complet'] . '</td>' .
                '<td class="corp-table">'.$row['nature_operation'] . '</td>' .
                '<td class="corp-table">'.$row['libelle'] . '</td>' .
                '<td class="corp-table">'.$row['montant'] . '</td>' .
                '<td class="corp-table">'.$row['devise'] . '</td>' .
                '<td class="corp-table">'.$row['taux'] . '</td>' .
                '<td class="corp-table">'.$row['date_extract'] . '</td>' .
                '<td class="corp-table">'.$row['statut'] . '</td>' .
                '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="maj-encodage_tiers.php?ref_doc=' . $row['ref_doc'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
                '</tr>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
        }
      } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
      }
      //filtrage eleve par classe
    }
  }
  else {
  }
}

//Afficher la liste pour extrait compte tiers
function liste_extrait_tiers(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $statut_fin = "Actif";
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd->query($requete);

      if ($resultats->num_rows > 0) { // verification du compte administratif
        while ($row = $resultats->fetch_assoc()) {
          $code_admin = $row['code_admin'];
          $codesoc = $row['code_soc'];
          $societe = $row['societe'];
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) { // verification de droit administratif
          if (empty($_GET['compte'])) {
            if (empty($_GET['description'])) {
              $req1 = "SELECT * FROM compta_tiers WHERE statut='Actif' AND societe='$societe' ORDER BY compte ASC";
              $res1 = $bd->query($req1);

              if ($res1->num_rows > 0) {
                while ($row1 = $res1->fetch_assoc()) {
                  echo '<tr>' .
                    '<td class="corp-table">'.$row1['compte'].'</td>'.
                    '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">'.$row1['description'].'</td>'.
                    '<td class="corp-table">'.$row1['statut'].'</td>'.
                    '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="liste_compte_tiers.php?compte='.$row1['compte'].'&&ID='.$row1['id'].'&&societed='.$row1['societe'].'" class="selecteur text-white" title="Cliquez pour selectionner">' . 'select' . '</a>' . '</td>' .
                    '<tr>';
                }
              } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
              }
            } else {
              $description = $_GET['description'];
              $req2 = "SELECT * FROM compta_tiers WHERE description LIKE '%$description%' AND societe='$societe' AND statut='Actif'";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row2 = $res2->fetch_assoc()) {
                  echo '<tr>' .
                    '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">' . $row2['description'] . '</td>' .
                    '<td class="corp-table">' . $row2['compte'] . '</td>' .
                    '<td class="corp-table">' . $row2['statut'] . '</td>' .
                    '<td class="corp-table" style="background-color:orange!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="liste_compte_tiers.php?compte=' . $row2['compte'] . '" class="selecteur" title="Cliquez pour selectionner">' . 'select' . '</a>' . '</td>' .
                    '<tr>';
                }
              } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
              }
            }
          } else {
            $compte = $_GET['compte'];
            $req3 = "SELECT * FROM compta_tiers WHERE compte LIKE '%$compte%' AND societe='$societe' AND statut='Actif'";
            $res3 = $bd->query($req3);

            if ($res3->num_rows > 0) {
              while ($row3 = $res3->fetch_assoc()) {
                echo '<tr>' .
                  '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">' . $row3['description'] . '</td>' .
                  '<td class="corp-table">' . $row3['compte'] . '</td>' .
                  '<td class="corp-table">' . $row3['statut'] . '</td>' .
                  '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="liste_compte_tiers.php?compte=' . $row3['compte'] . '" class="selecteur text-white" title="Cliquez pour selectionner">' . 'select' . '</a>' . '</td>' .
                  '<tr>';
              }
            } else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
            }
          }
        } else { // verification de droit administratif
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Violation de droit administratif." . '</div>';
        }
      } else { // verification du compte administratif
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide." . '</div>';
      }
    } //fin de base de données
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue." . '</div>';
  }
}

//Afficher le bouton d'extrait compte tiers
function extrait_compte_tiers(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['compte']) && empty($_GET['ID'])) {
        echo '';
      } else {
        $compte = $_GET['compte'];
        $id_societed = $_GET['societed']; 
        $req = "SELECT * FROM compta_tiers WHERE compte ='$compte' AND societe='$id_societed'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            $num_compte = $row['compte'];
            $id_societed = $row['societe'];

            echo '<li><a href="../78954RPOTYHUYG/extrait_tiers.php?compte='.$num_compte.'&&societed='.$id_societed.'" class="btn btn-primary" target="_blank">' . 'Extrait de compte' . '</a></li>';
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

//Afficher les informations du compte selectionner
function extrait_cpte_tiers_header(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['compte'])) {
        echo '<div class="row w-100 d-flex justify-content-end">
				      <fieldset class="col-lg-12 col-md-12 col-sm-12">
				        <h5 class="" style="">
				          <b>EXTRAIT-COMPTE_Tiers | No_COMPTE | NOMS </b>
				        </h5>
				      </fieldset>
				    </div><br>';
      } else {
        $compte_tier = $_GET['compte'];
        $req = "SELECT * FROM compta_tiers WHERE compte = '$compte_tier' AND statut = 'Actif'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            echo '<div class="row w-100 d-flex justify-content-end">
				          <fieldset class="col-lg-12 col-md-12 col-sm-12">
				            <h5 class="" style="font-size: 16px">
				              <b>EXTRAIT-COMPTE_Tiers | ' . $row['compte'] . ' | ' . $row['description'] . ' </b>
				            </h5>
				          </fieldset>
				         </div><br>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
        }
      }
    }
  } else {
    echo '';
  }
}

//Afficher le recouvrement personnel_USD
function Etat_recvremntTiers(){
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
          $societe = $row['societe'];
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) { // verification de droit administratif

          //$mois_frais = $_GET['mois_frais'];

          $req2 = "SELECT * FROM compta_tiers WHERE societe='$societe' ORDER BY description ASC";
          $sql2 = $bd->query($req2);

          if ($sql2->num_rows > 0) {
            while ($row2 = $sql2->fetch_assoc()) {
              $description = $row2['description'];
              $compteTiers = $row2['compte'];
              $debitUSD = $row2['debit2_usd'];
              $CreditUSD = $row2['credit2_usd'];
              $soldeUSD = $row2['usd'];//Solde1 report année passe

              //Calculer du solde
              $Sglobal = ($soldeUSD + $debitUSD) - $CreditUSD;

              echo '<tr>' .
                '<td style="border: 1px solid #000">' . $compteTiers . '</td>' .
                '<td style="text-transform:uppercase!important;border: 1px solid #000;text-align:left!important">' . $description . '</td>' .
                '<td style="text-align:right;border: 1px solid #000">' . $soldeUSD . '</td>' .
                '<td style="text-align:right;border: 1px solid #000">' . $CreditUSD . '</td>' .
                '<td style="text-align:right;border: 1px solid #000">' . $debitUSD . '</td>' .
                '<td style="text-align:right;border: 1px solid #000">' . $Sglobal . '</td>' .
                '</tr>';
            }
          } else { //
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Aucune information trouvée." . '</div>';
          }
        } else {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Violation d'accès." . '</div>';
        } // verification de droit administratif
      } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide." . '</div>';
      } // verification du compte administratif
    }
  } else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue." . '</div>';
  }
} //fin fonction impression recouvrement
