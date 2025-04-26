  <!--- Partie entête ---->
  <?php 
    require_once '../includes/Globals_function.php';

    require('../admin/s/o/f/t/connexion.php');
    $num_order = $_GET['date'];
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
        width: 80%;
        margin-left: 10%;
        margin-top: 3%
      }
    </style>
  </head>
  <body>
    <div class="loader"></div>
    <div id="app">
      <div class="main">
        <section class="section">
          <!--- Partie Affichage des utilisateurs --->
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h5 style="text-align: center;width: 90%;font-size: 24px">Transactions du <?= $num_order ?></h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id='table-r' style="width: 100%">
                        <thead>
                          <tr>
                            <th style="border: 1px solid #000;font-weight: bold;">Date doc </th>
                            <th style="border: 1px solid #000;font-weight: bold;">Compte </th>
                            <th style="border: 1px solid #000;font-weight: bold;">Nom_complet </th>
                            <th style="border: 1px solid #000;font-weight: bold;">N_OP</th>
                            <th style="border: 1px solid #000;font-weight: bold;">Libelle</th>
                            <th style="border: 1px solid #000;font-weight: bold;">Taux</th>
                            <th style="border: 1px solid #000;font-weight: bold;">Entrées_USD </th>
                            <th style="border: 1px solid #000;font-weight: bold;">Sorties_USD</th>
                            <th style="border: 1px solid #000;font-weight: bold;">Entrée_CDF</th>
                            <th style="border: 1px solid #000;font-weight: bold;">Sortie_CDF</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php listing_transactiontoday(); ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="row w-100" style="padding: 21px">
                      <fieldset class="col-lg-3 col-md-3 col-sm-12">
                      </fieldset>
                      <fieldset class="col-lg-3 col-md-3 col-sm-12">
                        <p class="lien"><a href="../main/dashboard.php" class="btn btn-primary" style="background-color: #44597b">Revenir à la page précédente</a></p>
                      </fieldset>
                      <fieldset class="col-lg-3 col-md-3 col-sm-12">
                        <button id="print" class="btn btn-primary" tabindex="170" style="background-color: #304c79">
                          <i class="fa fa-print"></i> Imprimer
                        </button>
                      </fieldset>
                      <fieldset class="col-lg-3 col-md-3 col-sm-12">
                        <button type="button" id="export_button" class="btn btn-success col-sm-3" style="font-weight: bold;font-size: 14px">Excel</button>
                      </fieldset>
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

    <script src="../assets/printThis.js"></script>

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
    <script>
      $('#print').click(function() {
        $('.section-body').printThis({
          debug: false, // show the iframe for debugging
          importCSS: true, // import parent page css
          importStyle: true, // import style tags
          printContainer: true, // print outer container/$.selector
          loadCSS: "", // path to additional css file - use an array [] for multiple
          pageTitle: "", // add title to print page
          removeInline: false, // remove inline styles from print elements
          removeInlineSelector: "*", // custom selectors to filter inline styles. removeInline must be true
          printDelay: 333, // variable print delay
          header: null, // prefix to html
          footer: null, // postfix to html
          base: false, // preserve the BASE tag or accept a string for the URL
          formValues: true, // preserve input/form values
          canvas: true, // copy canvas content
          doctypeString: '<!DOCTYPE html>', // enter a different doctype for older markup
          removeScripts: false, // remove script tags from print content
          copyTagClasses: true, // copy classes from the html & body tag
          copyTagStyles: true, // copy styles from html & body tag (for CSS Variables)
          beforePrintEvent: null, // callback function for printEvent in iframe
          beforePrint: null, // function called before iframe is filled
          afterPrint: null // function called before iframe is removed
        });
      })
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
  </body>
</html>