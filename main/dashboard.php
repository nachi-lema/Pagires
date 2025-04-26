
  <!--- Partie entête ---->
  <?php 
    require_once '../includes/Globals_function.php';
    include_once("../includes/_header.php") ;

  ?>

    <div class="main-content">
      <section class="section">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4>Tableau de Bord</h4>
              </div>

              <div class="card-body">
                <div class="row">

                  <div class="col-xl-5 col-sm-6 col-12 d-flex">
                    <div class="card bg-one w-100">
                      <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                          <img src="../assets/img/banner-img.png" alt="" sizes="" srcset="">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-5 col-sm-6 col-12 d-flex">
                    <div class="card bg-one w-100">
                      <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center" style="padding:132px">
                          <?php
                          include("../admin/s/o/f/t/connexion.php");
                          $query = "SELECT * FROM admin_tb WHERE pseudo ='$session_id'";
                          $slq = $bd->query($query);
                          if ($slq->num_rows > 0) {
                            while ($row = $slq->fetch_assoc()) {
                              $pseudo = $row['pseudo'];
                            }

                            echo '<h4 class="font-20 mb-10 text-capitalize">
                                          Bienvenue chez nous <div class="weight-600 font-30 text-blue">' . $pseudo . '</div>
                                        </h4>';
                          }
                          ?>


                        </div>
                      </div>
                    </div>
                  </div>


                </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-one w-100">
                      <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                          <div class="db-icon">
                            <i class="fas fa-users"></i>
                          </div>
                          <?php //compteur_Agents(); ?>
                          <div class="db-info">

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-one w-100">
                      <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                          <div class="db-icon">
                            <i class="fas fa-user"></i>
                          </div>
                          <div class="db-info">
                            <?php //compteur_depart(); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-one w-100">
                      <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                          <div class="db-icon">
                            <i class="fa fa-hourglass"></i>
                          </div>
                          <div class="db-info">
                            <?php //compteur_conge(); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-one w-100">
                      <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                          <div class="db-icon">
                            <i class="fas fa-sticky-note"></i>
                          </div>
                          <div class="db-info">
                            <?php //compteur_autres(); 
                            ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  </div>

  <?php include('../includes/_footer.php'); ?>