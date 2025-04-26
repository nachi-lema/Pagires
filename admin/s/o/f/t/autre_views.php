<?php

//Afficher la liste des autres
function liste_autres(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['description_autre'])) {
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
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
          $res1 = $bd->query($req1);

          if ($res1->num_rows > 0) {
            $req2 = "SELECT * FROM compta_autres WHERE societe='$societe' AND statut ='Actif' ORDER BY compte ASC";
            $res2 = $bd->query($req2);

            if ($res2->num_rows > 0) {
              while ($row = $res2->fetch_assoc()) {
                echo '<tr>' .
                  '<td class="corp-table">' . $row['compte'] . '</td>' .
                  '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">'.$row['description'].'</td>'.
                  '<td class="corp-table">' . $row['solde1_cdf'] . '</td>' .
                  '<td class="corp-table">' . $row['solde1_usd'] . '</td>' .
                  '<td class="corp-table">' . $row['credit1_usd'] . '</td>' .
                  '<td class="corp-table">' . $row['credit1_cdf'] . '</td>' .
                  '<td class="corp-table">' . $row['debit1_usd'] . '</td>' .
                  '<td class="corp-table">' . $row['debit1_cdf'] . '</td>' .
                  '<td class="corp-table">' . $row['solde2_cdf'] . '</td>' .
                  '<td class="corp-table">' . $row['solde2_usd'] . '</td>' .
                  '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="list_autre.php?compte='.$row['compte'].'&&Code='.$row['code_soc'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
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
        $num_compte = $_GET['compte'];
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
            $req2 = "SELECT * FROM compta_autres WHERE compte LIKE '%$num_compte%' AND societe='$societe' AND statut = 'Actif' ORDER BY id DESC";
            $res2 = $bd->query($req2);

            if ($res2->num_rows > 0) {
              while ($row = $res2->fetch_assoc()) {
                echo '<tr>' .
                  '<td class="corp-table">' . $row['compte'] . '</td>' .
                  '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">' . $row['description'] . '</td>' .
                  '<td class="corp-table">' . $row['solde1_cdf'] . '</td>' .
                  '<td class="corp-table">' . $row['solde1_usd'] . '</td>' .
                  '<td class="corp-table">' . $row['credit1_usd'] . '</td>' .
                  '<td class="corp-table">' . $row['credit1_cdf'] . '</td>' .
                  '<td class="corp-table">' . $row['debit1_usd'] . '</td>' .
                  '<td class="corp-table">' . $row['debit1_cdf'] . '</td>' .
                  '<td class="corp-table">' . $row['solde2_cdf'] . '</td>' .
                  '<td class="corp-table">' . $row['solde2_usd'] . '</td>' .
                  '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="list_autre.php?compte=' . $row['compte'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
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
      $admin = $_SESSION['pseudo'];
      $description_autre = $_GET['description_autre'];
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
          $req2 = "SELECT * FROM compta_autres WHERE description LIKE '%$description_autre%' AND societe='$societe' AND statut = 'Actif' ORDER BY id DESC";
          $res2 = $bd->query($req2);

          if ($res2->num_rows > 0) {
            while ($row = $res2->fetch_assoc()) {
              echo '<tr>' .
                '<td class="corp-table">' . $row['compte'] . '</td>' .
                '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">' . $row['description'] . '</td>' .
                '<td class="corp-table">' . $row['solde1_cdf'] . '</td>' .
                '<td class="corp-table">' . $row['solde1_usd'] . '</td>' .
                '<td class="corp-table">' . $row['credit1_usd'] . '</td>' .
                '<td class="corp-table">' . $row['credit1_cdf'] . '</td>' .
                '<td class="corp-table">' . $row['debit1_usd'] . '</td>' .
                '<td class="corp-table">' . $row['debit1_cdf'] . '</td>' .
                '<td class="corp-table">' . $row['solde2_cdf'] . '</td>' .
                '<td class="corp-table">' . $row['solde2_usd'] . '</td>' .
                '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="list_autre.php?compte=' . $row['compte'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
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
      //filtrage eleve par nom
    }
  } else {
  }
}

//Mise à jour autre compte
function update_autre(){
  if (isset($_SESSION['pseudo'])) {
    if (empty($_GET['compte'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' .
        '<strong>' . 'Desolé!' . '</strong>' . '&nbsp;' . 'Aucun parametre trouvé' .
        '<span aria-hidden="true" data-dismiss="alert" aria-label="close">' . '&times;' . '</span>' .
        '</div>';
    }
    else {
      $compte_autre = $_GET['compte'];
      $Code = $_GET['Code'];
      include("connexion.php");
      if ($bd->connect_error) {
        die('Impossible de se connecter à la BD:' . $bd->connect_error);
      } else {
        $req = "SELECT * FROM compta_autres WHERE compte ='$compte_autre' AND code_soc='$Code'";
        $resul = $bd->query($req);

        if ($resul->num_rows > 0) {
          while ($row = $resul->fetch_assoc()) {
            echo '<div class="row w-100 p-2">' .
              '<fieldset class="col-lg-4 col-md-4 col-sm-12 p-2">' .
              '<label>' . 'Num compte:' . '</label>' .
              '<input type="text" name="compte_autre" readonly="auto" class="form-control" value="' . $row['compte'] . '" tabindex="10" required>' .
              '</fieldset>' .
              '<fieldset class="col-lg-8 col-md-8 col-sm-12 p-2">' .
              '<label>' . '<i class="fa fa-user">' . '</i>' . '&nbsp;' . 'Description:' . '</label>' .
              '<input type="text" name="description_autre" value="' . $row['description'] . '" class="form-control" tabindex="110" maxlength="50" required >' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<label class="control-label" for="solde1_cdf">Report_CDF :</label>' .
              '<input type="text" value="' . $row['solde1_cdf'] . '" class="form-control" name="solde1_cdf" placeholder="solde1_cdf">' .
              '</fieldset>'.
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<label class="control-label" for="solde1_usd">Report_USD :</label>' .
              '<input type="text" value="' . $row['solde1_usd'] . '" class="form-control" name="solde1_usd" placeholder="solde1 usd">' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<input type="hidden" value="' . $row['solde2_cdf'] . '" class="form-control" name="solde2_cdf" placeholder="solde2_cdf">' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<input type="hidden" value="' . $row['solde2_usd'] . '" class="form-control" name="solde2_usd" placeholder="solde2 usd">' .
              '<input type="hidden" name="statut_autre" value="Actif">' .
              '</fieldset>' .
              '</div>' .
              '<div class="row w-100 p-2">' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12">' .
              '<button type="reset"  class="btn btn-primary mt-4 col-sm-6" tabindex="170" style="background-color: #304c79">' . 'Annuler' . '</button>' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12">' .
              '<button type="submit" class="btn btn-primary mt-4 col-sm-6" name="cmd_editautre" tabindex="170" style="background-color: #304c79">' . 'Modifier' . '</button>' .
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

//fonction d'attire la liste autre à la BDD
function liste_classe_autrecompte(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
    $resultats = $bd->query($requete);

    if ($resultats->num_rows > 0) {
      while ($row = $resultats->fetch_assoc()) {
        $code_admin = $row['code_admin'];
      }
      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
      $res1 = $bd->query($req1);

      if ($res1->num_rows > 0) {
        $req2 = "SELECT * FROM compta_classe";
        $res2 = $bd->query($req2);

        if ($res2->num_rows > 0) {
          while ($row = $res2->fetch_assoc()) {
            echo '<option value="' . $row['groupe'] . '">' . $row['groupe_clas'] . '</option>';
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

//Afficher la liste de paie autre
function liste_paeifrais_autre(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['ref_doc'])) {
      if (empty($_GET['nom_autre'])) {
        if (empty($_GET['date_doc'])) {
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

              $req2 = "SELECT * FROM comptes_autres WHERE societe ='$societe' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  echo '<tr>' .
                    '<td class="corp-table">' . $row['id'] . '</td>' .
                    '<td class="corp-table">' . $row['ref_doc'] . '</td>' .
                    '<td class="corp-table">' . $row['compte_debit'] . '</td>' .
                    '<td class="corp-table">' . $row['nom_complet'] . '</td>' .
                    '<td class="corp-table">' . $row['nature_operation'] . '</td>' .
                    '<td class="corp-table">' . $row['libelle'] . '</td>' .
                    '<td class="corp-table">' . $row['montant'] . '</td>' .
                    '<td class="corp-table">' . $row['devise'] . '</td>' .
                    '<td class="corp-table">' . $row['taux'] . '</td>' .
                    '<td class="corp-table">' . $row['date_extract'] . '</td>' .
                    '<td class="corp-table">' . $row['statut'] . '</td>' .
                    '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="maj-encodage_autre.php?ref_doc=' . $row['ref_doc'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
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

              $req2 = "SELECT * FROM comptes_autres WHERE date_extract LIKE '%$date_doc%' AND societe ='$societe' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  echo '<tr>' .
                    '<td class="corp-table">' . $row['id'] . '</td>' .
                    '<td class="corp-table">' . $row['ref_doc'] . '</td>' .
                    '<td class="corp-table">' . $row['compte_debit'] . '</td>' .
                    '<td class="corp-table">' . $row['nom_complet'] . '</td>' .
                    '<td class="corp-table">' . $row['nature_operation'] . '</td>' .
                    '<td class="corp-table">' . $row['libelle'] . '</td>' .
                    '<td class="corp-table">' . $row['montant'] . '</td>' .
                    '<td class="corp-table">' . $row['devise'] . '</td>' .
                    '<td class="corp-table">' . $row['taux'] . '</td>' .
                    '<td class="corp-table">' . $row['date_extract'] . '</td>' .
                    '<td class="corp-table">' . $row['statut'] . '</td>' .
                    '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="maj-encodage_autre.php?ref_doc=' . $row['ref_doc'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
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
        $admin = $_SESSION['pseudo'];
        $nom_autre = $_GET['nom_autre'];
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
            $req2 = "SELECT * FROM comptes_autres WHERE nom_complet LIKE '%$nom_autre%' AND societe ='$societe' ORDER BY id DESC";
            $res2 = $bd->query($req2);

            if ($res2->num_rows > 0) {
              while ($row = $res2->fetch_assoc()) {
                echo '<tr>' .
                  '<td class="corp-table">' . $row['id'] . '</td>' .
                  '<td class="corp-table">' . $row['ref_doc'] . '</td>' .
                  '<td class="corp-table">' . $row['compte_debit'] . '</td>' .
                  '<td class="corp-table">' . $row['nom_complet'] . '</td>' .
                  '<td class="corp-table">' . $row['nature_operation'] . '</td>' .
                  '<td class="corp-table">' . $row['libelle'] . '</td>' .
                  '<td class="corp-table">' . $row['montant'] . '</td>' .
                  '<td class="corp-table">' . $row['devise'] . '</td>' .
                  '<td class="corp-table">' . $row['taux'] . '</td>' .
                  '<td class="corp-table">' . $row['date_extract'] . '</td>' .
                  '<td class="corp-table">' . $row['statut'] . '</td>' .
                  '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="maj-encodage_autre.php?ref_doc=' . $row['ref_doc'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
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
          $req2 = "SELECT * FROM comptes_autres WHERE ref_doc LIKE '%$ref_doc%' AND societe ='$societe' ORDER BY id DESC";
          $res2 = $bd->query($req2);

          if ($res2->num_rows > 0) {
            while ($row = $res2->fetch_assoc()) {
              echo '<tr>' .
                '<td class="corp-table">' . $row['id'] . '</td>' .
                '<td class="corp-table">' . $row['ref_doc'] . '</td>' .
                '<td class="corp-table">' . $row['compte_debit'] . '</td>' .
                '<td class="corp-table">' . $row['nom_complet'] . '</td>' .
                '<td class="corp-table">' . $row['nature_operation'] . '</td>' .
                '<td class="corp-table">' . $row['libelle'] . '</td>' .
                '<td class="corp-table">' . $row['montant'] . '</td>' .
                '<td class="corp-table">' . $row['devise'] . '</td>' .
                '<td class="corp-table">' . $row['taux'] . '</td>' .
                '<td class="corp-table">' . $row['date_extract'] . '</td>' .
                '<td class="corp-table">' . $row['statut'] . '</td>' .
                '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="maj-encodage_autre.php?ref_doc=' . $row['ref_doc'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
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
  } else {
  }
}
//Fin Afficher la liste de paie autre

//Afficher la liste Compte Autre
function liste_extrait_autre(){
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
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params ='$params'";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) { // verification de droit administratif
          if (empty($_GET['comptes_autres'])) {
            if (empty($_GET['description'])) {
              $req1 = "SELECT * FROM compta_autres WHERE statut='Actif' ORDER BY compte ASC";
              $res1 = $bd->query($req1);

              if ($res1->num_rows > 0) {
                while ($row1 = $res1->fetch_assoc()) {

                  echo'<tr>'.
                    '<td class="corp-table">'.$row1['compte'].'</td>'.
                    '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">'.$row1['descriptions'].'</td>'.
                    '<td class="corp-table">'.$row1['statut'].'</td>'.
                    '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="liste_compte_autre.php?compte='.$row1['compte'].'&&Societed='.$row1['societe'].'&&ID='.$row1['id'].'" class="selecteur text-white" title="Cliquez pour selectionner">' . 'select' . '</a>' . '</td>' .
                    '<tr>';
                }
              } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
              }
            } else {
              $description = $_GET['description'];
              $req2 = "SELECT * FROM compta_autres WHERE description LIKE '%$description%' AND statut='Actif'";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row2 = $res2->fetch_assoc()) {

                  echo '<tr>' .
                    '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">' . $row2['description'] . '</td>' .
                    '<td class="corp-table">' . $row2['compte'] . '</td>' .
                    '<td class="corp-table">' . $row2['statut'] . '</td>' .
                    '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="liste_compte_autre.php?compte=' . $row2['compte'] . '" class="selecteur text-white" title="Cliquez pour selectionner">' . 'select' . '</a>' . '</td>' .
                    '<tr>';
                }
              } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
              }
            }
          } else {
            $comptes_autres = $_GET['comptes_autres'];
            $req3 = "SELECT * FROM compta_autres WHERE compte_credit LIKE '%$comptes_autres%' AND statut='Actif'";
            $res3 = $bd->query($req3);

            if ($res3->num_rows > 0) {
              while ($row3 = $res3->fetch_assoc()) {

                echo '<tr>' .
                  '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">' . $row3['description'] . '</td>' .
                  '<td class="corp-table">' . $row3['compte'] . '</td>' .
                  '<td class="corp-table">' . $row3['statut'] . '</td>' .
                  '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="liste_compte_autre.php?compte=' . $row3['compte'] . '" class="selecteur text-white" title="Cliquez pour selectionner">' . 'select' . '</a>' . '</td>' .
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

//Afficher le bouiton d'extrait compte Autre
function extrait_compte_autre(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['compte']) && empty($_GET['ID'])) {
        echo '';
      } else {
        $compte = $_GET['compte'];
        $ID_autre = $_GET['ID'];
        $id_societed = $_GET['Societed'];
        $req = "SELECT * FROM compta_autres WHERE compte ='$compte' AND id='$ID_autre'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            $num_compte = $row['compte'];
            $id_societed = $row['societe'];

            echo '<a href="../78954RPOTYHUYG/extrait_autre.php?compte='.$num_compte.'&&Societed='.$id_societed.'" class="btn btn-primary" target="_blank" style="background-color: #44597b">' . 'Extrait de compte' . '</a>';
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

//Afficher les informations du compte selectionner autres
function extrait_compte_autre_header(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['compte'])) {
        echo '<div class="row w-100 d-flex justify-content-end mb-2">
				      <fieldset class="col-lg-12 col-md-12 col-sm-12">
				        <h5 class="" style="font-size: 16px">
				          <b>EXTRAIT-COMPTE | NOMS | No_COMPTE </b>
				        </h5>
				      </fieldset>
				    </div><br>';
      } else {
        $compte_autre = $_GET['compte'];
        $req = "SELECT * FROM compta_autres WHERE compte ='$compte_autre' AND statut ='Actif'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            echo '<div class="row w-100 d-flex justify-content-end mb-2">
				          <fieldset class="col-lg-12 col-md-12 col-sm-12">
				            <h5 class="" style="font-size: 16px">
				         			<b>EXTRAIT-COMPTE | ' . $row['description'] . ' | ' . $row['compte'] . ' </b>
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

//impression Tresorerie nette Campta_autre
function Etat_rapport_global_compta_autre2(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $statut = "actif";
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $result = $bd->query($requete);

      if ($result->num_rows > 0) { // verification du compte administratif
        while ($row = $result->fetch_assoc()) {
          $code_admin = $row['code_admin'];
          $societe = $row['societe'];
        }
        $req = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
        $res = $bd->query($req);

        if ($res->num_rows > 0) {
          $get = "SELECT * FROM compta_autres WHERE societe='$societe' AND groupe =57 AND statut ='$statut'";
          $ser = $bd->query($get);

          if ($ser->num_rows > 0) {
            while ($row1 = $ser->fetch_assoc()) {
              $ID = $row1['id'];
              $Description = $row1['description'];
              $Solde_USD   = $row1['solde1_usd'];
              $Solde_CDF   = $row1['solde1_cdf'];
              $Debit_USD   = $row1['Totaux_debit_usd'];
              $Credit_USD  = $row1['Totaux_credit_usd'];
              $Taux        = $row1['taux'];

              //Equation
              /*$Report = ($Solde_CDF/$Taux)+$Solde_USD;
              $Solde_glob = $Report+$Debit_USD-$Credit_USD;*/

              /*echo'<tr>'.
			              '<td class="corp-table">'.$ID.'</td>'.
		                '<td class="corp-table">'.$Description.'</td>'.
		                '<td class="corp-table">'.number_format($Report,2).'</td>'.
		                '<td class="corp-table">'.number_format($Debit_USD,2).'</td>'.
		                '<td class="corp-table">'.number_format($Credit_USD,2).'</td>'.
		                '<td class="corp-table">'.number_format($Solde_glob,2).'</td>'.
	                '</tr>';*/
            }
            //Calcule de toutes compte debit classe 52
            $get1 = "SELECT sum(Totaux_debit_usd) AS Total_debit_usd_bank1 FROM compta_autres WHERE societe='$societe' AND groupe =52 AND statut ='$statut'";
            $ser1 = $bd->query($get1);

            if ($ser1->num_rows > 0) {
              while ($row2 = $ser1->fetch_assoc()) {
                $Total_Debit_bank = number_format($row2['Total_debit_usd_bank1'], 2);
                $Total_Debit_bank1 = $row2['Total_debit_usd_bank1'];
              }
            }
            $get2 = "SELECT sum(Totaux_credit_usd) AS Total_credit_usd_bank1 FROM compta_autres WHERE societe='$societe' AND groupe =52 AND statut ='$statut'";
            $ser2 = $bd->query($get2);

            if ($ser2->num_rows > 0) {
              while ($row3 = $ser2->fetch_assoc()) {
                $Total_Credit_bank = number_format($row3['Total_credit_usd_bank1'], 2);
                $Total_Credit_bank1 = $row3['Total_credit_usd_bank1'];
              }
            }
            $get3 = "SELECT sum(solde1_usd) AS Solde_glob_USD_bank FROM compta_autres WHERE societe='$societe' AND groupe =52 AND statut ='$statut'";
            $ser3 = $bd->query($get3);

            if ($ser3->num_rows > 0) {
              while ($row4 = $ser3->fetch_assoc()) {
                $Sold_USD_bank = $row4['Solde_glob_USD_bank'];
              }
            }
            $get4 = "SELECT sum(solde1_cdf) AS Solde_glob_CDF_bank FROM compta_autres WHERE societe='$societe' AND groupe =52 AND statut ='$statut'";
            $ser4 = $bd->query($get4);

            if ($ser4->num_rows > 0) {
              while ($row5 = $ser4->fetch_assoc()) {
                $Sold_CDF_bank = $row5['Solde_glob_CDF_bank'];
              }
            }

            //Calcule de toutes compte debit classe 57
            $get1 = "SELECT sum(Totaux_debit_usd) AS Total_debit_usd_caisse1 FROM compta_autres WHERE societe='$societe' AND groupe =57 AND statut ='$statut'";
            $ser1 = $bd->query($get1);

            if ($ser1->num_rows > 0) {
              while ($row2 = $ser1->fetch_assoc()) {
                $Total_Debit_caisse = number_format($row2['Total_debit_usd_caisse1'], 2);
                $Total_Debit_caisse1 = $row2['Total_debit_usd_caisse1'];
              }
            }
            $get2 = "SELECT sum(Totaux_credit_usd) AS Total_credit_usd_caisse1 FROM compta_autres WHERE societe='$societe' AND groupe =57 AND statut ='$statut'";
            $ser2 = $bd->query($get2);

            if ($ser2->num_rows > 0) {
              while ($row3 = $ser2->fetch_assoc()) {
                $Total_Credit_caisse = number_format($row3['Total_credit_usd_caisse1'], 2);
                $Total_Credit_caisse1 = $row3['Total_credit_usd_caisse1'];
              }
            }
            $get3 = "SELECT sum(solde1_usd) AS Solde_glob_USD_caisse FROM compta_autres WHERE societe='$societe' AND groupe =57 AND statut ='$statut'";
            $ser3 = $bd->query($get3);

            if ($ser3->num_rows > 0) {
              while ($row4 = $ser3->fetch_assoc()) {
                $Sold_USD_caisse = $row4['Solde_glob_USD_caisse'];
              }
            }
            $get4 = "SELECT sum(solde1_cdf) AS Solde_glob_CDF_caisse FROM compta_autres WHERE societe='$societe' AND clas =6 AND statut ='$statut'";
            $ser4 = $bd->query($get4);

            if ($ser4->num_rows > 0) {
              while ($row5 = $ser4->fetch_assoc()) {
                $Sold_CDF_caisse = $row5['Solde_glob_CDF_caisse'];
              }
            }

            //Calcule de toutes compte debit classe 6
            $get1 = "SELECT sum(Totaux_debit_usd) AS Total_debit_usd2 FROM compta_autres WHERE societe='$societe' AND clas =6 AND statut ='$statut'";
            $ser1 = $bd->query($get1);

            if ($ser1->num_rows > 0) {
              while ($row2 = $ser1->fetch_assoc()) {
                $Total_Debit2 = number_format($row2['Total_debit_usd2'], 2);
                $Total_Debit3 = $row2['Total_debit_usd2'];
              }
            }
            $get2 = "SELECT sum(Totaux_credit_usd) AS Total_credit_usd2 FROM compta_autres WHERE societe='$societe' AND clas =6 AND statut ='$statut'";
            $ser2 = $bd->query($get2);

            if ($ser2->num_rows > 0) {
              while ($row3 = $ser2->fetch_assoc()) {
                $Total_Credit2 = number_format($row3['Total_credit_usd2'], 2);
                $Total_Credit3 = $row3['Total_credit_usd2'];
              }
            }
            $get3 = "SELECT sum(solde1_usd) AS Solde_glob_USD2 FROM compta_autres WHERE societe='$societe' AND clas =6 AND statut ='$statut'";
            $ser3 = $bd->query($get3);

            if ($ser3->num_rows > 0) {
              while ($row4 = $ser3->fetch_assoc()) {
                $Sold_USD2 = $row4['Solde_glob_USD2'];
              }
            }
            $get4 = "SELECT sum(solde1_cdf) AS Solde_glob_CDF2 FROM compta_autres WHERE societe='$societe' AND clas =6 AND statut ='$statut'";
            $ser4 = $bd->query($get4);

            if ($ser4->num_rows > 0) {
              while ($row5 = $ser4->fetch_assoc()) {
                $Sold_CDF2 = $row5['Solde_glob_CDF2'];
              }
            }

            //Equation2 Total des entrées classe 52
            $Raport_glob_cpte52 = ($Sold_CDF_bank / $Taux) + $Sold_USD_bank;
            $Sold_glob_USD_bank = $Raport_glob_cpte52 + $Total_Debit_bank1 - $Total_Credit_bank1;

            //Equation2 Total des entrées classe 57
            $Raport_glob_cpte57 = ($Sold_CDF_caisse / $Taux) + $Sold_USD_caisse;
            $Sold_glob_USD_caisse = $Raport_glob_cpte57 + $Total_Debit_caisse1 - $Total_Credit_caisse1;

            //Equation3 Total des sorties
            $Raport_glob_cpte6 = ($Sold_CDF2 / $Taux) + $Sold_USD2;
            $Sold_glob_USD2 = $Raport_glob_cpte6 + $Total_Debit3 - $Total_Credit3;

            //Equation3 Global
            $Solde_clas57526 = $Sold_glob_USD_bank + $Sold_glob_USD_caisse - $Sold_glob_USD2;

            //Affichager du coût global classe 52, 57 et 6
            //Toutes les Totals des entrées classe 52 Bank
            echo '<tr>' .
              '<td class="corp-table">1</td>' .
              '<td class="corp-table">Banques</td>' .
              '<td class="corp-table text-right">' . number_format($Raport_glob_cpte52, 2) . '</td>' .
              '<td class="corp-table text-right">' . $Total_Debit_bank . '</td>' .
              '<td class="corp-table text-right">' . $Total_Credit_bank . '</td>' .
              '<td class="corp-table text-right">' . number_format($Sold_glob_USD_bank, 2) . '</td>' .
              '</tr>';
            //Toute le Total des sorties
            echo '<tr>' .
              '<td class="corp-table">2</td>' .
              '<td class="corp-table">Caisse</td>' .
              '<td class="corp-table text-right">' . number_format($Raport_glob_cpte57, 2) . '</td>' .
              '<td class="corp-table text-right">' . $Total_Debit_caisse . '</td>' .
              '<td class="corp-table text-right">' . $Total_Credit_caisse . '</td>' .
              '<td class="corp-table text-right">' . number_format($Sold_glob_USD_caisse, 2) . '</td>' .
              '</tr>';
            //Toute le Total des sorties
            echo '<tr>' .
              '<td class="corp-table">3</td>' .
              '<td class="corp-table">Sorties</td>' .
              '<td class="corp-table text-right">' . number_format($Raport_glob_cpte6, 2) . '</td>' .
              '<td class="corp-table text-right">' . $Total_Debit2 . '</td>' .
              '<td class="corp-table text-right">' . $Total_Credit2 . '</td>' .
              '<td class="corp-table text-right">' . number_format($Sold_glob_USD2, 2) . '</td>' .
              '</tr>';

            //Le solde des entées et sortie
            echo '<tr><td colspan="6"></td></tr>';
            echo '<tr>' .
              '<td class="corp-table">4</td>' .
              '<td class="corp-table" colspan="4" style="font-weight:bold;font-size:20px;">Solde de la tresorerie </td>' .
              '<td class="corp-table text-center" style="font-weight:bold;font-size:20px;background:#c9c6ca">' . number_format($Solde_clas57526, 2) . '</td>' .
              '</tr>';
          }
          else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucune information trouvée" . '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
        }
      } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide." . '</div>';
      } // verification du compte administratif
    }
  } else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue." . '</div>';
  }
} //fin fonction impression tresorerie nette Campta_autre
