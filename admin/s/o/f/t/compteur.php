<?php
//compteur nombres de transaction tiers
function cptfin_tiers(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['ref_doc'])) {
        $req = "SELECT * FROM admin_tb WHERE pseudo='".$_SESSION['pseudo']."'";
        $resultats = $bd->query($req);
        if ($resultats ->num_rows > 0) {
          while ($row = $resultats ->fetch_assoc()) {
            $societe = $row['societe'];
          }
          $req = "SELECT * FROM comptes_tiers WHERE societe='$societe' AND statut ='en cours'";
          $resultats = $bd->query($req);

          $nbr = mysqli_num_rows($resultats);
          if ($nbr > 1) {
            echo '<h4 class="compteur_admin">'.'<i class="fa fa-users"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Transactions Tiers'.'</h4>';
          }
          else{
            echo '<h4 class="compteur_admin">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Transaction Tiers'.'</h4>';
          }
        }
        else {
          # code...
        }
      }
      else {
        $ref_doc = $_GET['ref_doc'];
        $req = "SELECT * FROM comptes_tiers WHERE ref_doc ='$ref_doc'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            echo '<h4 class="compteur_admin">' . '<span style="font-weight:bold!important">'.'<i class="fa fa-user"></i>' . '&nbsp;'.$row['nom_complet'].'&nbsp;'.'</span>' . 'est' . '&nbsp;' . 'selectionné.' . '</h4>';
          }
        } else {
          echo '<ha class="compteur_admin" style="color:#ee2546!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . 'Invalide.' . '</h4>';
        }
      }
    }
  } else {
    echo '<ha class="compteur_admin" style="color:#ee2546!important">' . 'Invalide.' . '</h4>';
  }
}
//Fin Compteur Transaction Tiers

//compteur nombres de transaction autre
function cptfin_autre(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['ref_doc'])) {
        $req = "SELECT * FROM admin_tb WHERE pseudo='".$_SESSION['pseudo']."'";
        $resultats = $bd->query($req);
        if ($resultats ->num_rows > 0) {
          while ($row = $resultats ->fetch_assoc()) {
            $societe = $row['societe'];
          }
          $req = "SELECT * FROM comptes_autres WHERE societe='$societe' AND statut ='en cours'";
          $resultats = $bd->query($req);

          $nbr = mysqli_num_rows($resultats);
          if ($nbr > 1) {
            echo '<h4 class="compteur_admin">'.'<i class="fa fa-users"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Transactions Tiers'.'</h4>';
          }
          else{
            echo '<h4 class="compteur_admin">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Transaction Tiers'.'</h4>';
          }
        }
        else {
          # code...
        }
      }
      else {
        $ref_doc = $_GET['ref_doc'];
        $req = "SELECT * FROM comptes_autres WHERE ref_doc ='$ref_doc'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            echo '<h4 class="compteur_admin">' . '<span style="font-weight:bold!important">'.'<i class="fa fa-user"></i>' . '&nbsp;'.$row['nom_complet'].'&nbsp;'.'</span>' . 'est' . '&nbsp;' . 'selectionné.' . '</h4>';
          }
        } else {
          echo '<ha class="compteur_admin" style="color:#ee2546!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . 'Invalide.' . '</h4>';
        }
      }
    }
  } else {
    echo '<ha class="compteur_admin" style="color:#ee2546!important">' . 'Invalide.' . '</h4>';
  }
}
//Fin Compteur Transaction Autre

//Compteur des personnel
function cpteur_pers()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['compte'])) {
        $req = "SELECT * FROM compta_pers WHERE statut = 'Actif'";
        $resultats = $bd->query($req);
        if ($resultats ->num_rows > 0) {
          while ($row = $resultats ->fetch_assoc()) {
            $societe = $row['societe'];
          }
          $req = "SELECT * FROM compta_pers WHERE statut = 'Actif' AND societe='$societe'";
          $resultats = $bd->query($req);

          $nbr = mysqli_num_rows($resultats);
          if ($nbr > 1) {
            echo '<h4 class="compteur_admin">'.'<i class="fa fa-users"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Personnels'.'</h4>';
          }
          else{
            echo '<h4 class="compteur_admin">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Personnel'.'</h4>';
          }
        }
        else {
          # code...
        }
      }
      else {
        $compte_personnel = $_GET['compte'];
        $req = "SELECT * FROM compta_pers WHERE compte = '$compte_personnel'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            echo '<h4 class="compteur_admin">' . '<span style="font-weight:bold!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . $row['nom_complet'] . '&nbsp;' . '</span>' . 'est' . '&nbsp;' . 'selectionné.' . '</h4>';
          }
        } else {
          echo '<ha class="compteur_admin" style="color:#ee2546!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . 'Invalide.' . '</h4>';
        }
      }
    }
  } else {
    echo '<ha class="compteur_admin" style="color:#ee2546!important">' . 'Invalide.' . '</h4>';
  }
}
//Fin Compteur des personnel

//Compteur des Tresorerie
function compteur_tresor()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['compte'])) {
        $req = "SELECT * FROM compta_tresor WHERE statut ='Actif'";
        $resultats = $bd->query($req);

        if ($resultats ->num_rows > 0) {
          while ($row = $resultats ->fetch_assoc()) {
            $societe = $row['societe'];
          }
          $req = "SELECT * FROM compta_tresor WHERE societe='$societe'";
          $resultats = $bd->query($req);

          $nbr = mysqli_num_rows($resultats);
          if ($nbr > 1) {
            echo '<h4 class="compteur_admin">'.'<i class="fa fa-users"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Compte Tresoreries'.'</h4>';
          }
          else{
            echo '<h4 class="compteur_admin">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Compte Tresorerie'.'</h4>';
          }
        }
        else {
          # code...
        }
      } else {
        $compte_tresor = $_GET['compte'];
        $req = "SELECT * FROM compta_tresor WHERE compte = '$compte_tresor'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            echo '<h4 class="compteur_admin">' . '<span style="font-weight:bold!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . $row['description'] . '&nbsp;' . '</span>' . 'est' . '&nbsp;' . 'selectionné.' . '</h4>';
          }
        } else {
          echo '<ha class="compteur_admin" style="color:#ee2546!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . 'Invalide.' . '</h4>';
        }
      }
    }
  } else {
    echo '<ha class="compteur_admin" style="color:#ee2546!important">' . 'Invalide.' . '</h4>';
  }
}

//Compteur
function cpt_tier(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['compte'])) {
        $req = "SELECT * FROM compta_tiers WHERE statut = 'Actif'";
        $resultats = $bd->query($req);

        $nbr = mysqli_num_rows($resultats);
        if ($nbr > 1) {
          echo '<h4 class="compteur_admin">' . '<i class="fa fa-users"></i>' . '&nbsp;' . $nbr . '&nbsp;' . 'Tiers' . '</h4>';
        } else {
          echo '<h4 class="compteur_admin">' . '<i class="fa fa-user"></i>' . '&nbsp;' . $nbr . '&nbsp;' . 'Tier' . '</h4>';
        }
      } else {
        $compte_tier = $_GET['compte'];
        $req = "SELECT * FROM compta_tiers WHERE compte = '$compte_tier'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            echo '<h4 class="compteur_admin">' . '<span style="font-weight:bold!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . $row['description'] . '&nbsp;' . '</span>' . 'est' . '&nbsp;' . 'selectionné.' . '</h4>';
          }
        } else {
          echo '<ha class="compteur_admin" style="color:#ee2546!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . 'Invalide.' . '</h4>';
        }
      }
    }
  } else {
    echo '<ha class="compteur_admin" style="color:#ee2546!important">' . 'Invalide.' . '</h4>';
  }
}

//compteur autres compte
function cpt_autres(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['compte'])) {
        $req = "SELECT * FROM compta_autres WHERE statut = 'Actif'";
        $resultats = $bd->query($req);

        $nbr = mysqli_num_rows($resultats);
        if ($nbr > 1) {
          echo '<h4 class="compteur_admin">' . '<i class="fa fa-users"></i>' . '&nbsp;' . $nbr . '&nbsp;'.'Lexique_comptes'.'</h4>';
        } else {
          echo '<h4 class="compteur_admin">' . '<i class="fa fa-user"></i>' . '&nbsp;' . $nbr . '&nbsp;'.'Lexique_compte'.'</h4>';
        }
      } else {
        $compte_autre = $_GET['compte'];
        $req = "SELECT * FROM compta_autres WHERE compte = '$compte_autre'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            echo '<h4 class="compteur_admin">' . '<span style="font-weight:bold!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . $row['compte'] . '&nbsp;' . '</span>' . 'est' . '&nbsp;' . 'selectionné.' . '</h4>';
          }
        } else {
          echo '<ha class="compteur_admin" style="color:#ee2546!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . 'Invalide.' . '</h4>';
        }
      }
    }
  } else {
    echo '<ha class="compteur_admin" style="color:#ee2546!important">' . 'Invalide.' . '</h4>';
  }
}

//Affichage Compteur global
function cpteur_fin(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['ref_doc'])) {
        $d_id = date("y-m-d");
        $req = "SELECT * FROM comptes_encodage WHERE date_extract ='$d_id'";
        $resultats = $bd->query($req);

        $nbr = mysqli_num_rows($resultats);
        if ($nbr > 1) {
          echo '<h4 class="compteur_admin">' . '<i class="fa fa-file"></i>' . '&nbsp;' . $nbr . '&nbsp;' . 'Transactions' . '</h4>';
        } else {
          echo '<h4 class="compteur_admin">' . '<i class="fa fa-file"></i>' . '&nbsp;' . $nbr . '&nbsp;' . 'Transaction' . '</h4>';
        }
      } else {
        $ref_doc = $_GET['ref_doc'];
        $req = "SELECT * FROM comptes_encodage WHERE ref_doc = '$ref_doc'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            echo '<h4 class="compteur_admin">' . '<span style="font-weight:bold!important">' . '<i class="fa fa-file"></i>' . '&nbsp;' . $row['nom_complet'] . '&nbsp;' . '</span>' . 'est' . '&nbsp;' . 'selectionné.' . '</h4>';
          }
        } else {
          echo '<ha class="compteur_admin" style="color:#ee2546!important">' . '<i class="fa fa-file"></i>' . '&nbsp;' . 'Invalide.' . '</h4>';
        }
      }
    }
  } else {
    echo '<ha class="compteur_admin" style="color:#ee2546!important">' . 'Invalide.' . '</h4>';
  }
}

//Pour extrait compte Tiers
function cpt_nbre_extraittiers()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['compte'])) {
        $req = "SELECT * FROM compta_tiers WHERE statut = 'Actif'";
        $resultats = $bd->query($req);

        $nbr = mysqli_num_rows($resultats);
        if ($nbr > 1) {
          echo '';
        } else {
          echo '';
        }
      } else {
        $compte = $_GET['compte'];
        $req = "SELECT * FROM compta_tiers WHERE compte = '$compte'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            echo '<h4 class="compteur_admin">' . '<span style="font-weight:bold!important">' . '<i class="fa fa-file"></i>' . '&nbsp;' . $row['description'] . '&nbsp;' . '</span>' . 'est' . '&nbsp;' . 'selectionné.' . '</h4>';
          }
        } else {
          echo '<ha class="compteur_admin" style="color:#ee2546!important">' . '<i class="fa fa-file"></i>' . '&nbsp;' . 'Invalide.' . '</h4>';
        }
      }
    }
  } else {
    echo '<ha class="compteur_admin" style="color:#ee2546!important">' . 'Invalide.' . '</h4>';
  }
}

//compteur autres compte
function cpteur_autres()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['compte'])) {
        $req = "SELECT * FROM compta_autres WHERE statut = 'Actif'";
        $resultats = $bd->query($req);

        $nbr = mysqli_num_rows($resultats);
        if ($nbr > 1) {
          echo '<h4 class="compteur_admin">' . '<i class="fa fa-users"></i>' . '&nbsp;' . $nbr . '&nbsp;' . 'Autres' . '</h4>';
        } else {
          echo '<h4 class="compteur_admin">' . '<i class="fa fa-user"></i>' . '&nbsp;' . $nbr . '&nbsp;' . 'Autre' . '</h4>';
        }
      } else {
        $compte_autre = $_GET['compte'];
        $req = "SELECT * FROM compta_autres WHERE compte = '$compte_autre'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            echo '<h4 class="compteur_admin">' . '<span style="font-weight:bold!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . $row['compte'] . '&nbsp;' . '</span>' . 'est' . '&nbsp;' . 'selectionné.' . '</h4>';
          }
        } else {
          echo '<ha class="compteur_admin" style="color:#ee2546!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . 'Invalide.' . '</h4>';
        }
      }
    }
  } else {
    echo '<ha class="compteur_admin" style="color:#ee2546!important">' . 'Invalide.' . '</h4>';
  }
}

//compteur autres compte
function cpteur_pesro()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['compte'])) {
        $req = "SELECT * FROM compta_pers WHERE statut = 'Actif'";
        $resultats = $bd->query($req);

        $nbr = mysqli_num_rows($resultats);
        if ($nbr > 1) {
          echo '<h4 class="compteur_admin">' . '<i class="fa fa-users"></i>' . '&nbsp;' . $nbr . '&nbsp;' . 'Personnels' . '</h4>';
        } else {
          echo '<h4 class="compteur_admin">' . '<i class="fa fa-user"></i>' . '&nbsp;' . $nbr . '&nbsp;' . 'Personnel' . '</h4>';
        }
      } else {
        $compte_perso = $_GET['compte'];
        $req = "SELECT * FROM compta_pers WHERE compte = '$compte_perso'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            echo '<h4 class="compteur_admin">' . '<span style="font-weight:bold!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . $row['compte'] . '&nbsp;' . '</span>' . 'est' . '&nbsp;' . 'selectionné.' . '</h4>';
          }
        } else {
          echo '<ha class="compteur_admin" style="color:#ee2546!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . 'Invalide.' . '</h4>';
        }
      }
    }
  } else {
    echo '<ha class="compteur_admin" style="color:#ee2546!important">' . 'Invalide.' . '</h4>';
  }
}

//Compteur des personnel
function cpteur_fin_pers(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['ref_doc'])) {
        $req = "SELECT * FROM admin_tb WHERE pseudo='".$_SESSION['pseudo']."' ";
        $resultats = $bd->query($req);
        if ($resultats ->num_rows > 0) {
          while ($row = $resultats ->fetch_assoc()) {
            $societe = $row['societe'];
          }
          $req = "SELECT * FROM comptes_pers WHERE societe='$societe' AND statut ='en cours'";
          $resultats = $bd->query($req);

          $nbr = mysqli_num_rows($resultats);
          if ($nbr > 1) {
            echo '<h4 class="compteur_admin">'.'<i class="fa fa-users"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Transactions Personnels'.'</h4>';
          }
          else{
            echo '<h4 class="compteur_admin">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Transactions Personnel'.'</h4>';
          }
        }
        else {
          # code...
        }
      }
      else {
        $ref_doc = $_GET['ref_doc'];
        $req = "SELECT * FROM comptes_pers WHERE ref_doc = '$ref_doc'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            echo '<h4 class="compteur_admin">' . '<span style="font-weight:bold!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . $row['nom_complet'] . '&nbsp;' . '</span>' . 'est' . '&nbsp;' . 'selectionné.' . '</h4>';
          }
        } else {
          echo '<ha class="compteur_admin" style="color:#ee2546!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . 'Invalide.' . '</h4>';
        }
      }
    }
  } else {
    echo '<ha class="compteur_admin" style="color:#ee2546!important">' . 'Invalide.' . '</h4>';
  }
}
//Fin Compteur Transaction personnel

//compteur_OD
function compteur_OD()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['ref_doc'])) {
        $req = "SELECT * FROM compte_od WHERE statut = 'en cours'";
        $resultats = $bd->query($req);

        $nbr = mysqli_num_rows($resultats);
        if ($nbr > 1) {
          echo '<h4 class="compteur_admin">' . '<i class="fa fa-users"></i>' . '&nbsp;' . $nbr . '&nbsp;' . 'Operations' . '</h4>';
        } else {
          echo '<h4 class="compteur_admin">' . '<i class="fa fa-user"></i>' . '&nbsp;' . $nbr . '&nbsp;' . 'Operation' . '</h4>';
        }
      } else {
        $compte_OD = $_GET['ref_doc'];
        $req = "SELECT * FROM compte_od WHERE ref_doc = '$compte_OD'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            echo '<h4 class="compteur_admin">' . '<span style="font-weight:bold!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . $row['compte_debit'] . '_' . $row['nom_debit'] . '&nbsp;' . '</span>' . 'est' . '&nbsp;' . 'selectionné.' . '</h4>';
          }
        } else {
          echo '<ha class="compteur_admin" style="color:#ee2546!important">' . '<i class="fa fa-user"></i>' . '&nbsp;' . 'Invalide.' . '</h4>';
        }
      }
    }
  } else {
    echo '<ha class="compteur_admin" style="color:#ee2546!important">' . 'Invalide.' . '</h4>';
  }
}

//Compteur stockage
function compteur_stock(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['ref_article'])) {
        $req = "SELECT * FROM appro_stocks WHERE statut = 'Actif'";
        $resultats = $bd ->query($req);

        $nbr = mysqli_num_rows($resultats);
        if ($nbr > 1) {
          //echo '<h4 class="compteur_admin">'.'<i class="fa fa-shopping-bag"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Stocks'.'</h4>';
        }
        else{
          //echo '<h4 class="compteur_admin">'.'<i class="fa fa-shopping-bag"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Stock'.'</h4>';
        }
      }
      else{
	      $compte_artcle = $_GET['ref_article'];
	      $req = "SELECT * FROM appro_stocks WHERE ref_article = '$compte_artcle'";
	      $resultats = $bd ->query($req);

	      if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	          echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fas fa-shopping-bag"></i>'.'&nbsp;'.$row['article'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
	        }
	   		}
	      else{
	        echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fas fa-shopping-bag"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
	      }
      }
   	}
	}
  else{
    echo '<h4 class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
  }
}