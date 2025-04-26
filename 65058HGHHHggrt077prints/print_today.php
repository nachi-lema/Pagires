            <?php $resultats = $bd->query(
                'SELECT id,ref_doc,nom_complet,compte_credit,nature_operation,libelle,devise,taux,debits_usd,credits_usd,debits_cdf,credits_cdf,date_doc,date_extract FROM comptes_pers WHERE date_extract = "' . $num_order . '"
                                    UNION
                SELECT id,ref_doc,nom_complet,compte_credit,nature_operation,libelle,devise,taux,debits_usd,credits_usd,debits_cdf,credits_cdf,date_doc,date_extract FROM comptes_tiers WHERE date_extract = "' . $num_order . '"
                                    UNION
                SELECT id,ref_doc,nom_complet,compte_credit,nature_operation,libelle,devise,taux,debits_usd,credits_usd,debits_cdf,credits_cdf,date_doc,date_extract FROM comptes_autres WHERE date_extract = "' . $num_order . '"
            ') ?>
            <?php while ($row = $resultats->fetch_array()) : ?>
                <tr>
                    <td style="border: 1px solid #000"><?= $row['date_doc'] ?></td>
                    <td style="border: 1px solid #000"><?= $row['compte_credit'] ?></td>
                    <td style="border: 1px solid #000"><?= $row['nom_complet'] ?></td>
                    <td style="border: 1px solid #000"><?= $row['nature_operation'] ?></td>
                    <td style="border: 1px solid #000"><?= $row['libelle'] ?></td>
                    <td style="border: 1px solid #000"><?= $row['taux'] ?></td>
                    <td style="border: 1px solid #000;text-align: right;"><?= $row['debits_usd'] ?></td>
                    <td style="border: 1px solid #000;text-align: right;"><?= $row['credits_usd'] ?></td>
                    <td style="border: 1px solid #000;text-align: right;"><?= $row['debits_cdf'] ?></td>
                    <td style="border: 1px solid #000;text-align: right;"><?= $row['credits_cdf'] ?></td>
                    
                </tr>
            <?php endwhile ?>
                <tr colspan="5"><!--somme debits usd---> 
                    <td class="center" colspan="6"><strong>Totaux  </strong></td>
                    <?php  $tot_debit_usd_personnes = $bd->query('SELECT SUM(debits_usd) FROM comptes_pers WHERE date_extract = "' .$num_order. '" && devise = "USD"') ?>
                    <?php  $tot_debit_usd_tiers = $bd->query('SELECT SUM(debits_usd) FROM comptes_tiers WHERE date_extract = "' .$num_order. '" && devise = "USD"') ?>
                    <?php  $tot_debit_usd_autres = $bd->query('SELECT SUM(debits_usd) FROM comptes_autres WHERE date_extract = "' .$num_order. '" && devise = "USD"') ?>

                    <?php $row_debit_usd_personne = $tot_debit_usd_personnes->fetch_array() ?>
                    <?php $row_debit_usd_tier = $tot_debit_usd_tiers->fetch_array() ?>
                    <?php $row_debit_usd_autre = $tot_debit_usd_autres->fetch_array() ?>
                    <td style="text-align: right;"><strong><?= number_format($row_debit_usd_personne[0] + $row_debit_usd_autre[0] + $row_debit_usd_tier[0],2) ?></strong></td>
                    <!--fin somme debits usd--->

                    <!--somme credit usd---> 
                    <?php  $tot_credit_usd_personnes = $bd->query('SELECT SUM(credits_usd) FROM comptes_pers WHERE date_extract = "' .$num_order. '" && devise = "USD"') ?>
                    <?php  $tot_credit_usd_tiers = $bd->query('SELECT SUM(credits_usd) FROM comptes_tiers WHERE date_extract = "' .$num_order. '" && devise = "USD"') ?>
                    <?php  $tot_credit_usd_autres = $bd->query('SELECT SUM(credits_usd) FROM comptes_autres WHERE date_extract = "' .$num_order. '" && devise = "USD"') ?>
                    <?php $row_credit_usd_personne = $tot_credit_usd_personnes->fetch_array() ?>
                    <?php $row_credit_usd_tier = $tot_credit_usd_tiers->fetch_array() ?>
                    <?php $row_credit_usd_autre = $tot_credit_usd_autres->fetch_array() ?>
                    <td style="text-align: right;"><strong><?= number_format($row_credit_usd_autre[0] + $row_credit_usd_personne[0] + $row_credit_usd_tier[0],2) ?></strong></td>
                    <!--fin somme debits usd--->  

                    <!--somme debits cdf---> 
                    <?php  $tot_debit_cdf_personnes = $bd->query('SELECT SUM(debits_cdf) FROM comptes_pers WHERE date_extract = "' . $num_order . '" && devise = "CDF"') ?>
                    <?php  $tot_debit_cdf_tiers = $bd->query('SELECT SUM(debits_cdf) FROM comptes_tiers WHERE date_extract = "' . $num_order . '" && devise = "CDF"') ?>
                    <?php  $tot_debit_cdf_autres = $bd->query('SELECT SUM(debits_cdf) FROM comptes_autres WHERE date_extract = "' . $num_order . '" && devise = "CDF"') ?>
                    <?php $row_debit_cdf_personne = $tot_debit_cdf_personnes->fetch_array() ?>
                    <?php $row_debit_cdf_tier = $tot_debit_cdf_tiers->fetch_array() ?>
                    <?php $row_debit_cdf_autre = $tot_debit_cdf_autres->fetch_array() ?>
                    <td style="text-align: right;"><strong><?= number_format($row_debit_cdf_personne[0] + $row_debit_cdf_tier[0] + $row_debit_cdf_autre[0],2) ?></strong></td>
                    <!--fin somme debits cdf---> 
                    
                    <!--somme credit cdf---> 
                    <?php  $tot_credit_cdf_personnes = $bd->query('SELECT SUM(credits_cdf) FROM comptes_pers WHERE date_extract = "' . $num_order . '" && devise = "CDF"') ?>
                    <?php  $tot_credit_cdf_tiers = $bd->query('SELECT SUM(credits_cdf) FROM comptes_tiers WHERE date_extract = "' . $num_order . '" && devise = "CDF"') ?>
                    <?php  $tot_credit_cdf_autres = $bd->query('SELECT SUM(credits_cdf) FROM comptes_autres WHERE date_extract = "' . $num_order . '" && devise = "CDF"') ?>

                    <?php $row_credit_cdf_personne = $tot_credit_cdf_personnes->fetch_array() ?>
                    <?php $row_credit_cdf_tier = $tot_credit_cdf_tiers->fetch_array() ?>
                    <?php $row_credit_cdf_autre = $tot_credit_cdf_autres->fetch_array() ?>

                    <td style="text-align: right;"><strong><?= number_format($row_credit_cdf_personne[0] + $row_credit_cdf_tier[0] + $row_credit_cdf_autre[0],2) ?></strong></td>
                    <!--somme credit cdf---> 
                </tr>
                <tr>
                    <td class=""></td>
                </tr>