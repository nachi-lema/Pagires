  <!--- Partie entête ---->
  <?php 
    require_once '../includes/Globals_function.php';
    include_once("../includes/_header.php") ;
    include("../includes/modal.php");
  ?>

  <div class="main-content">
    <section class="section">
      <div class="section-body">
        <?php new_autres();edit_autre();delete_autres(); ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="">Gestion Comptable</h4>
                <a href="list_autre.php" class="btn btn-primary" style="background-color: #44597b">Actualiser<i></i></a>
                <a href="javascript:void(0)" onclick="openComptAutre()" class="btn btn-primary" style="background-color: #304c79">Ajouter</a>
                <a href="javascript:void(0)" onclick="opnenupdateAutre();" class="btn btn-primary" style="background-color: #304c79">Mise à jour</a>
                <a href="javascript:void(0)" onclick="opnenSupAutre()" class="btn btn-primary" style="background-color: red">Supprimer</a>
              </div>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="p-3">
                    <form method="GET" action="list_autre.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                      <div class="input-group">
                        <input type="search" name="compte" required placeholder="Filtrer par Compte" autocomplete="on" required class="form-control" tabindex="10" style="color: #575757;" onfocus="this.value=''" />
                        <div class="input-group-btn m-0 p-0">
                          <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check"></i></button>
                        </div>
                      </div>
                    </form>
                    <form method="GET" action="list_autre.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                      <div class="input-group">
                        <input type="search" name="description_autre" required placeholder="Filtrer par Description" autocomplete="on" required class="form-control" tabindex="10" style="color: #575757;" onfocus="this.value=''" />
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
      <!--- Partie Affichage des Autre --->
      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <?php cpt_autres(); ?>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-hover" id='table-r' style="width:100%;">
                    <thead>
                      <tr>
                        <th>Compte </th>
                        <th>Description</th>
                        <th>Solde1_cdf </th>
                        <th>Solde1_usd</th>
                        <th>Credit1_usd</th>
                        <th>Credit1_cdf</th>
                        <th>Debit1_usd</th>
                        <th>Debit1_cdf</th>
                        <th>Solde2_cdf</th>
                        <th>Solde2_usd</th>
                        <th>Controleur</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php liste_autres(); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--- Fin Partie Affichage des Autre --->
    </section>
  </div>
</div>

<?php require '../includes/_footer.php'; ?>

<!-- Modal Compte autre -->
<div class="modal" id="form_CptAutres" tabindex="-1" aria-hidden="true" style="width: auto;margin-left: 400px;height: auto!important;overflow:auto!important;margin-top: 30px;box-shadow: 0px 2px 8px 0px black">
  <div class="" role="document">
    <div class="modal-content" style="background-color: #e7eaeb">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color: #fff"><i class="fa fa-user"></i>&nbsp;CRÉATION_LEXIQUE_COMPTES</h5>
        </div>
      </div>
      <div class="modal-body">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <!--Formulaires compte autre -->
        <form method="post">
          <div class="row w-100">
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="compte_autre">N° compte:</label>
              <input type="text" class="form-control" name="compte_autre" placeholder="N° de compte">
            </fieldset>
            <fieldset class="col-lg-8 col-md-8 col-sm-12">
              <label class="control-label" for="description_autre">Description:</label>
              <input type="text" class="form-control" placeholder="Description" name="description_autre" placeholder="">
            </fieldset>
          </div><br>
          <div class="row w-100">
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <label class="control-label" for="solde1_cdf">Report_CDF :</label>
              <input type="text" class="form-control" name="solde1_cdf" value="0" placeholder="">
            </fieldset>
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <label class="control-label" for="solde1_usd">Report_USD :</label>
              <input type="text" class="form-control" name="solde1_usd" value="0" placeholder="">
            </fieldset>
          </div><br>
          <div class="row w-100">
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <input type="hidden" class="form-control" name="solde2_cdf" value="0" placeholder="">
            </fieldset>
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <input type="hidden" class="form-control" name="solde2_usd" value="0" placeholder="">
              <input type="hidden" name="statut_autre" value="Actif">
            </fieldset>

          </div><br>
          <button type="submit" name="cmd_autrs" class="btn btn-primary mt-2 col-lg-12 col-md-12 col-sm-12" tabindex="170" style="background-color: #304c79">Sauvegarder</button>
        </form>
        <!--Formulaires compte autre-->
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-danger" onclick="closeComptAutre()" style="background-color: red">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal Compte autre -->

<!-- Modal UPDATE Tiers -->
<div class="modal" id="form_updateAutre" tabindex="-1" role="dialog" aria-hidden="true" style="height:530px!important;overflow:auto!important; margin-bottom: 10px!important;width: 750px;margin-left: 400px;margin-top: 22px;box-shadow: 0px 2px 8px 0px black">
  <div>
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel">Mise à Jour Autre compte</h5>
        </div>
      </div>
      <div class="modal-body">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <!--Formulaires des acces admin-->
        <form method="post" style="width: 700px">
          <?php update_autre() ?>
        </form>
        <!--Formulaires des acces admin-->
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-danger" onclick="closeupdateAutre()" style="background-color: red">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!--Fin Modal UPDATE Tiers -->

<!-- Modal DELETE Tiers -->
<div class="modal" id="form_supAutre" tabindex="-1" role="dialog" aria-hidden="true">
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
          <h5 class="modal-title">Voulez-vous supprimer cette Compte ?</h5>
          <button type="submit" name="cmd_delautres" class="btn btn-primary col-sm-3" style="background-color: #304c79">OUI</button>&nbsp;<button type="button" class="btn btn-danger col-sm-3" onclick="closeSupAutre()" style="background-color: red">NON</button>
        </form>
        <!--Formulaires des acces admin-->
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="closeSupAutre()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal DELETE Tiers -->

<script type="text/javascript">
  function openComptAutre() {
    document.getElementById('form_CptAutres').style.display = "block";
  }

  function closeComptAutre() {
    document.getElementById('form_CptAutres').style.display = "none";
  }
</script>
<script type="text/javascript">
  function opnenupdateAutre() {
    document.getElementById('form_updateAutre').style.display = "block";
  }

  function closeupdateAutre() {
    document.getElementById('form_updateAutre').style.display = "none";
  }
</script>
<script type="text/javascript">
  function opnenSupAutre() {
    document.getElementById('form_supAutre').style.display = "block";
  }

  function closeSupAutre() {
    document.getElementById('form_supAutre').style.display = "none";
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