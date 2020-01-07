<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'conventions';

		/* data for selected record, or defaults if none is selected */
		var data = {
			porteur: <?php echo json_encode(array('id' => $rdata['porteur'], 'value' => $rdata['porteur'], 'text' => $jdata['porteur'])); ?>,
			chef_projet: <?php echo json_encode(array('id' => $rdata['chef_projet'], 'value' => $rdata['chef_projet'], 'text' => $jdata['chef_projet'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for porteur */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'porteur' && d.id == data.porteur.id)
				return { results: [ data.porteur ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for chef_projet */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'chef_projet' && d.id == data.chef_projet.id)
				return { results: [ data.chef_projet ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

