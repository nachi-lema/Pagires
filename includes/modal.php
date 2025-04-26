<?php
require('../admin/s/o/f/t/connexion.php');

if (isset($_POST['submit_form'])) {
  $date_extra = $_POST['date_extra'];

  if (empty($date_extra)) {
    $message = '<p class="error">Vous devez séléctionner une date</p>';
  } else {
    header("location:../65058HGHHHggrt077prints/print_trans.php?date=$date_extra");
  }
}
?>
<?php
require('../admin/s/o/f/t/connexion.php');

if (isset($_POST['submit_period'])) {
  $_SESSION['debut'] = $_POST['date_debut'];
  $date_debut = $_SESSION['debut'];
  $_SESSION['fin'] = $_POST['date_fin'];
  $date_fin = $_SESSION['fin'];

  if (empty($date_debut) || empty($date_fin)) {
    $message = '<p class="error">Vous devez séléctionner les dates</p>';
  } else {
    header("location:../65058HGHHHggrt077prints/print_trans_per.php?date=$date_debut&&fin=$date_fin");
  }
}
?>
<?php
require('../admin/s/o/f/t/connexion.php');

if (isset($_POST['submit_tresor'])) {
  $date = $_POST['date_extract'];
  $tresor = $_POST['compte_tresor'];

  if (empty($date) || empty($tresor)) {
    $message = '<p class="error">Vous devez séléctionner une date et un compte</p>';
  } else {
    header("location:../65058HGHHHggrt077prints/print_tres_quot.php?date=$date&tresor=$tresor");
  }
}

if (isset($_POST['cmd_period'])) {
  $date_debut = $_POST['date_debut'];
  $date_fin = $_POST['date_fin'];
  $tresor = $_POST['compte_tresor'];

  if (empty($date_debut) || empty($date_fin) || empty($tresor)) {
    $message = '<p class="error">Toutes les sélections sont requises</p>';
  } else {
    header("location:../65058HGHHHggrt077prints/print_tres_perd.php?debut=$date_debut&fin=$date_fin&tresor=$tresor");
  }
}

if (isset($_POST['submit_tresorsold'])) {
  $date = $_POST['date_extract'];
  $tresor = $_POST['compte_tresor'];

  if (empty($date) || empty($tresor)) {
    $message = '<p class="error">Vous devez séléctionner une date et un compte</p>';
  } else {
    header("location:../65058HGHHHggrt077prints/tresorerie-solde.php?date=$date&tresor=$tresor");
  }
}
?>

<!-- Modal création de compte -->
<div class="modal" id="form_select" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color:black!important"><i class="fa fa-user"></i> Création cadre des Comptes</h5>
        </div>
      </div>
      <div class="modal-body" style="margin-left: 130px">
        <div class="inner-box">
          <div class="content-box"> </div>
        </div>
        <div class="row clearfix center">
          <div class="col-lg-12 col-md-12 col-sm-12 form-group">
            <a href="list_pers.php" class="btn btn-primary but" style="background-color: #304c79">Comptes_Personnel</a>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 form-group">
            <a href="list_tresor.php" class="btn btn-primary but" style="background-color: #304c79">Comptes_Trésorerie</a>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 form-group">
            <a href="liste_tiers.php" class="btn btn-primary but" style="background-color: #304c79">Comptes_Tiers &nbsp;&nbsp;&nbsp;&nbsp;</a>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 form-group">
            <a href="list_autre.php" class="btn btn-primary but" style="background-color: #304c79">Lexique_comptes</a>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-danger" onclick="closecrecompte()" style="background-color: red">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal création de compte -->

<!-- Modal pour FICHE RECAPITUALTIVE DE PAIE  -->
<div class="modal" id="form_recap" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color:black!important">FICHE RECAPITUALTIVE DE PAIE </h5>
        </div>
      </div>
      <div class="modal-body" style="width: 700px">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <form method="GET" action="recaptot.php" target="_blink">
          <div class="row w-100">
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <label class="control-label" for="section">Période:</label>
              <select name="periode" id="section" class="form-control">
                <option>Veuillez selectionnez svp?</option>
                <?php liste_annee(); ?>
              </select>
            </fieldset>
            <fieldset class="col-lg-5 col-md-5 col-sm-12 p-4">
              <button type="submit" class="btn btn-primary mt-2 col-md-5" tabindex="170" style="background-color: #304c79">Afficher</button>
            </fieldset>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="closerecap()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal FICHE RECAPITUALTIVE DE PAIE  -->

<!-- Modal pour Impression de fiche de paie en groupe -->
<div class="modal" id="form_fiche" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color:black!important">FICHE DE PAIE EN GROUP </h5>
        </div>
      </div>
      <div class="modal-body" style="width: 700px">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <form method="GET" action="fichepaie_gr.php" target="_blink">
          <div class="row w-100">
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <label class="control-label" for="depart">Département :</label>
              <select name="depart" id="depart" class="form-control">
                <option>Veuillez selectionnez svp?</option>
                <?php liste_Depart(); ?>
              </select>
            </fieldset>
            <select hidden name="periode" id="periode" class="form-control"><?php listppeye_mois(); ?></select>
            <fieldset class="col-lg-5 col-md-5 col-sm-12 p-4">
              <button type="submit" class="btn btn-primary mt-2 col-md-5" tabindex="170" style="background-color: #304c79">Afficher</button>
            </fieldset>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="closefiche()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal Impression de fiche de paie en groupe -->

<!-- Modal pour liste de transaction par jour -->
<div class="modal" id="form_transact" tabindex="-1" role="dialog" aria-hidden="true" target="_blink" style="box-shadow: 0px 2px 8px 0px black">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color:black!important">SÉLECTIONEZ LA DATE</h5>
        </div>
      </div>
      <div class="modal-body" style="margin-left: 70px">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <form method="POST" target="_blink">
          <div class="row w-100">
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <label class="control-label" for="option"></label>
              <input type="date" name="date_extra" autocomplete="on" class="form-control" tabindex="10" onfocus="this.value=''" />
            </fieldset>
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <button type="submit" name="submit_form" class="btn btn-primary col-sm-6 mt-2" target='_blink' tabindex="170" style="background-color: #304c79">Afficher</button>
            </fieldset>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="closetransact()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal liste de transaction par jour -->

<!-- Modal pour liste de transaction par periode -->
<div class="modal" id="form_Periodique" tabindex="-1" role="dialog" aria-hidden="true" target="_blink" style="box-shadow: 0px 2px 8px 0px black">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color:black!important">SÉLECTIONEZ UNE PERIODE</h5>
        </div>
      </div>
      <div class="modal-body" style="margin-left: 0px">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <form method="POST" target="_blink">
          <div class="row w-100">
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="option"></label>
              <input type="date" name="date_debut" placeholder="Filtrer par Date_doc" autocomplete="on" required class="form-control col-sm-12" tabindex="10" onfocus="this.value=''" />
            </fieldset>
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="option"></label>
              <input type="date" name="date_fin" placeholder="Filtrer par Date_doc" autocomplete="on" required class="form-control col-sm-12" tabindex="10" onfocus="this.value=''" />
            </fieldset>
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <button type="submit" name="submit_period" class="btn btn-primary col-sm-12 mt-2" tabindex="170" style="background-color: #304c79">Afficher</button>
            </fieldset>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="closePeriodique()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal liste de transaction par periode -->

<!-- Modal pour liste de tresorerie quotidienne -->
<div class="modal" id="form_tresorquotid" tabindex="-1" role="dialog" aria-hidden="true" target="_blink">
  <div role="document">
    <div class="modal-content" style="width: 650px;margin-left: 35%">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color:black!important">SÉLECTIONEZ LA DATE</h5>
        </div>
      </div>
      <div class="modal-body">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <form method="POST" target="_blink" style="width: 600px">
          <div class="row w-100">
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="option"></label>
              <input type="date" name="date_extract" placeholder="Filtrer par Date_doc" autocomplete="on" required class="form-control col-sm-12" tabindex="10" onfocus="this.value=''" />
            </fieldset>
            <fieldset class="col-lg-5 col-md-5 col-sm-12 mt-2">
              <select name="compte_tresor" class="form-control col-sm-12" required>
                <option value="0">Compte Tresorerie</option>
                <?php $result = $bd->query("SELECT * FROM compta_tresor") ?>
                <?php while ($row = $result->fetch_array()) : ?>
                  <option value="<?= $row['compte'] . '_' . $row['description'] ?>"><?= $row['compte'] . '_' . $row['description'] ?></option>
                <?php endwhile ?>
              </select>
            </fieldset>
            <fieldset class="col-lg-3 col-md-3 col-sm-12 mt-2">
              <button type="submit" name="submit_tresor" class="btn btn-primary col-sm-12" tabindex="170" style="background-color: #304c79">Affichez</button>
            </fieldset>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="closetresord()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal liste de tresorerie quotidienne -->

<!-- Modal pour liste de transaction -->
<div class="modal" id="form_Period_tresor" tabindex="-1" role="dialog" aria-hidden="true" target="_blink">
  <div role="document">
    <div class="modal-content" style="width: 670px;margin-left: 35%">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color:black!important">SÉLECTIONEZ UNE PERIODE</h5>
        </div>
      </div>
      <div class="modal-body">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <form method="POST" action="" style="width: 650px" target="_blink">
          <div class="row w-100">
            <fieldset class="col-lg-3 col-md-3 col-sm-12">
              <input type="date" name="date_debut" required placeholder="Filtrer par Date_doc" autocomplete="on" required class="form-control" tabindex="10" onfocus="this.value=''" />
            </fieldset>
            <fieldset class="col-lg-3 col-md-3 col-sm-12">
              <input type="date" name="date_fin" required placeholder="Filtrer par Date_doc" autocomplete="on" required class="form-control" tabindex="10" onfocus="this.value=''" />
            </fieldset>
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <select name="compte_tresor" class="form-control" required>
                <option value="0">Compte Tresorerie</option>
                <?php $result = $bd->query("SELECT * FROM compta_tresor") ?>
                <?php while ($row = $result->fetch_array()) : ?>
                  <option value="<?= $row['compte'] . '_' . $row['description'] ?>"><?= $row['compte'] . '_' . $row['description'] ?></option>
                <?php endwhile ?>
              </select>
            </fieldset>
            <fieldset class="col-lg-3 col-md-3 col-sm-12 mt-2"></fieldset>
            <fieldset class="col-lg-6 col-md-6 col-sm-12 mt-4">
              <button type="submit" name="cmd_period" class="btn btn-primary col-sm-6" tabindex="170" style="background-color: #304c79">Afficher</button>
            </fieldset>
            <fieldset class="col-lg-3 col-md-3 col-sm-12"></fieldset>
          </div>
        </form>
        <?php if (isset($message)) {
          echo $message;
        } ?>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="closePeriod_tresor()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal liste de transaction -->

<!-- Modal pour liste de tresorerie_Solde quotidienne -->
<div class="modal" id="form_tresorquotidSold" tabindex="-1" role="dialog" aria-hidden="true" target="_blink">
  <div role="document">
    <div class="modal-content" style="width: 650px;margin-left: 35%">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color:black!important">SÉLECTIONEZ LA DATE</h5>
        </div>
      </div>
      <div class="modal-body">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <form method="POST" target="_blink" style="width: 600px">
          <div class="row w-100">
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="option"></label>
              <input type="date" name="date_extract" placeholder="Filtrer par Date_doc" autocomplete="on" required class="form-control col-sm-12" tabindex="10" onfocus="this.value=''" />
            </fieldset>
            <fieldset class="col-lg-5 col-md-5 col-sm-12 mt-2">
              <select name="compte_tresor" class="form-control col-sm-12" required>
                <option value="0">Compte Tresorerie</option>
                <?php $result = $bd->query("SELECT * FROM compta_tresor") ?>
                <?php while ($row = $result->fetch_array()) : ?>
                  <option value="<?= $row['compte'] . '_' . $row['description'] ?>"><?= $row['compte'].'_'.$row['description'] ?></option>
                <?php endwhile ?>
              </select>
            </fieldset>
            <fieldset class="col-lg-3 col-md-3 col-sm-12 mt-2">
              <button type="submit" name="submit_tresorsold" class="btn btn-primary col-sm-12" tabindex="170" style="background-color: #304c79">Affichez</button>
            </fieldset>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="closetresorSold()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal liste de tresorerie_Solde quotidienne -->

<!------------ Balance de compte ---------------->
<!-- Modal pour Balance de compte par classe -->
<div class="modal" id="form_balanceclasse" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color:black!important">BALANCE DE COMPTE PAR CLASSE</h5>
        </div>
      </div>
      <div class="modal-body" style="width: 700px">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <form method="GET" action="balanceparclasse.php" target="_blink">
          <div class="row w-100">
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="section">Par_classe :</label>
              <select name="Classe" id="section" class="form-control">
                <option>Selectionnez svp?</option>
                <option value="1">classe_1</option>
                <option value="2">classe_2</option>
                <option value="3">classe_3</option>
                <option value="4">classe_4</option>
                <option value="5">classe_5</option>
                <option value="6">classe_6</option>
                <option value="7">classe_7</option>
              </select>
            </fieldset>
            <fieldset class="col-lg-5 col-md-5 col-sm-12 p-4">
              <button type="submit" class="btn btn-primary mt-2 col-md-5" tabindex="170" style="background-color: #304c79">Afficher</button>
            </fieldset>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="closebalanceparclasse()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal Balance de compte par classe -->

<!-- Modal pour Balance de compte par groupe -->
<div class="modal" id="form_balancegroupe" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color:black!important">BALANCE DE COMPTE PAR GROUPE</h5>
        </div>
      </div>
      <div class="modal-body" style="width: 700px">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <form method="GET" action="balancepargroupe.php" target="_blink">
          <div class="row w-100">
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="section">Par_groupe :</label>
              <select name="Groupe" id="section" class="form-control">
                <option>Selectionnez svp?</option>
                <?php liste_balancegroupe(); ?>
              </select>
            </fieldset>
            <fieldset class="col-lg-5 col-md-5 col-sm-12 p-4">
              <button type="submit" class="btn btn-primary mt-2 col-md-5" tabindex="170" style="background-color: #304c79">Afficher</button>
            </fieldset>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="closebalancepargroupe()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal Balance de compte par groupe -->

<!-- Modal pour Balance de compte par groupe -->
<div class="modal" id="form_balanceGlobal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color:black!important">BALANCE GLOBAL PAR CLASSE</h5>
        </div>
      </div>
      <div class="modal-body" style="width: 700px">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <form method="GET" action="global_classe.php" target="_blink">
          <div class="row w-100">
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="section">Par_groupe :</label>
              <select name="Groupe" id="section" class="form-control">
                <option>Selectionnez svp?</option>
                <?php liste_balancegroupe(); ?>
              </select>
            </fieldset>
            <fieldset class="col-lg-5 col-md-5 col-sm-12 p-4">
              <button type="submit" class="btn btn-primary mt-2 col-md-5" tabindex="170" style="background-color: #304c79">Afficher</button>
            </fieldset>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="closebalanceglobal()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal Balance de compte par groupe -->