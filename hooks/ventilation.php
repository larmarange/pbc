<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function ventilation_init(&$options, $memberInfo, &$args){

		return TRUE;
	}

	function ventilation_header($contentType, $memberInfo, &$args){
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

	function ventilation_footer($contentType, $memberInfo, &$args){
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

	function ventilation_before_insert(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function ventilation_after_insert($data, $memberInfo, &$args){
		if ($data['convention']) maj_convention($data['convention']);
		maj_ventilation($data['id']);
		
		return TRUE;
	}

	function ventilation_before_update(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function ventilation_after_update($data, $memberInfo, &$args){
		if ($data['convention']) maj_convention($data['convention']);
		maj_ventilation($data['id']);

		return TRUE;
	}

	function ventilation_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){
		$selectedID = makeSafe($selectedID);
		$GLOBALS['maj_ convention'] = sqlValue("select convention from ventilation where id='{$selectedID}'", $eo);

		return TRUE;
	}

	function ventilation_after_delete($selectedID, $memberInfo, &$args){
		if ($GLOBALS['maj_ convention']) maj_convention($GLOBALS['maj_ convention']);

	}

	function ventilation_dv($selectedID, $memberInfo, &$html, &$args){

	}

	function ventilation_csv($query, $memberInfo, &$args){

		return $query;
	}
	function ventilation_batch_actions(&$args){

		return array();
	}
