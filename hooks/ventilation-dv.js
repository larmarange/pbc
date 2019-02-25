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
	$j('#accorde').css('max-width', '100px').css('text-align', 'right');
	
	$j('#reserve').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#reserve').val()) + '</div>'));
	$j('#liquide').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#liquide').val()) + '</div>'));
	$j('#utilise').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#utilise').val()) + '</div>'));
	$j('#disponible').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#disponible').val()) + '</div>'));
	$j('#reste_engager').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + currency($j('#reste_engager').val()) + '</div>'));	
	
	$j('#prop_ua').hide().after($j('<div class="form-control-static" style="text-align: right; max-width: 100px;">' + percent($j('#prop_ua').val()) + '</div>'));		
});