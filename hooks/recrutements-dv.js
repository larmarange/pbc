function addThousandsSpaces(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ' ' + '$2');
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
	$j('#duree').hide().after($j('<div class="form-control-static">' + $j('#duree').val() + '</div>'));

	$j('#depense').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#depense').val()) + '</div>'));
	$j('#reservation_salaire').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#reservation_salaire').val()) + '</div>'));

	$j('#prop_dp').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + percent($j('#prop_dp').val()) + '</div>'));

});
