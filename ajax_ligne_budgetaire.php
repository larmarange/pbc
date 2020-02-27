<?php
	$curr_dir = dirname(__FILE__);
	include("$curr_dir/defaultLang.php");
	include("$curr_dir/language.php");
	include("$curr_dir/lib.php");

	handle_maintenance();

	if (isset($_REQUEST['ligne_credit'])) {
		$ligne_credit = makeSafe(from_utf8($_REQUEST['ligne_credit']));
		$ret = sqlValue("SELECT CONCAT_WS(' - ', types_ligne.gestionnaire, types_ligne.type, budgets.precision) FROM lignes_credits LEFT JOIN budgets ON lignes_credits.ligne_budgetaire=budgets.id LEFT JOIN types_ligne ON types_ligne.id=budgets.type WHERE lignes_credits.id={$ligne_credit}");
		echo($ret);
	}
