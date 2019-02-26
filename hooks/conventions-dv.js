function addThousandsSpaces(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '&nbsp;' + '$2');
    }
    return x1 + x2;
}

function currency(x) {
	if (x >= 0) {col = 'black';} else {col = 'red';}
	return '<span style="color:' + col + ';">' + addThousandsSpaces(x) + '</span>';
}

function percent(x) {
	if (x <= 100) {col = 'black';} else {col = 'red';}
	return '<span style="color:' + col + ';">' + addThousandsSpaces(x) + '%</span>';
}

$j(function () {
	$j("#conventions_dv_container").prepend("<div class='alert alert-info'>Sauvez les changements pour forcer la mise à jour des champs calculés.</div>");
	
	$j('#duree').hide().after($j('<div class="form-control-static">' + $j('#duree').val() + '</div>'));
	
	$j('#frais_gestion').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#frais_gestion').val()) + '</div>'));
	$j('#accorde_hfg').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#accorde_hfg').val()) + '</div>'));
	$j('#accorde').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#accorde').val()) + '</div>'));
	$j('#verse').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#verse').val()) + '</div>'));
	$j('#ouvert').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#ouvert').val()) + '</div>'));
	$j('#reserve').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#reserve').val()) + '</div>'));
	$j('#liquide').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#liquide').val()) + '</div>'));
	$j('#utilise').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#utilise').val()) + '</div>'));
	$j('#disponible').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#disponible').val()) + '</div>'));
	$j('#reste_verser').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#reste_verser').val()) + '</div>'));
	$j('#reste_ouvrir').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#reste_ouvrir').val()) + '</div>'));
	$j('#reste_engager').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#reste_engager').val()) + '</div>'));	
	$j('#budget_nv').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#budget_nv').val()) + '</div>'));	
	$j('#depenses_nv').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#depenses_nv').val()) + '</div>'));	
	
	$j('#prop_uo').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + percent($j('#prop_uo').val()) + '</div>'));	
	$j('#prop_uv').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + percent($j('#prop_uv').val()) + '</div>'));	
	$j('#prop_ua').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + percent($j('#prop_ua').val()) + '</div>'));		
});