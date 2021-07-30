<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/budgets.php");
	include_once("{$currDir}/budgets_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('budgets');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'budgets';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`budgets`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Type */" => "type",
		"`budgets`.`precision`" => "precision",
		"CONCAT('<span style=''color: ', IF(`budgets`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"if(CHAR_LENGTH(`budgets`.`notes`)>80, concat(left(`budgets`.`notes`,80),' ...'), `budgets`.`notes`)" => "notes",
		"CONCAT('<span style=''color: ', IF(`budgets`.`verse` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`verse`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "verse",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_verser` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_verser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_verser",
		"CONCAT('<span style=''color: ', IF(`budgets`.`ouvert` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`ouvert`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "ouvert",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_ouvrir` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_ouvrir`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_ouvrir",
		"CONCAT('<span style=''color: ', IF(`budgets`.`non_liquide` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`non_liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "non_liquide",
		"CONCAT('<span style=''color: ', IF(`budgets`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`budgets`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`budgets`.`disponible` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`disponible`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "disponible",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_uo` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_uo`, 0, 'ru_RU'), '%</span>')" => "prop_uo",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_uv` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_uv`, 0, 'ru_RU'), '%</span>')" => "prop_uv",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`budgets`.`id`',
		2 => '`conventions1`.`nom`',
		3 => 3,
		4 => 4,
		5 => '`budgets`.`accorde`',
		6 => 6,
		7 => '`budgets`.`verse`',
		8 => '`budgets`.`reste_verser`',
		9 => '`budgets`.`ouvert`',
		10 => '`budgets`.`reste_ouvrir`',
		11 => '`budgets`.`non_liquide`',
		12 => '`budgets`.`liquide`',
		13 => '`budgets`.`utilise`',
		14 => '`budgets`.`disponible`',
		15 => '`budgets`.`reste_engager`',
		16 => '`budgets`.`reservation_salaire`',
		17 => '`budgets`.`reste_depenser`',
		18 => '`budgets`.`prop_uo`',
		19 => '`budgets`.`prop_uv`',
		20 => '`budgets`.`prop_ua`',
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`budgets`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Type */" => "type",
		"`budgets`.`precision`" => "precision",
		"CONCAT('<span style=''color: ', IF(`budgets`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"`budgets`.`notes`" => "notes",
		"CONCAT('<span style=''color: ', IF(`budgets`.`verse` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`verse`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "verse",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_verser` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_verser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_verser",
		"CONCAT('<span style=''color: ', IF(`budgets`.`ouvert` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`ouvert`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "ouvert",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_ouvrir` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_ouvrir`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_ouvrir",
		"CONCAT('<span style=''color: ', IF(`budgets`.`non_liquide` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`non_liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "non_liquide",
		"CONCAT('<span style=''color: ', IF(`budgets`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`budgets`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`budgets`.`disponible` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`disponible`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "disponible",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_uo` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_uo`, 0, 'ru_RU'), '%</span>')" => "prop_uo",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_uv` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_uv`, 0, 'ru_RU'), '%</span>')" => "prop_uv",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`budgets`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "Convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Type */" => "Type",
		"`budgets`.`precision`" => "Pr&#233;cision",
		"`budgets`.`accorde`" => "Accord&#233;",
		"`budgets`.`notes`" => "Notes",
		"`budgets`.`verse`" => "Vers&#233;",
		"`budgets`.`reste_verser`" => "Reste &#224; Verser",
		"`budgets`.`ouvert`" => "Ouvert",
		"`budgets`.`reste_ouvrir`" => "Reste &#224; Ouvrir",
		"`budgets`.`non_liquide`" => "Non Liquid&#233;",
		"`budgets`.`liquide`" => "Liquid&#233;",
		"`budgets`.`utilise`" => "Utilis&#233;",
		"`budgets`.`disponible`" => "Disponible",
		"`budgets`.`reste_engager`" => "Reste &#224; Engager",
		"`budgets`.`reservation_salaire`" => "Salaires restant &#224; verser",
		"`budgets`.`reste_depenser`" => "Reste &#224; D&#233;penser",
		"`budgets`.`prop_uo`" => "U/O (%)",
		"`budgets`.`prop_uv`" => "U/V (%)",
		"`budgets`.`prop_ua`" => "U/A (%)",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`budgets`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Type */" => "type",
		"`budgets`.`precision`" => "precision",
		"CONCAT('<span style=''color: ', IF(`budgets`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"`budgets`.`notes`" => "Notes",
		"CONCAT('<span style=''color: ', IF(`budgets`.`verse` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`verse`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "verse",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_verser` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_verser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_verser",
		"CONCAT('<span style=''color: ', IF(`budgets`.`ouvert` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`ouvert`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "ouvert",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_ouvrir` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_ouvrir`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_ouvrir",
		"CONCAT('<span style=''color: ', IF(`budgets`.`non_liquide` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`non_liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "non_liquide",
		"CONCAT('<span style=''color: ', IF(`budgets`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`budgets`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`budgets`.`disponible` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`disponible`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "disponible",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_uo` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_uo`, 0, 'ru_RU'), '%</span>')" => "prop_uo",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_uv` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_uv`, 0, 'ru_RU'), '%</span>')" => "prop_uv",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['convention' => 'Convention', 'type' => 'Type', ];

	$x->QueryFrom = "`budgets` LEFT JOIN `conventions` as conventions1 ON `conventions1`.`id`=`budgets`.`convention` LEFT JOIN `types_ligne` as types_ligne1 ON `types_ligne1`.`id`=`budgets`.`type` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 50;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'budgets_view.php';
	$x->RedirectAfterInsert = 'budgets_view.php';
	$x->TableTitle = 'Lignes budg&#233;taires';
	$x->TableIcon = 'resources/table_icons/006-business.png';
	$x->PrimaryKey = '`budgets`.`id`';
	$x->DefaultSortField = '3';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Convention', 'Type', 'Pr&#233;cision', 'Accord&#233;', 'Notes', 'Vers&#233;', 'Reste &#224; Verser', 'Ouvert', 'Reste &#224; Ouvrir', 'Non Liquid&#233;', 'Liquid&#233;', 'Utilis&#233;', 'Disponible', 'Reste &#224; Engager', 'Salaires restant &#224; verser', 'Reste &#224; D&#233;penser', 'U/O (%)', 'U/V (%)', 'U/A (%)', ];
	$x->ColFieldName = ['convention', 'type', 'precision', 'accorde', 'notes', 'verse', 'reste_verser', 'ouvert', 'reste_ouvrir', 'non_liquide', 'liquide', 'utilise', 'disponible', 'reste_engager', 'reservation_salaire', 'reste_depenser', 'prop_uo', 'prop_uv', 'prop_ua', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/budgets_templateTV.html';
	$x->SelectedTemplate = 'templates/budgets_templateTVS.html';
	$x->TemplateDV = 'templates/budgets_templateDV.html';
	$x->TemplateDVP = 'templates/budgets_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: budgets_init
	$render = true;
	if(function_exists('budgets_init')) {
		$args = [];
		$render = budgets_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// column sums
	if(strpos($x->HTML, '<!-- tv data below -->')) {
		// if printing multi-selection TV, calculate the sum only for the selected records
		if(isset($_REQUEST['Print_x']) && is_array($_REQUEST['record_selector'])) {
			$QueryWhere = '';
			foreach($_REQUEST['record_selector'] as $id) {   // get selected records
				if($id != '') $QueryWhere .= "'" . makeSafe($id) . "',";
			}
			if($QueryWhere != '') {
				$QueryWhere = 'where `budgets`.`id` in ('.substr($QueryWhere, 0, -1).')';
			} else { // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		} else {
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "SELECT CONCAT('<span style=''color: ', IF(SUM(`budgets`.`accorde`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`budgets`.`accorde`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`budgets`.`verse`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`budgets`.`verse`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`budgets`.`reste_verser`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`budgets`.`reste_verser`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`budgets`.`ouvert`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`budgets`.`ouvert`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`budgets`.`reste_ouvrir`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`budgets`.`reste_ouvrir`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`budgets`.`non_liquide`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`budgets`.`non_liquide`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`budgets`.`liquide`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`budgets`.`liquide`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`budgets`.`utilise`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`budgets`.`utilise`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`budgets`.`disponible`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`budgets`.`disponible`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`budgets`.`reste_engager`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`budgets`.`reste_engager`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`budgets`.`reservation_salaire`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`budgets`.`reservation_salaire`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`budgets`.`reste_depenser`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`budgets`.`reste_depenser`), 2, 'ru_RU'), '&nbsp;&euro;</span>') FROM {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)) {
			$sumRow = '<tr class="success sum">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<th class="text-center sum">&sum;</th>';
			$sumRow .= '<td class="budgets-convention sum"></td>';
			$sumRow .= '<td class="budgets-type sum"></td>';
			$sumRow .= '<td class="budgets-precision sum"></td>';
			$sumRow .= "<td class=\"budgets-accorde text-right sum\">{$row[0]}</td>";
			$sumRow .= '<td class="budgets-notes sum"></td>';
			$sumRow .= "<td class=\"budgets-verse text-right sum\">{$row[1]}</td>";
			$sumRow .= "<td class=\"budgets-reste_verser text-right sum\">{$row[2]}</td>";
			$sumRow .= "<td class=\"budgets-ouvert text-right sum\">{$row[3]}</td>";
			$sumRow .= "<td class=\"budgets-reste_ouvrir text-right sum\">{$row[4]}</td>";
			$sumRow .= "<td class=\"budgets-non_liquide text-right sum\">{$row[5]}</td>";
			$sumRow .= "<td class=\"budgets-liquide text-right sum\">{$row[6]}</td>";
			$sumRow .= "<td class=\"budgets-utilise text-right sum\">{$row[7]}</td>";
			$sumRow .= "<td class=\"budgets-disponible text-right sum\">{$row[8]}</td>";
			$sumRow .= "<td class=\"budgets-reste_engager text-right sum\">{$row[9]}</td>";
			$sumRow .= "<td class=\"budgets-reservation_salaire text-right sum\">{$row[10]}</td>";
			$sumRow .= "<td class=\"budgets-reste_depenser text-right sum\">{$row[11]}</td>";
			$sumRow .= '<td class="budgets-prop_uo sum"></td>';
			$sumRow .= '<td class="budgets-prop_uv sum"></td>';
			$sumRow .= '<td class="budgets-prop_ua sum"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: budgets_header
	$headerCode = '';
	if(function_exists('budgets_header')) {
		$args = [];
		$headerCode = budgets_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: budgets_footer
	$footerCode = '';
	if(function_exists('budgets_footer')) {
		$args = [];
		$footerCode = budgets_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
