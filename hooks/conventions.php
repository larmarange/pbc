<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function conventions_init(&$options, $memberInfo, &$args){

		return TRUE;
	}

	function conventions_header($contentType, $memberInfo, &$args){
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

	function conventions_footer($contentType, $memberInfo, &$args){
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

	function conventions_before_insert(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function conventions_after_insert($data, $memberInfo, &$args){
		maj_convention($data['id'], false);

		return TRUE;
	}

	function conventions_before_update(&$data, $memberInfo, &$args){
		// Calcul de la durée de la convention
		if (is_null($data['date_debut']) OR is_null($data['date_fin']))
			$data['duree'] = "";
		else
			$data['duree'] = dateDifference($data['date_debut'], $data['date_fin']);
		
		return TRUE;
	}

	function conventions_after_update($data, $memberInfo, &$args){
		maj_convention($data['id']);
		
		return TRUE;
	}

	function conventions_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){

		return TRUE;
	}

	function conventions_after_delete($selectedID, $memberInfo, &$args){

	}

	function conventions_dv($selectedID, $memberInfo, &$html, &$args){

	}

	function conventions_csv($query, $memberInfo, &$args){

		return $query;
	}
	function conventions_batch_actions(&$args){

		return array();
	}
