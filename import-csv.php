<?php
	define('PREPEND_PATH', '');
	$app_dir = dirname(__FILE__);
	include_once("{$app_dir}/lib.php");

	// accept a record as an assoc array, return transformed row ready to insert to table
	$transformFunctions = [
		'conventions' => function($data, $options = []) {
			if(isset($data['porteur'])) $data['porteur'] = pkGivenLookupText($data['porteur'], 'conventions', 'porteur');
			if(isset($data['chef_projet'])) $data['chef_projet'] = pkGivenLookupText($data['chef_projet'], 'conventions', 'chef_projet');
			if(isset($data['date_reponse'])) $data['date_reponse'] = guessMySQLDateTime($data['date_reponse']);
			if(isset($data['demande'])) $data['demande'] = preg_replace('/[^\d\.]/', '', $data['demande']);
			if(isset($data['date_debut'])) $data['date_debut'] = guessMySQLDateTime($data['date_debut']);
			if(isset($data['date_fin'])) $data['date_fin'] = guessMySQLDateTime($data['date_fin']);
			if(isset($data['accorde_hfg'])) $data['accorde_hfg'] = preg_replace('/[^\d\.]/', '', $data['accorde_hfg']);
			if(isset($data['frais_gestion'])) $data['frais_gestion'] = preg_replace('/[^\d\.]/', '', $data['frais_gestion']);
			if(isset($data['accorde'])) $data['accorde'] = preg_replace('/[^\d\.]/', '', $data['accorde']);
			if(isset($data['verse'])) $data['verse'] = preg_replace('/[^\d\.]/', '', $data['verse']);
			if(isset($data['reste_verser'])) $data['reste_verser'] = preg_replace('/[^\d\.]/', '', $data['reste_verser']);
			if(isset($data['verse_hfg'])) $data['verse_hfg'] = preg_replace('/[^\d\.]/', '', $data['verse_hfg']);
			if(isset($data['ouvert'])) $data['ouvert'] = preg_replace('/[^\d\.]/', '', $data['ouvert']);
			if(isset($data['reste_ouvrir'])) $data['reste_ouvrir'] = preg_replace('/[^\d\.]/', '', $data['reste_ouvrir']);
			if(isset($data['non_liquide'])) $data['non_liquide'] = preg_replace('/[^\d\.]/', '', $data['non_liquide']);
			if(isset($data['liquide'])) $data['liquide'] = preg_replace('/[^\d\.]/', '', $data['liquide']);
			if(isset($data['utilise'])) $data['utilise'] = preg_replace('/[^\d\.]/', '', $data['utilise']);
			if(isset($data['disponible'])) $data['disponible'] = preg_replace('/[^\d\.]/', '', $data['disponible']);
			if(isset($data['reste_engager'])) $data['reste_engager'] = preg_replace('/[^\d\.]/', '', $data['reste_engager']);
			if(isset($data['reservation_salaire'])) $data['reservation_salaire'] = preg_replace('/[^\d\.]/', '', $data['reservation_salaire']);
			if(isset($data['reste_depenser'])) $data['reste_depenser'] = preg_replace('/[^\d\.]/', '', $data['reste_depenser']);
			if(isset($data['prop_uo'])) $data['prop_uo'] = preg_replace('/[^\d\.]/', '', $data['prop_uo']);
			if(isset($data['prop_uv'])) $data['prop_uv'] = preg_replace('/[^\d\.]/', '', $data['prop_uv']);
			if(isset($data['prop_ua'])) $data['prop_ua'] = preg_replace('/[^\d\.]/', '', $data['prop_ua']);
			if(isset($data['budget_nv'])) $data['budget_nv'] = preg_replace('/[^\d\.]/', '', $data['budget_nv']);
			if(isset($data['depenses_nv'])) $data['depenses_nv'] = preg_replace('/[^\d\.]/', '', $data['depenses_nv']);

			return $data;
		},
		'budgets' => function($data, $options = []) {
			if(isset($data['convention'])) $data['convention'] = pkGivenLookupText($data['convention'], 'budgets', 'convention');
			if(isset($data['type'])) $data['type'] = pkGivenLookupText($data['type'], 'budgets', 'type');
			if(isset($data['accorde'])) $data['accorde'] = preg_replace('/[^\d\.]/', '', $data['accorde']);
			if(isset($data['verse'])) $data['verse'] = preg_replace('/[^\d\.]/', '', $data['verse']);
			if(isset($data['reste_verser'])) $data['reste_verser'] = preg_replace('/[^\d\.]/', '', $data['reste_verser']);
			if(isset($data['ouvert'])) $data['ouvert'] = preg_replace('/[^\d\.]/', '', $data['ouvert']);
			if(isset($data['reste_ouvrir'])) $data['reste_ouvrir'] = preg_replace('/[^\d\.]/', '', $data['reste_ouvrir']);
			if(isset($data['non_liquide'])) $data['non_liquide'] = preg_replace('/[^\d\.]/', '', $data['non_liquide']);
			if(isset($data['liquide'])) $data['liquide'] = preg_replace('/[^\d\.]/', '', $data['liquide']);
			if(isset($data['utilise'])) $data['utilise'] = preg_replace('/[^\d\.]/', '', $data['utilise']);
			if(isset($data['disponible'])) $data['disponible'] = preg_replace('/[^\d\.]/', '', $data['disponible']);
			if(isset($data['reste_engager'])) $data['reste_engager'] = preg_replace('/[^\d\.]/', '', $data['reste_engager']);
			if(isset($data['reservation_salaire'])) $data['reservation_salaire'] = preg_replace('/[^\d\.]/', '', $data['reservation_salaire']);
			if(isset($data['reste_depenser'])) $data['reste_depenser'] = preg_replace('/[^\d\.]/', '', $data['reste_depenser']);
			if(isset($data['prop_uo'])) $data['prop_uo'] = preg_replace('/[^\d\.]/', '', $data['prop_uo']);
			if(isset($data['prop_uv'])) $data['prop_uv'] = preg_replace('/[^\d\.]/', '', $data['prop_uv']);
			if(isset($data['prop_ua'])) $data['prop_ua'] = preg_replace('/[^\d\.]/', '', $data['prop_ua']);

			return $data;
		},
		'versements' => function($data, $options = []) {
			if(isset($data['convention'])) $data['convention'] = pkGivenLookupText($data['convention'], 'versements', 'convention');
			if(isset($data['ligne_budgetaire'])) $data['ligne_budgetaire'] = pkGivenLookupText($data['ligne_budgetaire'], 'versements', 'ligne_budgetaire');
			if(isset($data['date'])) $data['date'] = guessMySQLDateTime($data['date']);
			if(isset($data['montant'])) $data['montant'] = preg_replace('/[^\d\.]/', '', $data['montant']);

			return $data;
		},
		'lignes_credits' => function($data, $options = []) {
			if(isset($data['convention'])) $data['convention'] = pkGivenLookupText($data['convention'], 'lignes_credits', 'convention');
			if(isset($data['ligne_budgetaire'])) $data['ligne_budgetaire'] = pkGivenLookupText($data['ligne_budgetaire'], 'lignes_credits', 'ligne_budgetaire');
			if(isset($data['ouvert'])) $data['ouvert'] = preg_replace('/[^\d\.]/', '', $data['ouvert']);
			if(isset($data['non_liquide'])) $data['non_liquide'] = preg_replace('/[^\d\.]/', '', $data['non_liquide']);
			if(isset($data['liquide'])) $data['liquide'] = preg_replace('/[^\d\.]/', '', $data['liquide']);
			if(isset($data['utilise'])) $data['utilise'] = preg_replace('/[^\d\.]/', '', $data['utilise']);
			if(isset($data['disponible'])) $data['disponible'] = preg_replace('/[^\d\.]/', '', $data['disponible']);
			if(isset($data['prop_uo'])) $data['prop_uo'] = preg_replace('/[^\d\.]/', '', $data['prop_uo']);

			return $data;
		},
		'credits' => function($data, $options = []) {
			if(isset($data['convention'])) $data['convention'] = pkGivenLookupText($data['convention'], 'credits', 'convention');
			if(isset($data['ligne_budgetaire'])) $data['ligne_budgetaire'] = pkGivenLookupText($data['ligne_budgetaire'], 'credits', 'ligne_budgetaire');
			if(isset($data['ligne_credit'])) $data['ligne_credit'] = pkGivenLookupText($data['ligne_credit'], 'credits', 'ligne_credit');
			if(isset($data['date'])) $data['date'] = guessMySQLDateTime($data['date']);
			if(isset($data['montant'])) $data['montant'] = preg_replace('/[^\d\.]/', '', $data['montant']);

			return $data;
		},
		'rubriques' => function($data, $options = []) {
			if(isset($data['convention'])) $data['convention'] = pkGivenLookupText($data['convention'], 'rubriques', 'convention');
			if(isset($data['accorde'])) $data['accorde'] = preg_replace('/[^\d\.]/', '', $data['accorde']);
			if(isset($data['non_liquide'])) $data['non_liquide'] = preg_replace('/[^\d\.]/', '', $data['non_liquide']);
			if(isset($data['liquide'])) $data['liquide'] = preg_replace('/[^\d\.]/', '', $data['liquide']);
			if(isset($data['utilise'])) $data['utilise'] = preg_replace('/[^\d\.]/', '', $data['utilise']);
			if(isset($data['reste_engager'])) $data['reste_engager'] = preg_replace('/[^\d\.]/', '', $data['reste_engager']);
			if(isset($data['reservation_salaire'])) $data['reservation_salaire'] = preg_replace('/[^\d\.]/', '', $data['reservation_salaire']);
			if(isset($data['reste_depenser'])) $data['reste_depenser'] = preg_replace('/[^\d\.]/', '', $data['reste_depenser']);
			if(isset($data['prop_ua'])) $data['prop_ua'] = preg_replace('/[^\d\.]/', '', $data['prop_ua']);

			return $data;
		},
		'ventilation' => function($data, $options = []) {
			if(isset($data['convention'])) $data['convention'] = pkGivenLookupText($data['convention'], 'ventilation', 'convention');
			if(isset($data['rubrique'])) $data['rubrique'] = pkGivenLookupText($data['rubrique'], 'ventilation', 'rubrique');
			if(isset($data['accorde'])) $data['accorde'] = preg_replace('/[^\d\.]/', '', $data['accorde']);
			if(isset($data['non_liquide'])) $data['non_liquide'] = preg_replace('/[^\d\.]/', '', $data['non_liquide']);
			if(isset($data['liquide'])) $data['liquide'] = preg_replace('/[^\d\.]/', '', $data['liquide']);
			if(isset($data['utilise'])) $data['utilise'] = preg_replace('/[^\d\.]/', '', $data['utilise']);
			if(isset($data['reste_engager'])) $data['reste_engager'] = preg_replace('/[^\d\.]/', '', $data['reste_engager']);
			if(isset($data['reservation_salaire'])) $data['reservation_salaire'] = preg_replace('/[^\d\.]/', '', $data['reservation_salaire']);
			if(isset($data['reste_depenser'])) $data['reste_depenser'] = preg_replace('/[^\d\.]/', '', $data['reste_depenser']);
			if(isset($data['prop_ua'])) $data['prop_ua'] = preg_replace('/[^\d\.]/', '', $data['prop_ua']);

			return $data;
		},
		'recrutements' => function($data, $options = []) {
			if(isset($data['convention'])) $data['convention'] = pkGivenLookupText($data['convention'], 'recrutements', 'convention');
			if(isset($data['beneficiaire'])) $data['beneficiaire'] = pkGivenLookupText($data['beneficiaire'], 'recrutements', 'beneficiaire');
			if(isset($data['date_debut'])) $data['date_debut'] = guessMySQLDateTime($data['date_debut']);
			if(isset($data['date_fin'])) $data['date_fin'] = guessMySQLDateTime($data['date_fin']);
			if(isset($data['ligne_budgetaire'])) $data['ligne_budgetaire'] = pkGivenLookupText($data['ligne_budgetaire'], 'recrutements', 'ligne_budgetaire');
			if(isset($data['ventilation'])) $data['ventilation'] = pkGivenLookupText($data['ventilation'], 'recrutements', 'ventilation');
			if(isset($data['previsionnel'])) $data['previsionnel'] = preg_replace('/[^\d\.]/', '', $data['previsionnel']);
			if(isset($data['depense'])) $data['depense'] = preg_replace('/[^\d\.]/', '', $data['depense']);
			if(isset($data['reservation_salaire'])) $data['reservation_salaire'] = preg_replace('/[^\d\.]/', '', $data['reservation_salaire']);
			if(isset($data['prop_dp'])) $data['prop_dp'] = preg_replace('/[^\d\.]/', '', $data['prop_dp']);

			return $data;
		},
		'depenses' => function($data, $options = []) {
			if(isset($data['convention'])) $data['convention'] = pkGivenLookupText($data['convention'], 'depenses', 'convention');
			if(isset($data['ligne_budgetaire'])) $data['ligne_budgetaire'] = pkGivenLookupText($data['ligne_budgetaire'], 'depenses', 'ligne_budgetaire');
			if(isset($data['ligne_credit'])) $data['ligne_credit'] = pkGivenLookupText($data['ligne_credit'], 'depenses', 'ligne_credit');
			if(isset($data['date'])) $data['date'] = guessMySQLDateTime($data['date']);
			if(isset($data['contrat'])) $data['contrat'] = pkGivenLookupText($data['contrat'], 'depenses', 'contrat');
			if(isset($data['beneficiaire'])) $data['beneficiaire'] = pkGivenLookupText($data['beneficiaire'], 'depenses', 'beneficiaire');
			if(isset($data['montant'])) $data['montant'] = preg_replace('/[^\d\.]/', '', $data['montant']);
			if(isset($data['ventilation'])) $data['ventilation'] = pkGivenLookupText($data['ventilation'], 'depenses', 'ventilation');

			return $data;
		},
		'fichiers' => function($data, $options = []) {
			if(isset($data['convention'])) $data['convention'] = pkGivenLookupText($data['convention'], 'fichiers', 'convention');

			return $data;
		},
		'personnes' => function($data, $options = []) {

			return $data;
		},
		'types_ligne' => function($data, $options = []) {

			return $data;
		},
	];

	// accept a record as an assoc array, return a boolean indicating whether to import or skip record
	$filterFunctions = [
		'conventions' => function($data, $options = []) { return true; },
		'budgets' => function($data, $options = []) { return true; },
		'versements' => function($data, $options = []) { return true; },
		'lignes_credits' => function($data, $options = []) { return true; },
		'credits' => function($data, $options = []) { return true; },
		'rubriques' => function($data, $options = []) { return true; },
		'ventilation' => function($data, $options = []) { return true; },
		'recrutements' => function($data, $options = []) { return true; },
		'depenses' => function($data, $options = []) { return true; },
		'fichiers' => function($data, $options = []) { return true; },
		'personnes' => function($data, $options = []) { return true; },
		'types_ligne' => function($data, $options = []) { return true; },
	];

	/*
	Hook file for overwriting/amending $transformFunctions and $filterFunctions:
	hooks/import-csv.php
	If found, it's included below

	The way this works is by either completely overwriting any of the above 2 arrays,
	or, more commonly, overwriting a single function, for example:
		$transformFunctions['tablename'] = function($data, $options = []) {
			// new definition here
			// then you must return transformed data
			return $data;
		};

	Another scenario is transforming a specific field and leaving other fields to the default
	transformation. One possible way of doing this is to store the original transformation function
	in GLOBALS array, calling it inside the custom transformation function, then modifying the
	specific field:
		$GLOBALS['originalTransformationFunction'] = $transformFunctions['tablename'];
		$transformFunctions['tablename'] = function($data, $options = []) {
			$data = call_user_func_array($GLOBALS['originalTransformationFunction'], [$data, $options]);
			$data['fieldname'] = 'transformed value';
			return $data;
		};
	*/

	@include("{$app_dir}/hooks/import-csv.php");

	$ui = new CSVImportUI($transformFunctions, $filterFunctions);
