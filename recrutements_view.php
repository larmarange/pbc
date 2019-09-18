<?php
// This script and data application were generated by AppGini 5.76
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/recrutements.php");
	include("$currDir/recrutements_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('recrutements');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "recrutements";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`recrutements`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"`recrutements`.`intitule`" => "intitule",
		"IF(    CHAR_LENGTH(`personnes1`.`nom`), CONCAT_WS('',   `personnes1`.`nom`), '') /* B&#233;n&#233;ficiaire */" => "beneficiaire",
		"if(`recrutements`.`date_debut`,date_format(`recrutements`.`date_debut`,'%d/%m/%Y'),'')" => "date_debut",
		"if(`recrutements`.`date_fin`,date_format(`recrutements`.`date_fin`,'%d/%m/%Y'),'')" => "date_fin",
		"`recrutements`.`duree`" => "duree",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne budg&#233;taire */" => "ligne_budgetaire",
		"IF(    CHAR_LENGTH(`ventilation1`.`intitule`), CONCAT_WS('',   `ventilation1`.`intitule`), '') /* Ventilation Budg&#233;taire */" => "ventilation",
		"if(CHAR_LENGTH(`recrutements`.`notes`)>80, concat(left(`recrutements`.`notes`,80),' ...'), `recrutements`.`notes`)" => "notes",
		"CONCAT('<span style=''color: ', IF(`recrutements`.`previsionnel` < 0, 'red', 'black'), ';''>', FORMAT(`recrutements`.`previsionnel`, 2, 'ru_RU'), '</span>')" => "previsionnel",
		"CONCAT('<span style=''color: ', IF(`recrutements`.`depense` < 0, 'red', 'black'), ';''>', FORMAT(`recrutements`.`depense`, 2, 'ru_RU'), '</span>')" => "depense",
		"CONCAT('<span style=''color: ', IF(`recrutements`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`recrutements`.`reservation_salaire`, 2, 'ru_RU'), '</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`recrutements`.`prop_dp` > 100, 'red', 'black'), ';''>', FORMAT(`recrutements`.`prop_dp`, 0, 'ru_RU'), '%</span>')" => "prop_dp"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`recrutements`.`id`',
		2 => '`conventions1`.`nom`',
		3 => 3,
		4 => '`personnes1`.`nom`',
		5 => '`recrutements`.`date_debut`',
		6 => '`recrutements`.`date_fin`',
		7 => '`recrutements`.`duree`',
		8 => 8,
		9 => '`ventilation1`.`intitule`',
		10 => 10,
		11 => '`recrutements`.`previsionnel`',
		12 => '`recrutements`.`depense`',
		13 => '`recrutements`.`reservation_salaire`',
		14 => '`recrutements`.`prop_dp`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`recrutements`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"`recrutements`.`intitule`" => "intitule",
		"IF(    CHAR_LENGTH(`personnes1`.`nom`), CONCAT_WS('',   `personnes1`.`nom`), '') /* B&#233;n&#233;ficiaire */" => "beneficiaire",
		"if(`recrutements`.`date_debut`,date_format(`recrutements`.`date_debut`,'%d/%m/%Y'),'')" => "date_debut",
		"if(`recrutements`.`date_fin`,date_format(`recrutements`.`date_fin`,'%d/%m/%Y'),'')" => "date_fin",
		"`recrutements`.`duree`" => "duree",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne budg&#233;taire */" => "ligne_budgetaire",
		"IF(    CHAR_LENGTH(`ventilation1`.`intitule`), CONCAT_WS('',   `ventilation1`.`intitule`), '') /* Ventilation Budg&#233;taire */" => "ventilation",
		"`recrutements`.`notes`" => "notes",
		"CONCAT('<span style=''color: ', IF(`recrutements`.`previsionnel` < 0, 'red', 'black'), ';''>', FORMAT(`recrutements`.`previsionnel`, 2, 'ru_RU'), '</span>')" => "previsionnel",
		"CONCAT('<span style=''color: ', IF(`recrutements`.`depense` < 0, 'red', 'black'), ';''>', FORMAT(`recrutements`.`depense`, 2, 'ru_RU'), '</span>')" => "depense",
		"CONCAT('<span style=''color: ', IF(`recrutements`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`recrutements`.`reservation_salaire`, 2, 'ru_RU'), '</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`recrutements`.`prop_dp` > 100, 'red', 'black'), ';''>', FORMAT(`recrutements`.`prop_dp`, 0, 'ru_RU'), '%</span>')" => "prop_dp"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`recrutements`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "Convention",
		"`recrutements`.`intitule`" => "Intitul&#233; du poste",
		"IF(    CHAR_LENGTH(`personnes1`.`nom`), CONCAT_WS('',   `personnes1`.`nom`), '') /* B&#233;n&#233;ficiaire */" => "B&#233;n&#233;ficiaire",
		"`recrutements`.`date_debut`" => "D&#233;but",
		"`recrutements`.`date_fin`" => "Fin",
		"`recrutements`.`duree`" => "Dur&#233;e (mois)",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne budg&#233;taire */" => "Ligne budg&#233;taire",
		"IF(    CHAR_LENGTH(`ventilation1`.`intitule`), CONCAT_WS('',   `ventilation1`.`intitule`), '') /* Ventilation Budg&#233;taire */" => "Ventilation Budg&#233;taire",
		"`recrutements`.`notes`" => "Notes",
		"`recrutements`.`previsionnel`" => "Co&#251;t total pr&#233;visionnel",
		"`recrutements`.`depense`" => "D&#233;pens&#233;",
		"`recrutements`.`reservation_salaire`" => "Salaires restant &#224; verser",
		"`recrutements`.`prop_dp`" => "D/P (%)"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`recrutements`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"`recrutements`.`intitule`" => "intitule",
		"IF(    CHAR_LENGTH(`personnes1`.`nom`), CONCAT_WS('',   `personnes1`.`nom`), '') /* B&#233;n&#233;ficiaire */" => "beneficiaire",
		"if(`recrutements`.`date_debut`,date_format(`recrutements`.`date_debut`,'%d/%m/%Y'),'')" => "date_debut",
		"if(`recrutements`.`date_fin`,date_format(`recrutements`.`date_fin`,'%d/%m/%Y'),'')" => "date_fin",
		"`recrutements`.`duree`" => "duree",
		"IF(    CHAR_LENGTH(`types_ligne1`.`gestionnaire`) || CHAR_LENGTH(`types_ligne1`.`type`), CONCAT_WS('',   `types_ligne1`.`gestionnaire`, ' - ', `types_ligne1`.`type`), '') /* Ligne budg&#233;taire */" => "ligne_budgetaire",
		"IF(    CHAR_LENGTH(`ventilation1`.`intitule`), CONCAT_WS('',   `ventilation1`.`intitule`), '') /* Ventilation Budg&#233;taire */" => "ventilation",
		"`recrutements`.`notes`" => "Notes",
		"CONCAT('<span style=''color: ', IF(`recrutements`.`previsionnel` < 0, 'red', 'black'), ';''>', FORMAT(`recrutements`.`previsionnel`, 2, 'ru_RU'), '</span>')" => "previsionnel",
		"CONCAT('<span style=''color: ', IF(`recrutements`.`depense` < 0, 'red', 'black'), ';''>', FORMAT(`recrutements`.`depense`, 2, 'ru_RU'), '</span>')" => "depense",
		"CONCAT('<span style=''color: ', IF(`recrutements`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`recrutements`.`reservation_salaire`, 2, 'ru_RU'), '</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`recrutements`.`prop_dp` > 100, 'red', 'black'), ';''>', FORMAT(`recrutements`.`prop_dp`, 0, 'ru_RU'), '%</span>')" => "prop_dp"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'convention' => 'Convention', 'beneficiaire' => 'B&#233;n&#233;ficiaire', 'ligne_budgetaire' => 'Ligne budg&#233;taire', 'ventilation' => 'Ventilation Budg&#233;taire');

	$x->QueryFrom = "`recrutements` LEFT JOIN `conventions` as conventions1 ON `conventions1`.`id`=`recrutements`.`convention` LEFT JOIN `personnes` as personnes1 ON `personnes1`.`id`=`recrutements`.`beneficiaire` LEFT JOIN `budgets` as budgets1 ON `budgets1`.`id`=`recrutements`.`ligne_budgetaire` LEFT JOIN `types_ligne` as types_ligne1 ON `types_ligne1`.`id`=`budgets1`.`type` LEFT JOIN `ventilation` as ventilation1 ON `ventilation1`.`id`=`recrutements`.`ventilation` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = false;
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
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "recrutements_view.php";
	$x->RedirectAfterInsert = "recrutements_view.php?SelectedID=#ID#";
	$x->TableTitle = "Recrutements";
	$x->TableIcon = "resources/table_icons/067-human-resources-1.png";
	$x->PrimaryKey = "`recrutements`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Convention", "Intitul&#233; du poste", "B&#233;n&#233;ficiaire", "D&#233;but", "Fin", "Dur&#233;e (mois)", "Ligne budg&#233;taire", "Ventilation Budg&#233;taire", "Notes", "Co&#251;t total pr&#233;visionnel", "D&#233;pens&#233;", "Salaires restant &#224; verser", "D/P (%)");
	$x->ColFieldName = array('convention', 'intitule', 'beneficiaire', 'date_debut', 'date_fin', 'duree', 'ligne_budgetaire', 'ventilation', 'notes', 'previsionnel', 'depense', 'reservation_salaire', 'prop_dp');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14);

	// template paths below are based on the app main directory
	$x->Template = 'templates/recrutements_templateTV.html';
	$x->SelectedTemplate = 'templates/recrutements_templateTVS.html';
	$x->TemplateDV = 'templates/recrutements_templateDV.html';
	$x->TemplateDVP = 'templates/recrutements_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `recrutements`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='recrutements' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `recrutements`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='recrutements' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`recrutements`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: recrutements_init
	$render=TRUE;
	if(function_exists('recrutements_init')){
		$args=array();
		$render=recrutements_init($x, getMemberInfo(), $args);
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
				$QueryWhere = 'where `recrutements`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select CONCAT('<span style=''color: ', IF(sum(`recrutements`.`previsionnel`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`recrutements`.`previsionnel`), 2, 'ru_RU'), '</span>'), CONCAT('<span style=''color: ', IF(sum(`recrutements`.`depense`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`recrutements`.`depense`), 2, 'ru_RU'), '</span>'), CONCAT('<span style=''color: ', IF(sum(`recrutements`.`reservation_salaire`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`recrutements`.`reservation_salaire`), 2, 'ru_RU'), '</span>') from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)){
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="recrutements-convention"></td>';
			$sumRow .= '<td class="recrutements-intitule"></td>';
			$sumRow .= '<td class="recrutements-beneficiaire"></td>';
			$sumRow .= '<td class="recrutements-date_debut"></td>';
			$sumRow .= '<td class="recrutements-date_fin"></td>';
			$sumRow .= '<td class="recrutements-duree"></td>';
			$sumRow .= '<td class="recrutements-ligne_budgetaire"></td>';
			$sumRow .= '<td class="recrutements-ventilation"></td>';
			$sumRow .= '<td class="recrutements-notes"></td>';
			$sumRow .= "<td class=\"recrutements-previsionnel text-right\">{$row[0]}</td>";
			$sumRow .= "<td class=\"recrutements-depense text-right\">{$row[1]}</td>";
			$sumRow .= "<td class=\"recrutements-reservation_salaire text-right\">{$row[2]}</td>";
			$sumRow .= '<td class="recrutements-prop_dp"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: recrutements_header
	$headerCode='';
	if(function_exists('recrutements_header')){
		$args=array();
		$headerCode=recrutements_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: recrutements_footer
	$footerCode='';
	if(function_exists('recrutements_footer')){
		$args=array();
		$footerCode=recrutements_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>