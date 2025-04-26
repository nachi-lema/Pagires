    <!--- Partie entête ---->
  <?php 
    require_once '../includes/Globals_function.php';
    include_once("../includes/_header.php") ;
    include("../includes/modal.php");
  ?>
  <div class="main-content">
    <section class="section">
      <div class="section-body">
        <?php new_tresor();edit_tresor() //delete_Tresorerie(); ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="">Gestion des Trésoreries</h4>
                <a href="list_tresor.php" class="btn btn-primary" style="background-color: #44597b">Actualiser<i></i></a>
                <a href="javascript:void(0)" onclick="openComptTresor()" class="btn btn-primary" style="background-color: #304c79">Ajouter</a>
                <a href="javascript:void(0)" onclick="opnenupdateTresor();" class="btn btn-primary" style="background-color: #304c79">Mise à jour</a>
              </div>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="p-3">
                    <form method="GET" action="list_tresor.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                      <div class="input-group">
                        <input type="search" name="compte" required placeholder="Filtrer par Compte" autocomplete="on" required class="form-control" tabindex="10" style="color: #575757;" onfocus="this.value=''" />
                        <div class="input-group-btn m-0 p-0">
                          <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check"></i></button>
                        </div>
                      </div>
                    </form>
                    <form method="GET" action="list_tresor.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                      <div class="input-group">
                        <input type="search" name="reference" required placeholder="Filtrer par Reference" autocomplete="on" required class="form-control" tabindex="10" style="color: #575757;" onfocus="this.value=''" />
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
      <!--- Partie Affichage des Tresorerie --->
      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <?php compteur_tresor(); ?>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-hover" id='table-r' style="width:100%;">
                    <thead>
                      <tr>
                        <th>Compte </th>
                        <th>Description</th>
                        <th>Référence </th>
                        <th>Solde1 cdf</th>
                        <th>Solde1 usd</th>
                        <th>Crédit1 usd</th>
                        <th>Crédit1 cdf</th>
                        <th>Debit1 cdf</th>
                        <th>Debit1 usd</th>
                        <th>Statut</th>
                        <th>Controleur</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php liste_tresor();  ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--- Fin Partie Affichage des Tresorerie --->
    </section>
  </div>
</div>

<?php require '../includes/_footer.php'; ?>

<!-- Modal Compte Eleve -->
<div class="modal" id="form_CptTresor" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: #e7eaeb">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color: #fff"><i class="fa fa-user"></i>&nbsp;Création Compte Trésorerie</h5>
        </div>
      </div>
      <div class="modal-body">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <!--Formulaires des acces admin-->
        <form method="post" style="height:340px!important;overflow:auto!important; margin-bottom: 10px!important;">
          <div class="row w-100">
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <label class="control-label" for="compte">Compte:</label>
              <input type="text" class="form-control" name="compte_tresor" placeholder="Numero compte_tresor">
            </fieldset>
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <label class="control-label" for="reference">Référence:</label>
              <input type="text" class="form-control" name="reference_tresor" placeholder="N° Référence">
            </fieldset><br><br><br>
            <fieldset class="col-lg-12 col-md-12 col-sm-12">
              <label class="control-label" for="description">Description:</label>
              <input type="text" class="form-control" name="description_tresor" placeholder="Description">
            </fieldset>
          </div><br>
          <div class="row w-100">
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <label class="control-label" for="credit1_usd">Report CDF :</label>
              <input type="text" class="form-control" name="scdf" value="0" placeholder="report credit usd">
            </fieldset>
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <label class="control-label" for="credit1_usd">Report USD :</label>
              <input type="text" class="form-control" name="solde1_usd" value="0" placeholder="report credit usd">
            </fieldset>
          </div><br>
          <div class="row w-100">
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <input type="hidden" class="form-control" name="solde2_usd" value="0" placeholder="report solde usd">
              <input type="hidden" name="statut_tresor" value="Actif">
            </fieldset>
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <input type="hidden" class="form-control" name="cdf" value="0" placeholder="report solde cdf">
            </fieldset>
          </div><br>
          <br>
          <button type="submit" name="cmd_tresor" class="btn btn-warning col-sm-12" tabindex="170" style="background-color: #304c79">Sauvegarder</button>
        </form>
        <!--Formulaires des acces admin-->
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-danger" onclick="closeComptTresor()" style="background-color: red">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal Compte Eleve -->

<!-- Modal UPDATE Personnel -->
<div class="modal" id="form_updateTresor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel">Mise à Jour Trésorerie</h5>
        </div>
      </div>
      <div class="modal-body">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <!--Formulaires des acces admin-->
        <form method="post" style="height:450px!important;overflow:auto!important; margin-bottom: 10px!important">
          <?php update_tresor() ?>
        </form>
        <!--Formulaires des acces admin-->
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-danger" onclick="closeupdateTresor()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!--Fin Modal UPDATE Personnel -->

<!-- Modal DELETE Personnel -->
<div class="modal" id="form_supTresor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        </div>
      </div>
      <div class="modal-body">
        <div class="inner-box">
          <div class="content-box"> </div>
        </div>
        <!--Formulaires des acces admin-->
        <form method="post">
          <h5 class="modal-title">Voulez-vous supprimer cet Compte?</h5>
          <button type="submit" name="cmd_delTresor" class="btn btn-primary col-sm-3" style="background-color: #304c79">OUI</button>&nbsp;<button type="button" class="btn btn-danger col-sm-3" style="background-color: red" onclick="closeSupTresor()">NON</button>
        </form>
        <!--Formulaires des acces admin-->
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="closeSupTresor()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!--Fin Modal UPDATE Personnel -->

<script type="text/javascript">
  function openComptTresor() {
    document.getElementById('form_CptTresor').style.display = "block";
  }

  function closeComptTresor() {
    document.getElementById('form_CptTresor').style.display = "none";
  }
</script>
<script type="text/javascript">
  function opnenupdateTresor() {
    document.getElementById('form_updateTresor').style.display = "block";
  }

  function closeupdateTresor() {
    document.getElementById('form_updateTresor').style.display = "none";
  }
</script>
<script type="text/javascript">
  function opnenSupTresor() {
    document.getElementById('form_supTresor').style.display = "block";
  }

  function closeSupTresor() {
    document.getElementById('form_supTresor').style.display = "none";
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