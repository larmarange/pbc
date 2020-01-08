<?php
// This script and data application were generated by AppGini 5.81
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/depenses.php");
	include("$currDir/depenses_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('depenses');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "depenses";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`depenses`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne Budg&#233;taire */" => "ligne_budgetaire",
		"IF(    CHAR_LENGTH(`lignes_credits1`.`intitule`) || CHAR_LENGTH(`lignes_credits1`.`exercice`), CONCAT_WS('',   `lignes_credits1`.`intitule`, ' - ', `lignes_credits1`.`exercice`), '') /* Ligne de cr&#233;dit (CFI) - Exercice */" => "ligne_credit",
		"if(`depenses`.`date`,date_format(`depenses`.`date`,'%d/%m/%Y'),'')" => "date",
		"`depenses`.`intitule`" => "intitule",
		"`depenses`.`reference`" => "reference",
		"IF(    CHAR_LENGTH(`recrutements1`.`intitule`) || CHAR_LENGTH(`personnes1`.`nom`), CONCAT_WS('',   `recrutements1`.`intitule`, ' - ', `personnes1`.`nom`), '') /* Contrat (si salaire) */" => "contrat",
		"IF(    CHAR_LENGTH(`personnes2`.`nom`), CONCAT_WS('',   `personnes2`.`nom`), '') /* B&#233;n&#233;ficiaire */" => "beneficiaire",
		"CONCAT('<span style=''color: ', IF(`depenses`.`montant` < 0, 'red', 'black'), ';''>', FORMAT(`depenses`.`montant`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "montant",
		"`depenses`.`statut`" => "statut",
		"IF(    CHAR_LENGTH(`ventilation1`.`intitule`), CONCAT_WS('',   `ventilation1`.`intitule`), '') /* Ventilation Budg&#233;taire */" => "ventilation",
		"if(CHAR_LENGTH(`depenses`.`notes`)>80, concat(left(`depenses`.`notes`,80),' ...'), `depenses`.`notes`)" => "notes",
		"concat('<i class=\"glyphicon glyphicon-', if(`depenses`.`verifie`, 'check', 'unchecked'), '\"></i>')" => "verifie",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`depenses`.`id`',
		2 => '`conventions1`.`nom`',
		3 => 3,
		4 => 4,
		5 => '`depenses`.`date`',
		6 => 6,
		7 => 7,
		8 => 8,
		9 => '`personnes2`.`nom`',
		10 => '`depenses`.`montant`',
		11 => 11,
		12 => '`ventilation1`.`intitule`',
		13 => 13,
		14 => 14,
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`depenses`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne Budg&#233;taire */" => "ligne_budgetaire",
		"IF(    CHAR_LENGTH(`lignes_credits1`.`intitule`) || CHAR_LENGTH(`lignes_credits1`.`exercice`), CONCAT_WS('',   `lignes_credits1`.`intitule`, ' - ', `lignes_credits1`.`exercice`), '') /* Ligne de cr&#233;dit (CFI) - Exercice */" => "ligne_credit",
		"if(`depenses`.`date`,date_format(`depenses`.`date`,'%d/%m/%Y'),'')" => "date",
		"`depenses`.`intitule`" => "intitule",
		"`depenses`.`reference`" => "reference",
		"IF(    CHAR_LENGTH(`recrutements1`.`intitule`) || CHAR_LENGTH(`personnes1`.`nom`), CONCAT_WS('',   `recrutements1`.`intitule`, ' - ', `personnes1`.`nom`), '') /* Contrat (si salaire) */" => "contrat",
		"IF(    CHAR_LENGTH(`personnes2`.`nom`), CONCAT_WS('',   `personnes2`.`nom`), '') /* B&#233;n&#233;ficiaire */" => "beneficiaire",
		"CONCAT('<span style=''color: ', IF(`depenses`.`montant` < 0, 'red', 'black'), ';''>', FORMAT(`depenses`.`montant`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "montant",
		"`depenses`.`statut`" => "statut",
		"IF(    CHAR_LENGTH(`ventilation1`.`intitule`), CONCAT_WS('',   `ventilation1`.`intitule`), '') /* Ventilation Budg&#233;taire */" => "ventilation",
		"`depenses`.`notes`" => "notes",
		"`depenses`.`verifie`" => "verifie",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`depenses`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "Convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne Budg&#233;taire */" => "Ligne Budg&#233;taire",
		"IF(    CHAR_LENGTH(`lignes_credits1`.`intitule`) || CHAR_LENGTH(`lignes_credits1`.`exercice`), CONCAT_WS('',   `lignes_credits1`.`intitule`, ' - ', `lignes_credits1`.`exercice`), '') /* Ligne de cr&#233;dit (CFI) - Exercice */" => "Ligne de cr&#233;dit (CFI) - Exercice",
		"`depenses`.`date`" => "Date",
		"`depenses`.`intitule`" => "Intitul&#233;",
		"`depenses`.`reference`" => "R&#233;ference",
		"IF(    CHAR_LENGTH(`recrutements1`.`intitule`) || CHAR_LENGTH(`personnes1`.`nom`), CONCAT_WS('',   `recrutements1`.`intitule`, ' - ', `personnes1`.`nom`), '') /* Contrat (si salaire) */" => "Contrat (si salaire)",
		"IF(    CHAR_LENGTH(`personnes2`.`nom`), CONCAT_WS('',   `personnes2`.`nom`), '') /* B&#233;n&#233;ficiaire */" => "B&#233;n&#233;ficiaire",
		"`depenses`.`montant`" => "Montant",
		"`depenses`.`statut`" => "Statut",
		"IF(    CHAR_LENGTH(`ventilation1`.`intitule`), CONCAT_WS('',   `ventilation1`.`intitule`), '') /* Ventilation Budg&#233;taire */" => "Ventilation Budg&#233;taire",
		"`depenses`.`notes`" => "Notes",
		"`depenses`.`verifie`" => "V&#233;rifi&#233;e ?",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`depenses`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne Budg&#233;taire */" => "ligne_budgetaire",
		"IF(    CHAR_LENGTH(`lignes_credits1`.`intitule`) || CHAR_LENGTH(`lignes_credits1`.`exercice`), CONCAT_WS('',   `lignes_credits1`.`intitule`, ' - ', `lignes_credits1`.`exercice`), '') /* Ligne de cr&#233;dit (CFI) - Exercice */" => "ligne_credit",
		"if(`depenses`.`date`,date_format(`depenses`.`date`,'%d/%m/%Y'),'')" => "date",
		"`depenses`.`intitule`" => "intitule",
		"`depenses`.`reference`" => "reference",
		"IF(    CHAR_LENGTH(`recrutements1`.`intitule`) || CHAR_LENGTH(`personnes1`.`nom`), CONCAT_WS('',   `recrutements1`.`intitule`, ' - ', `personnes1`.`nom`), '') /* Contrat (si salaire) */" => "contrat",
		"IF(    CHAR_LENGTH(`personnes2`.`nom`), CONCAT_WS('',   `personnes2`.`nom`), '') /* B&#233;n&#233;ficiaire */" => "beneficiaire",
		"CONCAT('<span style=''color: ', IF(`depenses`.`montant` < 0, 'red', 'black'), ';''>', FORMAT(`depenses`.`montant`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "montant",
		"`depenses`.`statut`" => "statut",
		"IF(    CHAR_LENGTH(`ventilation1`.`intitule`), CONCAT_WS('',   `ventilation1`.`intitule`), '') /* Ventilation Budg&#233;taire */" => "ventilation",
		"`depenses`.`notes`" => "Notes",
		"concat('<i class=\"glyphicon glyphicon-', if(`depenses`.`verifie`, 'check', 'unchecked'), '\"></i>')" => "verifie",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('convention' => 'Convention', 'ligne_budgetaire' => 'Ligne Budg&#233;taire', 'ligne_credit' => 'Ligne de cr&#233;dit (CFI) - Exercice', 'contrat' => 'Contrat (si salaire)', 'beneficiaire' => 'B&#233;n&#233;ficiaire', 'ventilation' => 'Ventilation Budg&#233;taire', );

	$x->QueryFrom = "`depenses` LEFT JOIN `conventions` as conventions1 ON `conventions1`.`id`=`depenses`.`convention` LEFT JOIN `budgets` as budgets1 ON `budgets1`.`id`=`depenses`.`ligne_budgetaire` LEFT JOIN `types_ligne` as types_ligne1 ON `types_ligne1`.`id`=`budgets1`.`type` LEFT JOIN `lignes_credits` as lignes_credits1 ON `lignes_credits1`.`id`=`depenses`.`ligne_credit` LEFT JOIN `recrutements` as recrutements1 ON `recrutements1`.`id`=`depenses`.`contrat` LEFT JOIN `personnes` as personnes1 ON `personnes1`.`id`=`recrutements1`.`beneficiaire` LEFT JOIN `personnes` as personnes2 ON `personnes2`.`id`=`depenses`.`beneficiaire` LEFT JOIN `ventilation` as ventilation1 ON `ventilation1`.`id`=`depenses`.`ventilation` ";
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
	$x->ScriptFileName = "depenses_view.php";
	$x->RedirectAfterInsert = "depenses_view.php?SelectedID=#ID#";
	$x->TableTitle = "D&#233;penses";
	$x->TableIcon = "resources/table_icons/005-expenses.png";
	$x->PrimaryKey = "`depenses`.`id`";
	$x->DefaultSortField = '`depenses`.`date`';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Convention", "Ligne Budg&#233;taire", "Ligne de cr&#233;dit (CFI) - Exercice", "Date", "Intitul&#233;", "R&#233;ference", "Contrat (si salaire)", "B&#233;n&#233;ficiaire", "Montant", "Statut", "Ventilation Budg&#233;taire", "Notes", "V&#233;rifi&#233;e ?");
	$x->ColFieldName = array('convention', 'ligne_budgetaire', 'ligne_credit', 'date', 'intitule', 'reference', 'contrat', 'beneficiaire', 'montant', 'statut', 'ventilation', 'notes', 'verifie');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14);

	// template paths below are based on the app main directory
	$x->Template = 'templates/depenses_templateTV.html';
	$x->SelectedTemplate = 'templates/depenses_templateTVS.html';
	$x->TemplateDV = 'templates/depenses_templateDV.html';
	$x->TemplateDVP = 'templates/depenses_templateDVP.html';

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
		$x->QueryWhere="where `depenses`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='depenses' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `depenses`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='depenses' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`depenses`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: depenses_init
	$render=TRUE;
	if(function_exists('depenses_init')) {
		$args=array();
		$render=depenses_init($x, getMemberInfo(), $args);
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
				$QueryWhere = 'where `depenses`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select CONCAT('<span style=''color: ', IF(sum(`depenses`.`montant`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`depenses`.`montant`), 2, 'ru_RU'), '&nbsp;&euro;</span>') from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)) {
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="depenses-convention"></td>';
			$sumRow .= '<td class="depenses-ligne_budgetaire"></td>';
			$sumRow .= '<td class="depenses-ligne_credit"></td>';
			$sumRow .= '<td class="depenses-date"></td>';
			$sumRow .= '<td class="depenses-intitule"></td>';
			$sumRow .= '<td class="depenses-reference"></td>';
			$sumRow .= '<td class="depenses-contrat"></td>';
			$sumRow .= '<td class="depenses-beneficiaire"></td>';
			$sumRow .= "<td class=\"depenses-montant text-right\">{$row[0]}</td>";
			$sumRow .= '<td class="depenses-statut"></td>';
			$sumRow .= '<td class="depenses-ventilation"></td>';
			$sumRow .= '<td class="depenses-notes"></td>';
			$sumRow .= '<td class="depenses-verifie"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: depenses_header
	$headerCode='';
	if(function_exists('depenses_header')) {
		$args=array();
		$headerCode=depenses_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: depenses_footer
	$footerCode='';
	if(function_exists('depenses_footer')) {
		$args=array();
		$footerCode=depenses_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>