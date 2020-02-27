<?php
	$currDir = dirname(__FILE__);
	require("{$currDir}/incCommon.php");
	$GLOBALS['page_title'] = $Translation['view or rebuild fields'];
	include("{$currDir}/incHeader.php");

	/*
		$schema: [ tablename => [ fieldname => [ appgini => '...', 'db' => '...'], ... ], ... ]
	*/

	/* application schema as created in AppGini */
	$schema = array(
		'conventions' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'nom' => array('appgini' => 'VARCHAR(40) not null '),
			'statut' => array('appgini' => 'VARCHAR(40) not null default \'active\' '),
			'bailleur' => array('appgini' => 'VARCHAR(40) null '),
			'porteur' => array('appgini' => 'INT unsigned null '),
			'chef_projet' => array('appgini' => 'INT unsigned null '),
			'date_reponse' => array('appgini' => 'DATE null '),
			'demande' => array('appgini' => 'DECIMAL(10,2) null '),
			'date_debut' => array('appgini' => 'DATE null '),
			'date_fin' => array('appgini' => 'DATE null '),
			'duree' => array('appgini' => 'MEDIUMINT unsigned null '),
			'notes' => array('appgini' => 'TEXT null '),
			'accorde_hfg' => array('appgini' => 'DECIMAL(10,2) null '),
			'frais_gestion' => array('appgini' => 'DECIMAL(10,2) unsigned null '),
			'accorde' => array('appgini' => 'DECIMAL(10,2) null '),
			'verse' => array('appgini' => 'DECIMAL(10,2) null '),
			'reste_verser' => array('appgini' => 'DECIMAL(10,2) null '),
			'verse_hfg' => array('appgini' => 'DECIMAL(10,2) null '),
			'ouvert' => array('appgini' => 'DECIMAL(10,2) null '),
			'reste_ouvrir' => array('appgini' => 'DECIMAL(10,2) null '),
			'non_liquide' => array('appgini' => 'DECIMAL(10,2) null '),
			'liquide' => array('appgini' => 'DECIMAL(10,2) null '),
			'utilise' => array('appgini' => 'DECIMAL(10,2) null '),
			'disponible' => array('appgini' => 'DOUBLE(10,2) null '),
			'reste_engager' => array('appgini' => 'DECIMAL(10,2) null '),
			'reservation_salaire' => array('appgini' => 'DECIMAL(10,2) null '),
			'reste_depenser' => array('appgini' => 'DECIMAL(10,2) null '),
			'prop_uo' => array('appgini' => 'DECIMAL(10,1) null '),
			'prop_uv' => array('appgini' => 'DECIMAL(10,1) null '),
			'prop_ua' => array('appgini' => 'DECIMAL(10,1) null '),
			'budget_nv' => array('appgini' => 'DECIMAL(10,2) null '),
			'depenses_nv' => array('appgini' => 'DECIMAL(10,2) null '),
		),
		'budgets' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'convention' => array('appgini' => 'INT unsigned not null '),
			'type' => array('appgini' => 'INT unsigned not null '),
			'precision' => array('appgini' => 'VARCHAR(100) null '),
			'accorde' => array('appgini' => 'DECIMAL(10,2) unsigned not null '),
			'notes' => array('appgini' => 'TEXT null '),
			'verse' => array('appgini' => 'DECIMAL(10,2) null '),
			'reste_verser' => array('appgini' => 'DECIMAL(10,2) null '),
			'ouvert' => array('appgini' => 'DECIMAL(10,2) null '),
			'reste_ouvrir' => array('appgini' => 'DECIMAL(10,2) null '),
			'non_liquide' => array('appgini' => 'DECIMAL(10,2) null '),
			'liquide' => array('appgini' => 'DECIMAL(10,2) null '),
			'utilise' => array('appgini' => 'DECIMAL(10,2) null '),
			'disponible' => array('appgini' => 'FLOAT(10,2) null '),
			'reste_engager' => array('appgini' => 'DECIMAL(10,2) null '),
			'reservation_salaire' => array('appgini' => 'DECIMAL(10,2) null '),
			'reste_depenser' => array('appgini' => 'DECIMAL(10,2) null '),
			'prop_uo' => array('appgini' => 'DECIMAL(10,1) null '),
			'prop_uv' => array('appgini' => 'DECIMAL(10,1) null '),
			'prop_ua' => array('appgini' => 'DECIMAL(10,1) null '),
		),
		'versements' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'convention' => array('appgini' => 'INT unsigned not null '),
			'ligne_budgetaire' => array('appgini' => 'INT unsigned not null '),
			'date' => array('appgini' => 'DATE not null '),
			'intitule' => array('appgini' => 'VARCHAR(100) null '),
			'montant' => array('appgini' => 'DECIMAL(10,2) not null '),
			'notes' => array('appgini' => 'TEXT null '),
		),
		'lignes_credits' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'convention' => array('appgini' => 'INT unsigned not null '),
			'ligne_budgetaire' => array('appgini' => 'INT unsigned not null '),
			'intitule' => array('appgini' => 'VARCHAR(40) not null '),
			'exercice' => array('appgini' => 'VARCHAR(10) not null '),
			'notes' => array('appgini' => 'TEXT null '),
			'ouvert' => array('appgini' => 'DECIMAL(10,2) null '),
			'non_liquide' => array('appgini' => 'DECIMAL(10,2) null '),
			'liquide' => array('appgini' => 'DECIMAL(10,2) null '),
			'utilise' => array('appgini' => 'DECIMAL(10,2) null '),
			'disponible' => array('appgini' => 'FLOAT(10,2) null '),
			'prop_uo' => array('appgini' => 'DECIMAL(10,1) null '),
		),
		'credits' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'convention' => array('appgini' => 'INT unsigned not null '),
			'ligne_budgetaire' => array('appgini' => 'INT unsigned null '),
			'ligne_credit' => array('appgini' => 'INT unsigned not null '),
			'date' => array('appgini' => 'DATE not null '),
			'intitule' => array('appgini' => 'VARCHAR(100) null '),
			'montant' => array('appgini' => 'DECIMAL(10,2) not null '),
			'notes' => array('appgini' => 'TEXT null '),
		),
		'rubriques' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'convention' => array('appgini' => 'INT unsigned not null '),
			'intitule' => array('appgini' => 'VARCHAR(100) not null '),
			'notes' => array('appgini' => 'TEXT null '),
			'accorde' => array('appgini' => 'DOUBLE(10,2) unsigned null '),
			'non_liquide' => array('appgini' => 'DECIMAL(10,2) null '),
			'liquide' => array('appgini' => 'DECIMAL(10,2) null '),
			'utilise' => array('appgini' => 'DECIMAL(10,2) null '),
			'reste_engager' => array('appgini' => 'DECIMAL(10,2) null '),
			'reservation_salaire' => array('appgini' => 'DECIMAL(10,2) null '),
			'reste_depenser' => array('appgini' => 'DECIMAL(10,2) null '),
			'prop_ua' => array('appgini' => 'DECIMAL(10,1) null '),
		),
		'ventilation' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'convention' => array('appgini' => 'INT unsigned not null '),
			'rubrique' => array('appgini' => 'INT unsigned null '),
			'intitule' => array('appgini' => 'VARCHAR(100) not null '),
			'notes' => array('appgini' => 'TEXT null '),
			'accorde' => array('appgini' => 'DOUBLE(10,2) unsigned null '),
			'non_liquide' => array('appgini' => 'DECIMAL(10,2) null '),
			'liquide' => array('appgini' => 'DECIMAL(10,2) null '),
			'utilise' => array('appgini' => 'DECIMAL(10,2) null '),
			'reste_engager' => array('appgini' => 'DECIMAL(10,2) null '),
			'reservation_salaire' => array('appgini' => 'DECIMAL(10,2) null '),
			'reste_depenser' => array('appgini' => 'DECIMAL(10,2) null '),
			'prop_ua' => array('appgini' => 'DECIMAL(10,1) null '),
		),
		'recrutements' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'convention' => array('appgini' => 'INT unsigned not null '),
			'intitule' => array('appgini' => 'VARCHAR(100) not null '),
			'beneficiaire' => array('appgini' => 'INT unsigned null '),
			'date_debut' => array('appgini' => 'DATE null '),
			'date_fin' => array('appgini' => 'DATE null '),
			'duree' => array('appgini' => 'MEDIUMINT unsigned null '),
			'ligne_budgetaire' => array('appgini' => 'INT unsigned null '),
			'ventilation' => array('appgini' => 'INT unsigned null '),
			'notes' => array('appgini' => 'TEXT null '),
			'previsionnel' => array('appgini' => 'DOUBLE(10,2) unsigned null '),
			'depense' => array('appgini' => 'DECIMAL(10,2) null '),
			'reservation_salaire' => array('appgini' => 'DECIMAL(10,2) null '),
			'prop_dp' => array('appgini' => 'DECIMAL(10,2) null '),
		),
		'depenses' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'convention' => array('appgini' => 'INT unsigned not null '),
			'ligne_budgetaire' => array('appgini' => 'INT unsigned null '),
			'ligne_credit' => array('appgini' => 'INT unsigned not null '),
			'date' => array('appgini' => 'DATE not null '),
			'intitule' => array('appgini' => 'VARCHAR(100) not null '),
			'reference' => array('appgini' => 'VARCHAR(40) null '),
			'contrat' => array('appgini' => 'INT unsigned null '),
			'beneficiaire' => array('appgini' => 'INT unsigned null '),
			'montant' => array('appgini' => 'DECIMAL(10,2) not null '),
			'liquidee' => array('appgini' => 'TINYINT null '),
			'ventilation' => array('appgini' => 'INT unsigned null '),
			'notes' => array('appgini' => 'TEXT null '),
			'verifie' => array('appgini' => 'TINYINT null '),
		),
		'fichiers' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'convention' => array('appgini' => 'INT unsigned not null '),
			'titre' => array('appgini' => 'VARCHAR(100) not null '),
			'fichier' => array('appgini' => 'VARCHAR(150) null '),
			'notes' => array('appgini' => 'TEXT null '),
		),
		'personnes' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'nom' => array('appgini' => 'VARCHAR(100) not null '),
			'email' => array('appgini' => 'VARCHAR(80) null '),
		),
		'types_ligne' => array(
			'frais_gestion' => array('appgini' => 'VARCHAR(40) null '),
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'gestionnaire' => array('appgini' => 'VARCHAR(40) not null '),
			'type' => array('appgini' => 'VARCHAR(40) not null '),
		),
	);

	$table_captions = getTableList();

	/* function for preparing field definition for comparison */
	function prepare_def($def) {
		$def = strtolower($def);

		/* ignore 'null' */
		$def = preg_replace('/\s+not\s+null\s*/', '%%NOT_NULL%%', $def);
		$def = preg_replace('/\s+null\s*/', ' ', $def);
		$def = str_replace('%%NOT_NULL%%', ' not null ', $def);

		/* ignore length for int data types */
		$def = preg_replace('/int\s*\([0-9]+\)/', 'int', $def);

		/* make sure there is always a space before mysql words */
		$def = preg_replace('/(\S)(unsigned|not null|binary|zerofill|auto_increment|default)/', '$1 $2', $def);

		/* treat 0.000.. same as 0 */
		$def = preg_replace('/([0-9])*\.0+/', '$1', $def);

		/* treat unsigned zerofill same as zerofill */
		$def = str_ireplace('unsigned zerofill', 'zerofill', $def);

		/* ignore zero-padding for date data types */
		$def = preg_replace("/date\s*default\s*'([0-9]{4})-0?([1-9])-0?([1-9])'/", "date default '$1-$2-$3'", $def);

		return trim($def);
	}

	/**
	 *  @brief creates/fixes given field according to given schema
	 *  @return integer: 0 = error, 1 = field updated, 2 = field created
	 */
	function fix_field($fix_table, $fix_field, $schema, &$qry) {
		if(!isset($schema[$fix_table][$fix_field])) return 0;

		$def = $schema[$fix_table][$fix_field];
		$field_added = $field_updated = false;
		$eo['silentErrors'] = true;

		// field exists?
		$res = sql("show columns from `{$fix_table}` like '{$fix_field}'", $eo);
		if($row = db_fetch_assoc($res)) {
			// modify field
			$qry = "alter table `{$fix_table}` modify `{$fix_field}` {$def['appgini']}";
			sql($qry, $eo);

			// remove unique from db if necessary
			if($row['Key'] == 'UNI' && !stripos($def['appgini'], ' unique')) {
				// retrieve unique index name
				$res_unique = sql("show index from `{$fix_table}` where Column_name='{$fix_field}' and Non_unique=0", $eo);
				if($row_unique = db_fetch_assoc($res_unique)) {
					$qry_unique = "drop index `{$row_unique['Key_name']}` on `{$fix_table}`";
					sql($qry_unique, $eo);
					$qry .= ";\n{$qry_unique}";
				}
			}

			return 1;
		}

		// missing field is defined as PK and table has another PK field?
		$current_pk = getPKFieldName($fix_table);
		if(stripos($def['appgini'], 'primary key') !== false && $current_pk !== false) {
			// if current PK is not another AppGini-defined field, then rename it.
			if(!isset($schema[$fix_table][$current_pk])) {
				// no need to include 'primary key' in definition since it's already a PK field
				$redef = str_ireplace(' primary key', '', $def['appgini']);
				$qry = "alter table `{$fix_table}` change `{$current_pk}` `{$fix_field}` {$redef}";
				sql($qry, $eo);
				return 1;
			}

			// current PK field is another AppGini-defined field
			// this happens if table had a PK field in AppGini then it was unset as PK
			// and another field was created and set as PK
			// in that case, drop PK index from current PK
			// and also remove auto_increment from it if defined
			// then proceed to creating the missing PK field
			$pk_def = str_ireplace(' auto_increment', '', $schema[$fix_table][$current_pk]);
			sql("alter table `{$fix_table}` modify `{$current_pk}` {$pk_def}", $eo);
		}

		// create field
		$qry = "alter table `{$fix_table}` add column `{$fix_field}` {$def['appgini']}";
		sql($qry, $eo);
		return 2;
	}

	/* process requested fixes */
	$fix_table = (isset($_GET['t']) ? $_GET['t'] : false);
	$fix_field = (isset($_GET['f']) ? $_GET['f'] : false);
	$fix_all = (isset($_GET['all']) ? true : false);

	if($fix_field && $fix_table) $fix_status = fix_field($fix_table, $fix_field, $schema, $qry);

	/* retrieve actual db schema */
	foreach($table_captions as $tn => $tc) {
		$eo['silentErrors'] = true;
		$res = sql("show columns from `{$tn}`", $eo);
		if($res) {
			while($row = db_fetch_assoc($res)) {
				if(!isset($schema[$tn][$row['Field']]['appgini'])) continue;
				$field_description = strtoupper(str_replace(' ', '', $row['Type']));
				$field_description = str_ireplace('unsigned', ' unsigned', $field_description);
				$field_description = str_ireplace('zerofill', ' zerofill', $field_description);
				$field_description = str_ireplace('binary', ' binary', $field_description);
				$field_description .= ($row['Null'] == 'NO' ? ' not null' : '');
				$field_description .= ($row['Key'] == 'PRI' ? ' primary key' : '');
				$field_description .= ($row['Key'] == 'UNI' ? ' unique' : '');
				$field_description .= ($row['Default'] != '' ? " default '" . makeSafe($row['Default']) . "'" : '');
				$field_description .= ($row['Extra'] == 'auto_increment' ? ' auto_increment' : '');

				$schema[$tn][$row['Field']]['db'] = '';
				if(isset($schema[$tn][$row['Field']])) {
					$schema[$tn][$row['Field']]['db'] = $field_description;
				}
			}
		}
	}

	/* handle fix_all request */
	if($fix_all) {
		foreach($schema as $tn => $fields) {
			foreach($fields as $fn => $fd) {
				if(prepare_def($fd['appgini']) == prepare_def($fd['db'])) continue;
				fix_field($tn, $fn, $schema, $qry);
			}
		}

		redirect('admin/pageRebuildFields.php');
		exit;
	}
?>

<?php if($fix_status == 1 || $fix_status == 2) { ?>
	<div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<i class="glyphicon glyphicon-info-sign"></i>
		<?php 
			$originalValues = array('<ACTION>', '<FIELD>', '<TABLE>', '<QUERY>');
			$action = ($fix_status == 2 ? 'create' : 'update');
			$replaceValues = array($action, $fix_field, $fix_table, $qry);
			echo str_replace($originalValues, $replaceValues, $Translation['create or update table']);
		?>
	</div>
<?php } ?>

<div class="page-header"><h1>
	<?php echo $Translation['view or rebuild fields'] ; ?>
	<button type="button" class="btn btn-default" id="show_deviations_only"><i class="glyphicon glyphicon-eye-close"></i> <?php echo $Translation['show deviations only'] ; ?></button>
	<button type="button" class="btn btn-default hidden" id="show_all_fields"><i class="glyphicon glyphicon-eye-open"></i> <?php echo $Translation['show all fields'] ; ?></button>
</h1></div>

<p class="lead"><?php echo $Translation['compare tables page'] ; ?></p>

<div class="alert summary"></div>
<table class="table table-responsive table-hover table-striped">
	<thead><tr>
		<th></th>
		<th><?php echo $Translation['field'] ; ?></th>
		<th><?php echo $Translation['AppGini definition'] ; ?></th>
		<th><?php echo $Translation['database definition'] ; ?></th>
		<th id="fix_all"></th>
	</tr></thead>

	<tbody>
	<?php foreach($schema as $tn => $fields) { ?>
		<tr class="text-info"><td colspan="5"><h4 data-placement="left" data-toggle="tooltip" title="<?php echo str_replace ( "<TABLENAME>" , $tn , $Translation['table name title']) ; ?>"><i class="glyphicon glyphicon-th-list"></i> <?php echo $table_captions[$tn]; ?></h4></td></tr>
		<?php foreach($fields as $fn => $fd) { ?>
			<?php $diff = ((prepare_def($fd['appgini']) == prepare_def($fd['db'])) ? false : true); ?>
			<?php $no_db = ($fd['db'] ? false : true); ?>
			<tr class="<?php echo ($diff ? 'warning' : 'field_ok'); ?>">
				<td><i class="glyphicon glyphicon-<?php echo ($diff ? 'remove text-danger' : 'ok text-success'); ?>"></i></td>
				<td><?php echo $fn; ?></td>
				<td class="<?php echo ($diff ? 'bold text-success' : ''); ?>"><?php echo $fd['appgini']; ?></td>
				<td class="<?php echo ($diff ? 'bold text-danger' : ''); ?>"><?php echo thisOr($fd['db'], $Translation['does not exist']); ?></td>
				<td>
					<?php if($diff && $no_db) { ?>
						<a href="pageRebuildFields.php?t=<?php echo $tn; ?>&f=<?php echo $fn; ?>" class="btn btn-success btn-xs btn_create" data-toggle="tooltip" data-placement="top" title="<?php echo $Translation['create field'] ; ?>"><i class="glyphicon glyphicon-plus"></i> <?php echo $Translation['create it'] ; ?></a>
					<?php }elseif($diff) { ?>
						<a href="pageRebuildFields.php?t=<?php echo $tn; ?>&f=<?php echo $fn; ?>" class="btn btn-warning btn-xs btn_update" data-toggle="tooltip" title="<?php echo $Translation['fix field'] ; ?>"><i class="glyphicon glyphicon-cog"></i> <?php echo $Translation['fix it'] ; ?></a>
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
	<?php } ?>
	</tbody>
</table>
<div class="alert summary"></div>

<style>
	.bold{ font-weight: bold; }
	[data-toggle="tooltip"]{ display: block !important; }
</style>

<script>
	$j(function() {
		$j('[data-toggle="tooltip"]').tooltip();

		$j('#show_deviations_only').click(function() {
			$j(this).addClass('hidden');
			$j('#show_all_fields').removeClass('hidden');
			$j('.field_ok').hide();
		});

		$j('#show_all_fields').click(function() {
			$j(this).addClass('hidden');
			$j('#show_deviations_only').removeClass('hidden');
			$j('.field_ok').show();
		});

		$j('.btn_update, #fix_all').click(function() {
			return confirm("<?php echo $Translation['field update warning'] ; ?>");
		});

		var count_updates = $j('.btn_update').length;
		var count_creates = $j('.btn_create').length;
		if(!count_creates && !count_updates) {
			$j('.summary').addClass('alert-success').html("<?php echo $Translation['no deviations found'] ; ?>");
		}else{
			var fieldsCount = "<?php echo $Translation['error fields']; ?>";
			fieldsCount = fieldsCount.replace(/<CREATENUM>/, count_creates ).replace(/<UPDATENUM>/, count_updates);


			$j('.summary')
				.addClass('alert-warning')
				.html(
					fieldsCount + 
					'<br><br>' + 
					'<a href="pageBackupRestore.php" class="alert-link">' +
						'<b><?php echo addslashes($Translation['backup before fix']); ?></b>' +
					'</a>'
				);

			$j('<a href="pageRebuildFields.php?all=1" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-cog"></i> <?php echo addslashes($Translation['fix all']); ?></a>').appendTo('#fix_all');
		}
	});
</script>

<?php
	include("{$currDir}/incFooter.php");
?>
