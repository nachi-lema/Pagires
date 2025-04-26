  <!--- Partie entête ---->
  <?php 
    require_once '../includes/Globals_function.php';
    include_once("../includes/_header.php") ;
    include("../includes/modal.php");
  ?>

<div class="main-content">
  <section class="section">
    <div class="section-body">
      <?php new_tiers();edit_tier();delete_tier(); ?>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="">Gestion des Tiers</h4>
              <a href="liste_tiers.php" class="btn btn-primary" style="background-color: #44597b">Actualiser<i></i></a>
              <a href="javascript:void(0)" onclick="openComptTiers()" class="btn btn-primary" style="background-color: #304c79">Ajouter</a>
              <a href="javascript:void(0)" onclick="opnenupdateTiers();" class="btn btn-primary" style="background-color: #304c79">Mise à jour</a>
              <a href="javascript:void(0)" onclick="opnenSupTier()" class="btn btn-primary" style="background-color: red">Supprimer</a>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="p-3">
                  <form method="GET" action="liste_tiers.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                    <div class="input-group">
                      <input type="search" name="compte" required placeholder="Filtrer par Compte" autocomplete="on" required class="form-control" tabindex="10" style="color: #575757;" onfocus="this.value=''" />
                      <div class="input-group-btn m-0 p-0">
                        <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check"></i></button>
                      </div>
                    </div>
                  </form>
                  <form method="GET" action="liste_tiers.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                    <div class="input-group">
                      <input type="search" name="description" required placeholder="Filtrer par Description" autocomplete="on" required class="form-control" tabindex="10" style="color: #575757;" onfocus="this.value=''" />
                      <div class="input-group-btn m-0 p-0">
                        <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--- Partie Affichage des Tiers --->
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <?php cpt_tier(); ?>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id='table-r' style="width:100%;">
                  <thead>
                    <tr>
                      <th>Compte </th>
                      <th>Description</th>
                      <th>Solde1 cdf</th>
                      <th>Solde1 usd</th>
                      <th>Credit1 usd</th>
                      <th>Credit1 cdf</th>
                      <th>Statut</th>
                      <th>Controleur</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php liste_tiers(); ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--- Fin Partie Affichage des Tiers --->
  </section>
</div>
</div>

<?php require '../includes/_footer.php'; ?>

<!-- Modal Compte Tiers -->
<div class="modal" id="form_CptTiers" tabindex="-1" aria-hidden="true" style="width: 35%;margin-left: 400px;height: auto!important;overflow:auto!important;margin-top: 30px;box-shadow: 0px 2px 8px 0px black">
  <div>
    <div class="modal-content" style="background-color: #e7eaeb">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color: #fff"><i class="fa fa-user"></i>&nbsp;Formulaire d'Inscription Tiers</h5>
        </div>
      </div>
      <div class="modal-body">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <!--Formulaires des acces admin-->
        <form method="post">
          <div class="row w-100">
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="compte_tier">Compte:</label>
              <input type="text" class="form-control" name="compte_tier" placeholder="compte_tiers">
            </fieldset>
            <fieldset class="col-lg-8 col-md-8 col-sm-12">
              <label class="control-label" for="description_tier">Description:</label>
              <input type="text" class="form-control" name="description_tier" placeholder="Description">
            </fieldset>
            <fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mt-2">
              <label class="control-label" for="solde1_cdf">Report CDF:</label>
              <input type="text" class="form-control" name="solde1_cdf" value="0" placeholder="report solde cdf">
            </fieldset>
            <fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mt-2">
              <label class="control-label" for="solde1_usd">Report USD:</label>
              <input type="text" class="form-control" name="usd" value="0" placeholder="report solde usd">
            </fieldset>
            <fieldset class="col-lg-6 col-md-6 col-sm-12 p-2">
              <input type="hidden" class="form-control" name="solde2_cdf" value="0" placeholder="report solde2 cdf">
            </fieldset>
            <fieldset class="col-lg-6 col-md-6 col-sm-12 p-2">
              <input type="hidden" class="form-control" name="solde2_usd" value="0" placeholder="report solde2 usd">
              <input type="hidden" name="statut_tiers" value="Actif">
            </fieldset>
          </div>
          <br>
          <button type="submit" name="cmd_tiers" class="btn btn-primary mt-2 col-lg-12 col-md-12 col-sm-12" tabindex="170" style="background-color: #304c79">Sauvegarder</button>
        </form>
        <!--Formulaires des acces admin-->
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-danger" onclick="closeComptTiers()" style="background-color: red">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal Compte Tiers -->

<!-- Modal UPDATE Tiers -->
<div class="modal" id="form_updateTiers" tabindex="-1" role="dialog" aria-hidden="true" style="height:510px!important;overflow:auto!important; margin-bottom: 10px!important;width: 750px;margin-left: 400px;margin-top: 22px;box-shadow: 0px 2px 8px 0px black">
  <div>
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel">Mise à Jour Compte Tiers</h5>
        </div>
      </div>
      <div class="modal-body">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <!--Formulaires des acces admin-->
        <form method="post" style="width: 700px">
          <?php update_tiers() ?>
        </form>
        <!--Formulaires des acces admin-->
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-danger" onclick="closeupdateTiers()" style="background-color: red">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!--Fin Modal UPDATE Tiers -->

<!-- Modal DELETE Tiers -->
<div class="modal" id="form_supTier" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        </div>
      </div>
      <div class="modal-body">
        <div class="inner-box">
          <div class="content-box">
          </div>
        </div>
        <!--Formulaires des acces admin-->
        <form method="post">
          <h5 class="modal-title">Voulez-vous supprimer cette compte tiers?</h5>
          <button type="submit" name="cmd_delTier" class="btn btn-primary col-sm-3" style="background-color: #304c79">OUI</button>&nbsp;<button type="button" class="btn btn-danger col-sm-3" onclick="closeSupTier()" style="background-color: red">NON</button>
        </form>
        <!--Formulaires des acces admin-->
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="closeSupTier()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal DELETE Tiers -->

<script type="text/javascript">
  function openComptTiers() {
    document.getElementById('form_CptTiers').style.display = "block";
  }

  function closeComptTiers() {
    document.getElementById('form_CptTiers').style.display = "none";
  }
</script>
<script type="text/javascript">
  function opnenupdateTiers() {
    document.getElementById('form_updateTiers').style.display = "block";
  }

  function closeupdateTiers() {
    document.getElementById('form_updateTiers').style.display = "none";
  }
</script>
<script type="text/javascript">
  function opnenSupTier() {
    document.getElementById('form_supTier').style.display = "block";
  }

  function closeSupTier() {
    document.getElementById('form_supTier').style.display = "none";
  }
</script>

<script type="text/javascript">
  function visibility(thingId) {
    var targetElement;
    targetElement = document.getElementById(thingId);
    if (targetElement.style.display == "none") {
      targetElement.style.display = "";
    } else {
      targetElement.style.display = "none";
    }
  }
</script>
<script>
  // Catégorie 
  $('#ArchivgroupeG').on('change', function() {
    var groupe = this.value;
    $.ajax({
      url: 'auto_script/listing_classeArchiv.php',
      type: "POST",
      data: {
        cat_data: groupe
      },
      success: function(result) {
        $('#Archivcompte_eleveG').html(result);
      }
    })
  });
</script>