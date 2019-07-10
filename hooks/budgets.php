<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function budgets_init(&$options, $memberInfo, &$args){
		/* Inserted by Search Page Maker for AppGini on 2019-07-10 12:50:28 */
		$options->FilterPage = 'hooks/budgets_filter.php';
		/* End of Search Page Maker for AppGini code */


		return TRUE;
	}

	function budgets_header($contentType, $memberInfo, &$args){
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

	function budgets_footer($contentType, $memberInfo, &$args){
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

	function budgets_before_insert(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function budgets_after_insert($data, $memberInfo, &$args){
		if ($data['convention']) maj_convention($data['convention']);
		maj_budgets($data['id']);
		
		return TRUE;
	}

	function budgets_before_update(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function budgets_after_update($data, $memberInfo, &$args){
		if ($data['convention']) maj_convention($data['convention']);
		maj_budgets($data['id']);

		return TRUE;
	}

	function budgets_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){
		$selectedID = makeSafe($selectedID);
		$GLOBALS['maj_convention'] = sqlValue("select convention from budgets where id='{$selectedID}'", $eo);
	
		return TRUE;
	}

	function budgets_after_delete($selectedID, $memberInfo, &$args){
		if ($GLOBALS['maj_convention']) maj_convention($GLOBALS['maj_convention']);
	}

	function budgets_dv($selectedID, $memberInfo, &$html, &$args){

	}

	function budgets_csv($query, $memberInfo, &$args){

		return $query;
	}
	function budgets_batch_actions(&$args){

		return array();
	}
