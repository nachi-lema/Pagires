<?php 
  require_once '../includes/Globals_function.php';
  include_once("../includes/_header.php");
?>

      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="">Recapitulatif_Stocks</h4>
                    <a href="recap_stock.php" class="btn btn-info"><i class="fa fa-spinner"></i> Actualiser </a>
                  </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="p-3">
                        <form method="GET" action="recap_stock.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                          <div class="input-group">
                            <select type="search" name="categorie" placeholder="Filtrer par Catégorie" autocomplete="on" required class="form-control">
                              <option value="">Filtrer par Categorie</option>
                              <?php liste_comboclasse(); ?>
                            </select>
                            <div class="input-group-btn m-0 p-0">
                              <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check" ></i></button> 
                            </div>
                          </div>   
                        </form>
                        <form method="GET" action="recap_stock.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                          <div class="input-group">
                            <input type="search" name="article" placeholder="Filtrer par Article" autocomplete="on" required class="form-control"  tabindex="10" style="color: #575757;" onfocus="this.value=''" />
                              <div class="input-group-btn m-0 p-0">
                                <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check"></i></button> 
                              </div>
                          </div>   
                        </form>
                        <form method="GET" action="recap_stock.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                          <div class="input-group">
                            <input type="date" name="Date_stock" placeholder="Filtrer par Date" autocomplete="on" required class="form-control"  tabindex="10" style="color: #575757;" onfocus="this.value=''" />
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
          <!--- Partie Affichage des élèves --->
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <?php //compteur_stock(); ?>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id='table-r' style="width:100%;">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Ref_article</th>
                            <th>Catégorie</th>
                            <th>Article</th>
                            <th>Unité_stock</th>
                            <th>Qte_stock</th>
                            <th>Prix unitaire</th>
                            <th>Date_stock</th>
                          </tr>
                        </thead>
                        <tbody><?php impress_stocks(); ?></tbody>
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

    <?php include('../includes/_footer.php'); ?>

    <script>
      $(document).on('click', '.add_staff', function(){
        $('#staff-add-form').modal('show');
      });
      (function($) {
       
        var table = $('#example5').DataTable({
          searching: false,
          paging:true,
          select: false,
          //info: false,
          lengthChange:false 
          
        });
        $('#example tbody').on('click', 'tr', function () {
          var data = table.row( this ).data();

        });
      })(jQuery);
    </script>
    <script> 
      $(document).on('click', '.edit_staff', function(){
        $('#staff-edit-form').modal('show');
      });
      (function($) {
       
        var table = $('#example5').DataTable({
          searching: false,
          paging:true,
          select: false,
          //info: false, 
          lengthChange:false 
          
        });
        $('#example tbody').on('click', 'tr', function () {
          var data = table.row( this ).data();
          
        });
         
      })(jQuery);
    </script>
    <script type="text/javascript">
      function opnenSupArticle() {
        document.getElementById('form_supArticle').style.display = "block";
      }

      function closeSupArticle() {
        document.getElementById('form_supArticle').style.display = "none";
      }
    </script>
