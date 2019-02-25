<?php
// This script and data application were generated by AppGini 5.74
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/versements.php");
	include("$currDir/versements_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('versements');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "versements";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`versements`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne Budg&#233;taire */" => "ligne_budgetaire",
		"if(`versements`.`date`,date_format(`versements`.`date`,'%d/%m/%Y'),'')" => "date",
		"`versements`.`intitule`" => "intitule",
		"CONCAT('<span style=''color: ', IF(`versements`.`montant` < 0, 'red', 'black'), ';''>', FORMAT(`versements`.`montant`, 2, 'ru_RU'), '</span>')" => "montant",
		"`versements`.`notes`" => "notes"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`versements`.`id`',
		2 => '`conventions1`.`nom`',
		3 => 3,
		4 => '`versements`.`date`',
		5 => 5,
		6 => '`versements`.`montant`',
		7 => 7
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`versements`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne Budg&#233;taire */" => "ligne_budgetaire",
		"if(`versements`.`date`,date_format(`versements`.`date`,'%d/%m/%Y'),'')" => "date",
		"`versements`.`intitule`" => "intitule",
		"CONCAT('<span style=''color: ', IF(`versements`.`montant` < 0, 'red', 'black'), ';''>', FORMAT(`versements`.`montant`, 2, 'ru_RU'), '</span>')" => "montant",
		"`versements`.`notes`" => "notes"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`versements`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "Convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne Budg&#233;taire */" => "Ligne Budg&#233;taire",
		"`versements`.`date`" => "Date",
		"`versements`.`intitule`" => "Intitul&#233;",
		"`versements`.`montant`" => "Montant",
		"`versements`.`notes`" => "Notes"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`versements`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne Budg&#233;taire */" => "ligne_budgetaire",
		"if(`versements`.`date`,date_format(`versements`.`date`,'%d/%m/%Y'),'')" => "date",
		"`versements`.`intitule`" => "intitule",
		"CONCAT('<span style=''color: ', IF(`versements`.`montant` < 0, 'red', 'black'), ';''>', FORMAT(`versements`.`montant`, 2, 'ru_RU'), '</span>')" => "montant",
		"`versements`.`notes`" => "notes"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'convention' => 'Convention', 'ligne_budgetaire' => 'Ligne Budg&#233;taire');

	$x->QueryFrom = "`versements` LEFT JOIN `conventions` as conventions1 ON `conventions1`.`id`=`versements`.`convention` LEFT JOIN `budgets` as budgets1 ON `budgets1`.`id`=`versements`.`ligne_budgetaire` LEFT JOIN `types_ligne` as types_ligne1 ON `types_ligne1`.`id`=`budgets1`.`type` ";
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
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 50;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "versements_view.php";
	$x->RedirectAfterInsert = "versements_view.php?SelectedID=#ID#";
	$x->TableTitle = "Versements (bailleur)";
	$x->TableIcon = "resources/table_icons/009-cash.png";
	$x->PrimaryKey = "`versements`.`id`";
	$x->DefaultSortField = '`versements`.`date`';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Convention", "Ligne Budg&#233;taire", "Date", "Intitul&#233;", "Montant", "Notes");
	$x->ColFieldName = array('convention', 'ligne_budgetaire', 'date', 'intitule', 'montant', 'notes');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7);

	// template paths below are based on the app main directory
	$x->Template = 'templates/versements_templateTV.html';
	$x->SelectedTemplate = 'templates/versements_templateTVS.html';
	$x->TemplateDV = 'templates/versements_templateDV.html';
	$x->TemplateDVP = 'templates/versements_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `versements`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='versements' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `versements`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='versements' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`versements`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: versements_init
	$render=TRUE;
	if(function_exists('versements_init')){
		$args=array();
		$render=versements_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// column sums
	if(strpos($x->HTML, '<!-- tv data below -->')){
		// if printing multi-selection TV, calculate the sum only for the selected records
		if(isset($_REQUEST['Print_x']) && is_array($_REQUEST['record_selector'])){
			$QueryWhere = '';
			foreach($_REQUEST['record_selector'] as $id){   // get selected records
				if($id != '') $QueryWhere .= "'" . makeSafe($id) . "',";
			}
			if($QueryWhere != ''){
				$QueryWhere = 'where `versements`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select CONCAT('<span style=''color: ', IF(sum(`versements`.`montant`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`versements`.`montant`), 2, 'ru_RU'), '</span>') from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)){
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="versements-convention"></td>';
			$sumRow .= '<td class="versements-ligne_budgetaire"></td>';
			$sumRow .= '<td class="versements-date"></td>';
			$sumRow .= '<td class="versements-intitule"></td>';
			$sumRow .= "<td class=\"versements-montant text-right\">{$row[0]}</td>";
			$sumRow .= '<td class="versements-notes"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: versements_header
	$headerCode='';
	if(function_exists('versements_header')){
		$args=array();
		$headerCode=versements_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: versements_footer
	$footerCode='';
	if(function_exists('versements_footer')){
		$args=array();
		$footerCode=versements_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>