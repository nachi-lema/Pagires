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
                    <h4 class="">Liste_ventes cash</h4>
                    <a href="listevente_cash.php" class="btn btn-info"><i class="fa fa-spinner"></i> Actualiser</a>
                  </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="p-3">
                        <form method="GET" action="listevente_cash.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
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
                        <form method="GET" action="listevente_cash.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                          <div class="input-group">
                            <input type="search" name="article" placeholder="Filtrer par Article" autocomplete="on" required class="form-control"  tabindex="10" style="color: #575757;" onfocus="this.value=''" />
                              <div class="input-group-btn m-0 p-0">
                                <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check"></i></button> 
                              </div>
                          </div>   
                        </form>
                        <form method="GET" action="listevente_cash.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
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
                    <?php //compteur_Vente(); ?>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id='table-r' style="width:100%;">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Nature</th>
                            <th>Ref_article</th>
                            <th>Catégorie</th>
                            <th>Article</th>
                            <th>Unité_vente</th>
                            <th>Qte_vente</th>
                            <th>Prix_unitaire</th>
                            <th>Total</th>
                            <th>Date_vente</th>
                            <th>User</th>
                          </tr>
                        </thead>
                        <tbody><?php lest_ventecash(); ?></tbody>
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