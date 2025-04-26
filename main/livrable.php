<?php 
  require_once '../includes/Globals_function.php';
  include_once("../includes/_header.php");
?>
      <div class="main-content">
        <section class="section">
          <?php new_client_autre(); ?>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header dropdown">
                    <h4 class="">Gestion_ventes </h4>
                    <a href="livrable.php" class="btn btn-info"><i class="fa fa-spinner"></i> Actualiser</a>
                  </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="p-3">
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
                      <!-- Modal Compte Appro vente -->
                      <div class="" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header" style="border:1px solid #ccc">
                              <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-shopping-bag"></i>&nbsp;LIVRABLE</h5>
                            </div>
                            <div class="modal-body">
                              <form method="POST" autocomplete="off">
                                <div class="row w-100">
                                  <fieldset class="col-lg-3 col-md-3 col-sm-12 p-2 mt-2">
                                    <label class="control-label" for="nature_operation">Nature :</label>
                                    <select name="nature" class="form-control" required tabindex="100">
                                      <option value="Credit">Credit</option>
                                    </select>
                                  </fieldset>
                                  <fieldset class="col-lg-6 col-md-6 col-sm-12 p-2 mt-2">
                                    <label class="control-label" for="nom_complet">Nom complet : </label>
                                    <input type="text" name="nom_complet" id="nom_complet" class="form-control" required tabindex="150">
                                  </fieldset>
                                   <fieldset class="col-lg-3 col-md-3 col-sm-12 p-2 mt-2">
                                    <label class="control-label" for="nature_operation">Date_doc :</label>
                                    <input type="date" name="date_doc" id="date_doc" class="form-control" required>
                                  </fieldset>
                                </div><br>
                                <div class="row w-100">
                                  <div class="col-sm-2 col-md-2"></div>
                                  <div class="col-sm-6 col-md-6">
                                    <button type="submit" name="cmd_validAutre" class="btn btn-primary mt-2 col-sm-6" tabindex="190" style="background-color: #44597b;">Enregistrer</button>
                                  </div>
                                  <div class="col-sm-4 col-md-4">
                                    <button type="reset" class="btn btn-danger mt-2 col-sm-4" tabindex="200">Annuler</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer" style="border-top: 1px solid #ccc">
                              <a href="" class="btn btn-danger col-sm-3" data-bs-dismiss="modal" name="ferme">Ferme</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Fin Modal Appro vente -->   
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

    <?php include('../includes/_footer.php'); ?>

    <script type="text/javascript">
      function openrecustock() {
        document.getElementById('form_recu').style.display = "block";
      }

      function closerecustock() {
        document.getElementById('form_recu').style.display = "none";
      }
    </script>
    <script>
      // Catégorie 
      $('#groupe').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: 'auto_script/listing_classe.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#nom_complet').html(result);
          }
        })
      });
    </script>