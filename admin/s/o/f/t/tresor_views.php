<?php

//Lite d'Affichage tresorerie
function liste_tresor(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['reference'])) {
      if (empty($_GET['compte'])) {
        $admin = $_SESSION['pseudo'];
        $params = 1;
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
        $resultats = $bd->query($requete);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
            $codesoc = $row['code_soc'];
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
          $res1 = $bd->query($req1);

          if ($res1->num_rows > 0) {

            $req2 = "SELECT * FROM compta_tresor WHERE societe='$societe' AND statut ='Actif'";
            $res2 = $bd->query($req2);

            if ($res2->num_rows > 0) {
              while ($row = $res2->fetch_assoc()) {
                echo '<tr>' .
                  '<td class="corp-table">' . $row['compte'] . '</td>' .
                  '<td class="corp-table">' . $row['description'] . '</td>' .
                  '<td class="corp-table">' . $row['reference'] . '</td>' .
                  '<td class="corp-table">' . $row['scdf'] . '</td>' .
                  '<td class="corp-table">' . $row['solde1_usd'] . '</td>' .
                  '<td class="corp-table">' . $row['credit1_usd'] . '</td>' .
                  '<td class="corp-table">' . $row['credit1_cdf'] . '</td>' .
                  '<td class="corp-table">' . $row['debit1_cdf'] . '</td>' .
                  '<td class="corp-table">' . $row['debit1_usd'] . '</td>' .
                  '<td class="corp-table">' . $row['statut'] . '</td>' .
                  '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="list_tresor.php?compte='.$row['compte'].'&&Code='.$row['code_soc'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
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
        //filtrage eleve par compte
        $compte_tresor = $_GET['compte'];
        $params = 1;
        $admin = $_SESSION['pseudo'];
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

            $req2 = "SELECT * FROM compta_tresor WHERE compte LIKE '%$compte_tresor%' AND societe='$societe' AND statut = 'Actif' ORDER BY id DESC";
            $res2 = $bd->query($req2);

            if ($res2->num_rows > 0) {
              while ($row = $res2->fetch_assoc()) {
                echo '<tr>' .
                  '<td class="corp-table">' . $row['compte'] . '</td>' .
                  '<td class="corp-table">' . $row['description'] . '</td>' .
                  '<td class="corp-table">' . $row['reference'] . '</td>' .
                  '<td class="corp-table">' . $row['scdf'] . '</td>' .
                  '<td class="corp-table">' . $row['solde1_usd'] . '</td>' .
                  '<td class="corp-table">' . $row['credit1_usd'] . '</td>' .
                  '<td class="corp-table">' . $row['credit1_cdf'] . '</td>' .
                  '<td class="corp-table">' . $row['debit1_cdf'] . '</td>' .
                  '<td class="corp-table">' . $row['debit1_usd'] . '</td>' .
                  '<td class="corp-table">' . $row['statut'] . '</td>' .
                  '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="list_tresor.php?compte=' . $row['compte'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
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
      $reference_tresor = $_GET['reference'];
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
          $req2 = "SELECT * FROM compta_tresor WHERE reference LIKE '%$reference_tresor%' AND societe='$societe' AND statut = 'Actif' ORDER BY id DESC";
          $res2 = $bd->query($req2);

          if ($res2->num_rows > 0) {
            while ($row = $res2->fetch_assoc()) {
              echo '<tr>' .
                '<td class="corp-table">' . $row['compte'] . '</td>' .
                '<td class="corp-table">' . $row['description'] . '</td>' .
                '<td class="corp-table">' . $row['reference'] . '</td>' .
                '<td class="corp-table">' . $row['scdf'] . '</td>' .
                '<td class="corp-table">' . $row['solde1_usd'] . '</td>' .
                '<td class="corp-table">' . $row['credit1_usd'] . '</td>' .
                '<td class="corp-table">' . $row['credit1_cdf'] . '</td>' .
                '<td class="corp-table">' . $row['debit1_cdf'] . '</td>' .
                '<td class="corp-table">' . $row['debit1_usd'] . '</td>' .
                '<td class="corp-table">' . $row['statut'] . '</td>' .
                '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="list_tresor.php?compte=' . $row['compte'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
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
  }
  else {
  }
}

// Mise à jour du compte Trésorerie
function update_tresor(){
  if (isset($_SESSION['pseudo'])) {
    if (empty($_GET['compte'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' .
        '<strong>' . 'Desolé!' . '</strong>' . '&nbsp;' . 'Aucun parametre trouvé' .
        '<span aria-hidden="true" data-dismiss="alert" aria-label="close">' . '&times;' . '</span>' .
        '</div>';
    } else {
      $compte_tresor = $_GET['compte'];
      $codesoc = $_GET['Code'];
      include("connexion.php");
      if ($bd->connect_error) {
        die('Impossible de se connecter à la BD:' . $bd->connect_error);
      } else {
        $req = "SELECT * FROM compta_tresor WHERE compte ='$compte_tresor' AND code_soc='$codesoc'";
        $resul = $bd->query($req);

        if ($resul->num_rows > 0) {
          while ($row = $resul->fetch_assoc()) {
            echo '<div class="row w-100 p-2">' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<label>' . 'Num compte:' . '</label>' .
              '<input type="text" name="compte_tresor" readonly="auto" class="form-control" value="' . $row['compte'] . '" tabindex="10" required>' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<label class="control-label" for="reference">Référence:</label>' .
              '<input type="text" class="form-control" readonly="auto" name="reference_tresor" value="' . $row['reference'] . '" placeholder="N° Référence">' .
              '</fieldset>' .
              '<fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mb-2">' .
              '<label>' . '<i class="fa fa-user">' . '</i>' . '&nbsp;' . 'Description:' . '</label>' .
              '<input type="text" name="description_tresor" readonly="auto" value="' . $row['description'] . '" class="form-control" tabindex="110" maxlength="50" required >' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<label class="control-label" for="">Report CDF:</label>' .
              '<input type="text" class="form-control" id="scdf" name="scdf" value="' . $row['scdf'] . '"">' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<label class="control-label" for="credit1_usd">Report USD:</label>' .
              '<input type="text" class="form-control" name="solde1_usd" value="' . $row['solde1_usd'] . '" placeholder="report credit usd">' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<input type="hidden" class="form-control" name="cdf" value="' . $row['2_cdf'] . '" placeholder="report solde cdf">' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mb-2">' .
              '<input type="hidden" class="form-control" name="solde2_usd" value="' . $row['solde2_usd'] . '"placeholder="report solde usd">' .
              '<input type="hidden" name="statut_tresor" value="Actif">' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12">' .
              '<button type="reset"  class="btn btn-primary mt-4 col-lg-6 col-md-6" tabindex="170" style="background-color: #304c79">' . 'Annuler' . '</button>' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12">' .
              '<button type="submit" class="btn btn-primary mt-4 col-lg-6 col-md-6" name="cmd_edittresor" tabindex="170" style="background-color: #304c79">' . 'Modifier' . '</button>' .
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

//Afficher la liste Taux de change
function listing_tauxchange(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['nom_eleve'])) {
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
          $req2 = "SELECT * FROM taux_tb WHERE societe ='$societe' ORDER BY id ASC";
          $res2 = $bd->query($req2);

          if ($res2->num_rows > 0) {
            while ($row = $res2->fetch_assoc()) {
              echo '<tr>' .
                '<td class="corp-table">' . $row['id'] . '</td>' .
                '<td class="corp-table">' . $row['date_crea'] . '</td>' .
                '<td class="corp-table">' . $row['devise'] . '</td>' .
                '<td class="corp-table">' . $row['taux'] . '</td>' .
                '<td class="corp-table">' . $row['statut'] . '</td>' .
                '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="taux-change.php?ID=' . $row['id'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
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
    }
  } else {
  }
}
//FIN Afficher la liste Taux de change

//Button desactiver le taux
function update_taux(){
  if (isset($_SESSION['pseudo'])) {
    if (empty($_GET['ID'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' .
        '<strong>' . 'Desolé!' . '</strong>' . '&nbsp;' . 'Aucun parametre trouvé' .
        '<span aria-hidden="true" data-dismiss="alert" aria-label="close">' . '&times;' . '</span>' .
        '</div>';
    } else {
      $compte = $_GET['ID'];
      include("connexion.php");
      if ($bd->connect_error) {
        die('Impossible de se connecter à la BD:' . $bd->connect_error);
      } else {
        $req = "SELECT * FROM taux_tb WHERE id ='$compte'";
        $resul = $bd->query($req);

        if ($resul->num_rows > 0) {
          while ($row = $resul->fetch_assoc()) {
            echo '<div class="row w-100 p-2">' .
              '<fieldset class="col-lg-2 col-md-2 col-sm-12">
                  </fieldset>' .
              '<fieldset class="col-lg-4 col-md-4 col-sm-12">' .
              '<select name="desactiver" class="form-control" tabindex="" required>' .
              '<option value="DESACTIVE">OUI <option>' .
              '<option value="en cours">NON <option>' .
              '<select>' .
              '</fieldset>' .
              '<fieldset class="col-lg-6 col-md-6 col-sm-12">' .
              '<button type="submit" class="btn btn-danger col-sm-6" name="cmd_desataux" tabindex="170">' . 'Desactiver' . '</button>' .
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