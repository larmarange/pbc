<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/types_ligne.php");
	include_once("{$currDir}/types_ligne_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('types_ligne');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'types_ligne';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"concat('<i class=\"glyphicon glyphicon-', if(`types_ligne`.`frais_gestion`, 'check', 'unchecked'), '\"></i>')" => "frais_gestion",
		"`types_ligne`.`id`" => "id",
		"`types_ligne`.`gestionnaire`" => "gestionnaire",
		"`types_ligne`.`type`" => "type",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => 1,
		2 => '`types_ligne`.`id`',
		3 => 3,
		4 => 4,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`types_ligne`.`frais_gestion`" => "frais_gestion",
		"`types_ligne`.`id`" => "id",
		"`types_ligne`.`gestionnaire`" => "gestionnaire",
		"`types_ligne`.`type`" => "type",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`types_ligne`.`frais_gestion`" => "Frais de Gestion ?",
		"`types_ligne`.`id`" => "ID",
		"`types_ligne`.`gestionnaire`" => "Organisme gestionnaire",
		"`types_ligne`.`type`" => "Type",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"concat('<i class=\"glyphicon glyphicon-', if(`types_ligne`.`frais_gestion`, 'check', 'unchecked'), '\"></i>')" => "frais_gestion",
		"`types_ligne`.`id`" => "id",
		"`types_ligne`.`gestionnaire`" => "gestionnaire",
		"`types_ligne`.`type`" => "type",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`types_ligne` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = (getLoggedAdmin() !== false);
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = (getLoggedAdmin() !== false);
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = (getLoggedAdmin() !== false);
	$x->RecordsPerPage = 50;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'types_ligne_view.php';
	$x->RedirectAfterInsert = 'types_ligne_view.php';
	$x->TableTitle = 'Type de lignes budg&#233;taires';
	$x->TableIcon = 'resources/table_icons/034-mechanism.png';
	$x->PrimaryKey = '`types_ligne`.`id`';
	$x->DefaultSortField = '3';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth = [150, 150, 150, ];
	$x->ColCaption = ['Frais de Gestion ?', 'Organisme gestionnaire', 'Type', ];
	$x->ColFieldName = ['frais_gestion', 'gestionnaire', 'type', ];
	$x->ColNumber  = [1, 3, 4, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/types_ligne_templateTV.html';
	$x->SelectedTemplate = 'templates/types_ligne_templateTVS.html';
	$x->TemplateDV = 'templates/types_ligne_templateDV.html';
	$x->TemplateDVP = 'templates/types_ligne_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: types_ligne_init
	$render = true;
	if(function_exists('types_ligne_init')) {
		$args = [];
		$render = types_ligne_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: types_ligne_header
	$headerCode = '';
	if(function_exists('types_ligne_header')) {
		$args = [];
		$headerCode = types_ligne_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: types_ligne_footer
	$footerCode = '';
	if(function_exists('types_ligne_footer')) {
		$args = [];
		$footerCode = types_ligne_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
