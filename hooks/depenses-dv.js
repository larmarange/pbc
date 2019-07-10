$j(function () {
	$j.ajax({
		url: 'ajax_combo.php',
		dataType: 'json',
		data: { id: $j('#ligne_budgetaire').val(), t: 'credits', f: 'ligne_budgetaire' },
		success: function(resp){
			$j('#ligne_budgetaire').parentsUntil('.form-group', '.form-control-static').after($j('<div class="form-control-static" id="val_ligne_budgetaire">' + resp.results[0].text + '</div>'));
			$j('#ligne_budgetaire').parentsUntil('.form-group').find('.form-control-static').first().hide();
		}
	});

	ligne_credit = $j('#ligne_credit').val();
	contrat = $j('#contrat').val();

	if (contrat > 0) {
		$j('#beneficiaire').parentsUntil('.form-group').parent().hide();
		$j('#ventilation').parentsUntil('.form-group').parent().hide();
	} else {
		$j('#beneficiaire').parentsUntil('.form-group').parent().show();
		$j('#ventilation').parentsUntil('.form-group').parent().show();
	}

setInterval(function() {
		if ($j('#ligne_credit').val() != ligne_credit) {
			ligne_credit = $j('#ligne_credit').val();
			if (ligne_credit) {
				$j.ajax({
					url: 'ajax_ligne_budgetaire.php',
					data: { ligne_credit: ligne_credit},
					success: function(resp){
						$j("#val_ligne_budgetaire").html(resp);
					}
				});
			}
		}

		if ($j('#contrat').val() != contrat) {
			contrat = $j('#contrat').val();
			if (contrat > 0) {
				$j('#beneficiaire').parentsUntil('.form-group').parent().hide();
				$j('#ventilation').parentsUntil('.form-group').parent().hide();
			} else {
				$j('#beneficiaire').parentsUntil('.form-group').parent().show();
				$j('#ventilation').parentsUntil('.form-group').parent().show();
			}
		}

	}, 1000);
});
