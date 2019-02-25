<?php

// Data functions (insert, update, delete, form) for table versements

// This script and data application were generated by AppGini 5.74
// Download AppGini for free from https://bigprof.com/appgini/download/

function versements_insert(){
	global $Translation;

	// mm: can member insert record?
	$arrPerm=getTablePermissions('versements');
	if(!$arrPerm[1]){
		return false;
	}

	$data['convention'] = makeSafe($_REQUEST['convention']);
		if($data['convention'] == empty_lookup_value){ $data['convention'] = ''; }
	$data['ligne_budgetaire'] = makeSafe($_REQUEST['ligne_budgetaire']);
		if($data['ligne_budgetaire'] == empty_lookup_value){ $data['ligne_budgetaire'] = ''; }
	$data['date'] = intval($_REQUEST['dateYear']) . '-' . intval($_REQUEST['dateMonth']) . '-' . intval($_REQUEST['dateDay']);
	$data['date'] = parseMySQLDate($data['date'], '1');
	$data['intitule'] = makeSafe($_REQUEST['intitule']);
		if($data['intitule'] == empty_lookup_value){ $data['intitule'] = ''; }
	$data['montant'] = makeSafe($_REQUEST['montant']);
		if($data['montant'] == empty_lookup_value){ $data['montant'] = ''; }
	$data['notes'] = makeSafe($_REQUEST['notes']);
		if($data['notes'] == empty_lookup_value){ $data['notes'] = ''; }
	if($data['convention']== ''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Convention': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	if($data['ligne_budgetaire']== ''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Ligne Budg&#233;taire': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	if($data['date']== ''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Date': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	if($data['montant']== ''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Montant': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}

	// hook: versements_before_insert
	if(function_exists('versements_before_insert')){
		$args=array();
		if(!versements_before_insert($data, getMemberInfo(), $args)){ return false; }
	}

	$o = array('silentErrors' => true);
	sql('insert into `versements` set       `convention`=' . (($data['convention'] !== '' && $data['convention'] !== NULL) ? "'{$data['convention']}'" : 'NULL') . ', `ligne_budgetaire`=' . (($data['ligne_budgetaire'] !== '' && $data['ligne_budgetaire'] !== NULL) ? "'{$data['ligne_budgetaire']}'" : 'NULL') . ', `date`=' . (($data['date'] !== '' && $data['date'] !== NULL) ? "'{$data['date']}'" : 'NULL') . ', `intitule`=' . (($data['intitule'] !== '' && $data['intitule'] !== NULL) ? "'{$data['intitule']}'" : 'NULL') . ', `montant`=' . (($data['montant'] !== '' && $data['montant'] !== NULL) ? "'{$data['montant']}'" : 'NULL') . ', `notes`=' . (($data['notes'] !== '' && $data['notes'] !== NULL) ? "'{$data['notes']}'" : 'NULL'), $o);
	if($o['error']!=''){
		echo $o['error'];
		echo "<a href=\"versements_view.php?addNew_x=1\">{$Translation['< back']}</a>";
		exit;
	}

	$recID = db_insert_id(db_link());

	// hook: versements_after_insert
	if(function_exists('versements_after_insert')){
		$res = sql("select * from `versements` where `id`='" . makeSafe($recID, false) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=array();
		if(!versements_after_insert($data, getMemberInfo(), $args)){ return $recID; }
	}

	// mm: save ownership data
	set_record_owner('versements', $recID, getLoggedMemberID());

	return $recID;
}

function versements_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false){
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('versements');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='versements' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='versements' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: versements_before_delete
	if(function_exists('versements_before_delete')){
		$args=array();
		if(!versements_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	sql("delete from `versements` where `id`='$selected_id'", $eo);

	// hook: versements_after_delete
	if(function_exists('versements_after_delete')){
		$args=array();
		versements_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='versements' and pkValue='$selected_id'", $eo);
}

function versements_update($selected_id){
	global $Translation;

	// mm: can member edit record?
	$arrPerm=getTablePermissions('versements');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='versements' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='versements' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){ // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['convention'] = makeSafe($_REQUEST['convention']);
		if($data['convention'] == empty_lookup_value){ $data['convention'] = ''; }
	if($data['convention']==''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Convention': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['ligne_budgetaire'] = makeSafe($_REQUEST['ligne_budgetaire']);
		if($data['ligne_budgetaire'] == empty_lookup_value){ $data['ligne_budgetaire'] = ''; }
	if($data['ligne_budgetaire']==''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Ligne Budg&#233;taire': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['date'] = intval($_REQUEST['dateYear']) . '-' . intval($_REQUEST['dateMonth']) . '-' . intval($_REQUEST['dateDay']);
	$data['date'] = parseMySQLDate($data['date'], '1');
	if($data['date']==''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Date': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['intitule'] = makeSafe($_REQUEST['intitule']);
		if($data['intitule'] == empty_lookup_value){ $data['intitule'] = ''; }
	$data['montant'] = makeSafe($_REQUEST['montant']);
		if($data['montant'] == empty_lookup_value){ $data['montant'] = ''; }
	if($data['montant']==''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Montant': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['notes'] = makeSafe($_REQUEST['notes']);
		if($data['notes'] == empty_lookup_value){ $data['notes'] = ''; }
	$data['selectedID']=makeSafe($selected_id);

	// hook: versements_before_update
	if(function_exists('versements_before_update')){
		$args=array();
		if(!versements_before_update($data, getMemberInfo(), $args)){ return false; }
	}

	$o=array('silentErrors' => true);
	sql('update `versements` set       `convention`=' . (($data['convention'] !== '' && $data['convention'] !== NULL) ? "'{$data['convention']}'" : 'NULL') . ', `ligne_budgetaire`=' . (($data['ligne_budgetaire'] !== '' && $data['ligne_budgetaire'] !== NULL) ? "'{$data['ligne_budgetaire']}'" : 'NULL') . ', `date`=' . (($data['date'] !== '' && $data['date'] !== NULL) ? "'{$data['date']}'" : 'NULL') . ', `intitule`=' . (($data['intitule'] !== '' && $data['intitule'] !== NULL) ? "'{$data['intitule']}'" : 'NULL') . ', `montant`=' . (($data['montant'] !== '' && $data['montant'] !== NULL) ? "'{$data['montant']}'" : 'NULL') . ', `notes`=' . (($data['notes'] !== '' && $data['notes'] !== NULL) ? "'{$data['notes']}'" : 'NULL') . " where `id`='".makeSafe($selected_id)."'", $o);
	if($o['error']!=''){
		echo $o['error'];
		echo '<a href="versements_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}


	// hook: versements_after_update
	if(function_exists('versements_after_update')){
		$res = sql("SELECT * FROM `versements` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['id'];
		$args = array();
		if(!versements_after_update($data, getMemberInfo(), $args)){ return; }
	}

	// mm: update ownership data
	sql("update membership_userrecords set dateUpdated='".time()."' where tableName='versements' and pkValue='".makeSafe($selected_id)."'", $eo);

}

function versements_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = ''){
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('versements');
	if(!$arrPerm[1] && $selected_id==''){ return ''; }
	$AllowInsert = ($arrPerm[1] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != ''){
		$dvprint = true;
	}

	$filterer_convention = thisOr(undo_magic_quotes($_REQUEST['filterer_convention']), '');
	$filterer_ligne_budgetaire = thisOr(undo_magic_quotes($_REQUEST['filterer_ligne_budgetaire']), '');

	// populate filterers, starting from children to grand-parents
	if($filterer_ligne_budgetaire && !$filterer_convention) $filterer_convention = sqlValue("select convention from budgets where id='" . makeSafe($filterer_ligne_budgetaire) . "'");

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: convention
	$combo_convention = new DataCombo;
	// combobox: ligne_budgetaire, filterable by: convention
	$combo_ligne_budgetaire = new DataCombo;
	// combobox: date
	$combo_date = new DateCombo;
	$combo_date->DateFormat = "dmy";
	$combo_date->MinYear = 1900;
	$combo_date->MaxYear = 2100;
	$combo_date->DefaultDate = parseMySQLDate('1', '1');
	$combo_date->MonthNames = $Translation['month names'];
	$combo_date->NamePrefix = 'date';

	if($selected_id){
		// mm: check member permissions
		if(!$arrPerm[2]){
			return "";
		}
		// mm: who is the owner?
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='versements' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='versements' and pkValue='".makeSafe($selected_id)."'");
		if($arrPerm[2]==1 && getLoggedMemberID()!=$ownerMemberID){
			return "";
		}
		if($arrPerm[2]==2 && getLoggedGroupID()!=$ownerGroupID){
			return "";
		}

		// can edit?
		if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){
			$AllowUpdate=1;
		}else{
			$AllowUpdate=0;
		}

		$res = sql("select * from `versements` where `id`='".makeSafe($selected_id)."'", $eo);
		if(!($row = db_fetch_array($res))){
			return error_message($Translation['No records found'], 'versements_view.php', false);
		}
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
		$combo_convention->SelectedData = $row['convention'];
		$combo_ligne_budgetaire->SelectedData = $row['ligne_budgetaire'];
		$combo_date->DefaultDate = $row['date'];
	}else{
		$combo_convention->SelectedData = $filterer_convention;
		$combo_ligne_budgetaire->SelectedData = $filterer_ligne_budgetaire;
	}
	$combo_convention->HTML = '<span id="convention-container' . $rnd1 . '"></span><input type="hidden" name="convention" id="convention' . $rnd1 . '" value="' . html_attr($combo_convention->SelectedData) . '">';
	$combo_convention->MatchText = '<span id="convention-container-readonly' . $rnd1 . '"></span><input type="hidden" name="convention" id="convention' . $rnd1 . '" value="' . html_attr($combo_convention->SelectedData) . '">';
	$combo_ligne_budgetaire->HTML = '<span id="ligne_budgetaire-container' . $rnd1 . '"></span><input type="hidden" name="ligne_budgetaire" id="ligne_budgetaire' . $rnd1 . '" value="' . html_attr($combo_ligne_budgetaire->SelectedData) . '">';
	$combo_ligne_budgetaire->MatchText = '<span id="ligne_budgetaire-container-readonly' . $rnd1 . '"></span><input type="hidden" name="ligne_budgetaire" id="ligne_budgetaire' . $rnd1 . '" value="' . html_attr($combo_ligne_budgetaire->SelectedData) . '">';

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_convention__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['convention'] : $filterer_convention); ?>"};
		AppGini.current_ligne_budgetaire__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['ligne_budgetaire'] : $filterer_ligne_budgetaire); ?>"};

		jQuery(function() {
			setTimeout(function(){
				if(typeof(convention_reload__RAND__) == 'function') convention_reload__RAND__();
				<?php echo (!$AllowUpdate || $dvprint ? 'if(typeof(ligne_budgetaire_reload__RAND__) == \'function\') ligne_budgetaire_reload__RAND__(AppGini.current_convention__RAND__.value);' : ''); ?>
			}, 10); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function convention_reload__RAND__(){
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint){ ?>

			$j("#convention-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c){
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_convention__RAND__.value, t: 'versements', f: 'convention' },
						success: function(resp){
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="convention"]').val(resp.results[0].id);
							$j('[id=convention-container-readonly__RAND__]').html('<span id="convention-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=conventions_view_parent]').hide(); }else{ $j('.btn[id=conventions_view_parent]').show(); }

						if(typeof(ligne_budgetaire_reload__RAND__) == 'function') ligne_budgetaire_reload__RAND__(AppGini.current_convention__RAND__.value);

							if(typeof(convention_update_autofills__RAND__) == 'function') convention_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term){ /* */ return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 5,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page){ /* */ return { s: term, p: page, t: 'versements', f: 'convention' }; },
					results: function(resp, page){ /* */ return resp; }
				},
				escapeMarkup: function(str){ /* */ return str; }
			}).on('change', function(e){
				AppGini.current_convention__RAND__.value = e.added.id;
				AppGini.current_convention__RAND__.text = e.added.text;
				$j('[name="convention"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=conventions_view_parent]').hide(); }else{ $j('.btn[id=conventions_view_parent]').show(); }

						if(typeof(ligne_budgetaire_reload__RAND__) == 'function') ligne_budgetaire_reload__RAND__(AppGini.current_convention__RAND__.value);

				if(typeof(convention_update_autofills__RAND__) == 'function') convention_update_autofills__RAND__();
			});

			if(!$j("#convention-container__RAND__").length){
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_convention__RAND__.value, t: 'versements', f: 'convention' },
					success: function(resp){
						$j('[name="convention"]').val(resp.results[0].id);
						$j('[id=convention-container-readonly__RAND__]').html('<span id="convention-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=conventions_view_parent]').hide(); }else{ $j('.btn[id=conventions_view_parent]').show(); }

						if(typeof(convention_update_autofills__RAND__) == 'function') convention_update_autofills__RAND__();
					}
				});
			}

		<?php }else{ ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_convention__RAND__.value, t: 'versements', f: 'convention' },
				success: function(resp){
					$j('[id=convention-container__RAND__], [id=convention-container-readonly__RAND__]').html('<span id="convention-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=conventions_view_parent]').hide(); }else{ $j('.btn[id=conventions_view_parent]').show(); }

					if(typeof(convention_update_autofills__RAND__) == 'function') convention_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
		function ligne_budgetaire_reload__RAND__(filterer_convention){
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint){ ?>

			$j("#ligne_budgetaire-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c){
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { filterer_convention: filterer_convention, id: AppGini.current_ligne_budgetaire__RAND__.value, t: 'versements', f: 'ligne_budgetaire' },
						success: function(resp){
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="ligne_budgetaire"]').val(resp.results[0].id);
							$j('[id=ligne_budgetaire-container-readonly__RAND__]').html('<span id="ligne_budgetaire-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=budgets_view_parent]').hide(); }else{ $j('.btn[id=budgets_view_parent]').show(); }


							if(typeof(ligne_budgetaire_update_autofills__RAND__) == 'function') ligne_budgetaire_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term){ /* */ return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 5,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page){ /* */ return { filterer_convention: filterer_convention, s: term, p: page, t: 'versements', f: 'ligne_budgetaire' }; },
					results: function(resp, page){ /* */ return resp; }
				},
				escapeMarkup: function(str){ /* */ return str; }
			}).on('change', function(e){
				AppGini.current_ligne_budgetaire__RAND__.value = e.added.id;
				AppGini.current_ligne_budgetaire__RAND__.text = e.added.text;
				$j('[name="ligne_budgetaire"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=budgets_view_parent]').hide(); }else{ $j('.btn[id=budgets_view_parent]').show(); }


				if(typeof(ligne_budgetaire_update_autofills__RAND__) == 'function') ligne_budgetaire_update_autofills__RAND__();
			});

			if(!$j("#ligne_budgetaire-container__RAND__").length){
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_ligne_budgetaire__RAND__.value, t: 'versements', f: 'ligne_budgetaire' },
					success: function(resp){
						$j('[name="ligne_budgetaire"]').val(resp.results[0].id);
						$j('[id=ligne_budgetaire-container-readonly__RAND__]').html('<span id="ligne_budgetaire-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=budgets_view_parent]').hide(); }else{ $j('.btn[id=budgets_view_parent]').show(); }

						if(typeof(ligne_budgetaire_update_autofills__RAND__) == 'function') ligne_budgetaire_update_autofills__RAND__();
					}
				});
			}

		<?php }else{ ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_ligne_budgetaire__RAND__.value, t: 'versements', f: 'ligne_budgetaire' },
				success: function(resp){
					$j('[id=ligne_budgetaire-container__RAND__], [id=ligne_budgetaire-container-readonly__RAND__]').html('<span id="ligne_budgetaire-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=budgets_view_parent]').hide(); }else{ $j('.btn[id=budgets_view_parent]').show(); }

					if(typeof(ligne_budgetaire_update_autofills__RAND__) == 'function') ligne_budgetaire_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_contents());
	ob_end_clean();


	// code for template based detail view forms

	// open the detail view template
	if($dvprint){
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/versements_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	}else{
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/versements_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Versement', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($arrPerm[1] && !$selected_id){ // allow insert and no record selected?
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return versements_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return versements_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']){
		$backAction = 'AppGini.closeParentModal(); return false;';
	}else{
		$backAction = '$j(\'form\').eq(0).attr(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id){
		if(!$_REQUEST['Embedded']) $templateCode = str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="dvprint" name="dvprint_x" value="1" onclick="$j(\'form\').eq(0).prop(\'novalidate\', true); document.myform.reset(); return true;" title="' . html_attr($Translation['Print Preview']) . '"><i class="glyphicon glyphicon-print"></i> ' . $Translation['Print Preview'] . '</button>', $templateCode);
		if($AllowUpdate){
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return versements_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');" title="' . html_attr($Translation['Delete']) . '"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', ($ShowCancel ? '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>' : ''), $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate) || (!$selected_id && !$AllowInsert)){
		$jsReadOnly .= "\tjQuery('#convention').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#convention_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#ligne_budgetaire').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#ligne_budgetaire_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#date').prop('readonly', true);\n";
		$jsReadOnly .= "\tjQuery('#dateDay, #dateMonth, #dateYear').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#intitule').replaceWith('<div class=\"form-control-static\" id=\"intitule\">' + (jQuery('#intitule').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#montant').replaceWith('<div class=\"form-control-static\" id=\"montant\">' + (jQuery('#montant').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif(($AllowInsert && !$selected_id) || ($AllowUpdate && $selected_id)){
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(convention)%%>', $combo_convention->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(convention)%%>', $combo_convention->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(convention)%%>', urlencode($combo_convention->MatchText), $templateCode);
	$templateCode = str_replace('<%%COMBO(ligne_budgetaire)%%>', $combo_ligne_budgetaire->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(ligne_budgetaire)%%>', $combo_ligne_budgetaire->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(ligne_budgetaire)%%>', urlencode($combo_ligne_budgetaire->MatchText), $templateCode);
	$templateCode = str_replace('<%%COMBO(date)%%>', ($selected_id && !$arrPerm[3] ? '<div class="form-control-static">' . $combo_date->GetHTML(true) . '</div>' : $combo_date->GetHTML()), $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(date)%%>', $combo_date->GetHTML(true), $templateCode);

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array(  'convention' => array('conventions', 'Convention'), 'ligne_budgetaire' => array('budgets', 'Ligne Budg&#233;taire'));
	foreach($lookup_fields as $luf => $ptfc){
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']){
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent hspacer-md" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] && !$_REQUEST['Embedded']){
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-success add_new_parent hspacer-md" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus-sign"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode = str_replace('<%%UPLOADFILE(id)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(convention)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(ligne_budgetaire)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(date)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(intitule)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(montant)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(notes)%%>', '', $templateCode);

	// process values
	if($selected_id){
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', safe_html($urow['id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(convention)%%>', safe_html($urow['convention']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(convention)%%>', html_attr($row['convention']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(convention)%%>', urlencode($urow['convention']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(ligne_budgetaire)%%>', safe_html($urow['ligne_budgetaire']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(ligne_budgetaire)%%>', html_attr($row['ligne_budgetaire']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(ligne_budgetaire)%%>', urlencode($urow['ligne_budgetaire']), $templateCode);
		$templateCode = str_replace('<%%VALUE(date)%%>', @date('d/m/Y', @strtotime(html_attr($row['date']))), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(date)%%>', urlencode(@date('d/m/Y', @strtotime(html_attr($urow['date'])))), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(intitule)%%>', safe_html($urow['intitule']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(intitule)%%>', html_attr($row['intitule']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(intitule)%%>', urlencode($urow['intitule']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(montant)%%>', safe_html($urow['montant']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(montant)%%>', html_attr($row['montant']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(montant)%%>', urlencode($urow['montant']), $templateCode);
		if($AllowUpdate || $AllowInsert){
			$templateCode = str_replace('<%%HTMLAREA(notes)%%>', '<textarea name="notes" id="notes" rows="5">' . html_attr($row['notes']) . '</textarea>', $templateCode);
		}else{
			$templateCode = str_replace('<%%HTMLAREA(notes)%%>', '<div id="notes" class="form-control-static">' . $row['notes'] . '</div>', $templateCode);
		}
		$templateCode = str_replace('<%%VALUE(notes)%%>', nl2br($row['notes']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(notes)%%>', urlencode($urow['notes']), $templateCode);
	}else{
		$templateCode = str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(convention)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(convention)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(ligne_budgetaire)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(ligne_budgetaire)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(date)%%>', '1', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(date)%%>', urlencode('1'), $templateCode);
		$templateCode = str_replace('<%%VALUE(intitule)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(intitule)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(montant)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(montant)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%HTMLAREA(notes)%%>', '<textarea name="notes" id="notes" rows="5"></textarea>', $templateCode);
	}

	// process translations
	foreach($Translation as $symbol=>$trans){
		$templateCode = str_replace("<%%TRANSLATION($symbol)%%>", $trans, $templateCode);
	}

	// clear scrap
	$templateCode = str_replace('<%%', '<!-- ', $templateCode);
	$templateCode = str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_REQUEST['dvprint_x'] == ''){
		$templateCode .= "\n\n<script>\$j(function(){\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption){
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id){
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('versements');
	if($selected_id){
		$jdata = get_joined_record('versements', $selected_id);
		if($jdata === false) $jdata = get_defaults('versements');
		$rdata = $row;
	}
	$templateCode .= loadView('versements-ajax-cache', array('rdata' => $rdata, 'jdata' => $jdata));

	// hook: versements_dv
	if(function_exists('versements_dv')){
		$args=array();
		versements_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>