<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if (!(isset($_SESSION['pseudo']) && $_SESSION['code_admin'] != '')) {
    header("location:login.php");
    exit;
  }
  $session_id = $_SESSION['pseudo'];

  //Function / model
  include("../admin/s/o/f/t/fonctions.php");
  include("../admin/s/o/f/t/fonctions_pers.php");
  require_once("../admin/s/o/f/t/cerveau.php");
  require_once("../admin/s/o/f/t/acces_admin.php");
  
  require_once("../admin/s/o/f/t/tiers_function.php");
  require_once("../admin/s/o/f/t/autre_function.php");
  require_once("../admin/s/o/f/t/stocks_function.php");
  
  //Views / Affichages
  include("../admin/s/o/f/t/affiche_admin.php");
  include("../admin/s/o/f/t/affichage_pers.php");
  require_once("../admin/s/o/f/t/affichage_print.php");
  require_once("../admin/s/o/f/t/affichage.php");
  require_once("../admin/s/o/f/t/affichage_finance.php");

  require_once("../admin/s/o/f/t/compteur.php");
  require_once("../admin/s/o/f/t/afficher_recu.php");

  require_once("../admin/s/o/f/t/tresor_views.php");
  require_once("../admin/s/o/f/t/tiers_views.php");
  require_once("../admin/s/o/f/t/autre_views.php");
  require_once("../admin/s/o/f/t/stocks_views.php");

  


  $page = $_SERVER['PHP_SELF'];
  $sec = "60";

