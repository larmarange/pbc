<?php
// This script and data application were generated by AppGini 5.82
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/ventilation.php");
	include("$currDir/ventilation_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('ventilation');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "ventilation";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`ventilation`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`rubriques1`.`intitule`), CONCAT_WS('',   `rubriques1`.`intitule`), '') /* Rubrique de Ventilation */" => "rubrique",
		"`ventilation`.`intitule`" => "intitule",
		"if(CHAR_LENGTH(`ventilation`.`notes`)>80, concat(left(`ventilation`.`notes`,80),' ...'), `ventilation`.`notes`)" => "notes",
		"CONCAT('$', FORMAT(`ventilation`.`accorde`, 2))" => "accorde",
		"CONCAT('$', FORMAT(`ventilation`.`non_liquide`, 2))" => "non_liquide",
		"CONCAT('$', FORMAT(`ventilation`.`liquide`, 2))" => "liquide",
		"CONCAT('$', FORMAT(`ventilation`.`utilise`, 2))" => "utilise",
		"CONCAT('$', FORMAT(`ventilation`.`reste_engager`, 2))" => "reste_engager",
		"CONCAT('$', FORMAT(`ventilation`.`reservation_salaire`, 2))" => "reservation_salaire",
		"CONCAT('$', FORMAT(`ventilation`.`reste_depenser`, 2))" => "reste_depenser",
		"CONCAT('&euro;', FORMAT(`ventilation`.`prop_ua`, 2))" => "prop_ua",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
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
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`ventilation`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`rubriques1`.`intitule`), CONCAT_WS('',   `rubriques1`.`intitule`), '') /* Rubrique de Ventilation */" => "rubrique",
		"`ventilation`.`intitule`" => "intitule",
		"`ventilation`.`notes`" => "notes",
		"CONCAT('$', FORMAT(`ventilation`.`accorde`, 2))" => "accorde",
		"CONCAT('$', FORMAT(`ventilation`.`non_liquide`, 2))" => "non_liquide",
		"CONCAT('$', FORMAT(`ventilation`.`liquide`, 2))" => "liquide",
		"CONCAT('$', FORMAT(`ventilation`.`utilise`, 2))" => "utilise",
		"CONCAT('$', FORMAT(`ventilation`.`reste_engager`, 2))" => "reste_engager",
		"CONCAT('$', FORMAT(`ventilation`.`reservation_salaire`, 2))" => "reservation_salaire",
		"CONCAT('$', FORMAT(`ventilation`.`reste_depenser`, 2))" => "reste_depenser",
		"CONCAT('&euro;', FORMAT(`ventilation`.`prop_ua`, 2))" => "prop_ua",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
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
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`ventilation`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`rubriques1`.`intitule`), CONCAT_WS('',   `rubriques1`.`intitule`), '') /* Rubrique de Ventilation */" => "rubrique",
		"`ventilation`.`intitule`" => "intitule",
		"`ventilation`.`notes`" => "Notes",
		"CONCAT('$', FORMAT(`ventilation`.`accorde`, 2))" => "accorde",
		"CONCAT('$', FORMAT(`ventilation`.`non_liquide`, 2))" => "non_liquide",
		"CONCAT('$', FORMAT(`ventilation`.`liquide`, 2))" => "liquide",
		"CONCAT('$', FORMAT(`ventilation`.`utilise`, 2))" => "utilise",
		"CONCAT('$', FORMAT(`ventilation`.`reste_engager`, 2))" => "reste_engager",
		"CONCAT('$', FORMAT(`ventilation`.`reservation_salaire`, 2))" => "reservation_salaire",
		"CONCAT('$', FORMAT(`ventilation`.`reste_depenser`, 2))" => "reste_depenser",
		"CONCAT('&euro;', FORMAT(`ventilation`.`prop_ua`, 2))" => "prop_ua",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('convention' => 'Convention', 'rubrique' => 'Rubrique de Ventilation', );

	$x->QueryFrom = "`ventilation` LEFT JOIN `conventions` as conventions1 ON `conventions1`.`id`=`ventilation`.`convention` LEFT JOIN `rubriques` as rubriques1 ON `rubriques1`.`id`=`ventilation`.`rubrique` ";
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
	$x->ScriptFileName = "ventilation_view.php";
	$x->RedirectAfterInsert = "ventilation_view.php?SelectedID=#ID#";
	$x->TableTitle = "Ventilation Budg&#233;taire";
	$x->TableIcon = "resources/table_icons/024-tasks.png";
	$x->PrimaryKey = "`ventilation`.`id`";
	$x->DefaultSortField = '3';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Convention", "Rubrique de Ventilation", "Intitul&#233;", "Notes", "Pr&#233;visionnel", "Non Liquid&#233;", "Liquid&#233;", "Utilis&#233;", "Reste &#224; Engager", "Salaires restant &#224; verser", "Reste &#224; D&#233;penser", "U/P (%)");
	$x->ColFieldName = array('convention', 'rubrique', 'intitule', 'notes', 'accorde', 'non_liquide', 'liquide', 'utilise', 'reste_engager', 'reservation_salaire', 'reste_depenser', 'prop_ua');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13);

	// template paths below are based on the app main directory
	$x->Template = 'templates/ventilation_templateTV.html';
	$x->SelectedTemplate = 'templates/ventilation_templateTVS.html';
	$x->TemplateDV = 'templates/ventilation_templateDV.html';
	$x->TemplateDVP = 'templates/ventilation_templateDVP.html';

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
		$x->QueryWhere="where `ventilation`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='ventilation' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `ventilation`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='ventilation' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`ventilation`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: ventilation_init
	$render=TRUE;
	if(function_exists('ventilation_init')) {
		$args=array();
		$render=ventilation_init($x, getMemberInfo(), $args);
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
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select CONCAT('$', FORMAT(sum(`ventilation`.`accorde`), 2)), CONCAT('$', FORMAT(sum(`ventilation`.`non_liquide`), 2)), CONCAT('$', FORMAT(sum(`ventilation`.`liquide`), 2)), CONCAT('$', FORMAT(sum(`ventilation`.`utilise`), 2)), CONCAT('$', FORMAT(sum(`ventilation`.`reste_engager`), 2)), CONCAT('$', FORMAT(sum(`ventilation`.`reservation_salaire`), 2)), CONCAT('$', FORMAT(sum(`ventilation`.`reste_depenser`), 2)) from {$x->QueryFrom} {$QueryWhere}";
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
	$headerCode='';
	if(function_exists('ventilation_header')) {
		$args=array();
		$headerCode=ventilation_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: ventilation_footer
	$footerCode='';
	if(function_exists('ventilation_footer')) {
		$args=array();
		$footerCode=ventilation_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>