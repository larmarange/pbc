<?php
	// check this file's MD5 to make sure it wasn't called before
	$prevMD5 = @file_get_contents(dirname(__FILE__) . '/setup.md5');
	$thisMD5 = md5(@file_get_contents(dirname(__FILE__) . '/updateDB.php'));

	// check if setup already run
	if($thisMD5 != $prevMD5) {
		// $silent is set if this file is included from setup.php
		if(!isset($silent)) $silent = true;

		// set up tables
		setupTable(
			'conventions', " 
			CREATE TABLE IF NOT EXISTS `conventions` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`nom` VARCHAR(40) NOT NULL,
				`statut` VARCHAR(40) NOT NULL DEFAULT 'active',
				`bailleur` VARCHAR(40) NULL,
				`porteur` INT UNSIGNED NULL,
				`chef_projet` INT UNSIGNED NULL,
				`date_reponse` DATE NULL,
				`demande` DECIMAL(10,2) NULL,
				`date_debut` DATE NULL,
				`date_fin` DATE NULL,
				`duree` MEDIUMINT UNSIGNED NULL,
				`notes` TEXT NULL,
				`accorde_hfg` DECIMAL(10,2) NULL,
				`frais_gestion` DECIMAL(10,2) UNSIGNED NULL,
				`accorde` DECIMAL(10,2) NULL,
				`verse` DECIMAL(10,2) NULL,
				`reste_verser` DECIMAL(10,2) NULL,
				`verse_hfg` DECIMAL(10,2) NULL,
				`ouvert` DECIMAL(10,2) NULL,
				`reste_ouvrir` DECIMAL(10,2) NULL,
				`non_liquide` DECIMAL(10,2) NULL,
				`liquide` DECIMAL(10,2) NULL,
				`utilise` DECIMAL(10,2) NULL,
				`disponible` DOUBLE(10,2) NULL,
				`reste_engager` DECIMAL(10,2) NULL,
				`reservation_salaire` DECIMAL(10,2) NULL,
				`reste_depenser` DECIMAL(10,2) NULL,
				`prop_uo` DECIMAL(10,1) NULL,
				`prop_uv` DECIMAL(10,1) NULL,
				`prop_ua` DECIMAL(10,1) NULL,
				`budget_nv` DECIMAL(10,2) NULL,
				`depenses_nv` DECIMAL(10,2) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('conventions', ['porteur','chef_projet',]);

		setupTable(
			'budgets', " 
			CREATE TABLE IF NOT EXISTS `budgets` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`convention` INT UNSIGNED NOT NULL,
				`type` INT UNSIGNED NOT NULL,
				`precision` VARCHAR(100) NULL,
				`accorde` DECIMAL(10,2) UNSIGNED NOT NULL,
				`notes` TEXT NULL,
				`verse` DECIMAL(10,2) NULL,
				`reste_verser` DECIMAL(10,2) NULL,
				`ouvert` DECIMAL(10,2) NULL,
				`reste_ouvrir` DECIMAL(10,2) NULL,
				`non_liquide` DECIMAL(10,2) NULL,
				`liquide` DECIMAL(10,2) NULL,
				`utilise` DECIMAL(10,2) NULL,
				`disponible` FLOAT(10,2) NULL,
				`reste_engager` DECIMAL(10,2) NULL,
				`reservation_salaire` DECIMAL(10,2) NULL,
				`reste_depenser` DECIMAL(10,2) NULL,
				`prop_uo` DECIMAL(10,1) NULL,
				`prop_uv` DECIMAL(10,1) NULL,
				`prop_ua` DECIMAL(10,1) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('budgets', ['convention','type',]);

		setupTable(
			'versements', " 
			CREATE TABLE IF NOT EXISTS `versements` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`convention` INT UNSIGNED NOT NULL,
				`ligne_budgetaire` INT UNSIGNED NOT NULL,
				`date` DATE NOT NULL,
				`intitule` VARCHAR(100) NULL,
				`montant` DECIMAL(10,2) NOT NULL,
				`notes` TEXT NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('versements', ['convention','ligne_budgetaire',]);

		setupTable(
			'lignes_credits', " 
			CREATE TABLE IF NOT EXISTS `lignes_credits` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`convention` INT UNSIGNED NOT NULL,
				`ligne_budgetaire` INT UNSIGNED NOT NULL,
				`intitule` VARCHAR(40) NOT NULL,
				`exercice` VARCHAR(10) NOT NULL,
				`notes` TEXT NULL,
				`ouvert` DECIMAL(10,2) NULL,
				`non_liquide` DECIMAL(10,2) NULL,
				`liquide` DECIMAL(10,2) NULL,
				`utilise` DECIMAL(10,2) NULL,
				`disponible` FLOAT(10,2) NULL,
				`prop_uo` DECIMAL(10,1) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('lignes_credits', ['convention','ligne_budgetaire',]);

		setupTable(
			'credits', " 
			CREATE TABLE IF NOT EXISTS `credits` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`convention` INT UNSIGNED NOT NULL,
				`ligne_budgetaire` INT UNSIGNED NULL,
				`ligne_credit` INT UNSIGNED NOT NULL,
				`date` DATE NOT NULL,
				`intitule` VARCHAR(100) NULL,
				`montant` DECIMAL(10,2) NOT NULL,
				`notes` TEXT NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('credits', ['convention','ligne_budgetaire','ligne_credit',]);

		setupTable(
			'rubriques', " 
			CREATE TABLE IF NOT EXISTS `rubriques` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`convention` INT UNSIGNED NOT NULL,
				`intitule` VARCHAR(100) NOT NULL,
				`notes` TEXT NULL,
				`accorde` DOUBLE(10,2) UNSIGNED NULL,
				`non_liquide` DECIMAL(10,2) NULL,
				`liquide` DECIMAL(10,2) NULL,
				`utilise` DECIMAL(10,2) NULL,
				`reste_engager` DECIMAL(10,2) NULL,
				`reservation_salaire` DECIMAL(10,2) NULL,
				`reste_depenser` DECIMAL(10,2) NULL,
				`prop_ua` DECIMAL(10,1) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('rubriques', ['convention',]);

		setupTable(
			'ventilation', " 
			CREATE TABLE IF NOT EXISTS `ventilation` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`convention` INT UNSIGNED NOT NULL,
				`rubrique` INT UNSIGNED NULL,
				`intitule` VARCHAR(100) NOT NULL,
				`notes` TEXT NULL,
				`accorde` DOUBLE(10,2) UNSIGNED NULL,
				`non_liquide` DECIMAL(10,2) NULL,
				`liquide` DECIMAL(10,2) NULL,
				`utilise` DECIMAL(10,2) NULL,
				`reste_engager` DECIMAL(10,2) NULL,
				`reservation_salaire` DECIMAL(10,2) NULL,
				`reste_depenser` DECIMAL(10,2) NULL,
				`prop_ua` DECIMAL(10,1) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('ventilation', ['convention','rubrique',]);

		setupTable(
			'recrutements', " 
			CREATE TABLE IF NOT EXISTS `recrutements` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`convention` INT UNSIGNED NOT NULL,
				`intitule` VARCHAR(100) NOT NULL,
				`beneficiaire` INT UNSIGNED NULL,
				`date_debut` DATE NULL,
				`date_fin` DATE NULL,
				`duree` MEDIUMINT UNSIGNED NULL,
				`ligne_budgetaire` INT UNSIGNED NULL,
				`ventilation` INT UNSIGNED NULL,
				`notes` TEXT NULL,
				`previsionnel` DOUBLE(10,2) UNSIGNED NULL,
				`depense` DECIMAL(10,2) NULL,
				`reservation_salaire` DECIMAL(10,2) NULL,
				`prop_dp` DECIMAL(10,2) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('recrutements', ['convention','beneficiaire','ligne_budgetaire','ventilation',]);

		setupTable(
			'depenses', " 
			CREATE TABLE IF NOT EXISTS `depenses` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`convention` INT UNSIGNED NOT NULL,
				`ligne_budgetaire` INT UNSIGNED NULL,
				`ligne_credit` INT UNSIGNED NOT NULL,
				`date` DATE NULL,
				`intitule` VARCHAR(100) NOT NULL,
				`reference` VARCHAR(40) NULL,
				`contrat` INT UNSIGNED NULL,
				`beneficiaire` INT UNSIGNED NULL,
				`montant` DECIMAL(10,2) NOT NULL,
				`liquidee` TINYINT NULL,
				`ventilation` INT UNSIGNED NULL,
				`notes` TEXT NULL,
				`verifie` TINYINT NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('depenses', ['convention','ligne_budgetaire','ligne_credit','contrat','beneficiaire','ventilation',]);

		setupTable(
			'fichiers', " 
			CREATE TABLE IF NOT EXISTS `fichiers` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`convention` INT UNSIGNED NOT NULL,
				`titre` VARCHAR(100) NOT NULL,
				`fichier` VARCHAR(150) NULL,
				`notes` TEXT NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('fichiers', ['convention',]);

		setupTable(
			'personnes', " 
			CREATE TABLE IF NOT EXISTS `personnes` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`nom` VARCHAR(100) NOT NULL,
				`email` VARCHAR(80) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'types_ligne', " 
			CREATE TABLE IF NOT EXISTS `types_ligne` ( 
				`frais_gestion` VARCHAR(40) NULL,
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`gestionnaire` VARCHAR(40) NOT NULL,
				`type` VARCHAR(40) NOT NULL
			) CHARSET utf8",
			$silent
		);



		// save MD5
		@file_put_contents(dirname(__FILE__) . '/setup.md5', $thisMD5);
	}


	function setupIndexes($tableName, $arrFields) {
		if(!is_array($arrFields) || !count($arrFields)) return false;

		foreach($arrFields as $fieldName) {
			if(!$res = @db_query("SHOW COLUMNS FROM `$tableName` like '$fieldName'")) continue;
			if(!$row = @db_fetch_assoc($res)) continue;
			if($row['Key']) continue;

			@db_query("ALTER TABLE `$tableName` ADD INDEX `$fieldName` (`$fieldName`)");
		}
	}


	function setupTable($tableName, $createSQL = '', $silent = true, $arrAlter = '') {
		global $Translation;
		ob_start();

		echo '<div style="padding: 5px; border-bottom:solid 1px silver; font-family: verdana, arial; font-size: 10px;">';

		// is there a table rename query?
		if(is_array($arrAlter)) {
			$matches = [];
			if(preg_match("/ALTER TABLE `(.*)` RENAME `$tableName`/i", $arrAlter[0], $matches)) {
				$oldTableName = $matches[1];
			}
		}

		if($res = @db_query("SELECT COUNT(1) FROM `$tableName`")) { // table already exists
			if($row = @db_fetch_array($res)) {
				echo str_replace(['<TableName>', '<NumRecords>'], [$tableName, $row[0]], $Translation['table exists']);
				if(is_array($arrAlter)) {
					echo '<br>';
					foreach($arrAlter as $alter) {
						if($alter != '') {
							echo "$alter ... ";
							if(!@db_query($alter)) {
								echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
								echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
							} else {
								echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
							}
						}
					}
				} else {
					echo $Translation['table uptodate'];
				}
			} else {
				echo str_replace('<TableName>', $tableName, $Translation['couldnt count']);
			}
		} else { // given tableName doesn't exist

			if($oldTableName != '') { // if we have a table rename query
				if($ro = @db_query("SELECT COUNT(1) FROM `$oldTableName`")) { // if old table exists, rename it.
					$renameQuery = array_shift($arrAlter); // get and remove rename query

					echo "$renameQuery ... ";
					if(!@db_query($renameQuery)) {
						echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
						echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
					} else {
						echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
					}

					if(is_array($arrAlter)) setupTable($tableName, $createSQL, false, $arrAlter); // execute Alter queries on renamed table ...
				} else { // if old tableName doesn't exist (nor the new one since we're here), then just create the table.
					setupTable($tableName, $createSQL, false); // no Alter queries passed ...
				}
			} else { // tableName doesn't exist and no rename, so just create the table
				echo str_replace("<TableName>", $tableName, $Translation["creating table"]);
				if(!@db_query($createSQL)) {
					echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
					echo '<div class="text-danger">' . $Translation['mysql said'] . db_error(db_link()) . '</div>';
				} else {
					echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
				}
			}
		}

		echo '</div>';

		$out = ob_get_clean();
		if(!$silent) echo $out;
	}
