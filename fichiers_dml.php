<?php

// Data functions (insert, update, delete, form) for table fichiers

// This script and data application were generated by AppGini 5.82
// Download AppGini for free from https://bigprof.com/appgini/download/

function fichiers_insert() {
	global $Translation;

	// mm: can member insert record?
	$arrPerm = getTablePermissions('fichiers');
	if(!$arrPerm[1]) return false;

	$data = array();
	$data['convention'] = $_REQUEST['convention'];
		if($data['convention'] == empty_lookup_value) { $data['convention'] = ''; }
	$data['titre'] = $_REQUEST['titre'];
		if($data['titre'] == empty_lookup_value) { $data['titre'] = ''; }
	$data['notes'] = $_REQUEST['notes'];
		if($data['notes'] == empty_lookup_value) { $data['notes'] = ''; }
	$data['fichier'] = PrepareUploadedFile('fichier', 1024000000,'txt|doc|docx|docm|odt|pdf|rtf|jpg|png|gif|csv|xls|xlsx|xlsm|ods|zip|rar|gz|tar|iso', true, '');
	if($data['convention']== '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Convention': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	if($data['titre']== '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Titre': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}

	/* for empty upload fields, when saving a copy of an existing record, copy the original upload field */
	if($_REQUEST['SelectedID']) {
		$res = sql("select * from fichiers where id='" . makeSafe($_REQUEST['SelectedID']) . "'", $eo);
		if($row = db_fetch_assoc($res)) {
			if(!$data['fichier']) $data['fichier'] = $row['fichier'];
		}
	}

	// hook: fichiers_before_insert
	if(function_exists('fichiers_before_insert')) {
		$args = array();
		if(!fichiers_before_insert($data, getMemberInfo(), $args)) { return false; }
	}

	$error = '';
	// set empty fields to NULL
	$data = array_map(function($v) { return ($v === '' ? NULL : $v); }, $data);
	insert('fichiers', backtick_keys_once($data), $error);
	if($error)
		die("{$error}<br><a href=\"#\" onclick=\"history.go(-1);\">{$Translation['< back']}</a>");

	$recID = db_insert_id(db_link());

	// hook: fichiers_after_insert
	if(function_exists('fichiers_after_insert')) {
		$res = sql("select * from `fichiers` where `id`='" . makeSafe($recID, false) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=array();
		if(!fichiers_after_insert($data, getMemberInfo(), $args)) { return $recID; }
	}

	// mm: save ownership data
	set_record_owner('fichiers', $recID, getLoggedMemberID());

	// if this record is a copy of another record, copy children if applicable
	if(!empty($_REQUEST['SelectedID'])) fichiers_copy_children($recID, $_REQUEST['SelectedID']);

	return $recID;
}

function fichiers_copy_children($destination_id, $source_id) {
	global $Translation;
	$requests = array(); // array of curl handlers for launching insert requests
	$eo = array('silentErrors' => true);
	$uploads_dir = realpath(dirname(__FILE__) . '/../' . $Translation['ImageFolder']);
	$safe_sid = makeSafe($source_id);

	// launch requests, asynchronously
	curl_batch($requests);
}

function fichiers_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false) {
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('fichiers');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='fichiers' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='fichiers' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3) { // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: fichiers_before_delete
	if(function_exists('fichiers_before_delete')) {
		$args=array();
		if(!fichiers_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	// delete file stored in the 'fichier' field
	$res = sql("select `fichier` from `fichiers` where `id`='$selected_id'", $eo);
	if($row=@db_fetch_row($res)) {
		if($row[0]!='') {
			@unlink(getUploadDir('').$row[0]);
		}
	}

	sql("delete from `fichiers` where `id`='$selected_id'", $eo);

	// hook: fichiers_after_delete
	if(function_exists('fichiers_after_delete')) {
		$args=array();
		fichiers_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='fichiers' and pkValue='$selected_id'", $eo);
}

function fichiers_update($selected_id) {
	global $Translation;

	// mm: can member edit record?
	$arrPerm=getTablePermissions('fichiers');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='fichiers' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='fichiers' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3) { // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['convention'] = makeSafe($_REQUEST['convention']);
		if($data['convention'] == empty_lookup_value) { $data['convention'] = ''; }
	if($data['convention']=='') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Convention': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['titre'] = makeSafe($_REQUEST['titre']);
		if($data['titre'] == empty_lookup_value) { $data['titre'] = ''; }
	if($data['titre']=='') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Titre': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['notes'] = makeSafe($_REQUEST['notes']);
		if($data['notes'] == empty_lookup_value) { $data['notes'] = ''; }
	$data['selectedID'] = makeSafe($selected_id);
	if($_REQUEST['fichier_remove'] == 1) {
		$data['fichier'] = '';
		// delete file from server
		$res = sql("select `fichier` from `fichiers` where `id`='".makeSafe($selected_id)."'", $eo);
		if($row = @db_fetch_row($res)) {
			if($row[0] != '') {
				@unlink(getUploadDir('') . $row[0]);
			}
		}
	} else {
		$data['fichier'] = PrepareUploadedFile('fichier', 1024000000, 'txt|doc|docx|docm|odt|pdf|rtf|jpg|png|gif|csv|xls|xlsx|xlsm|ods|zip|rar|gz|tar|iso', true, "");
		// delete file from server
		if($data['fichier'] != '') {
			$res = sql("select `fichier` from `fichiers` where `id`='" . makeSafe($selected_id) . "'", $eo);
			if($row = @db_fetch_row($res)) {
				if($row[0] != '') {
					@unlink(getUploadDir('') . $row[0]);
				}
			}
		}
	}

	// hook: fichiers_before_update
	if(function_exists('fichiers_before_update')) {
		$args = array();
		if(!fichiers_before_update($data, getMemberInfo(), $args)) { return false; }
	}

	$o = array('silentErrors' => true);
	sql('update `fichiers` set       `convention`=' . (($data['convention'] !== '' && $data['convention'] !== NULL) ? "'{$data['convention']}'" : 'NULL') . ', `titre`=' . (($data['titre'] !== '' && $data['titre'] !== NULL) ? "'{$data['titre']}'" : 'NULL') . ', ' . ($data['fichier']!='' ? "`fichier`='{$data['fichier']}'" : ($_REQUEST['fichier_remove'] != 1 ? '`fichier`=`fichier`' : '`fichier`=NULL')) . ', `notes`=' . (($data['notes'] !== '' && $data['notes'] !== NULL) ? "'{$data['notes']}'" : 'NULL') . " where `id`='".makeSafe($selected_id)."'", $o);
	if($o['error']!='') {
		echo $o['error'];
		echo '<a href="fichiers_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}


	// hook: fichiers_after_update
	if(function_exists('fichiers_after_update')) {
		$res = sql("SELECT * FROM `fichiers` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['id'];
		$args = array();
		if(!fichiers_after_update($data, getMemberInfo(), $args)) { return; }
	}

	// mm: update ownership data
	sql("update `membership_userrecords` set `dateUpdated`='" . time() . "' where `tableName`='fichiers' and `pkValue`='" . makeSafe($selected_id) . "'", $eo);

}

function fichiers_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = '') {
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('fichiers');
	if(!$arrPerm[1] && $selected_id=='') { return ''; }
	$AllowInsert = ($arrPerm[1] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != '') {
		$dvprint = true;
	}

	$filterer_convention = thisOr(undo_magic_quotes($_REQUEST['filterer_convention']), '');

	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: convention
	$combo_convention = new DataCombo;

	if($selected_id) {
		// mm: check member permissions
		if(!$arrPerm[2]) {
			return "";
		}
		// mm: who is the owner?
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='fichiers' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='fichiers' and pkValue='".makeSafe($selected_id)."'");
		if($arrPerm[2]==1 && getLoggedMemberID()!=$ownerMemberID) {
			return "";
		}
		if($arrPerm[2]==2 && getLoggedGroupID()!=$ownerGroupID) {
			return "";
		}

		// can edit?
		if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3) {
			$AllowUpdate=1;
		}else{
			$AllowUpdate=0;
		}

		$res = sql("SELECT * FROM `fichiers` WHERE `id`='" . makeSafe($selected_id) . "'", $eo);
		if(!($row = db_fetch_array($res))) {
			return error_message($Translation['No records found'], 'fichiers_view.php', false);
		}
		$combo_convention->SelectedData = $row['convention'];
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
	} else {
		$combo_convention->SelectedData = $filterer_convention;
	}
	$combo_convention->HTML = '<span id="convention-container' . $rnd1 . '"></span><input type="hidden" name="convention" id="convention' . $rnd1 . '" value="' . html_attr($combo_convention->SelectedData) . '">';
	$combo_convention->MatchText = '<span id="convention-container-readonly' . $rnd1 . '"></span><input type="hidden" name="convention" id="convention' . $rnd1 . '" value="' . html_attr($combo_convention->SelectedData) . '">';

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_convention__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['convention'] : $filterer_convention); ?>"};

		jQuery(function() {
			setTimeout(function() {
				if(typeof(convention_reload__RAND__) == 'function') convention_reload__RAND__();
			}, 10); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function convention_reload__RAND__() {
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint) { ?>

			$j("#convention-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_convention__RAND__.value, t: 'fichiers', f: 'convention' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="convention"]').val(resp.results[0].id);
							$j('[id=convention-container-readonly__RAND__]').html('<span id="convention-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=conventions_view_parent]').hide(); }else{ $j('.btn[id=conventions_view_parent]').show(); }


							if(typeof(convention_update_autofills__RAND__) == 'function') convention_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term) { /* */ return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 5,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page) { /* */ return { s: term, p: page, t: 'fichiers', f: 'convention' }; },
					results: function(resp, page) { /* */ return resp; }
				},
				escapeMarkup: function(str) { /* */ return str; }
			}).on('change', function(e) {
				AppGini.current_convention__RAND__.value = e.added.id;
				AppGini.current_convention__RAND__.text = e.added.text;
				$j('[name="convention"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=conventions_view_parent]').hide(); }else{ $j('.btn[id=conventions_view_parent]').show(); }


				if(typeof(convention_update_autofills__RAND__) == 'function') convention_update_autofills__RAND__();
			});

			if(!$j("#convention-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_convention__RAND__.value, t: 'fichiers', f: 'convention' },
					success: function(resp) {
						$j('[name="convention"]').val(resp.results[0].id);
						$j('[id=convention-container-readonly__RAND__]').html('<span id="convention-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=conventions_view_parent]').hide(); }else{ $j('.btn[id=conventions_view_parent]').show(); }

						if(typeof(convention_update_autofills__RAND__) == 'function') convention_update_autofills__RAND__();
					}
				});
			}

		<?php }else{ ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_convention__RAND__.value, t: 'fichiers', f: 'convention' },
				success: function(resp) {
					$j('[id=convention-container__RAND__], [id=convention-container-readonly__RAND__]').html('<span id="convention-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=conventions_view_parent]').hide(); }else{ $j('.btn[id=conventions_view_parent]').show(); }

					if(typeof(convention_update_autofills__RAND__) == 'function') convention_update_autofills__RAND__();
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
	if($dvprint) {
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/fichiers_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	}else{
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/fichiers_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Fichier', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert) {
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return fichiers_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return fichiers_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']) {
		$backAction = 'AppGini.closeParentModal(); return false;';
	}else{
		$backAction = '$j(\'form\').eq(0).attr(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id) {
		if(!$_REQUEST['Embedded']) $templateCode = str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="dvprint" name="dvprint_x" value="1" onclick="$j(\'form\').eq(0).prop(\'novalidate\', true); document.myform.reset(); return true;" title="' . html_attr($Translation['Print Preview']) . '"><i class="glyphicon glyphicon-print"></i> ' . $Translation['Print Preview'] . '</button>', $templateCode);
		if($AllowUpdate) {
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return fichiers_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3) { // allow delete?
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
	if(($selected_id && !$AllowUpdate && !$AllowInsert) || (!$selected_id && !$AllowInsert)) {
		$jsReadOnly .= "\tjQuery('#convention').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#convention_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#titre').replaceWith('<div class=\"form-control-static\" id=\"titre\">' + (jQuery('#titre').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#fichier').replaceWith('<div class=\"form-control-static\" id=\"fichier\">' + (jQuery('#fichier').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#fichier, #fichier-edit-link').hide();\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif($AllowInsert) {
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(convention)%%>', $combo_convention->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(convention)%%>', $combo_convention->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(convention)%%>', urlencode($combo_convention->MatchText), $templateCode);

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array('convention' => array('conventions', 'Convention'), );
	foreach($lookup_fields as $luf => $ptfc) {
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']) {
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent hspacer-md" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] && !$_REQUEST['Embedded']) {
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-success add_new_parent hspacer-md" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus-sign"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode = str_replace('<%%UPLOADFILE(id)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(convention)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(titre)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fichier)%%>', ($noUploads ? '' : "<div>{$Translation['upload image']}</div>" . '<i class="glyphicon glyphicon-remove text-danger clear-upload hidden"></i> <input type="file" name="fichier" id="fichier" data-filetypes="txt|doc|docx|docm|odt|pdf|rtf|jpg|png|gif|csv|xls|xlsx|xlsm|ods|zip|rar|gz|tar|iso" data-maxsize="1024000000">'), $templateCode);
	if($AllowUpdate && $row['fichier'] != '') {
		$templateCode = str_replace('<%%REMOVEFILE(fichier)%%>', '<br><input type="checkbox" name="fichier_remove" id="fichier_remove" value="1"> <label for="fichier_remove" style="color: red; font-weight: bold;">'.$Translation['remove image'].'</label>', $templateCode);
	}else{
		$templateCode = str_replace('<%%REMOVEFILE(fichier)%%>', '', $templateCode);
	}
	$templateCode = str_replace('<%%UPLOADFILE(notes)%%>', '', $templateCode);

	// process values
	if($selected_id) {
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', safe_html($urow['id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(convention)%%>', safe_html($urow['convention']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(convention)%%>', html_attr($row['convention']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(convention)%%>', urlencode($urow['convention']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(titre)%%>', safe_html($urow['titre']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(titre)%%>', html_attr($row['titre']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(titre)%%>', urlencode($urow['titre']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(fichier)%%>', safe_html($urow['fichier']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(fichier)%%>', html_attr($row['fichier']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fichier)%%>', urlencode($urow['fichier']), $templateCode);
		if($AllowUpdate || $AllowInsert) {
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
		$templateCode = str_replace('<%%VALUE(titre)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(titre)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fichier)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fichier)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%HTMLAREA(notes)%%>', '<textarea name="notes" id="notes" rows="5"></textarea>', $templateCode);
	}

	// process translations
	foreach($Translation as $symbol=>$trans) {
		$templateCode = str_replace("<%%TRANSLATION($symbol)%%>", $trans, $templateCode);
	}

	// clear scrap
	$templateCode = str_replace('<%%', '<!-- ', $templateCode);
	$templateCode = str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_REQUEST['dvprint_x'] == '') {
		$templateCode .= "\n\n<script>\$j(function() {\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption) {
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id) {
			$templateCode.="\n\tif(document.getElementById('fichierEdit')) { document.getElementById('fichierEdit').style.display='inline'; }";
			$templateCode.="\n\tif(document.getElementById('fichierEditLink')) { document.getElementById('fichierEditLink').style.display='none'; }";
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
	$rdata = $jdata = get_defaults('fichiers');
	if($selected_id) {
		$jdata = get_joined_record('fichiers', $selected_id);
		if($jdata === false) $jdata = get_defaults('fichiers');
		$rdata = $row;
	}
	$templateCode .= loadView('fichiers-ajax-cache', array('rdata' => $rdata, 'jdata' => $jdata));

	// hook: fichiers_dv
	if(function_exists('fichiers_dv')) {
		$args=array();
		fichiers_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>