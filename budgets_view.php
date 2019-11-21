<?php
// This script and data application were generated by AppGini 5.81
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/budgets.php");
	include("$currDir/budgets_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('budgets');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "budgets";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`budgets`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Type */" => "type",
		"CONCAT('<span style=''color: ', IF(`budgets`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"CONCAT('<span style=''color: ', IF(`budgets`.`verse` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`verse`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "verse",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_verser` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_verser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_verser",
		"CONCAT('<span style=''color: ', IF(`budgets`.`ouvert` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`ouvert`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "ouvert",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_ouvrir` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_ouvrir`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_ouvrir",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reserve` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reserve`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reserve",
		"CONCAT('<span style=''color: ', IF(`budgets`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`budgets`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`budgets`.`disponible` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`disponible`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "disponible",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_uo` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_uo`, 0, 'ru_RU'), '%</span>')" => "prop_uo",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_uv` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_uv`, 0, 'ru_RU'), '%</span>')" => "prop_uv",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`budgets`.`id`',
		2 => '`conventions1`.`nom`',
		3 => 3,
		4 => '`budgets`.`accorde`',
		5 => '`budgets`.`verse`',
		6 => '`budgets`.`reste_verser`',
		7 => '`budgets`.`ouvert`',
		8 => '`budgets`.`reste_ouvrir`',
		9 => '`budgets`.`reserve`',
		10 => '`budgets`.`liquide`',
		11 => '`budgets`.`utilise`',
		12 => '`budgets`.`disponible`',
		13 => '`budgets`.`reste_engager`',
		14 => '`budgets`.`reservation_salaire`',
		15 => '`budgets`.`reste_depenser`',
		16 => '`budgets`.`prop_uo`',
		17 => '`budgets`.`prop_uv`',
		18 => '`budgets`.`prop_ua`',
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`budgets`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Type */" => "type",
		"CONCAT('<span style=''color: ', IF(`budgets`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"CONCAT('<span style=''color: ', IF(`budgets`.`verse` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`verse`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "verse",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_verser` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_verser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_verser",
		"CONCAT('<span style=''color: ', IF(`budgets`.`ouvert` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`ouvert`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "ouvert",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_ouvrir` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_ouvrir`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_ouvrir",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reserve` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reserve`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reserve",
		"CONCAT('<span style=''color: ', IF(`budgets`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`budgets`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`budgets`.`disponible` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`disponible`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "disponible",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_uo` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_uo`, 0, 'ru_RU'), '%</span>')" => "prop_uo",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_uv` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_uv`, 0, 'ru_RU'), '%</span>')" => "prop_uv",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`budgets`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "Convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Type */" => "Type",
		"`budgets`.`accorde`" => "Accord&#233;",
		"`budgets`.`verse`" => "Vers&#233;",
		"`budgets`.`reste_verser`" => "Reste &#224; Verser",
		"`budgets`.`ouvert`" => "Ouvert",
		"`budgets`.`reste_ouvrir`" => "Reste &#224; Ouvrir",
		"`budgets`.`reserve`" => "R&#233;serv&#233;",
		"`budgets`.`liquide`" => "Liquid&#233;",
		"`budgets`.`utilise`" => "Utilis&#233;",
		"`budgets`.`disponible`" => "Disponible",
		"`budgets`.`reste_engager`" => "Reste &#224; Engager",
		"`budgets`.`reservation_salaire`" => "Salaires restant &#224; verser",
		"`budgets`.`reste_depenser`" => "Reste &#224; D&#233;penser",
		"`budgets`.`prop_uo`" => "U/O (%)",
		"`budgets`.`prop_uv`" => "U/V (%)",
		"`budgets`.`prop_ua`" => "U/A (%)",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`budgets`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Type */" => "type",
		"CONCAT('<span style=''color: ', IF(`budgets`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"CONCAT('<span style=''color: ', IF(`budgets`.`verse` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`verse`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "verse",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_verser` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_verser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_verser",
		"CONCAT('<span style=''color: ', IF(`budgets`.`ouvert` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`ouvert`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "ouvert",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_ouvrir` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_ouvrir`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_ouvrir",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reserve` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reserve`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reserve",
		"CONCAT('<span style=''color: ', IF(`budgets`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`budgets`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`budgets`.`disponible` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`disponible`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "disponible",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`budgets`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`budgets`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_uo` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_uo`, 0, 'ru_RU'), '%</span>')" => "prop_uo",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_uv` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_uv`, 0, 'ru_RU'), '%</span>')" => "prop_uv",
		"CONCAT('<span style=''color: ', IF(`budgets`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`budgets`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('convention' => 'Convention', 'type' => 'Type', );

	$x->QueryFrom = "`budgets` LEFT JOIN `conventions` as conventions1 ON `conventions1`.`id`=`budgets`.`convention` LEFT JOIN `types_ligne` as types_ligne1 ON `types_ligne1`.`id`=`budgets`.`type` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
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
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "budgets_view.php";
	$x->RedirectAfterInsert = "budgets_view.php";
	$x->TableTitle = "Lignes budg&#233;taires";
	$x->TableIcon = "resources/table_icons/006-business.png";
	$x->PrimaryKey = "`budgets`.`id`";
	$x->DefaultSortField = '3';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Convention", "Type", "Accord&#233;", "Vers&#233;", "Reste &#224; Verser", "Ouvert", "Reste &#224; Ouvrir", "R&#233;serv&#233;", "Liquid&#233;", "Utilis&#233;", "Disponible", "Reste &#224; Engager", "Salaires restant &#224; verser", "Reste &#224; D&#233;penser", "U/O (%)", "U/V (%)", "U/A (%)");
	$x->ColFieldName = array('convention', 'type', 'accorde', 'verse', 'reste_verser', 'ouvert', 'reste_ouvrir', 'reserve', 'liquide', 'utilise', 'disponible', 'reste_engager', 'reservation_salaire', 'reste_depenser', 'prop_uo', 'prop_uv', 'prop_ua');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18);

	// template paths below are based on the app main directory
	$x->Template = 'templates/budgets_templateTV.html';
	$x->SelectedTemplate = 'templates/budgets_templateTVS.html';
	$x->TemplateDV = 'templates/budgets_templateDV.html';
	$x->TemplateDVP = 'templates/budgets_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';
	$x->HasCalculatedFields = false;

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))) { $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])) { // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `budgets`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='budgets' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `budgets`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='budgets' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`budgets`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: budgets_init
	$render=TRUE;
	if(function_exists('budgets_init')) {
		$args=array();
		$render=budgets_init($x, getMemberInfo(), $args);
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
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select CONCAT('<span style=''color: ', IF(sum(`budgets`.`accorde`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`budgets`.`accorde`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`budgets`.`verse`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`budgets`.`verse`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`budgets`.`reste_verser`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`budgets`.`reste_verser`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`budgets`.`ouvert`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`budgets`.`ouvert`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`budgets`.`reste_ouvrir`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`budgets`.`reste_ouvrir`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`budgets`.`reserve`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`budgets`.`reserve`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`budgets`.`liquide`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`budgets`.`liquide`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`budgets`.`utilise`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`budgets`.`utilise`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`budgets`.`disponible`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`budgets`.`disponible`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`budgets`.`reste_engager`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`budgets`.`reste_engager`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`budgets`.`reservation_salaire`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`budgets`.`reservation_salaire`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`budgets`.`reste_depenser`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`budgets`.`reste_depenser`), 2, 'ru_RU'), '&nbsp;&euro;</span>') from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)) {
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="budgets-convention"></td>';
			$sumRow .= '<td class="budgets-type"></td>';
			$sumRow .= "<td class=\"budgets-accorde text-right\">{$row[0]}</td>";
			$sumRow .= "<td class=\"budgets-verse text-right\">{$row[1]}</td>";
			$sumRow .= "<td class=\"budgets-reste_verser text-right\">{$row[2]}</td>";
			$sumRow .= "<td class=\"budgets-ouvert text-right\">{$row[3]}</td>";
			$sumRow .= "<td class=\"budgets-reste_ouvrir text-right\">{$row[4]}</td>";
			$sumRow .= "<td class=\"budgets-reserve text-right\">{$row[5]}</td>";
			$sumRow .= "<td class=\"budgets-liquide text-right\">{$row[6]}</td>";
			$sumRow .= "<td class=\"budgets-utilise text-right\">{$row[7]}</td>";
			$sumRow .= "<td class=\"budgets-disponible text-right\">{$row[8]}</td>";
			$sumRow .= "<td class=\"budgets-reste_engager text-right\">{$row[9]}</td>";
			$sumRow .= "<td class=\"budgets-reservation_salaire text-right\">{$row[10]}</td>";
			$sumRow .= "<td class=\"budgets-reste_depenser text-right\">{$row[11]}</td>";
			$sumRow .= '<td class="budgets-prop_uo"></td>';
			$sumRow .= '<td class="budgets-prop_uv"></td>';
			$sumRow .= '<td class="budgets-prop_ua"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: budgets_header
	$headerCode='';
	if(function_exists('budgets_header')) {
		$args=array();
		$headerCode=budgets_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: budgets_footer
	$footerCode='';
	if(function_exists('budgets_footer')) {
		$args=array();
		$footerCode=budgets_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>