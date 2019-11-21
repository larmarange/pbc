<?php
// This script and data application were generated by AppGini 5.81
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/conventions.php");
	include("$currDir/conventions_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('conventions');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "conventions";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`conventions`.`id`" => "id",
		"`conventions`.`nom`" => "nom",
		"`conventions`.`statut`" => "statut",
		"`conventions`.`bailleur`" => "bailleur",
		"IF(    CHAR_LENGTH(`personnes1`.`nom`), CONCAT_WS('',   `personnes1`.`nom`), '') /* Porteur */" => "porteur",
		"if(`conventions`.`date_reponse`,date_format(`conventions`.`date_reponse`,'%d/%m/%Y'),'')" => "date_reponse",
		"CONCAT('<span style=''color: ', IF(`conventions`.`demande` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`demande`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "demande",
		"if(`conventions`.`date_debut`,date_format(`conventions`.`date_debut`,'%d/%m/%Y'),'')" => "date_debut",
		"if(`conventions`.`date_fin`,date_format(`conventions`.`date_fin`,'%d/%m/%Y'),'')" => "date_fin",
		"`conventions`.`duree`" => "duree",
		"`conventions`.`notes`" => "notes",
		"CONCAT('<span style=''color: ', IF(`conventions`.`accorde_hfg` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`accorde_hfg`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde_hfg",
		"CONCAT('<span style=''color: ', IF(`conventions`.`frais_gestion` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`frais_gestion`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "frais_gestion",
		"CONCAT('<span style=''color: ', IF(`conventions`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"CONCAT('<span style=''color: ', IF(`conventions`.`verse` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`verse`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "verse",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reste_verser` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reste_verser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_verser",
		"CONCAT('<span style=''color: ', IF(`conventions`.`verse_hfg` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`verse_hfg`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "verse_hfg",
		"CONCAT('<span style=''color: ', IF(`conventions`.`ouvert` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`ouvert`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "ouvert",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reste_ouvrir` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reste_ouvrir`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_ouvrir",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reserve` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reserve`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reserve",
		"CONCAT('<span style=''color: ', IF(`conventions`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`conventions`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`conventions`.`disponible` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`disponible`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "disponible",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`conventions`.`prop_uo` > 100, 'red', 'black'), ';''>', FORMAT(`conventions`.`prop_uo`, 0, 'ru_RU'), '%</span>')" => "prop_uo",
		"CONCAT('<span style=''color: ', IF(`conventions`.`prop_uv` > 100, 'red', 'black'), ';''>', FORMAT(`conventions`.`prop_uv`, 0, 'ru_RU'), '%</span>')" => "prop_uv",
		"CONCAT('<span style=''color: ', IF(`conventions`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`conventions`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
		"CONCAT('<span style=''color: ', IF(`conventions`.`budget_nv` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`budget_nv`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "budget_nv",
		"CONCAT('<span style=''color: ', IF(`conventions`.`depenses_nv` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`depenses_nv`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "depenses_nv",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`conventions`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => '`personnes1`.`nom`',
		6 => '`conventions`.`date_reponse`',
		7 => '`conventions`.`demande`',
		8 => '`conventions`.`date_debut`',
		9 => '`conventions`.`date_fin`',
		10 => '`conventions`.`duree`',
		11 => 11,
		12 => '`conventions`.`accorde_hfg`',
		13 => '`conventions`.`frais_gestion`',
		14 => '`conventions`.`accorde`',
		15 => '`conventions`.`verse`',
		16 => '`conventions`.`reste_verser`',
		17 => '`conventions`.`verse_hfg`',
		18 => '`conventions`.`ouvert`',
		19 => '`conventions`.`reste_ouvrir`',
		20 => '`conventions`.`reserve`',
		21 => '`conventions`.`liquide`',
		22 => '`conventions`.`utilise`',
		23 => '`conventions`.`disponible`',
		24 => '`conventions`.`reste_engager`',
		25 => '`conventions`.`reservation_salaire`',
		26 => '`conventions`.`reste_depenser`',
		27 => '`conventions`.`prop_uo`',
		28 => '`conventions`.`prop_uv`',
		29 => '`conventions`.`prop_ua`',
		30 => '`conventions`.`budget_nv`',
		31 => '`conventions`.`depenses_nv`',
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`conventions`.`id`" => "id",
		"`conventions`.`nom`" => "nom",
		"`conventions`.`statut`" => "statut",
		"`conventions`.`bailleur`" => "bailleur",
		"IF(    CHAR_LENGTH(`personnes1`.`nom`), CONCAT_WS('',   `personnes1`.`nom`), '') /* Porteur */" => "porteur",
		"if(`conventions`.`date_reponse`,date_format(`conventions`.`date_reponse`,'%d/%m/%Y'),'')" => "date_reponse",
		"CONCAT('<span style=''color: ', IF(`conventions`.`demande` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`demande`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "demande",
		"if(`conventions`.`date_debut`,date_format(`conventions`.`date_debut`,'%d/%m/%Y'),'')" => "date_debut",
		"if(`conventions`.`date_fin`,date_format(`conventions`.`date_fin`,'%d/%m/%Y'),'')" => "date_fin",
		"`conventions`.`duree`" => "duree",
		"`conventions`.`notes`" => "notes",
		"CONCAT('<span style=''color: ', IF(`conventions`.`accorde_hfg` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`accorde_hfg`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde_hfg",
		"CONCAT('<span style=''color: ', IF(`conventions`.`frais_gestion` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`frais_gestion`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "frais_gestion",
		"CONCAT('<span style=''color: ', IF(`conventions`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"CONCAT('<span style=''color: ', IF(`conventions`.`verse` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`verse`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "verse",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reste_verser` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reste_verser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_verser",
		"CONCAT('<span style=''color: ', IF(`conventions`.`verse_hfg` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`verse_hfg`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "verse_hfg",
		"CONCAT('<span style=''color: ', IF(`conventions`.`ouvert` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`ouvert`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "ouvert",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reste_ouvrir` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reste_ouvrir`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_ouvrir",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reserve` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reserve`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reserve",
		"CONCAT('<span style=''color: ', IF(`conventions`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`conventions`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`conventions`.`disponible` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`disponible`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "disponible",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`conventions`.`prop_uo` > 100, 'red', 'black'), ';''>', FORMAT(`conventions`.`prop_uo`, 0, 'ru_RU'), '%</span>')" => "prop_uo",
		"CONCAT('<span style=''color: ', IF(`conventions`.`prop_uv` > 100, 'red', 'black'), ';''>', FORMAT(`conventions`.`prop_uv`, 0, 'ru_RU'), '%</span>')" => "prop_uv",
		"CONCAT('<span style=''color: ', IF(`conventions`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`conventions`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
		"CONCAT('<span style=''color: ', IF(`conventions`.`budget_nv` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`budget_nv`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "budget_nv",
		"CONCAT('<span style=''color: ', IF(`conventions`.`depenses_nv` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`depenses_nv`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "depenses_nv",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`conventions`.`id`" => "ID",
		"`conventions`.`nom`" => "Nom",
		"`conventions`.`statut`" => "Statut",
		"`conventions`.`bailleur`" => "Bailleur(s)",
		"IF(    CHAR_LENGTH(`personnes1`.`nom`), CONCAT_WS('',   `personnes1`.`nom`), '') /* Porteur */" => "Porteur",
		"`conventions`.`date_reponse`" => "Date r&#233;ponse",
		"`conventions`.`demande`" => "Demand&#233;",
		"`conventions`.`date_debut`" => "D&#233;but",
		"`conventions`.`date_fin`" => "Fin",
		"`conventions`.`duree`" => "Dur&#233;e (mois)",
		"`conventions`.`notes`" => "Notes",
		"`conventions`.`accorde_hfg`" => "Accord&#233; hors FG",
		"`conventions`.`frais_gestion`" => "Frais de Gestion",
		"`conventions`.`accorde`" => "Total Accord&#233;",
		"`conventions`.`verse`" => "Vers&#233;",
		"`conventions`.`reste_verser`" => "Reste &#224; Verser",
		"`conventions`.`verse_hfg`" => "Vers&#233; hors FG",
		"`conventions`.`ouvert`" => "Ouvert",
		"`conventions`.`reste_ouvrir`" => "Reste &#224; Ouvrir",
		"`conventions`.`reserve`" => "R&#233;serv&#233;",
		"`conventions`.`liquide`" => "Liquid&#233;",
		"`conventions`.`utilise`" => "Utilis&#233; (R+L)",
		"`conventions`.`disponible`" => "Disponible (O-U)",
		"`conventions`.`reste_engager`" => "Reste &#224; Engager",
		"`conventions`.`reservation_salaire`" => "Salaires restant &#224; verser",
		"`conventions`.`reste_depenser`" => "Reste &#224; D&#233;penser",
		"`conventions`.`prop_uo`" => "U/O (%)",
		"`conventions`.`prop_uv`" => "U/V (%)",
		"`conventions`.`prop_ua`" => "U/A (%, hors FG)",
		"`conventions`.`budget_nv`" => "Budget non ventil&#233;",
		"`conventions`.`depenses_nv`" => "D&#233;penses non ventil&#233;es",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`conventions`.`id`" => "id",
		"`conventions`.`nom`" => "nom",
		"`conventions`.`statut`" => "statut",
		"`conventions`.`bailleur`" => "bailleur",
		"IF(    CHAR_LENGTH(`personnes1`.`nom`), CONCAT_WS('',   `personnes1`.`nom`), '') /* Porteur */" => "porteur",
		"if(`conventions`.`date_reponse`,date_format(`conventions`.`date_reponse`,'%d/%m/%Y'),'')" => "date_reponse",
		"CONCAT('<span style=''color: ', IF(`conventions`.`demande` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`demande`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "demande",
		"if(`conventions`.`date_debut`,date_format(`conventions`.`date_debut`,'%d/%m/%Y'),'')" => "date_debut",
		"if(`conventions`.`date_fin`,date_format(`conventions`.`date_fin`,'%d/%m/%Y'),'')" => "date_fin",
		"`conventions`.`duree`" => "duree",
		"`conventions`.`notes`" => "notes",
		"CONCAT('<span style=''color: ', IF(`conventions`.`accorde_hfg` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`accorde_hfg`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde_hfg",
		"CONCAT('<span style=''color: ', IF(`conventions`.`frais_gestion` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`frais_gestion`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "frais_gestion",
		"CONCAT('<span style=''color: ', IF(`conventions`.`accorde` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`accorde`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "accorde",
		"CONCAT('<span style=''color: ', IF(`conventions`.`verse` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`verse`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "verse",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reste_verser` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reste_verser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_verser",
		"CONCAT('<span style=''color: ', IF(`conventions`.`verse_hfg` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`verse_hfg`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "verse_hfg",
		"CONCAT('<span style=''color: ', IF(`conventions`.`ouvert` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`ouvert`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "ouvert",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reste_ouvrir` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reste_ouvrir`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_ouvrir",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reserve` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reserve`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reserve",
		"CONCAT('<span style=''color: ', IF(`conventions`.`liquide` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`liquide`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "liquide",
		"CONCAT('<span style=''color: ', IF(`conventions`.`utilise` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`utilise`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "utilise",
		"CONCAT('<span style=''color: ', IF(`conventions`.`disponible` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`disponible`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "disponible",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reste_engager` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reste_engager`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_engager",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reservation_salaire` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reservation_salaire`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reservation_salaire",
		"CONCAT('<span style=''color: ', IF(`conventions`.`reste_depenser` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`reste_depenser`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "reste_depenser",
		"CONCAT('<span style=''color: ', IF(`conventions`.`prop_uo` > 100, 'red', 'black'), ';''>', FORMAT(`conventions`.`prop_uo`, 0, 'ru_RU'), '%</span>')" => "prop_uo",
		"CONCAT('<span style=''color: ', IF(`conventions`.`prop_uv` > 100, 'red', 'black'), ';''>', FORMAT(`conventions`.`prop_uv`, 0, 'ru_RU'), '%</span>')" => "prop_uv",
		"CONCAT('<span style=''color: ', IF(`conventions`.`prop_ua` > 100, 'red', 'black'), ';''>', FORMAT(`conventions`.`prop_ua`, 0, 'ru_RU'), '%</span>')" => "prop_ua",
		"CONCAT('<span style=''color: ', IF(`conventions`.`budget_nv` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`budget_nv`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "budget_nv",
		"CONCAT('<span style=''color: ', IF(`conventions`.`depenses_nv` < 0, 'red', 'black'), ';''>', FORMAT(`conventions`.`depenses_nv`, 2, 'ru_RU'), '&nbsp;&euro;</span>')" => "depenses_nv",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('porteur' => 'Porteur', );

	$x->QueryFrom = "`conventions` LEFT JOIN `personnes` as personnes1 ON `personnes1`.`id`=`conventions`.`porteur` ";
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
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 50;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "conventions_view.php";
	$x->RedirectAfterInsert = "conventions_view.php?SelectedID=#ID#";
	$x->TableTitle = "Conventions";
	$x->TableIcon = "resources/table_icons/035-legal-document.png";
	$x->PrimaryKey = "`conventions`.`id`";
	$x->DefaultSortField = '`conventions`.`date_fin`';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Nom", "Statut", "Bailleur(s)", "Porteur", "Date r&#233;ponse", "Demand&#233;", "D&#233;but", "Fin", "Dur&#233;e (mois)", "Accord&#233; hors FG", "Frais de Gestion", "Total Accord&#233;", "Vers&#233;", "Reste &#224; Verser", "Vers&#233; hors FG", "Ouvert", "Reste &#224; Ouvrir", "R&#233;serv&#233;", "Liquid&#233;", "Utilis&#233; (R+L)", "Disponible (O-U)", "Reste &#224; Engager", "Salaires restant &#224; verser", "Reste &#224; D&#233;penser", "U/O (%)", "U/V (%)", "U/A (%, hors FG)", "Budget non ventil&#233;", "D&#233;penses non ventil&#233;es");
	$x->ColFieldName = array('nom', 'statut', 'bailleur', 'porteur', 'date_reponse', 'demande', 'date_debut', 'date_fin', 'duree', 'accorde_hfg', 'frais_gestion', 'accorde', 'verse', 'reste_verser', 'verse_hfg', 'ouvert', 'reste_ouvrir', 'reserve', 'liquide', 'utilise', 'disponible', 'reste_engager', 'reservation_salaire', 'reste_depenser', 'prop_uo', 'prop_uv', 'prop_ua', 'budget_nv', 'depenses_nv');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31);

	// template paths below are based on the app main directory
	$x->Template = 'templates/conventions_templateTV.html';
	$x->SelectedTemplate = 'templates/conventions_templateTVS.html';
	$x->TemplateDV = 'templates/conventions_templateDV.html';
	$x->TemplateDVP = 'templates/conventions_templateDVP.html';

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
		$x->QueryWhere="where `conventions`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='conventions' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `conventions`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='conventions' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`conventions`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: conventions_init
	$render=TRUE;
	if(function_exists('conventions_init')) {
		$args=array();
		$render=conventions_init($x, getMemberInfo(), $args);
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
				$QueryWhere = 'where `conventions`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select CONCAT('<span style=''color: ', IF(sum(`conventions`.`demande`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`demande`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`accorde_hfg`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`accorde_hfg`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`frais_gestion`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`frais_gestion`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`accorde`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`accorde`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`verse`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`verse`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`reste_verser`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`reste_verser`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`verse_hfg`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`verse_hfg`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`ouvert`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`ouvert`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`reste_ouvrir`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`reste_ouvrir`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`reserve`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`reserve`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`liquide`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`liquide`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`utilise`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`utilise`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`disponible`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`disponible`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`reste_engager`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`reste_engager`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`reservation_salaire`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`reservation_salaire`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`reste_depenser`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`reste_depenser`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`budget_nv`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`budget_nv`), 2, 'ru_RU'), '&nbsp;&euro;</span>'), CONCAT('<span style=''color: ', IF(sum(`conventions`.`depenses_nv`) < 0, 'red', 'black'), ';''>', FORMAT(sum(`conventions`.`depenses_nv`), 2, 'ru_RU'), '&nbsp;&euro;</span>') from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)) {
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="conventions-nom"></td>';
			$sumRow .= '<td class="conventions-statut"></td>';
			$sumRow .= '<td class="conventions-bailleur"></td>';
			$sumRow .= '<td class="conventions-porteur"></td>';
			$sumRow .= '<td class="conventions-date_reponse"></td>';
			$sumRow .= "<td class=\"conventions-demande text-right\">{$row[0]}</td>";
			$sumRow .= '<td class="conventions-date_debut"></td>';
			$sumRow .= '<td class="conventions-date_fin"></td>';
			$sumRow .= '<td class="conventions-duree"></td>';
			$sumRow .= "<td class=\"conventions-accorde_hfg text-right\">{$row[1]}</td>";
			$sumRow .= "<td class=\"conventions-frais_gestion text-right\">{$row[2]}</td>";
			$sumRow .= "<td class=\"conventions-accorde text-right\">{$row[3]}</td>";
			$sumRow .= "<td class=\"conventions-verse text-right\">{$row[4]}</td>";
			$sumRow .= "<td class=\"conventions-reste_verser text-right\">{$row[5]}</td>";
			$sumRow .= "<td class=\"conventions-verse_hfg text-right\">{$row[6]}</td>";
			$sumRow .= "<td class=\"conventions-ouvert text-right\">{$row[7]}</td>";
			$sumRow .= "<td class=\"conventions-reste_ouvrir text-right\">{$row[8]}</td>";
			$sumRow .= "<td class=\"conventions-reserve text-right\">{$row[9]}</td>";
			$sumRow .= "<td class=\"conventions-liquide text-right\">{$row[10]}</td>";
			$sumRow .= "<td class=\"conventions-utilise text-right\">{$row[11]}</td>";
			$sumRow .= "<td class=\"conventions-disponible text-right\">{$row[12]}</td>";
			$sumRow .= "<td class=\"conventions-reste_engager text-right\">{$row[13]}</td>";
			$sumRow .= "<td class=\"conventions-reservation_salaire text-right\">{$row[14]}</td>";
			$sumRow .= "<td class=\"conventions-reste_depenser text-right\">{$row[15]}</td>";
			$sumRow .= '<td class="conventions-prop_uo"></td>';
			$sumRow .= '<td class="conventions-prop_uv"></td>';
			$sumRow .= '<td class="conventions-prop_ua"></td>';
			$sumRow .= "<td class=\"conventions-budget_nv text-right\">{$row[16]}</td>";
			$sumRow .= "<td class=\"conventions-depenses_nv text-right\">{$row[17]}</td>";
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: conventions_header
	$headerCode='';
	if(function_exists('conventions_header')) {
		$args=array();
		$headerCode=conventions_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: conventions_footer
	$footerCode='';
	if(function_exists('conventions_footer')) {
		$args=array();
		$footerCode=conventions_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>