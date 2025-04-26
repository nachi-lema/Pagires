<style type="text/css">
  .dropdown .nav-link:hover {
    color: #304c79;
    font-weight: bold;
    font-size: 15px;
  }
</style>

<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="dashboard.php">
      <?php affiche_logo_soc(); ?>
      <?php affiche_societe(); ?>
    </a>
  </div>
  <ul class="sidebar-menu">
    <!--- 1er etape --->
    <li class="dropdown">
      <a href="dashboard.php" class="nav-link" style="font-size: 14px"><i class="fa fa-home"></i><span>Dashbord</span></a>
    </li>
    <!--- Fin 1er etape --->
    <!--- 2eme etape partie Administrateur --->
    <?php acces_droitAdmin() ?>
    <li class="dropdown">
      <a href="#" class="nav-link" style="font-size: 14px"><i class="fas fa-user-plus"></i><span>Authentifier</span></a>
    </li>
    <li class="dropdown">
      <a href="#" class="nav-link" style="font-size: 14px"><i class="fas fa-wallet"></i><span>Management</span></a>
    </li>
    <li class="dropdown">
      <a href="#" class="nav-link" style="font-size: 14px"><i class="fas fa-file"></i><span>Administration</span></a>
    </li>
    <!--- Fin 2eme etape --->
    <!--- 3eme etape --->
    <li class="menu-header"><i class="fas fa-dollar-sign"></i> Finances Et Comptabilité</li>
    <li class="dropdown">
      <a href="javascript:void(0)" onclick="opnencrecompte()" class="nav-link" style="font-size: 14px;"><i class="fas fa-user"></i><span>Comptes_courants </span></a>
    </li>
    <!-------------->
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-credit-card"></i><span>Caisses_Banques</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" style="font-size:0.75em;font-weight:bold" href="encodage.php">Encodage</a></li>
        <li><a class="nav-link" style="font-size:0.75em;font-weight:bold" href="#">Transactions_encours</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-credit-card"></i><span>Guichet_unique</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" style="font-size:0.75em;font-weight:bold" href="encodage.php">Encodage</a></li>
        <li><a class="nav-link" style="font-size:0.75em;font-weight:bold" href="#">Transactions_encours</a></li>
      </ul>
    </li>
    <!-------------->
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fas fa-coins"></i><span>OD_facturation</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" style="font-size:0.75em;font-weight:bold" href="nivellement.php">Nivellement_comptes</a></li>
        <li><a class="nav-link" style="font-size:0.75em;font-weight:bold" href="compte_OD.php">Facturation</a></li>
        <li><a class="nav-link" style="font-size:0.75em;font-weight:bold" href="taux-change.php">Taux de change</a></li>
        <li><a class="nav-link" style="font-size:0.75em;font-weight:bold" href="#">Tarification_scolaire</a></li>
      </ul>
    </li>
    <!-------------->
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-print"></i><span>Recouvrements_extraits</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="liste_compte_pers.php" target="_blank" style="font-size:0.75em;font-weight:bold">Extrait_Personnel</a></li>
        <li><a class="nav-link" href="liste_compte_tiers.php" target="_blank" style="font-size:0.75em;font-weight:bold">Extrait_Tiers</a></li>
        <li><a class="nav-link" href="liste_compte_autre.php" target="_blank" style="font-size:0.75em;font-weight:bold">Extrait_Lexique</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-print"></i><span>Recouvrements_releves</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="#" target="_blank" style="font-size:0.75em;font-weight:bold">Releves_Personnel</a></li>
        <li><a class="nav-link" href="#" target="_blank" style="font-size:0.75em;font-weight:bold">Releves_Tiers</a></li>
        <li><a class="nav-link" href="#" target="_blank" style="font-size:0.75em;font-weight:bold">Releves_comptes</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-print"></i><span>Recouvrements_comptes</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="../recouvrmt954wdfd89rup5/recouvrmt_person.php" target="_blank" style="font-size:0.75em;font-weight:bold">Recouvrement_Personnel_usd</a></li>
        <li><a class="nav-link" href="../recouvrmt954wdfd89rup5/recouvrmt_person_CDF.php" target="_blank" style="font-size:0.75em;font-weight:bold">Recouvrement_Personnel_cdf</a></li>
        <li><a class="nav-link" href="../recouvrmt954wdfd89rup5/recouvrmt_tiers.php" target="_blank" style="font-size:0.75em;font-weight:bold">Recouvrement_Tiers_usd</a></li>
        <li><a class="nav-link" href="#" target="_blank" style="font-size:0.75em;font-weight:bold">Recouvrement_Tiers_cdf</a></li>
      </ul>
    </li>
    <!-------------->
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-print"></i><span>Listing_transactions</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="javascript:void(0)" onclick="opnetransact()" style="font-size:0.75em;font-weight:bold">Transations_quotidiennes</a></li>
        <li><a class="nav-link" href="javascript:void(0)" onclick="opnePeriodique()" style="font-size:0.75em;font-weight:bold">Transations_périodique</a></li>
        <li><a class="nav-link" style="font-size:0.75em;font-weight:bold">Transactions_par_rubriques</a></li>
      </ul>
    </li>
    <!-------------->
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-print"></i><span>Trésorerie</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="javascript:void(0)" onclick="opnetresord()" style="font-size:0.75em;font-weight:bold">Tresorerie_quotidiennes</a></li>
        <li><a class="nav-link" href="javascript:void(0)" onclick="opnePeriod_tresor()" style="font-size:0.75em;font-weight:bold">Tresorerie_Periodique</a></li>
        <li><a class="nav-link" href="javascript:void(0)" onclick="opnetresorSold()" style="font-size:0.75em;font-weight:bold">Tresorerie_Solde</a></li>
        <li><a class="nav-link" href="../65058HGHHHggrt077prints/tresoreie-nette.php" target="_blank" style="font-size:0.75em;font-weight:bold">Tresorerie_nette</a></li>
      </ul>
    </li>
    <!-------------->
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-print"></i><span>Balance_comptes</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="javascript:void(0)" onclick="opnenbalanceparclasse()" style="font-size:0.75em;font-weight:bold">Balance_comptes_classe</a></li>
        <li><a class="nav-link" href="javascript:void(0)" onclick="opnenbalancepargroupe()" style="font-size:0.75em;font-weight:bold">Balance_comptes_groupe</a></li>
        <li><a class="nav-link" href="javascript:void(0)" onclick="opnenbalanceglobal()" style="font-size:0.75em;font-weight:bold">Balance_globale_classe_usd</a></li>
        <li><a class="nav-link" href="balance_details.php" style="font-size:0.75em;font-weight:bold">Balance_details_cdf_usd</a></li>
        <li><a class="nav-link" href="balglobal_details.php" style="font-size:0.75em;font-weight:bold">Balance_globale_listing_usd</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fas fa-wallet"></i><span>Recapitulatif_global</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="#" target="_blank" style="font-size:0.75em;font-weight:bold">Comptes_Actif</a></li>
        <li><a class="nav-link" href="#" target="_blank" style="font-size:0.75em;font-weight:bold">Comptes_Passif</a></li>
        <li><a class="nav-link" href="#" target="_blank" style="font-size:0.75em;font-weight:bold">Rapport_global</a></li>
        <li><a class="nav-link" href="#" target="_blank" style="font-size:0.75em;font-weight:bold">TFR</a></li>
      </ul>
    </li>

    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fas fa-wallet"></i><span>Archivage_Historique</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="#" target="_blank" style="font-size:0.75em;font-weight:bold">Extraits_comptes</a></li>
        <li><a class="nav-link" href="#" target="_blank" style="font-size:0.75em;font-weight:bold">Recouvrement_Tiers</a></li>
        <li><a class="nav-link" href="#" target="_blank" style="font-size:0.75em;font-weight:bold">Recouvrement_Personnel</a></li>
        <li><a class="nav-link" href="#" target="_blank" style="font-size:0.75em;font-weight:bold">Recouvrement_Lexique</a></li>
        <li><a class="nav-link" href="#" target="_blank" style="font-size:0.75em;font-weight:bold">Balance_comptes</a></li>
        <li><a class="nav-link" href="#" target="_blank" style="font-size:0.75em;font-weight:bold">Recapitulatif_comptes</a></li>
      </ul>
    </li>
    <!-------------->
    <!--- Fin 3eme etape --->

    <!--- 4eme etape --->
    <li class="menu-header"><i class="fas fa-users"></i>Ressources Humaines</li>
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-user-plus"></i><span>RH_Personnel</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="creat_agent.php">Création personnel</a></li>
        <li><a class="nav-link" href="creat_depent.php">Création dependant</a></li>
        <li><a class="nav-link" href="pers_classe.php">Maj_classification</a></li>
        <li><a class="nav-link" href="#">Identification_agent</a></li>
        <li><a class="nav-link" href="#">Contrat_personnel</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fas fa-coins"></i><span>RH_Creation_Baremes</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="baremsal.php">Barème_salarial</a></li>
        <li><a class="nav-link" href="#">Bareme_taxes</a></li>
        <li><a class="nav-link" href="#">Impression_salaires_agent</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-user-plus"></i><span>RH_Impression_staff</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="repert_staff.php">Staff_repertoire personnel</a></li>
        <li><a class="nav-link" href="print_staff.php">Staff_listing personnel</a></li>
        <li><a class="nav-link" href="#">Staff_listing-dependant</a></li>
        <li><a class="nav-link" href="#">Staff_fiche individuelle</a></li>
        <li><a class="nav-link" href="#">Staff_attestation-service</a></li>
        <li><a class="nav-link" href="congestaff.php">Staff_congés</a></li>
        <li><a class="nav-link" href="persoins.php">staff_bon_soins</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fas fa-clock"></i><span>RH_Paie_mensuelle</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="maj-pers.php">Maj_mensuelles</a></li>
        <li><a class="nav-link" href="#">Maj_salaires</a></li>
        <li><a class="nav-link" href="tauxjr.php">taux_change</a></li>
        <li><a class="nav-link" href="periodpay.php">Periode_Paie</a></li>
        <li><a class="nav-link" href="peradvances.php">Maj_avances-prets</a></li>
        <li><a class="nav-link" href="regulars.php">Maj_regularisations</a></li>
        <li><a class="nav-link" href="creat_mens.php">Pointages_mensuels</a></li>

        <!--<li><a class="nav-link" href="perpoint.php">Maj_pointages_mensuels</a></li>-->

        <!--
        <li class="dropdown">
          <a class="nav-link menu-toggle has-dropdown" href="#" style="font-weight: bold;">Maj_Mensuels</a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="creat_mens.php">Creat_mensuelles</a></li>
            <li><a class="nav-link" href="perpoint.php">Presences_mensuelles</a></li>
            
            
            
            <li><a class="nav-link" href="pers_salbase.php">Salaire-base</a></li>
            <li><a class="nav-link" href="pers_baseind.php">Base_ind-primes</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="nav-link menu-toggle has-dropdown" href="#" style="font-weight: bold;">Totaux_bruts_base</a>
          <ul class="dropdown-menu">
            
            
            
            
            <li><a class="nav-link" href="quote-partp.php">Quote-part-patronal</a></li>
            <li><a class="nav-link" href="netpay.php">Net-a-payer</a></li>
          </ul>
        </li> 
        ---->
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-user-plus"></i><span>RH_Impression_salaires-bruts</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="pers_salbrut.php">Salaire-brut</a></li>
        <li><a class="nav-link" href="pers_indprimes.php">Indem-primes</a></li>
        <li><a class="nav-link" href="pers_bruttotal.php">Brut_total (all)</a></li>
        <li><a class="nav-link" href="quote-part.php">Retenues</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-user-plus"></i><span>RH_Etats_mensuels</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="perpoint.php">Recap_Listing_pointages</a></li>
        <li><a class="nav-link" href="fichpay.php">Impression_fiche-paie</a></li>
        <li><a class="nav-link" href="javascript:void(0)" onclick="opnenfiche()">Impression_fiches-paie</a></li>
        <li><a class="nav-link" href="listingpay.php">Listing_paie_banque</a></li>
        <li><a class="nav-link" href="listing_mens.php">Listing_mensuel</a></li>
        <li><a class="nav-link" href="listfisc.php">Listing_declarations_taxes</a></li>
        <li><a class="nav-link" href="fiscanex.php">Listing_declaration_unique</a></li>
        <li><a class="nav-link" href="#">Listing_regularisations</a></li>
        <li><a class="nav-link" href="#">Listing_avances-prets</a></li>
        <li><a class="nav-link" href="listnet.php">Listing-paie_global</a></li>
        <li><a class="nav-link" href="javascript:void(0)" onclick="opnenrecap()">Recapitulatif_mensuel</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fas fa-donate"></i><span>RH_Paie_complementaire</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="decompte.php">Decompte_Maj-encodage</a></li>
        <li><a class="nav-link" href="payfiche.php">Decompte-impression_fiche</a></li>
        <li><a class="nav-link" href="bdecompte.php">Decompte_impression_listing</a></li>
        <li><a class="nav-link" href="#">Decompte_attestation-fin-services</a></li>
        <li><a class="nav-link" href="paie_supplmn.php">Prestation-supplem_maj-encodage</a></li>
        <!--<li><a class="nav-link" href="base_supplmnt.php">Base_supplementaire</a></li>--->
        <li><a class="nav-link" href="impssn_fichpaie.php">Prestation_supplem_impression_fiche</a></li>
        <li><a class="nav-link" href="impssn_listpaie.php">Prestation_supplem_impression_listing</a></li>
        <!--
        <li class="dropdown">
          <a class="nav-link menu-toggle has-dropdown" href="#" style="font-weight: bold;">Decompte_Final</a>
          <ul class="dropdown-menu">
            
            <li><a class="nav-link" href="jourpreav.php">Jours_preavis</a></li>
            <li><a class="nav-link" href="brutcmpt.php">Brut_decompte</a></li>
            <li><a class="nav-link" href="indemniprime.php">Indeniminite_prime</a></li>
            <li><a class="nav-link" href="netpaycpmt.php">Netpay_decompte</a></li>
            <li><a class="nav-link" href="decptebsal.php">Decompte_base-salariale</a></li>
            <li><a class="nav-link" href="decpte_tbrut.php">Decompte_listing_totaux-bruts</a></li>
            
            <li><a class="nav-link" href="print_listdecpt.php">Print_listing-decompte</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="nav-link menu-toggle has-dropdown" href="#" style="font-weight: bold;">Paie-supplementaires</a>
          <ul class="dropdown-menu">
            
            <li><a class="nav-link" href="netpaysupplmnt.php">Net_paie_supplementaire</a></li>
            
            
          </ul>
        </li>--->
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-print"></i><span>RH_Etats_annuels</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="#">Recap_listing_pointages</a></li>
        <li><a class="nav-link" href="#">Impression_fiche_paie</a></li>
        <li><a class="nav-link" href="#">Impression_fiches_paie</a></li>
        <li><a class="nav-link" href="#">Listing_paie_banque</a></li>
        <li><a class="nav-link" href="#">Listing_mensuel</a></li>
        <li><a class="nav-link" href="#">Listing_declarations_taxes</a></li>
        <li><a class="nav-link" href="#">Listing_declaration_unique</a></li>
        <li><a class="nav-link" href="#">Listing_regularisations</a></li>
        <li><a class="nav-link" href="#">Listing_avances-prets</a></li>
        <li><a class="nav-link" href="#">Listing_paie_globale</a></li>
        <li><a class="nav-link" href="#">Recapitulatif_annuel</a></li>
        <!--
        <li><a class="nav-link" href="#">Recap_declaration-unique</a></li>
        <li><a class="nav-link" href="#">Recap_listings paie_secteur</a></li>
        <li><a class="nav-link" href="#">Listing_staff</a></li>
        <li><a class="nav-link" href="#">Listing_dependants</a></li>
        <li><a class="nav-link" href="#">Listing_declarations</a></li>-->
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-user"></i><span>RH_Historique</span></a>
      <ul class="dropdown-menu">
        <!--<li><a class="nav-link" href="#">Salaires_agent</a></li>--->
        <li><a class="nav-link" href="#">Salaire_agent</a></li>
        <li><a class="nav-link" href="#">Listing_statistiques</a></li>
        <li><a class="nav-link" href="#">Listing_sorties</a></li>
        <li><a class="nav-link" href="#">Listing_decomptes</a></li>
        <li><a class="nav-link" href="#">Listing_declarations</a></li>
        <li><a class="nav-link" href="#">Listing_staff</a></li>
        <li><a class="nav-link" href="#">Listing_congés</a></li>
      </ul>
    </li>
    <!--- Fin 4eme etape --->
    <li class="menu-header"><i class="fa fa-shopping-bag"></i> GESTION_STOCKS_ARTICLES</li>
    <?php acces_droitGeststocks() ?>
    <?php acces_droitGestachats() ?>
    <?php acces_droitGestvente() ?>
    <?php acces_droitGestprint() ?>
    <?php acces_droitGestinvet() ?>
    <!---------------------------->
    <li class="menu-header"><i class="fa fa-shopping-bag"></i> GESTION_IMMO</li>
    <li class="dropdown">
      <a class="menu-toggle nav-link has-dropdown" href="#" style="font-size: 14px"><i class="fa fa-wallet"></i> Stock_initial_immo</a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="#">Stock-initial_creation & maj</a></li>
        <li><a class="nav-link" href="#">Stock-initial_listing</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a class="menu-toggle nav-link has-dropdown" href="#" style="font-size: 14px"><i class="fa fa-wallet"></i> Entrées_immo</a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="#">Stock_entrees_creation & maj</a></li>
        <li><a class="nav-link" href="#">Stock_entrees_listing</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a class="menu-toggle nav-link has-dropdown" href="#" style="font-size: 14px"><i class="fa fa-wallet"></i> Livraisons_immo</a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="#">Livraisions_autres</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a class="menu-toggle nav-link has-dropdown" href="#" style="font-size: 14px"><i class="fa fa-print"></i> Impressions_immo</a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="#">Listing_stock-inital</a></li>
        <li><a class="nav-link" href="#">Listing_stock-entrées</a></li>
        <li><a class="nav-link" href="#">Listing_stock-sorties</a></li>
        <li><a class="nav-link" href="#">Listing_global</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a class="menu-toggle nav-link has-dropdown" href="#" style="font-size: 14px"><i class="fa fa-wallet"></i> Inventaires_immo</a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="#">Inventaire_actuel</a></li>
        <li><a class="nav-link" href="#">Inventaire_periodique</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a class="menu-toggle nav-link has-dropdown" href="#" style="font-size: 14px"><i class="fa fa-wallet"></i> Amortissements_immo</a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="#">Amortissement_maj</a></li>
        <li><a class="nav-link" href="#">Listing_amortissement</a></li>
        <li><a class="nav-link" href="#">Listing_immo_VNC</a></li>
      </ul>
    </li>

    <li class="menu-header"><i class="fa fa-sign-out-alt"></i> Se Deconnecter</li>
    <li class="dropdown">
      <a href="logout.php" class="nav-link" href="#"><i class="fa fa-sign-out-alt"></i><span>Se deconnecter</span></a>
    </li>
  </ul>
</aside>

<!---  Script ---->
<script type="text/javascript">
  function opnencrecompte() {
    document.getElementById('form_select').style.display = "block";
  }

  function closecrecompte() {
    document.getElementById('form_select').style.display = "none";
  }
</script>
<script type="text/javascript">
  function opnenrecap() {
    document.getElementById('form_recap').style.display = "block";
  }

  function closerecap() {
    document.getElementById('form_recap').style.display = "none";
  }

  function opnenfiche() {
    document.getElementById('form_fiche').style.display = "block";
  }

  function closefiche() {
    document.getElementById('form_fiche').style.display = "none";
  }

  function opnetransact() {
    document.getElementById('form_transact').style.display = "block";
  }

  function closetransact() {
    document.getElementById('form_transact').style.display = "none";
  }

  function opnePeriodique() {
    document.getElementById('form_Periodique').style.display = "block";
  }

  function closePeriodique() {
    document.getElementById('form_Periodique').style.display = "none";
  }

  function opnetresord() {
    document.getElementById('form_tresorquotid').style.display = "block";
  }

  function closetresord() {
    document.getElementById('form_tresorquotid').style.display = "none";
  }

  function opnePeriod_tresor() {
    document.getElementById('form_Period_tresor').style.display = "block";
  }

  function closePeriod_tresor() {
    document.getElementById('form_Period_tresor').style.display = "none";
  }

  function opnetresorSold() {
    document.getElementById('form_tresorquotidSold').style.display = "block";
  }

  function closetresorSold() {
    document.getElementById('form_tresorquotidSold').style.display = "none";
  }

  function opnenbalanceparclasse() {
    document.getElementById('form_balanceclasse').style.display = "block";
  }

  function closebalanceparclasse() {
    document.getElementById('form_balanceclasse').style.display = "none";
  }

  function opnenbalancepargroupe() {
    document.getElementById('form_balancegroupe').style.display = "block";
  }

  function closebalancepargroupe() {
    document.getElementById('form_balancegroupe').style.display = "none";
  }

  function opnenbalanceglobal() {
    document.getElementById('form_balanceGlobal').style.display = "block";
  }

  function closebalanceglobal() {
    document.getElementById('form_balanceGlobal').style.display = "none";
  }
</script>