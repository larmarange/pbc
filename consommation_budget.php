<?php
	$currDir = dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	include_once("$currDir/header.php");

	/* L'utilisateur a-t-il accès à la table conventions ? */
	$conventions_from = get_sql_from('conventions');
	if(!$conventions_from) exit(error_message('Accès interdit', false));

	/* Récupération identifiant */
	$convention_id = intval($_REQUEST['ConventionID']);
	if(!$convention_id) exit(error_message('Identifiant incorrect !', false));

	/* Est-ce que la convention existe ? */
	$res = sql("select * from conventions where conventions.id={$convention_id}", $eo);
	if(!($convention = db_fetch_assoc($res))) exit(error_message('Conventions non trouvée !', false));

  /*var_dump($convention);*/

  /* Vérifier les droits utilisateurs sur cette convention particulière */


  /* formatteurs */
  function euro($nombre) {
    $res = number_format($nombre, 2, ',', ' ')  . "&nbsp;&euro;";
    if ($nombre >=0 ) {
      echo $res;
    } else {
      echo '<span style="color: red;">' . $res . '</span>';
    }
  }
  function euro2($non_liquide, $liquide) {
    if (is_null($non_liquide)) $non_liquide = 0;
    if (is_null($liquide)) $liquide = 0;
    $res = number_format($non_liquide + $liquide, 2, ',', ' ')  . "&nbsp;&euro;";
    if ($non_liquide >0 ) {
      echo $res . "*";
    } else {
      echo $res . "&nbsp;";
    }

  }
  // function pourcent($nombre) {
  //   $res = number_format($nombre * 100, 1, ',', ' ')  . "&nbsp;%";
  //   if ($nombre >=1 ) {
  //     echo $res;
  //   } else {
  //     echo '<span style="color: red;">' . $res . '</span>';
  //   }
  // }
  function pourcent($nombre) {
    $res = number_format($nombre * 100, 0, ',', ' ')  . "%";
    $value = round($nombre * 100);
    if ($value > 100) {
      $width = 100;
    } else {
      $width = $value;
    }
    if ($value < 50) {
      $class = "progress-bar-success";
    } else if ($value >=50 & $value < 75) {
      $class = "progress-bar-info";
    } else if ($value >= 75 & $value < 100) {
      $class = "progress-bar-warning";
    } else {
      $class = "progress-bar-danger";
    }
    echo '<div class="progress" style="min-width: 75px; margin: 0;">
      <div class="progress-bar '.$class.'" role="progressbar" aria-valuenow="'.$value.'" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: '.$width.'%; font-size: .9em;">
        '.$res.'
      </div>
    </div>';
  }

  /* sélectionner les exercices */
  $res = sql("SELECT DISTINCT exercice FROM lignes_credits WHERE convention={$convention_id} ORDER BY exercice", $eo);
  $exercices = array();
  while($row = $res->fetch_assoc()) {
    $exercices[] = $row['exercice'];
  }
	?>


  <div class="row">
    <div class="col-xs-12">
			<h1><?php echo $convention['nom']; ?></h1>
			<p>Version du <?php setlocale(LC_TIME, 'fr_FR'); echo strftime('%A %d %B %Y'); ?></p>
      <p>Les astérisques (*) indiquent les montants où les dépenses ne sont pas toutes liquidées.</p>
    </div>
	</div>

  <div class="row">
    <div class="col-xs-12">
      <h2>Consommation Budgétaire</h2>
    </div>
  </div>

  <table class="table table-striped table-bordered">
		<thead>
			<th>Ligne budgétaire</th>
			<th class="text-right">Accordé</th>
      <?php
        foreach ($exercices as $e) {
          echo '<th class="text-right">' . $e . '</th>';
        }
      ?>
      <th class="text-right">Total consommé</th>
      <th class="text-right">&nbsp;</th>
			<th class="text-right">Non consommé</th>
		</thead>

		<tbody>
      <?php
        $res_lignes = sql("
        SELECT *, CONCAT_WS(' - ', types_ligne.gestionnaire, types_ligne.type, budgets.precision) AS nom_ligne, budgets.id AS id_ligne
          FROM budgets LEFT JOIN types_ligne ON types_ligne.id=budgets.type WHERE types_ligne.frais_gestion IS NULL AND budgets.convention={$convention_id}
        ", $eo);
        while($ligne = $res_lignes->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $ligne['nom_ligne']; ?></td>
            <td class="text-right"><?php euro($ligne['accorde']); ?></td>
            <?php
              $id_ligne = $ligne['id_ligne'];
              foreach ($exercices as $e) {
                $e = makeSafe($e);
                $non_liquide = sqlValue("
                  SELECT SUM(montant) FROM depenses LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
                  WHERE depenses.liquidee IS NULL AND lignes_credits.exercice={$e} AND depenses.ligne_budgetaire={$id_ligne}"
                );
                $liquide = sqlValue("
                  SELECT SUM(montant) FROM depenses LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
                  WHERE depenses.liquidee IS NOT NULL AND lignes_credits.exercice={$e} AND depenses.ligne_budgetaire={$id_ligne}"
                );
                echo '<td class="text-right">';
                euro2($non_liquide, $liquide);
                echo '</td>';
              }
              // Total
              $non_liquide = sqlValue("
                SELECT SUM(montant) FROM depenses LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
                WHERE depenses.liquidee IS NULL AND depenses.ligne_budgetaire={$id_ligne}"
              );
              $liquide = sqlValue("
                SELECT SUM(montant) FROM depenses LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
                WHERE depenses.liquidee IS NOT NULL AND depenses.ligne_budgetaire={$id_ligne}"
              );
              echo '<td class="text-right">';
              euro2($non_liquide, $liquide);
              echo '</td>';
              // Pourcentage
              echo '<td class="text-right">';
              pourcent(($non_liquide + $liquide) / $ligne['accorde']);
              echo '</td>';
							// Non consommé
							echo '<td class="text-right">';
              euro($ligne['accorde'] - ($non_liquide + $liquide));
              echo '</td>';

            ?>

          </tr>
          <?php
        }
      ?>
		</tbody>

		<tfoot>
			<tr>
        <th>TOTAL</th>
        <?php
          $accorde = sqlValue("
            SELECT SUM(budgets.accorde) FROM budgets LEFT JOIN types_ligne ON types_ligne.id=budgets.type
            WHERE types_ligne.frais_gestion IS NULL AND budgets.convention={$convention_id}"
          );
          echo '<th class="text-right">';
          euro($accorde);
          echo '</th>';
          foreach ($exercices as $e) {
            $e = makeSafe($e);
            $non_liquide = sqlValue("
              SELECT SUM(montant) FROM depenses LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
              WHERE depenses.liquidee IS NULL AND lignes_credits.exercice={$e} AND depenses.convention={$convention_id}"
            );
            $liquide = sqlValue("
              SELECT SUM(montant) FROM depenses LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
              WHERE depenses.liquidee IS NOT NULL AND lignes_credits.exercice={$e} AND depenses.convention={$convention_id}"
            );
            echo '<th class="text-right">';
            euro2($non_liquide, $liquide);
            echo '</th>';
          }
          // Total
          $non_liquide = sqlValue("
            SELECT SUM(montant) FROM depenses LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
            WHERE depenses.liquidee IS NULL AND depenses.convention={$convention_id}"
          );
          $liquide = sqlValue("
            SELECT SUM(montant) FROM depenses LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
            WHERE depenses.liquidee IS NOT NULL  AND depenses.convention={$convention_id}"
          );
          echo '<th class="text-right">';
          euro2($non_liquide, $liquide);
          echo '</th>';
          // Pourcentage
          echo '<th class="text-right">';
          pourcent(($non_liquide + $liquide) / $accorde);
          echo '</th>';
					// Non consommé
					echo '<th class="text-right">';
					euro($accorde - ($non_liquide + $liquide));
					echo '</th>';
        ?>
			</tr>
		</tfoot>
	</table>

  <div class="row">
    <div class="col-xs-12">
      <h2>Consommation Analytique</h2>
    </div>
	</div>

  <table class="table table-striped table-bordered">
		<thead>
			<th>Ventilation budgétaire</th>
			<th class="text-right">Prévisionnel</th>
      <?php
        foreach ($exercices as $e) {
          echo '<th class="text-right">' . $e . '</th>';
        }
      ?>
      <th class="text-right">Total consommé</th>
      <th class="text-right">&nbsp;</th>
			<th class="text-right">Non consommé</th>
		</thead>

		<tbody>
      <?php
      // Pour chaque ligne de ventilation hors rubrique
      $res_lignes = sql("SELECT * FROM `ventilation` WHERE convention={$convention_id} AND rubrique IS NULL ORDER BY intitule", $eo);
      while($ligne = $res_lignes->fetch_assoc()) {
        echo '<tr>';
        $id_ligne = $ligne['id'];
        echo '<td>'.$ligne['intitule'].'</td>';
        $previsionnel = $ligne['accorde'];
        if (is_null($previsionnel)) $previsionnel = 0;
        echo '<td class="text-right">';
        euro($previsionnel);
        echo '</td>';
        foreach ($exercices as $e) {
          $e = makeSafe($e);
          $non_liquide = sqlValue("
            SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
            LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
            WHERE depenses.liquidee IS NULL  AND lignes_credits.exercice={$e} AND ventilation.id={$id_ligne}"
          );
          $liquide = sqlValue("
          SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
          LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
          WHERE depenses.liquidee IS NOT NULL  AND lignes_credits.exercice={$e} AND ventilation.id={$id_ligne}"
          );
          echo '<td class="text-right">';
          euro2($non_liquide, $liquide);
          echo '</td>';
        }
        // Total de la rubrique
        $non_liquide = sqlValue("
          SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
          WHERE depenses.liquidee IS NULL AND ventilation.id={$id_ligne}"
        );
        $liquide = sqlValue("
          SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
          WHERE depenses.liquidee IS NOT NULL AND ventilation.id={$id_ligne}"
        );
        echo '<td class="text-right">';
        euro2($non_liquide, $liquide);
        echo '</td>';
        // Pourcentage
        echo '<td class="text-right">';
        if ($previsionnel > 0) { pourcent(($non_liquide + $liquide) / $previsionnel); }
        echo '</td>';
				// Non consommé
				echo '<td class="text-right">';
				if ($previsionnel > 0) {euro($previsionnel - ($non_liquide + $liquide));}
				echo '</td>';
        echo '</tr>';
      }

        $res_rubriques = sql("SELECT * FROM `rubriques` WHERE convention={$convention_id} ORDER BY intitule", $eo);
        // Pour chaque rubrique de ventilation
        while($rubrique = $res_rubriques->fetch_assoc()) {
          echo '<tr>';
          $id_rubrique = $rubrique['id'];
          echo '<th>'.$rubrique['intitule'].'</th>';
          $previsionnel = $rubrique['accorde'];
          if (is_null($previsionnel)) $previsionnel = 0;
          echo '<th class="text-right">';
          euro($previsionnel);
          echo '</th>';
          foreach ($exercices as $e) {
            $e = makeSafe($e);
            $non_liquide = sqlValue("
              SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
              LEFT JOIN rubriques ON rubriques.id = ventilation.rubrique LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
              WHERE depenses.liquidee IS NULL  AND lignes_credits.exercice={$e} AND rubriques.id={$id_rubrique}"
            );
            $liquide = sqlValue("
            SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
            LEFT JOIN rubriques ON rubriques.id = ventilation.rubrique LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
            WHERE depenses.liquidee IS NOT NULL  AND lignes_credits.exercice={$e} AND rubriques.id={$id_rubrique}"
            );
            echo '<th class="text-right">';
            euro2($non_liquide, $liquide);
            echo '</th>';
          }
          // Total de la rubrique
          $non_liquide = sqlValue("
            SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
            LEFT JOIN rubriques ON rubriques.id = ventilation.rubrique
            WHERE depenses.liquidee IS NULL AND rubriques.id={$id_rubrique}"
          );
          $liquide = sqlValue("
            SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
            LEFT JOIN rubriques ON rubriques.id = ventilation.rubrique
            WHERE depenses.liquidee IS NOT NULL AND rubriques.id={$id_rubrique}"
          );
          echo '<th class="text-right">';
          euro2($non_liquide, $liquide);
          echo '</th>';
          // Pourcentage
          echo '<th class="text-right">';
          if ($previsionnel > 0) { pourcent(($non_liquide + $liquide) / $previsionnel); }
          echo '</th>';
					// Non consommé
					echo '<th class="text-right">';
					if ($previsionnel > 0) {euro($previsionnel - ($non_liquide + $liquide));}
					echo '</th>';
          echo '</tr>';
          // Pour chaque ligne de ventilation de la rubrique
          $res_lignes = sql("SELECT * FROM `ventilation` WHERE convention={$convention_id} AND rubrique={$id_rubrique} ORDER BY intitule", $eo);
          while($ligne = $res_lignes->fetch_assoc()) {
            echo '<tr>';
            $id_ligne = $ligne['id'];
            echo '<td>'.$ligne['intitule'].'</td>';
            $previsionnel = $ligne['accorde'];
            if (is_null($previsionnel)) $previsionnel = 0;
            echo '<td class="text-right">';
            euro($previsionnel);
            echo '</td>';
            foreach ($exercices as $e) {
              $e = makeSafe($e);
              $non_liquide = sqlValue("
                SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
                LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
                WHERE depenses.liquidee IS NULL  AND lignes_credits.exercice={$e} AND ventilation.id={$id_ligne}"
              );
              $liquide = sqlValue("
              SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
              LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
              WHERE depenses.liquidee IS NOT NULL  AND lignes_credits.exercice={$e} AND ventilation.id={$id_ligne}"
              );
              echo '<td class="text-right">';
              euro2($non_liquide, $liquide);
              echo '</td>';
            }
            // Total de la rubrique
            $non_liquide = sqlValue("
              SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
              WHERE depenses.liquidee IS NULL AND ventilation.id={$id_ligne}"
            );
            $liquide = sqlValue("
              SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
              WHERE depenses.liquidee IS NOT NULL AND ventilation.id={$id_ligne}"
            );
            echo '<td class="text-right">';
            euro2($non_liquide, $liquide);
            echo '</td>';
            // Pourcentage
            echo '<td class="text-right">';
            if ($previsionnel > 0) { pourcent(($non_liquide + $liquide) / $previsionnel); }
            echo '</td>';
						// Non consommé
						echo '<td class="text-right">';
						if ($previsionnel > 0) {euro($previsionnel - ($non_liquide + $liquide));}
						echo '</td>';
            echo '</tr>';
          }
        }
        // Dépenses non ventilées
        $previsionnel = $convention['budget_nv'];
        $total_depenses_nv = sqlValue("
          SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
          WHERE ventilation.id IS NULL AND depenses.convention={$convention_id}"
        );
        if ($previsionnel > 0 | !is_null($total_depenses_nv)) {
          echo '<tr>';
          echo '<th>Dépenses non ventilées</th>';
          echo '<th class="text-right">';
          euro($previsionnel);
          echo '</th>';
          foreach ($exercices as $e) {
            $e = makeSafe($e);
            $non_liquide = sqlValue("
              SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
              LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
              WHERE depenses.liquidee IS NULL  AND lignes_credits.exercice={$e} AND ventilation.id IS NULL AND depenses.convention={$convention_id}"
            );
            $liquide = sqlValue("
            SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
            LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
            WHERE depenses.liquidee IS NOT NULL  AND lignes_credits.exercice={$e} AND ventilation.id IS NULL AND depenses.convention={$convention_id}"
            );
            echo '<th class="text-right">';
            euro2($non_liquide, $liquide);
            echo '</th>';
          }
          // Total de la rubrique
          $non_liquide = sqlValue("
            SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
            WHERE depenses.liquidee IS NULL AND ventilation.id IS NULL AND depenses.convention={$convention_id}"
          );
          $liquide = sqlValue("
            SELECT SUM(montant) FROM depenses LEFT JOIN ventilation ON depenses.ventilation=ventilation.id
            WHERE depenses.liquidee IS NOT NULL AND ventilation.id IS NULL AND depenses.convention={$convention_id}"
          );
          echo '<th class="text-right">';
          euro2($non_liquide, $liquide);
          echo '</th>';
          // Pourcentage
          echo '<th class="text-right">';
          if ($previsionnel > 0) { pourcent(($non_liquide + $liquide) / $previsionnel); }
          echo '</th>';
					// Non consommé
					echo '<th class="text-right">';
					if ($previsionnel > 0) {euro($previsionnel - ($non_liquide + $liquide));}
					echo '</th>';
          echo '</tr>';
        }
      ?>
		</tbody>

		<tfoot>
			<tr>
        <th>TOTAL</th>
        <?php
          $accorde = sqlValue("
            SELECT SUM(budgets.accorde) FROM budgets LEFT JOIN types_ligne ON types_ligne.id=budgets.type
            WHERE types_ligne.frais_gestion IS NULL AND budgets.convention={$convention_id}"
          );
          echo '<th class="text-right">';
          euro($accorde);
          echo '</th>';
          foreach ($exercices as $e) {
            $e = makeSafe($e);
            $non_liquide = sqlValue("
              SELECT SUM(montant) FROM depenses LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
              WHERE depenses.liquidee IS NULL AND lignes_credits.exercice={$e} AND depenses.convention={$convention_id}"
            );
            $liquide = sqlValue("
              SELECT SUM(montant) FROM depenses LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
              WHERE depenses.liquidee IS NOT NULL AND lignes_credits.exercice={$e} AND depenses.convention={$convention_id}"
            );
            echo '<th class="text-right">';
            euro2($non_liquide, $liquide);
            echo '</th>';
          }
          // Total
          $non_liquide = sqlValue("
            SELECT SUM(montant) FROM depenses LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
            WHERE depenses.liquidee IS NULL AND depenses.convention={$convention_id}"
          );
          $liquide = sqlValue("
            SELECT SUM(montant) FROM depenses LEFT JOIN lignes_credits ON lignes_credits.id=depenses.ligne_credit
            WHERE depenses.liquidee IS NOT NULL AND depenses.convention={$convention_id}"
          );
          echo '<th class="text-right">';
          euro2($non_liquide, $liquide);
          echo '</th>';
          // Pourcentage
          echo '<th class="text-right">';
          pourcent(($non_liquide + $liquide) / $accorde);
          echo '</th>';
					// Non consommé
					echo '<th class="text-right">';
					euro($accorde - ($non_liquide + $liquide));
					echo '</th>';
        ?>
			</tr>
		</tfoot>
	</table>

<?php
  include_once("$currDir/footer.php");

?>
