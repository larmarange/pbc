<?php
	// check this file's MD5 to make sure it wasn't called before
	$prevMD5=@implode('', @file(dirname(__FILE__).'/setup.md5'));
	$thisMD5=md5(@implode('', @file("./updateDB.php")));
	if($thisMD5==$prevMD5){
		$setupAlreadyRun=true;
	}else{
		// set up tables
		if(!isset($silent)){
			$silent=true;
		}

		// set up tables
		setupTable('conventions', "create table if not exists `conventions` (   `id` INT unsigned not null auto_increment , primary key (`id`), `nom` VARCHAR(40) not null , `statut` VARCHAR(40) not null default 'active' , `bailleur` VARCHAR(40) null , `porteur` INT unsigned null , `date_reponse` DATE null , `demande` DECIMAL(10,2) null , `date_debut` DATE null , `date_fin` DATE null , `duree` MEDIUMINT unsigned null , `notes` TEXT null , `accorde_hfg` DECIMAL(10,2) null , `frais_gestion` DECIMAL(10,2) unsigned null , `accorde` DECIMAL(10,2) null , `verse` DECIMAL(10,2) null , `reste_verser` DECIMAL(10,2) null , `verse_hfg` DECIMAL(10,2) null , `ouvert` DECIMAL(10,2) null , `reste_ouvrir` DECIMAL(10,2) null , `reserve` DECIMAL(10,2) null , `liquide` DECIMAL(10,2) null , `utilise` DECIMAL(10,2) null , `disponible` DOUBLE(10,2) null , `reste_engager` DECIMAL(10,2) null , `prop_uo` DECIMAL(10,1) null , `prop_uv` DECIMAL(10,1) null , `prop_ua` DECIMAL(10,1) null , `budget_nv` DECIMAL(10,2) null , `depenses_nv` DECIMAL(10,2) null ) CHARSET utf8", $silent, array( "ALTER TABLE `conventions` ADD `accorde_1` DECIMAL(10,2) null ","ALTER TABLE `conventions` CHANGE `accorde_1` `demande` DECIMAL(10,2) null ","ALTER TABLE `conventions` ADD `date_debut_1` DATE null ","ALTER TABLE `conventions` CHANGE `date_debut_1` `date_reponse` DATE null "));
		setupIndexes('conventions', array('porteur'));
		setupTable('budgets', "create table if not exists `budgets` (   `id` INT unsigned not null auto_increment , primary key (`id`), `convention` INT unsigned not null , `type` INT unsigned not null , `accorde` DECIMAL(10,2) unsigned not null , `verse` DECIMAL(10,2) null , `reste_verser` DECIMAL(10,2) null , `ouvert` DECIMAL(10,2) null , `reste_ouvrir` DECIMAL(10,2) null , `reserve` DECIMAL(10,2) null , `liquide` DECIMAL(10,2) null , `utilise` DECIMAL(10,2) null , `disponible` FLOAT(10,2) null , `reste_engager` DECIMAL(10,2) null , `prop_uo` DECIMAL(10,1) null , `prop_uv` DECIMAL(10,1) null , `prop_ua` DECIMAL(10,1) null ) CHARSET utf8", $silent);
		setupIndexes('budgets', array('convention','type'));
		setupTable('versements', "create table if not exists `versements` (   `id` INT unsigned not null auto_increment , primary key (`id`), `convention` INT unsigned not null , `ligne_budgetaire` INT unsigned not null , `date` DATE not null , `intitule` VARCHAR(100) null , `montant` DECIMAL(10,2) not null , `notes` TEXT null ) CHARSET utf8", $silent);
		setupIndexes('versements', array('convention','ligne_budgetaire'));
		setupTable('lignes_credits', "create table if not exists `lignes_credits` (   `id` INT unsigned not null auto_increment , primary key (`id`), `convention` INT unsigned not null , `ligne_budgetaire` INT unsigned not null , `intitule` VARCHAR(40) null , `notes` TEXT null , `ouvert` DECIMAL(10,2) null , `reserve` DECIMAL(10,2) null , `liquide` DECIMAL(10,2) null , `utilise` DECIMAL(10,2) null , `disponible` FLOAT(10,2) null , `prop_uo` DECIMAL(10,1) null ) CHARSET utf8", $silent);
		setupIndexes('lignes_credits', array('convention','ligne_budgetaire'));
		setupTable('credits', "create table if not exists `credits` (   `id` INT unsigned not null auto_increment , primary key (`id`), `convention` INT unsigned not null , `ligne_budgetaire` INT unsigned null , `ligne_credit` INT unsigned not null , `date` DATE not null , `intitule` VARCHAR(100) null , `montant` DECIMAL(10,2) not null , `notes` TEXT null ) CHARSET utf8", $silent);
		setupIndexes('credits', array('convention','ligne_budgetaire','ligne_credit'));
		setupTable('ventilation', "create table if not exists `ventilation` (   `id` INT unsigned not null auto_increment , primary key (`id`), `convention` INT unsigned not null , `intitule` VARCHAR(100) not null , `notes` TEXT null , `accorde` DOUBLE(10,2) unsigned null , `reserve` DECIMAL(10,2) null , `liquide` DECIMAL(10,2) null , `utilise` DECIMAL(10,2) null , `reste_engager` DECIMAL(10,2) null , `prop_ua` DECIMAL(10,1) null ) CHARSET utf8", $silent);
		setupIndexes('ventilation', array('convention'));
		setupTable('depenses', "create table if not exists `depenses` (   `id` INT unsigned not null auto_increment , primary key (`id`), `convention` INT unsigned not null , `ligne_budgetaire` INT unsigned null , `ligne_credit` INT unsigned not null , `date` DATE not null , `intitule` VARCHAR(100) not null , `beneficiaire` INT unsigned null , `montant` DECIMAL(10,2) not null , `statut` VARCHAR(40) not null default '1' , `ventilation` INT unsigned null , `notes` TEXT null ) CHARSET utf8", $silent);
		setupIndexes('depenses', array('convention','ligne_budgetaire','ligne_credit','beneficiaire','ventilation'));
		setupTable('fichiers', "create table if not exists `fichiers` (   `id` INT unsigned not null auto_increment , primary key (`id`), `convention` INT unsigned not null , `titre` VARCHAR(100) not null , `fichier` VARCHAR(150) null , `notes` TEXT null ) CHARSET utf8", $silent);
		setupIndexes('fichiers', array('convention'));
		setupTable('personnes', "create table if not exists `personnes` (   `id` INT unsigned not null auto_increment , primary key (`id`), `nom` VARCHAR(100) not null , `email` VARCHAR(80) null ) CHARSET utf8", $silent);
		setupTable('types_ligne', "create table if not exists `types_ligne` (   `frais_gestion` VARCHAR(40) null , `id` INT unsigned not null auto_increment , primary key (`id`), `gestionnaire` VARCHAR(40) not null , `type` VARCHAR(40) not null ) CHARSET utf8", $silent);


		// save MD5
		if($fp=@fopen(dirname(__FILE__).'/setup.md5', 'w')){
			fwrite($fp, $thisMD5);
			fclose($fp);
		}
	}


	function setupIndexes($tableName, $arrFields){
		if(!is_array($arrFields)){
			return false;
		}

		foreach($arrFields as $fieldName){
			if(!$res=@db_query("SHOW COLUMNS FROM `$tableName` like '$fieldName'")){
				continue;
			}
			if(!$row=@db_fetch_assoc($res)){
				continue;
			}
			if($row['Key']==''){
				@db_query("ALTER TABLE `$tableName` ADD INDEX `$fieldName` (`$fieldName`)");
			}
		}
	}


	function setupTable($tableName, $createSQL='', $silent=true, $arrAlter=''){
		global $Translation;
		ob_start();

		echo '<div style="padding: 5px; border-bottom:solid 1px silver; font-family: verdana, arial; font-size: 10px;">';

		// is there a table rename query?
		if(is_array($arrAlter)){
			$matches=array();
			if(preg_match("/ALTER TABLE `(.*)` RENAME `$tableName`/", $arrAlter[0], $matches)){
				$oldTableName=$matches[1];
			}
		}

		if($res=@db_query("select count(1) from `$tableName`")){ // table already exists
			if($row = @db_fetch_array($res)){
				echo str_replace("<TableName>", $tableName, str_replace("<NumRecords>", $row[0],$Translation["table exists"]));
				if(is_array($arrAlter)){
					echo '<br>';
					foreach($arrAlter as $alter){
						if($alter!=''){
							echo "$alter ... ";
							if(!@db_query($alter)){
								echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
								echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
							}else{
								echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
							}
						}
					}
				}else{
					echo $Translation["table uptodate"];
				}
			}else{
				echo str_replace("<TableName>", $tableName, $Translation["couldnt count"]);
			}
		}else{ // given tableName doesn't exist

			if($oldTableName!=''){ // if we have a table rename query
				if($ro=@db_query("select count(1) from `$oldTableName`")){ // if old table exists, rename it.
					$renameQuery=array_shift($arrAlter); // get and remove rename query

					echo "$renameQuery ... ";
					if(!@db_query($renameQuery)){
						echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
						echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
					}else{
						echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
					}

					if(is_array($arrAlter)) setupTable($tableName, $createSQL, false, $arrAlter); // execute Alter queries on renamed table ...
				}else{ // if old tableName doesn't exist (nor the new one since we're here), then just create the table.
					setupTable($tableName, $createSQL, false); // no Alter queries passed ...
				}
			}else{ // tableName doesn't exist and no rename, so just create the table
				echo str_replace("<TableName>", $tableName, $Translation["creating table"]);
				if(!@db_query($createSQL)){
					echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
					echo '<div class="text-danger">' . $Translation['mysql said'] . db_error(db_link()) . '</div>';
				}else{
					echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
				}
			}
		}

		echo "</div>";

		$out=ob_get_contents();
		ob_end_clean();
		if(!$silent){
			echo $out;
		}
	}
?>