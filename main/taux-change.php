  <!--- Partie entête ---->
  <?php 
    require_once '../includes/Globals_function.php';
    include_once("../includes/_header.php") ;
    include("../includes/modal.php");
  ?>

<div class="main-content">
  <section class="section">
    <div class="section-body">
      <?php tauchange();destauxchange(); ?>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="">Taux de change </h4>
              <a href="taux-change.php" class="btn btn-primary" style="background-color: #44597b"><i class="fa fa-spinner"></i> Actualiser </a>
              <a href="javascript:void(0)" onclick="opnentaux()" class="btn btn-primary" style="background-color: #44597b"><i class=""></i> Désactiver </a>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="p-3">
                  <form action="" method="post" id="f-pass" class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label>&nbsp;DEVISE:</label>
                      <input class="form-control" type="text" name="devise" readonly placeholder="CDF">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label>&nbsp;TAUX: USD-CDF</label>
                      <input class="form-control" type="number" name="taux" value="2800" minlength="4">
                    </div>
                    <p><em msg2></em></p>
                    <div class="col-lg-3 col-md-3 col-sm-12 mt-3 p-3">
                      <button type="submit" name="cmd_devise" class="btn btn-primary col-sm-3 text-white" style="background-color: #304c79"><i class="fa fa-plus"></i> Ajouter</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--- Partie Affichage des élèves --->
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id='table-r' style="width:100%;">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>DATE</th>
                      <th>DEVISE</th>
                      <th>TAUX</th>
                      <th>STATUT </th>
                      <th>CONTROLEUR</th>
                    </tr>
                  </thead>
                  <tbody><?php listing_tauxchange(); ?></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--- Fin Partie Affichage des élèves --->
  </section>
</div>
</div>

<?php require '../includes/_footer.php'; ?>

<!-- Modal Desactication eleve -->
<div class="modal" id="form_taux" tabindex="-1" role="dialog" aria-hidden="true" style="width: 100%">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="height:150px!important;width: 700px">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel" style="color:black!important">Desactiver le taux de change?</h5>
        </div>
        <a href="javascript:void(0)" class="btn btn-danger" title="Fermer" onclick="closetaux()">X</a>
      </div>
      <div class="modal-body" style="height:auto!important">
        <form method="post" class="row w-100">
          <?php update_taux() ?>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- fin Modal Desactivation eleve -->

<script>
  $(document).on('click', '.Updatelev', function() {
    $('#form_update_elev').modal('show');
  });
  (function($) {

    var table = $('#example5').DataTable({
      searching: false,
      paging: true,
      select: false,
      //info: false,
      lengthChange: false

    });
    $('#example tbody').on('click', 'tr', function() {
      var data = table.row(this).data();

    });

  })(jQuery);
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
<script type="text/javascript">
  function opnentaux() {
    document.getElementById('form_taux').style.display = "block";
  }

  function closetaux() {
    document.getElementById('form_taux').style.display = "none";
  }
</script>