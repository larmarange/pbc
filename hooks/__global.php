<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function login_ok($memberInfo, &$args){

		return '';
	}

	function login_failed($attempt, &$args){

	}

	function member_activity($memberInfo, $activity, &$args){
		switch($activity){
			case 'pending':
				break;

			case 'automatic':
				break;

			case 'profile':
				break;

			case 'password':
				break;

		}
	}

	function sendmail_handler(&$pm){

	}

	// HELPERS

	function dateDifference($date_1 , $date_2){
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);

		$diff = date_diff($datetime1, $datetime2);

		return round($diff->y * 12 + $diff->m + $diff->d/30 + $diff->h / 24);

	}

	function maj_convention($id_convention, $maj_droit = true){
		$id_convention = makeSafe($id_convention);
		// mise à jour des sous-tables

			// budgets
			$l = sql("SELECT id FROM budgets WHERE convention={$id_convention}", $eo);
			if ($l->num_rows > 0) {
				while($row = $l->fetch_assoc()) {
					maj_budgets($row['id']);
				}
			}

			// recrutements
			$l = sql("SELECT id FROM recrutements WHERE convention={$id_convention}", $eo);
			if ($l->num_rows > 0) {
				while($row = $l->fetch_assoc()) {
					maj_recrutements($row['id']);
				}
			}

			// ventilation
			$l = sql("SELECT id FROM ventilation WHERE convention={$id_convention}", $eo);
			if ($l->num_rows > 0) {
				while($row = $l->fetch_assoc()) {
					maj_ventilation($row['id']);
				}
			}

			// lignes de crédits
			$l = sql("SELECT id FROM lignes_credits WHERE convention={$id_convention}", $eo);
			if ($l->num_rows > 0) {
				while($row = $l->fetch_assoc()) {
					maj_ligne_credit($row['id']);
				}
			}

		// mise à jour des droits
		if ($maj_droit) {
			$groupe = sqlValue("SELECT groupID FROM `membership_userrecords` WHERE tableName='conventions' AND pkValue={$id_convention}");
			sql("UPDATE `membership_userrecords` INNER JOIN `budgets` ON membership_userrecords.pkValue=budgets.id SET membership_userrecords.groupID={$groupe} WHERE membership_userrecords.tableName='budgets' AND budgets.convention={$id_convention}", $eo);
			sql("UPDATE `membership_userrecords` INNER JOIN `versements` ON membership_userrecords.pkValue=versements.id SET membership_userrecords.groupID={$groupe} WHERE membership_userrecords.tableName='versements' AND versements.convention={$id_convention}", $eo);
			sql("UPDATE `membership_userrecords` INNER JOIN `lignes_credits` ON membership_userrecords.pkValue=lignes_credits.id SET membership_userrecords.groupID={$groupe} WHERE membership_userrecords.tableName='lignes_credits' AND lignes_credits.convention={$id_convention}", $eo);
			sql("UPDATE `membership_userrecords` INNER JOIN `credits` ON membership_userrecords.pkValue=credits.id SET membership_userrecords.groupID={$groupe} WHERE membership_userrecords.tableName='credits' AND credits.convention={$id_convention}", $eo);
			sql("UPDATE `membership_userrecords` INNER JOIN `ventilation` ON membership_userrecords.pkValue=ventilation.id SET membership_userrecords.groupID={$groupe} WHERE membership_userrecords.tableName='ventilation' AND ventilation.convention={$id_convention}", $eo);
			sql("UPDATE `membership_userrecords` INNER JOIN `depenses` ON membership_userrecords.pkValue=depenses.id SET membership_userrecords.groupID={$groupe} WHERE membership_userrecords.tableName='depenses' AND depenses.convention={$id_convention}", $eo);
			sql("UPDATE `membership_userrecords` INNER JOIN `fichiers` ON membership_userrecords.pkValue=fichiers.id SET membership_userrecords.groupID={$groupe} WHERE membership_userrecords.tableName='fichiers' AND fichiers.convention={$id_convention}", $eo);
			sql("UPDATE `membership_userrecords` INNER JOIN `recrutements` ON membership_userrecords.pkValue=recrutements.id SET membership_userrecords.groupID={$groupe} WHERE membership_userrecords.tableName='recrutements' AND recrutements.convention={$id_convention}", $eo);
		}

		// mise à jour convention
		$accorde_hfg = sqlValue("SELECT sum(accorde) FROM `budgets` LEFT JOIN types_ligne ON budgets.type=types_ligne.id WHERE types_ligne.frais_gestion IS NULL AND budgets.convention={$id_convention}");
		if (is_null($accorde_hfg)) $accorde_hfg = 0;
		$frais_gestion = sqlValue("SELECT sum(accorde) FROM `budgets` LEFT JOIN types_ligne ON budgets.type=types_ligne.id WHERE types_ligne.frais_gestion IS NOT NULL AND budgets.convention={$id_convention}");
		if (is_null($frais_gestion)) $frais_gestion = 0;
		$accorde = $accorde_hfg + $frais_gestion;
		$verse = sqlValue("SELECT sum(montant) FROM `versements` WHERE convention={$id_convention}");
		if (is_null($verse)) $verse = 0;
		$verse_hfg = sqlValue("SELECT sum(montant) FROM `versements` LEFT JOIN budgets ON versements.ligne_budgetaire=budgets.id LEFT JOIN types_ligne ON budgets.type = types_ligne.id WHERE types_ligne.frais_gestion IS NULL AND versements.convention={$id_convention}");
		if (is_null($verse_hfg)) $verse_hfg = 0;
		$ouvert = sqlValue("SELECT sum(montant) FROM `credits` WHERE convention={$id_convention}");
		if (is_null($ouvert)) $ouvert = 0;
		$reserve = sqlValue("SELECT sum(montant) FROM `depenses` WHERE convention={$id_convention} AND statut='réservée'");
		if (is_null($reserve)) $reserve = 0;
		$liquide = sqlValue("SELECT sum(montant) FROM `depenses` WHERE convention={$id_convention} AND statut='liquidée'");
		if (is_null($liquide)) $liquide = 0;
		$utilise = $reserve + $liquide;
		$disponible = $ouvert - $utilise;
		$reste_verser = $accorde - $verse;
		$reste_ouvrir = $verse_hfg - $ouvert;
		$reste_engager = $accorde_hfg - $utilise;
		$reservation_salaire = sqlValue("SELECT sum(reservation_salaire) FROM `recrutements` WHERE convention={$id_convention}");
		if (is_null($reservation_salaire)) $reservation_salaire = 0;
		$reste_depenser = $reste_engager - $reservation_salaire;
		$prop_uo = ($ouvert > 0) ? 100 * $utilise / $ouvert : 0;
		$prop_uv = ($verse > 0) ? 100 * $utilise / $verse : 0;
		$prop_ua = ($accorde_hfg > 0) ? 100 * $utilise / $accorde_hfg : 0;
		$budget_ventile = sqlValue("SELECT sum(accorde) FROM `ventilation` WHERE convention={$id_convention}");
		$budget_nv = $accorde_hfg - $budget_ventile;
		$depenses_nv = sqlValue("SELECT sum(montant) FROM `depenses` WHERE convention={$id_convention} AND ventilation IS NULL");
		if (is_null($depenses_nv)) $depenses_nv = 0;

		sql("UPDATE conventions SET
			accorde_hfg='{$accorde_hfg}',
			frais_gestion='{$frais_gestion}',
			accorde='{$accorde}',
			verse='{$verse}',
			verse_hfg='{$verse_hfg}',
			ouvert='{$ouvert}',
			reserve='{$reserve}',
			liquide='{$liquide}',
			utilise='{$utilise}',
			disponible='{$disponible}',
			reste_verser='{$reste_verser}',
			reste_ouvrir='{$reste_ouvrir}',
			reste_engager='{$reste_engager}',
			reservation_salaire='{$reservation_salaire}',
			reste_depenser='{$reste_depenser}',
			prop_uo='{$prop_uo}',
			prop_uv='{$prop_uv}',
			prop_ua='{$prop_ua}',
			budget_nv='{$budget_nv}',
			depenses_nv='{$depenses_nv}'
			WHERE id={$id_convention}", $eo);
	}

	function maj_budgets($id_ligne){
		$id_ligne = makeSafe($id_ligne);
		$accorde = sqlValue("SELECT accorde FROM `budgets` WHERE id={$id_ligne}");
		if (is_null($accorde)) $accorde = 0;
		$verse = sqlValue("SELECT sum(montant) FROM `versements` WHERE ligne_budgetaire={$id_ligne}");
		if (is_null($verse)) $verse = 0;

		// Est-ce une ligne du type frais de gestion ?
		$type_fg = sqlValue("SELECT types_ligne.frais_gestion FROM budgets LEFT JOIN types_ligne ON budgets.type=types_ligne.id WHERE budgets.id={$id_ligne}");
		$reste_verser = $accorde - $verse;

		if ($type_fg) {
			$ouvert = "NULL";
			$reserve = "NULL";
			$liquide = "NULL";
			$utilise = "NULL";
			$disponible = "NULL";
			$reste_ouvrir = "NULL";
			$reste_engager = "NULL";
			$prop_uo = "NULL";
			$prop_uv = "NULL";
			$prop_ua = "NULL";

		} else {
			$ouvert = sqlValue("SELECT sum(montant) FROM `credits` WHERE ligne_budgetaire={$id_ligne}");
			if (is_null($ouvert)) $ouvert = 0;
			$reserve = sqlValue("SELECT sum(montant) FROM `depenses` WHERE ligne_budgetaire={$id_ligne} AND statut='réservée'");
			if (is_null($reserve)) $reserve = 0;
			$liquide = sqlValue("SELECT sum(montant) FROM `depenses` WHERE ligne_budgetaire={$id_ligne} AND statut='liquidée'");
			if (is_null($liquide)) $liquide = 0;
			$utilise = $reserve + $liquide;
			$disponible = $ouvert - $utilise;
			$reste_ouvrir = $verse - $ouvert;
			$reste_engager = $accorde - $utilise;
			$prop_uo = ($ouvert > 0) ? 100 * $utilise / $ouvert : 0;
			$prop_uv = ($verse > 0) ? 100 * $utilise / $verse : 0;
			$prop_ua = ($accorde > 0) ? 100 * $utilise / $accorde : 0;

		}

		sql("UPDATE budgets SET
			verse={$verse},
			ouvert={$ouvert},
			reserve={$reserve},
			liquide={$liquide},
			utilise={$utilise},
			disponible={$disponible},
			reste_verser={$reste_verser},
			reste_ouvrir={$reste_ouvrir},
			reste_engager={$reste_engager},
			prop_uo={$prop_uo},
			prop_uv={$prop_uv},
			prop_ua={$prop_ua}
			WHERE id={$id_ligne}", $eo);
	}

	function maj_ventilation($id_ventilation){
		$id_ventilation = makeSafe($id_ventilation);
		$accorde = sqlValue("SELECT accorde FROM `ventilation` WHERE id={$id_ventilation}");
		$reserve = sqlValue("SELECT sum(montant) FROM `depenses` WHERE ventilation={$id_ventilation} AND statut='réservée'");
		if (is_null($reserve)) $reserve = 0;
		$liquide = sqlValue("SELECT sum(montant) FROM `depenses` WHERE ventilation={$id_ventilation} AND statut='liquidée'");
		if (is_null($liquide)) $liquide = 0;
		$utilise = $reserve + $liquide;
		$reservation_salaire = sqlValue("SELECT sum(reservation_salaire) FROM `recrutements` WHERE ventilation={$id_ventilation}");
		if (is_null($reservation_salaire)) $reservation_salaire = 0;

		if (is_null($accorde)) {
			$accorde = "NULL";
			$reste_engager = "NULL";
			$reste_depenser = "NULL";
			$prop_ua = "NULL";
		} else {
			$reste_engager = $accorde - $utilise;
			$reste_depenser = $reste_engager - $reservation_salaire;
			$prop_ua = ($accorde > 0) ? 100 * $utilise / $accorde : 0;
		}

		sql("UPDATE ventilation SET
			reserve={$reserve},
			liquide={$liquide},
			utilise={$utilise},
			reste_engager={$reste_engager},
			reservation_salaire='{$reservation_salaire}',
			reste_depenser={$reste_depenser},
			prop_ua={$prop_ua}
			WHERE id={$id_ventilation}", $eo);
	}

	function maj_ligne_credit($id_ligne){
		$id_ligne = makeSafe($id_ligne);

		$ouvert = sqlValue("SELECT sum(montant) FROM `credits` WHERE ligne_credit={$id_ligne}");
		if (is_null($ouvert)) $ouvert = 0;
		$reserve = sqlValue("SELECT sum(montant) FROM `depenses` WHERE ligne_credit={$id_ligne} AND statut='réservée'");
		if (is_null($reserve)) $reserve = 0;
		$liquide = sqlValue("SELECT sum(montant) FROM `depenses` WHERE ligne_credit={$id_ligne} AND statut='liquidée'");
		if (is_null($liquide)) $liquide = 0;
		$utilise = $reserve + $liquide;
		$disponible = $ouvert - $utilise;
		$prop_uo = ($ouvert > 0) ? 100 * $utilise / $ouvert : 0;


		sql("UPDATE lignes_credits SET
			ouvert={$ouvert},
			reserve={$reserve},
			liquide={$liquide},
			utilise={$utilise},
			disponible={$disponible},
			prop_uo={$prop_uo}
			WHERE id={$id_ligne}", $eo);
	}

function maj_recrutements($id_contrat){
	$id_contrat = makeSafe($id_contrat);

	$beneficiaire = sqlValue("SELECT beneficiaire FROM `recrutements` WHERE id={$id_contrat}");
	$ventilation = sqlValue("SELECT ventilation FROM `recrutements` WHERE id={$id_contrat}");
  if (is_null($beneficiaire)) $beneficiaire = "NULL";
	if (is_null($ventilation)) $ventilation = "NULL";
	sql("UPDATE `depenses` SET depenses.beneficiaire={$beneficiaire}, depenses.ventilation={$ventilation} WHERE depenses.contrat={$id_contrat}", $eo);

	$previsionnel = sqlValue("SELECT previsionnel FROM `recrutements` WHERE id={$id_contrat}");
	$depense = sqlValue("SELECT sum(montant) FROM `depenses` WHERE contrat={$id_contrat}");
	if (is_null($depense)) $depense = 0;

	if (!is_null($previsionnel) & $previsionnel > 0) {
		$reservation_salaire = $previsionnel - $depense;
		$prop_dp = 100 * $depense / $previsionnel;
	} else {
		$reservation_salaire = "NULL";
		$prop_dp = "NULL";
	}

	sql("UPDATE recrutements SET
		depense={$depense},
		reservation_salaire={$reservation_salaire},
		prop_dp={$prop_dp}
		WHERE id={$id_contrat}", $eo);
}
