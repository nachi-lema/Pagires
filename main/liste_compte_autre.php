  <!--- Partie entête ---->
  <?php 
    require_once '../includes/Globals_function.php';
    include_once("../includes/_header.php") ;
    include("../includes/modal.php");
  ?>


 <div class="main-content">
   <section class="section">
     <div class="section-body">
       <div class="row">
         <div class="col-12">
           <div class="card">
             <div class="card-header dropdown">
               <h4 class="">Extrait compte</h4>
               <li><a href="liste_compte_autre.php" class="btn btn-primary" style="background-color: #44597b">Actualiser<i></i></a></li>
               <?php extrait_compte_autre(); ?>

               <div class="col-sm-6" style="margin-left: 20px">
                 <form method="GET" action="" class="form_filter col-lg-6 col-md-6 col-sm-12">
                   <div class="input-group">
                     <select name="description" class="form-control" required>
                       <option value="0">Autre compte</option>
                       <?php $result = $bd->query("SELECT * FROM compta_autres ORDER BY compte ASC") ?>
                       <?php while ($row = $result->fetch_array()) : ?>
                         <option value="<?= $row['descriptions'] ?>"><?= $row['descriptions'] ?></option>
                       <?php endwhile ?>
                     </select>
                     <div class="input-group-btn m-0 p-0">
                       <button type="submit" name="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check"></i></button>
                     </div>
                   </div>
                 </form>
               </div>

             </div>
           </div>
         </div>
       </div>
     </div>
     <!--- Partie Affichage des Transaction élèves --->
     <div class="section-body">
       <div class="row">
         <div class="col-12">
           <div class="card">
             <div class="card-header">
               <?php cpteur_autres(); ?>
             </div>
             <div class="card-body">
               <div class="table-responsive">
                 <table class="table table-striped table-hover" id='table-r'>
                   <thead>
                     <tr>
                       <th>COMPTES </th>
                       <th>INTITULE </th>
                       <th>STATUT </th>
                       <th>CONTROLER </th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php liste_extrait_autre(); ?>
                   </tbody>
                 </table>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
     <!--- Partie Affichage des Transaction élèves --->
   </section>
 </div>
 </div>

 <?php require '../includes/_footer.php'; ?>

 <!------- Modal de formulaire (caisse et banque) --------->

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