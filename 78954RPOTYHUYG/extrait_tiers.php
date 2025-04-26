  <!--- Partie entête ---->
  <?php 
    require_once '../includes/Globals_function.php';

    require('../admin/s/o/f/t/connexion.php');
    $compte = $_GET['compte'];
    $id_societed = $_GET['societed'];
  ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Gestion de paie || PAYROLL</title>
    <link rel="stylesheet" href="../assets/css/app.min.css">
    <link rel="stylesheet" href="../assets/bundles/prism/prism.css">
    <link rel="stylesheet" href="../assets/bundles/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/bundles/owlcarousel2/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="stylesheet" href="../assets/bundles/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="../assets/bundles/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="../assets/bundles/codemirror/theme/duotone-dark.css">
    <link rel="stylesheet" href="../assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet" href="../assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel='shortcut icon' type='image/x-icon' href="../assets/img/favicon.png" />

    <link rel="stylesheet" href="../assets/bundles/bootstrap-daterangepicker/daterangepicker.css">
    <!-- <link rel="stylesheet" href="assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css"> -->
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.min02.css"> -->
    <!-- <link rel="stylesheet" href="assets/css/style002.css"> -->
    <!-- <link rel="stylesheet" href="assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css"> -->
    <link rel="stylesheet" href="../assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="../assets/bundles/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="../assets/bundles/fullcalendar/fullcalendar.min.css" />
    <link rel="stylesheet" href="../assets/bundles/jquery-selectric/selectric.css">

    <link rel='shortcut icon' type='image/x-icon' href="../assets/img/favicon.png" />
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <style>
      .page-item.active .page-link {
        color: #fff !important;
        background-color: #ffc107 !important;
        border-color: #ffc107 !important;
      }

      .page-link {
        color: #ffc107 !important;
        background-color: #fff !important;
        border: 1px solid #dee2e6 !important;
      }

      .page-link:hover {
        color: #fff !important;
        background-color: #ffc107 !important;
        border-color: #ffc107 !important;
      }

      .db-icon {
        background-color: #304c79;
        padding: 20px;
        border-radius: 12px
      }

      .db-icon i {
        font-size: 32px;
        color: white;
      }

      .list-form-acces li a {
        color: #304c79
      }

      .main {
        width: 60%;
        margin: 0 auto;
        margin-top: 3%
      }
    </style>
  </head>
  <body>
    <div class="loader"></div>
    <div id="app">

      <div class="container" style="padding: 20px">
        <section class="section">
          <!--- Partie Affichage des utilisateurs --->
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h5 style="width: 100%;padding: 20px"><b><?php extrait_cpte_tiers_header(); ?></b></h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id='table-r' style="width: 100%">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Réf_Doc</th>
                            <th>N°_OP</th>
                            <th>Description</th>
                            <th>Debit_USD</th>
                            <th>Credit_USD</th>
                            <th>Debit_CDF</th>
                            <th>Credit_CDF</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $resultats = $bd->query(
                            'SELECT id,ref_doc,compte_debit,compte_credit,libelle,debits_usd,credits_usd,debits_cdf,credits_cdf,date_doc FROM comptes_tiers WHERE compte_credit = "'.$compte.'" AND societe="'.$id_societed.'"
                                UNION
                            SELECT id,ref_doc,compte_debit,compte_credit,libelle,debits_usd,credits_usd,debits_cdf,credits_cdf,date_doc FROM compte_od_tb WHERE compte_credit = "'.$compte.'" AND societe="'.$id_societed.'"
                            '
                          ) ?>

                          <?php while ($row = $resultats->fetch_array()) : ?>
                            <tr style="border:20px solid #000;">
                              <td class="" style="text-align: center;"><?= $row['date_doc'] ?></td>
                              <td class="" style="text-align: center;"><?= $row['ref_doc'] ?></td>
                              <td class="" style="text-align: center;"><?= $row['id'] ?></td>
                              <td class=""><?= $row['libelle'] ?></td>
                              <td class="" style="text-align: right;"><?= $row['credits_usd'] ?></td>
                              <td class="" style="text-align: right;"><?= $row['debits_usd'] ?></td>
                              <td class="" style="text-align: right;"><?= $row['credits_cdf'] ?></td>
                              <td class="" style="text-align: right;"><?= $row['debits_cdf'] ?></td>
                            </tr>
                          <?php endwhile ?>
                          <tr colspan="5">
                            <td class="" colspan="4"><strong>Totaux </strong></td>
                            <!--somme credit usd--->
                            <?php $tot_credit_usd_tiers = $bd->query('SELECT SUM(credits_usd) FROM comptes_tiers WHERE compte_credit = "'.$compte.'" AND societe="'.$id_societed.'" ') ?>
                            <?php $tot_credit_usd_CptOD = $bd->query('SELECT SUM(credits_usd) FROM compte_od_tb WHERE compte_credit = "'.$compte.'" AND societe="'.$id_societed.'" ') ?>

                            <?php $row_credit_usd_tiers = $tot_credit_usd_tiers->fetch_array() ?>
                            <?php $row_credit_usd_CptOD = $tot_credit_usd_CptOD->fetch_array() ?>
                            <td style="text-align: right;"><strong><?= number_format($row_glob2 = $row_credit_usd_tiers[0] + $row_credit_usd_CptOD[0], 2) ?></strong></td>
                            <!--fin somme debits usd--->

                            <!--somme debits usd--->
                            <?php $tot_debit_usd_tiers = $bd->query('SELECT SUM(debits_usd) FROM comptes_tiers WHERE compte_credit = "'.$compte.'" AND societe="'.$id_societed.'" ') ?>
                            <?php $row_debit_usd_tiers = $tot_debit_usd_tiers->fetch_array() ?>


                            <td class="" style="text-align: right;"><strong><?= number_format($row_glob1 = $row_debit_usd_tiers[0], 2) ?></strong></td>
                            <!--fin somme debits usd--->

                            <!--somme credit cdf--->
                            <?php $tot_credit_cdf_tiers = $bd->query('SELECT SUM(credits_cdf) FROM comptes_tiers WHERE compte_credit = "'.$compte.'" AND societe="'.$id_societed.'" ') ?>
                            <?php $tot_credit_cdf_CptOD = $bd->query('SELECT SUM(credits_cdf) FROM compte_od_tb WHERE compte_credit = "'.$compte.'" AND societe="'.$id_societed.'" ') ?>
                            <?php $row_credit_cdf_tiers = $tot_credit_cdf_tiers->fetch_array() ?>
                            <?php $row_credit_cdf_CpteOD = $tot_credit_cdf_CptOD->fetch_array() ?>


                            <td class="" style="text-align: right;"><strong><?= number_format($row_glob4 = $row_credit_cdf_tiers[0] + $row_credit_cdf_CpteOD[0], 2) ?></strong></td>
                            <!--somme credit cdf--->

                            <!--somme debits cdf--->
                            <?php $tot_debit_cdf_tiers = $bd->query('SELECT SUM(debits_cdf) FROM comptes_tiers WHERE compte_credit = "'.$compte.'" AND societe="'.$id_societed.'" ') ?>
                            <?php $row_debit_cdf_tiers = $tot_debit_cdf_tiers->fetch_array() ?>

                            <td class="" style="text-align: right;"><strong><?= number_format($row_glob3 = $row_debit_cdf_tiers[0], 2) ?></strong></td>
                            <!--fin somme debits cdf--->
                          </tr>
                          <tr>
                            <td colspan="9"></td>
                          </tr>
                          <?php
                          $req6 = "SELECT * FROM compta_tiers WHERE compte ='$compte' AND societe='$id_societed' AND statut ='Actif'";
                          $res6 = $bd->query($req6);

                          if ($res6->num_rows > 0) {
                            while ($row6 = $res6->fetch_assoc()) {
                              echo '<tr>' .
                                '<td align="left" colspan="4"><strong>REPORT</strong></td>' .
                                '<td colspan="2" style="text-align:right">' . '<strong>' . number_format($row_glob5 = $row6['usd'], 2) . '&nbsp;' . 'USD' . '</strong>' . '</td>' .
                                '<td colspan="2" style="text-align:right">' . '<strong>' . number_format($row_glob6 = $row6['solde1_cdf'], 2) . '&nbsp;' . 'CDF' . '</strong>' . '</td>' .
                                '</tr>';
                            }
                          }
                          ?>
                          <tr colspan="5"><!--somme debits usd--->
                            <td class="" colspan="4"><strong>SOLDE </strong></td>
                            <td class="tete-table" colspan="2" style="text-align: center;"><strong><?= number_format(($row_glob5 + $row_glob1) - $row_glob2, 2) ?></strong> $</td>
                            <td class="tete-table" colspan="2" style="text-align: center;"><strong><?= number_format(($row_glob6 + $row_glob3) - $row_glob4, 2) ?></strong> CDF</td>
                          </tr>
                          <tr>
                            <td align="left" colspan="9">NB : SAUF ERREUR OU OMISSION DE NOTRE PART</td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="row w-100">
                        <fieldset class="col-lg-4 col-md-4 col-sm-12">
                          <p class="lien"><a href="liste_compte_tiers.php" class="btn btn-primary" style="background-color: #44597b">Revenir à la page précédente</a></p>
                        </fieldset>
                        <fieldset class="col-lg-4 col-md-4 col-sm-12">
                          <button type="button" class="btn btn-primary" tabindex="170" style="background-color: #304c79">
                            <a href="javascript:void(0)" onclick="javascript:print()" class="text-white">
                              <i class="fa fa-print"></i> Imprimer
                            </a>
                          </button>
                        </fieldset>
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

    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/bundles/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="../assets/js/page/owl-carousel.js"></script>
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/page/multiple-upload.js"></script>
    <script src="../assets/bundles/prism/prism.js"></script>
    <script src="../assets/js/page/indexUniv.js"></script>

    <script src="../assets/bundles/fullcalendar/fullcalendar.min.js"></script>
    <script src="../assets/js/page/calendar.js"></script>

    <link rel="stylesheet" href="../assets/bundles/datatables/datatables.min.css">

    <script src="../assets/js/page/index.js"></script>
    <script src="../assets/bundles/datatables/datatables.min.js"></script>
    <script src="../assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
    <script src="../assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
    <script src="../assets/bundles/datatables/export-tables/jszip.min.js"></script>
    <script src="../assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
    <script src="../assets/bundles/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
    <script src="../assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
    <script src="../assets/js/page/datatables.js"></script>
    <script src="../assets/bundles/jquery-ui/jquery-ui.min.js"></script>
    <script src="../assets/bundles/summernote/summernote-bs4.js"></script>
    <script src="../assets/bundles/codemirror/lib/codemirror.js"></script>
    <script src="../assets/bundles/codemirror/mode/javascript/javascript.js"></script>
    <script src="../assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="../assets/bundles/ckeditor/ckeditor.js"></script>
    <script src="../assets/js/page/ckeditor.js"></script>

    <script src="../assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../assets/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="../assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

    <script type="text/javascript" src="../assets/js/daterangepicker/moment.js"></script>
    <script type="text/javascript" src="../assets/js/daterangepicker/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/js/daterangepicker/daterangepicker.css" />

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
      function html_table_to_excel(type) {
        var data = document.getElementById('table-r');

        var file = XLSX.utils.table_to_book(data, {
          sheet: "sheet1"
        });

        XLSX.write(file, {
          bookType: type,
          bookSST: true,
          type: 'base64'
        });

        XLSX.writeFile(file, 'file.' + type);
      }

      const export_button = document.getElementById('export_button');

      export_button.addEventListener('click', () => {
        html_table_to_excel('xlsx');
      });
    </script>
  </body>
</html>