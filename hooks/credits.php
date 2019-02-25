<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function credits_init(&$options, $memberInfo, &$args){

		return TRUE;
	}

	function credits_header($contentType, $memberInfo, &$args){
		$header='';

		switch($contentType){
			case 'tableview':
				$header='';
				break;

			case 'detailview':
				$header='';
				break;

			case 'tableview+detailview':
				$header='';
				break;

			case 'print-tableview':
				$header='';
				break;

			case 'print-detailview':
				$header='';
				break;

			case 'filters':
				$header='';
				break;
		}

		return $header;
	}

	function credits_footer($contentType, $memberInfo, &$args){
		$footer='';

		switch($contentType){
			case 'tableview':
				$footer='';
				break;

			case 'detailview':
				$footer='';
				break;

			case 'tableview+detailview':
				$footer='';
				break;

			case 'print-tableview':
				$footer='';
				break;

			case 'print-detailview':
				$footer='';
				break;

			case 'filters':
				$footer='';
				break;
		}

		return $footer;
	}

	function credits_before_insert(&$data, $memberInfo, &$args){
		$ligne_budgetaire = sqlValue("SELECT ligne_budgetaire FROM lignes_credits WHERE id={$data['ligne_credit']}");
		if($ligne_budgetaire) $data['ligne_budgetaire'] = $ligne_budgetaire; else return FALSE;

		return TRUE;
	}

	function credits_after_insert($data, $memberInfo, &$args){
		if ($data['convention']) maj_convention($data['convention']);
		
		return TRUE;
	}

	function credits_before_update(&$data, $memberInfo, &$args){
		$ligne_budgetaire = sqlValue("SELECT ligne_budgetaire FROM lignes_credits WHERE id={$data['ligne_credit']}");
		if($ligne_budgetaire) $data['ligne_budgetaire'] = $ligne_budgetaire; else return FALSE;

		return TRUE;
	}

	function credits_after_update($data, $memberInfo, &$args){
		if ($data['convention']) maj_convention($data['convention']);
		
		return TRUE;
	}

	function credits_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){
		$selectedID = makeSafe($selectedID);
		$GLOBALS['maj_convention'] = sqlValue("select convention from credits where id='{$selectedID}'", $eo);
		
		return TRUE;
	}

	function credits_after_delete($selectedID, $memberInfo, &$args){
		if ($GLOBALS['maj_convention']) maj_convention($GLOBALS['maj_convention']);
		
	}

	function credits_dv($selectedID, $memberInfo, &$html, &$args){

	}

	function credits_csv($query, $memberInfo, &$args){

		return $query;
	}
	function credits_batch_actions(&$args){

		return array();
	}
