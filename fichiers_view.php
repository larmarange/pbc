<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/fichiers.php");
	include("$currDir/fichiers_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('fichiers');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "fichiers";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`fichiers`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"`fichiers`.`titre`" => "titre",
		"`fichiers`.`fichier`" => "fichier",
		"if(CHAR_LENGTH(`fichiers`.`notes`)>80, concat(left(`fichiers`.`notes`,80),' ...'), `fichiers`.`notes`)" => "notes",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`fichiers`.`id`',
		2 => '`conventions1`.`nom`',
		3 => 3,
		4 => 4,
		5 => 5,
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`fichiers`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"`fichiers`.`titre`" => "titre",
		"`fichiers`.`fichier`" => "fichier",
		"`fichiers`.`notes`" => "notes",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`fichiers`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "Convention",
		"`fichiers`.`titre`" => "Titre",
		"`fichiers`.`fichier`" => "Fichier",
		"`fichiers`.`notes`" => "Notes",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`fichiers`.`id`" => "id",
		"IF(    CHAR_LENGTH(`conventions1`.`nom`), CONCAT_WS('',   `conventions1`.`nom`), '') /* Convention */" => "convention",
		"`fichiers`.`titre`" => "titre",
		"`fichiers`.`fichier`" => "fichier",
		"`fichiers`.`notes`" => "Notes",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('convention' => 'Convention', );

	$x->QueryFrom = "`fichiers` LEFT JOIN `conventions` as conventions1 ON `conventions1`.`id`=`fichiers`.`convention` ";
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
	$x->AllowCSV = 0;
	$x->RecordsPerPage = 50;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "fichiers_view.php";
	$x->RedirectAfterInsert = "fichiers_view.php?SelectedID=#ID#";
	$x->TableTitle = "Fichiers";
	$x->TableIcon = "resources/table_icons/025-exchange.png";
	$x->PrimaryKey = "`fichiers`.`id`";
	$x->DefaultSortField = '3';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth   = array(  150, 150, 150, 150);
	$x->ColCaption = array("Convention", "Titre", "Fichier", "Notes");
	$x->ColFieldName = array('convention', 'titre', 'fichier', 'notes');
	$x->ColNumber  = array(2, 3, 4, 5);

	// template paths below are based on the app main directory
	$x->Template = 'templates/fichiers_templateTV.html';
	$x->SelectedTemplate = 'templates/fichiers_templateTVS.html';
	$x->TemplateDV = 'templates/fichiers_templateDV.html';
	$x->TemplateDVP = 'templates/fichiers_templateDVP.html';

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
		$x->QueryWhere="where `fichiers`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='fichiers' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `fichiers`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='fichiers' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`fichiers`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: fichiers_init
	$render=TRUE;
	if(function_exists('fichiers_init')) {
		$args=array();
		$render=fichiers_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: fichiers_header
	$headerCode='';
	if(function_exists('fichiers_header')) {
		$args=array();
		$headerCode=fichiers_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: fichiers_footer
	$footerCode='';
	if(function_exists('fichiers_footer')) {
		$args=array();
		$footerCode=fichiers_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>