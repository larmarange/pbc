<?php
// This script and data application were generated by AppGini 5.92
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/ventilation.php");
	include_once("{$currDir}/ventilation_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('ventilation');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = 'ventilation';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`ventilation`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`rubriques1`.`intitule`), CONCAT_WS('',   `rubriques1`.`intitule`), '') /* Rubrique de Ventilation */" => "rubrique",
		"`ventilation`.`intitule`" => "intitule",
		"if(CHAR_LENGTH(`ventilation`.`notes`)>80, concat(left(`ventilation`.`notes`,80),' ...'), `ventilation`.`notes`)" => "notes",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`non_liquide` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`non_liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "non_liquide",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`ventilation`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`ventilation`.`id`',
		2 => '`conventions1`.`nom`',
		3 => '`rubriques1`.`intitule`',
		4 => 4,
		5 => 5,
		6 => '`ventilation`.`accorde`',
		7 => '`ventilation`.`non_liquide`',
		8 => '`ventilation`.`liquide`',
		9 => '`ventilation`.`utilise`',
		10 => '`ventilation`.`reste_engager`',
		11 => '`ventilation`.`reservation_salaire`',
		12 => '`ventilation`.`reste_depenser`',
		13 => '`ventilation`.`prop_ua`',
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`ventilation`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`rubriques1`.`intitule`), CONCAT_WS('',   `rubriques1`.`intitule`), '') /* Rubrique de Ventilation */" => "rubrique",
		"`ventilation`.`intitule`" => "intitule",
		"`ventilation`.`notes`" => "notes",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`non_liquide` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`non_liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "non_liquide",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`ventilation`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`ventilation`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "Convention",
		"IF(    CHAR_LENGTH(`rubriques1`.`intitule`), CONCAT_WS('',   `rubriques1`.`intitule`), '') /* Rubrique de Ventilation */" => "Rubrique de Ventilation",
		"`ventilation`.`intitule`" => "Intitul&#233;",
		"`ventilation`.`notes`" => "Notes",
		"`ventilation`.`accorde`" => "Pr&#233;visionnel",
		"`ventilation`.`non_liquide`" => "Non Liquid&#233;",
		"`ventilation`.`liquide`" => "Liquid&#233;",
		"`ventilation`.`utilise`" => "Utilis&#233;",
		"`ventilation`.`reste_engager`" => "Reste &#224; Engager",
		"`ventilation`.`reservation_salaire`" => "Salaires restant &#224; verser",
		"`ventilation`.`reste_depenser`" => "Reste &#224; D&#233;penser",
		"`ventilation`.`prop_ua`" => "U/P (%)",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`ventilation`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`rubriques1`.`intitule`), CONCAT_WS('',   `rubriques1`.`intitule`), '') /* Rubrique de Ventilation */" => "rubrique",
		"`ventilation`.`intitule`" => "intitule",
		"`ventilation`.`notes`" => "Notes",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`non_liquide` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`non_liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "non_liquide",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`ventilation`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`ventilation`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`ventilation`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['convention' => 'Convention', 'rubrique' => 'Rubrique de Ventilation', ];

	$x->QueryFrom = "`ventilation` LEFT JOIN `conventions` as conventions1 ON `conventions1`.`id`=`ventilation`.`convention` LEFT JOIN `rubriques` as rubriques1 ON `rubriques1`.`id`=`ventilation`.`rubrique` ";
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
	$x->ScriptFileName = 'ventilation_view.php';
	$x->RedirectAfterInsert = 'ventilation_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Ventilation Budg&#233;taire';
	$x->TableIcon = 'resources/table_icons/024-tasks.png';
	$x->PrimaryKey = '`ventilation`.`id`';
	$x->DefaultSortField = '3';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Convention', 'Rubrique de Ventilation', 'Intitul&#233;', 'Notes', 'Pr&#233;visionnel', 'Non Liquid&#233;', 'Liquid&#233;', 'Utilis&#233;', 'Reste &#224; Engager', 'Salaires restant &#224; verser', 'Reste &#224; D&#233;penser', 'U/P (%)', ];
	$x->ColFieldName = ['convention', 'rubrique', 'intitule', 'notes', 'accorde', 'non_liquide', 'liquide', 'utilise', 'reste_engager', 'reservation_salaire', 'reste_depenser', 'prop_ua', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/ventilation_templateTV.html';
	$x->SelectedTemplate = 'templates/ventilation_templateTVS.html';
	$x->TemplateDV = 'templates/ventilation_templateDV.html';
	$x->TemplateDVP = 'templates/ventilation_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, ['user', 'group'])) { $DisplayRecords = 'all'; }
	if($perm['view'] == 1 || ($perm['view'] > 1 && $DisplayRecords == 'user' && !$_REQUEST['NoFilter_x'])) { // view owner only
		$x->QueryFrom .= ', `membership_userrecords`';
		$x->QueryWhere = "WHERE `ventilation`.`id`=`membership_userrecords`.`pkValue` AND `membership_userrecords`.`tableName`='ventilation' AND LCASE(`membership_userrecords`.`memberID`)='" . getLoggedMemberID() . "'";
	} elseif($perm['view'] == 2 || ($perm['view'] > 2 && $DisplayRecords == 'group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom .= ', `membership_userrecords`';
		$x->QueryWhere = "WHERE `ventilation`.`id`=`membership_userrecords`.`pkValue` AND `membership_userrecords`.`tableName`='ventilation' AND `membership_userrecords`.`groupID`='" . getLoggedGroupID() . "'";
	} elseif($perm['view'] == 3) { // view all
		// no further action
	} elseif($perm['view'] == 0) { // view none
		$x->QueryFields = ['Not enough permissions' => 'NEP'];
		$x->QueryFrom = '`ventilation`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: ventilation_init
	$render = true;
	if(function_exists('ventilation_init')) {
		$args = [];
		$render = ventilation_init($x, getMemberInfo(), $args);
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
				$QueryWhere = 'where `ventilation`.`id` in ('.substr($QueryWhere, 0, -1).')';
			} else { // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		} else {
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "SELECT CONCAT('<span style=''color: ', IF(SUM(`ventilation`.`accorde`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`ventilation`.`accorde`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`ventilation`.`non_liquide`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`ventilation`.`non_liquide`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`ventilation`.`liquide`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`ventilation`.`liquide`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`ventilation`.`utilise`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`ventilation`.`utilise`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`ventilation`.`reste_engager`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`ventilation`.`reste_engager`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`ventilation`.`reservation_salaire`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`ventilation`.`reservation_salaire`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(SUM(`ventilation`.`reste_depenser`) < 0, 'red', 'black'), ';''>', FORMAT(SUM(`ventilation`.`reste_depenser`), 2, 'ru_RU'), '&nbsp;&euro;</span>') FROM {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)) {
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="ventilation-convention"></td>';
			$sumRow .= '<td class="ventilation-rubrique"></td>';
			$sumRow .= '<td class="ventilation-intitule"></td>';
			$sumRow .= '<td class="ventilation-notes"></td>';
			$sumRow .= "<td class=\"ventilation-accorde text-right\">{$row[0]}</td>";
			$sumRow .= "<td class=\"ventilation-non_liquide text-right\">{$row[1]}</td>";
			$sumRow .= "<td class=\"ventilation-liquide text-right\">{$row[2]}</td>";
			$sumRow .= "<td class=\"ventilation-utilise text-right\">{$row[3]}</td>";
			$sumRow .= "<td class=\"ventilation-reste_engager text-right\">{$row[4]}</td>";
			$sumRow .= "<td class=\"ventilation-reservation_salaire text-right\">{$row[5]}</td>";
			$sumRow .= "<td class=\"ventilation-reste_depenser text-right\">{$row[6]}</td>";
			$sumRow .= '<td class="ventilation-prop_ua"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: ventilation_header
	$headerCode = '';
	if(function_exists('ventilation_header')) {
		$args = [];
		$headerCode = ventilation_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: ventilation_footer
	$footerCode = '';
	if(function_exists('ventilation_footer')) {
		$args = [];
		$footerCode = ventilation_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
