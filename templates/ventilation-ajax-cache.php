<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'ventilation';

		/* data for selected record, or defaults if none is selected */
		var data = {
			convention: <?php echo json_encode(array('id' => $rdata['convention'], 'value' => $rdata['convention'], 'text' => $jdata['convention'])); ?>,
			rubrique: <?php echo json_encode(array('id' => $rdata['rubrique'], 'value' => $rdata['rubrique'], 'text' => $jdata['rubrique'])); ?>
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

		/* saved value for rubrique */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'rubrique' && d.id == data.rubrique.id)
				return { results: [ data.rubrique ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

