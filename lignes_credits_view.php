<?php
// This script and data application were generated by AppGini 5.82
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/lignes_credits.php");
	include("$currDir/lignes_credits_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('lignes_credits');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "lignes_credits";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`lignes_credits`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne Budg&#233;taire */" => "ligne_budgetaire",
		"`lignes_credits`.`intitule`" => "intitule",
		"`lignes_credits`.`exercice`" => "exercice",
		"if(CHAR_LENGTH(`lignes_credits`.`notes`)>80, concat(left(`lignes_credits`.`notes`,80),' ...'), `lignes_credits`.`notes`)" => "notes",
		"CONCAT('$', FORMAT(`lignes_credits`.`ouvert`, 2))" => "ouvert",
		"CONCAT('$', FORMAT(`lignes_credits`.`non_liquide`, 2))" => "non_liquide",
		"CONCAT('$', FORMAT(`lignes_credits`.`liquide`, 2))" => "liquide",
		"CONCAT('$', FORMAT(`lignes_credits`.`utilise`, 2))" => "utilise",
		"CONCAT('$', FORMAT(`lignes_credits`.`disponible`, 2))" => "disponible",
		"CONCAT('&euro;', FORMAT(`lignes_credits`.`prop_uo`, 2))" => "prop_uo",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`lignes_credits`.`id`',
		2 => '`conventions1`.`nom`',
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => '`lignes_credits`.`ouvert`',
		8 => '`lignes_credits`.`non_liquide`',
		9 => '`lignes_credits`.`liquide`',
		10 => '`lignes_credits`.`utilise`',
		11 => '`lignes_credits`.`disponible`',
		12 => '`lignes_credits`.`prop_uo`',
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`lignes_credits`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne Budg&#233;taire */" => "ligne_budgetaire",
		"`lignes_credits`.`intitule`" => "intitule",
		"`lignes_credits`.`exercice`" => "exercice",
		"`lignes_credits`.`notes`" => "notes",
		"CONCAT('$', FORMAT(`lignes_credits`.`ouvert`, 2))" => "ouvert",
		"CONCAT('$', FORMAT(`lignes_credits`.`non_liquide`, 2))" => "non_liquide",
		"CONCAT('$', FORMAT(`lignes_credits`.`liquide`, 2))" => "liquide",
		"CONCAT('$', FORMAT(`lignes_credits`.`utilise`, 2))" => "utilise",
		"CONCAT('$', FORMAT(`lignes_credits`.`disponible`, 2))" => "disponible",
		"CONCAT('&euro;', FORMAT(`lignes_credits`.`prop_uo`, 2))" => "prop_uo",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`lignes_credits`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "Convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne Budg&#233;taire */" => "Ligne Budg&#233;taire",
		"`lignes_credits`.`intitule`" => "Intitul&#233; / CFI",
		"`lignes_credits`.`exercice`" => "Exercice",
		"`lignes_credits`.`notes`" => "Notes",
		"`lignes_credits`.`ouvert`" => "Ouvert",
		"`lignes_credits`.`non_liquide`" => "Non Liquid&#233;",
		"`lignes_credits`.`liquide`" => "Liquid&#233;",
		"`lignes_credits`.`utilise`" => "Utilis&#233;",
		"`lignes_credits`.`disponible`" => "Disponible",
		"`lignes_credits`.`prop_uo`" => "U/O (%)",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`lignes_credits`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne Budg&#233;taire */" => "ligne_budgetaire",
		"`lignes_credits`.`intitule`" => "intitule",
		"`lignes_credits`.`exercice`" => "exercice",
		"`lignes_credits`.`notes`" => "Notes",
		"CONCAT('$', FORMAT(`lignes_credits`.`ouvert`, 2))" => "ouvert",
		"CONCAT('$', FORMAT(`lignes_credits`.`non_liquide`, 2))" => "non_liquide",
		"CONCAT('$', FORMAT(`lignes_credits`.`liquide`, 2))" => "liquide",
		"CONCAT('$', FORMAT(`lignes_credits`.`utilise`, 2))" => "utilise",
		"CONCAT('$', FORMAT(`lignes_credits`.`disponible`, 2))" => "disponible",
		"CONCAT('&euro;', FORMAT(`lignes_credits`.`prop_uo`, 2))" => "prop_uo",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('convention' => 'Convention', 'ligne_budgetaire' => 'Ligne Budg&#233;taire', );

	$x->QueryFrom = "`lignes_credits` LEFT JOIN `conventions` as conventions1 ON `conventions1`.`id`=`lignes_credits`.`convention` LEFT JOIN `budgets` as budgets1 ON `budgets1`.`id`=`lignes_credits`.`ligne_budgetaire` LEFT JOIN `types_ligne` as types_ligne1 ON `types_ligne1`.`id`=`budgets1`.`type` ";
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
	$x->AllowSavingFilters = 0;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 50;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "lignes_credits_view.php";
	$x->RedirectAfterInsert = "lignes_credits_view.php?SelectedID=#ID#";
	$x->TableTitle = "Lignes de Cr&#233;dits";
	$x->TableIcon = "resources/table_icons/044-prince2.png";
	$x->PrimaryKey = "`lignes_credits`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Convention", "Ligne Budg&#233;taire", "Intitul&#233; / CFI", "Exercice", "Notes", "Ouvert", "Non Liquid&#233;", "Liquid&#233;", "Utilis&#233;", "Disponible", "U/O (%)");
	$x->ColFieldName = array('convention', 'ligne_budgetaire', 'intitule', 'exercice', 'notes', 'ouvert', 'non_liquide', 'liquide', 'utilise', 'disponible', 'prop_uo');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);

	// template paths below are based on the app main directory
	$x->Template = 'templates/lignes_credits_templateTV.html';
	$x->SelectedTemplate = 'templates/lignes_credits_templateTVS.html';
	$x->TemplateDV = 'templates/lignes_credits_templateDV.html';
	$x->TemplateDVP = 'templates/lignes_credits_templateDVP.html';

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
		$x->QueryWhere="where `lignes_credits`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='lignes_credits' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `lignes_credits`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='lignes_credits' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`lignes_credits`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: lignes_credits_init
	$render=TRUE;
	if(function_exists('lignes_credits_init')) {
		$args=array();
		$render=lignes_credits_init($x, getMemberInfo(), $args);
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
				$QueryWhere = 'where `lignes_credits`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select CONCAT('$', FORMAT(sum(`lignes_credits`.`ouvert`), 2)), CONCAT('$', FORMAT(sum(`lignes_credits`.`non_liquide`), 2)), CONCAT('$', FORMAT(sum(`lignes_credits`.`liquide`), 2)), CONCAT('$', FORMAT(sum(`lignes_credits`.`utilise`), 2)), CONCAT('$', FORMAT(sum(`lignes_credits`.`disponible`), 2)) from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)) {
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="lignes_credits-convention"></td>';
			$sumRow .= '<td class="lignes_credits-ligne_budgetaire"></td>';
			$sumRow .= '<td class="lignes_credits-intitule"></td>';
			$sumRow .= '<td class="lignes_credits-exercice"></td>';
			$sumRow .= '<td class="lignes_credits-notes"></td>';
			$sumRow .= "<td class=\"lignes_credits-ouvert text-right\">{$row[0]}</td>";
			$sumRow .= "<td class=\"lignes_credits-non_liquide text-right\">{$row[1]}</td>";
			$sumRow .= "<td class=\"lignes_credits-liquide text-right\">{$row[2]}</td>";
			$sumRow .= "<td class=\"lignes_credits-utilise text-right\">{$row[3]}</td>";
			$sumRow .= "<td class=\"lignes_credits-disponible text-right\">{$row[4]}</td>";
			$sumRow .= '<td class="lignes_credits-prop_uo"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: lignes_credits_header
	$headerCode='';
	if(function_exists('lignes_credits_header')) {
		$args=array();
		$headerCode=lignes_credits_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: lignes_credits_footer
	$footerCode='';
	if(function_exists('lignes_credits_footer')) {
		$args=array();
		$footerCode=lignes_credits_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>