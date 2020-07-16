<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/rubriques.php");
	include("$currDir/rubriques_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('rubriques');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "rubriques";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`rubriques`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"`rubriques`.`intitule`" => "intitule",
		"if(CHAR_LENGTH(`rubriques`.`notes`)>80, concat(left(`rubriques`.`notes`,80),' ...'), `rubriques`.`notes`)" => "notes",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`non_liquide` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`non_liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "non_liquide",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`rubriques`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`rubriques`.`id`',
		2 => '`conventions1`.`nom`',
		3 => 3,
		4 => 4,
		5 => '`rubriques`.`accorde`',
		6 => '`rubriques`.`non_liquide`',
		7 => '`rubriques`.`liquide`',
		8 => '`rubriques`.`utilise`',
		9 => '`rubriques`.`reste_engager`',
		10 => '`rubriques`.`reservation_salaire`',
		11 => '`rubriques`.`reste_depenser`',
		12 => '`rubriques`.`prop_ua`',
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`rubriques`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"`rubriques`.`intitule`" => "intitule",
		"`rubriques`.`notes`" => "notes",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`non_liquide` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`non_liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "non_liquide",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`rubriques`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`rubriques`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "Convention",
		"`rubriques`.`intitule`" => "Intitul&#233;",
		"`rubriques`.`notes`" => "Notes",
		"`rubriques`.`accorde`" => "Pr&#233;visionnel",
		"`rubriques`.`non_liquide`" => "Non Liquid&#233;",
		"`rubriques`.`liquide`" => "Liquid&#233;",
		"`rubriques`.`utilise`" => "Utilis&#233;",
		"`rubriques`.`reste_engager`" => "Reste &#224; Engager",
		"`rubriques`.`reservation_salaire`" => "Salaires restant &#224; verser",
		"`rubriques`.`reste_depenser`" => "Reste &#224; D&#233;penser",
		"`rubriques`.`prop_ua`" => "U/P (%)",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`rubriques`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"`rubriques`.`intitule`" => "intitule",
		"`rubriques`.`notes`" => "Notes",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`non_liquide` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`non_liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "non_liquide",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`rubriques`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`rubriques`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`rubriques`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('convention' => 'Convention', );

	$x->QueryFrom = "`rubriques` LEFT JOIN `conventions` as conventions1 ON `conventions1`.`id`=`rubriques`.`convention` ";
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
	$x->ScriptFileName = "rubriques_view.php";
	$x->RedirectAfterInsert = "rubriques_view.php?SelectedID=#ID#";
	$x->TableTitle = "Rubriques de Ventilation";
	$x->TableIcon = "resources/table_icons/032-archives.png";
	$x->PrimaryKey = "`rubriques`.`id`";
	$x->DefaultSortField = '3';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Convention", "Intitul&#233;", "Notes", "Pr&#233;visionnel", "Non Liquid&#233;", "Liquid&#233;", "Utilis&#233;", "Reste &#224; Engager", "Salaires restant &#224; verser", "Reste &#224; D&#233;penser", "U/P (%)");
	$x->ColFieldName = array('convention', 'intitule', 'notes', 'accorde', 'non_liquide', 'liquide', 'utilise', 'reste_engager', 'reservation_salaire', 'reste_depenser', 'prop_ua');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);

	// template paths below are based on the app main directory
	$x->Template = 'templates/rubriques_templateTV.html';
	$x->SelectedTemplate = 'templates/rubriques_templateTVS.html';
	$x->TemplateDV = 'templates/rubriques_templateDV.html';
	$x->TemplateDVP = 'templates/rubriques_templateDVP.html';

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
		$x->QueryWhere="where `rubriques`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='rubriques' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `rubriques`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='rubriques' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`rubriques`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: rubriques_init
	$render=TRUE;
	if(function_exists('rubriques_init')) {
		$args=array();
		$render=rubriques_init($x, getMemberInfo(), $args);
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
				$QueryWhere = 'where `rubriques`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select CONCAT('<span style=''color: ', IF(sum(`rubriques`.`accorde`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`rubriques`.`accorde`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`rubriques`.`non_liquide`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`rubriques`.`non_liquide`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`rubriques`.`liquide`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`rubriques`.`liquide`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`rubriques`.`utilise`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`rubriques`.`utilise`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`rubriques`.`reste_engager`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`rubriques`.`reste_engager`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`rubriques`.`reservation_salaire`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`rubriques`.`reservation_salaire`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`rubriques`.`reste_depenser`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`rubriques`.`reste_depenser`), 2, 'ru_RU'), '&nbsp;&euro;</span>') from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)) {
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="rubriques-convention"></td>';
			$sumRow .= '<td class="rubriques-intitule"></td>';
			$sumRow .= '<td class="rubriques-notes"></td>';
			$sumRow .= "<td class=\"rubriques-accorde text-right\">{$row[0]}</td>";
			$sumRow .= "<td class=\"rubriques-non_liquide text-right\">{$row[1]}</td>";
			$sumRow .= "<td class=\"rubriques-liquide text-right\">{$row[2]}</td>";
			$sumRow .= "<td class=\"rubriques-utilise text-right\">{$row[3]}</td>";
			$sumRow .= "<td class=\"rubriques-reste_engager text-right\">{$row[4]}</td>";
			$sumRow .= "<td class=\"rubriques-reservation_salaire text-right\">{$row[5]}</td>";
			$sumRow .= "<td class=\"rubriques-reste_depenser text-right\">{$row[6]}</td>";
			$sumRow .= '<td class="rubriques-prop_ua"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: rubriques_header
	$headerCode='';
	if(function_exists('rubriques_header')) {
		$args=array();
		$headerCode=rubriques_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: rubriques_footer
	$footerCode='';
	if(function_exists('rubriques_footer')) {
		$args=array();
		$footerCode=rubriques_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>