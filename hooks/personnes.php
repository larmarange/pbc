<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function personnes_init(&$options, $memberInfo, &$args){
		/* Inserted by Search Page Maker for AppGini on 2019-07-10 12:50:29 */
		$options->FilterPage = 'hooks/personnes_filter.php';
		/* End of Search Page Maker for AppGini code */


		return TRUE;
	}

	function personnes_header($contentType, $memberInfo, &$args){
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

	function personnes_footer($contentType, $memberInfo, &$args){
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

	function personnes_before_insert(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function personnes_after_insert($data, $memberInfo, &$args){

		return TRUE;
	}

	function personnes_before_update(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function personnes_after_update($data, $memberInfo, &$args){

		return TRUE;
	}

	function personnes_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){

		return TRUE;
	}

	function personnes_after_delete($selectedID, $memberInfo, &$args){

	}

	function personnes_dv($selectedID, $memberInfo, &$html, &$args){

	}

	function personnes_csv($query, $memberInfo, &$args){

		return $query;
	}
	function personnes_batch_actions(&$args){

		return array();
	}
