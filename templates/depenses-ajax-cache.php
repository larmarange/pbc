<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'depenses';

		/* data for selected record, or defaults if none is selected */
		var data = {
			convention: <?php echo json_encode(array('id' => $rdata['convention'], 'value' => $rdata['convention'], 'text' => $jdata['convention'])); ?>,
			ligne_budgetaire: <?php echo json_encode(array('id' => $rdata['ligne_budgetaire'], 'value' => $rdata['ligne_budgetaire'], 'text' => $jdata['ligne_budgetaire'])); ?>,
			ligne_credit: <?php echo json_encode(array('id' => $rdata['ligne_credit'], 'value' => $rdata['ligne_credit'], 'text' => $jdata['ligne_credit'])); ?>,
			contrat: <?php echo json_encode(array('id' => $rdata['contrat'], 'value' => $rdata['contrat'], 'text' => $jdata['contrat'])); ?>,
			beneficiaire: <?php echo json_encode(array('id' => $rdata['beneficiaire'], 'value' => $rdata['beneficiaire'], 'text' => $jdata['beneficiaire'])); ?>,
			ventilation: <?php echo json_encode(array('id' => $rdata['ventilation'], 'value' => $rdata['ventilation'], 'text' => $jdata['ventilation'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for convention */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'convention' && d.id == data.convention.id)
				return { results: [ data.convention ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for ligne_budgetaire */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ligne_budgetaire' && d.id == data.ligne_budgetaire.id)
				return { results: [ data.ligne_budgetaire ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for ligne_credit */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ligne_credit' && d.id == data.ligne_credit.id)
				return { results: [ data.ligne_credit ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for contrat */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'contrat' && d.id == data.contrat.id)
				return { results: [ data.contrat ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for beneficiaire */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'beneficiaire' && d.id == data.beneficiaire.id)
				return { results: [ data.beneficiaire ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for ventilation */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ventilation' && d.id == data.ventilation.id)
				return { results: [ data.ventilation ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

