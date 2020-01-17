<?php $advanced_search_mode = intval($_REQUEST['advanced_search_mode']); ?>

	<input type="hidden" name="advanced_search_mode" value="<?php echo $advanced_search_mode; ?>" id="advanced_search_mode">
	<script>
		$j(function(){
			$j('.btn.search_mode').appendTo('.page-header h1');
			$j('.btn.search_mode').click(function(){
				var mode = parseInt($j('#advanced_search_mode').val());
				$j('#advanced_search_mode').val(1 - mode);
				if(typeof(beforeApplyFilters) == 'function') beforeApplyFilters();
				return true;
			});
		})
	</script>

<?php if($advanced_search_mode){ ?>
	<button class="btn btn-lg btn-success pull-right search_mode" type="submit" name="Filter_x" value="1">Switch to simple search mode</button>
	<?php include(dirname(__FILE__) . '/../defaultFilters.php'); ?>
	
<?php }else{ ?>

	<button class="btn btn-lg btn-default pull-right search_mode" type="submit" name="Filter_x" value="1">Switch to advanced search mode</button>
			
			<!-- load bootstrap datetime-picker -->
			<link rel="stylesheet" href="resources/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
			<script type="text/javascript" src="resources/moment/moment.min.js"></script>
			<script type="text/javascript" src="resources/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
			
			
			<div class="page-header"><h1>
				<a href="depenses_view.php" style="text-decoration: none; color: inherit;">
					<img src="resources/table_icons/005-expenses.png"> 					Dépenses Filters</a>
			</h1></div>

				

	<div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;">
		
		<div class="hidden-xs hidden-sm col-md-3 vspacer-lg text-right"><label for="">Convention</label></div>
		<div class="hidden-md hidden-lg col-xs-12 vspacer-lg"><label for="">Convention</label></div>
		
		
		<div class="col-md-8 col-lg-6 vspacer-md">
			<div id="filter_2" class="vspacer-lg"><span></span></div>

			<input type="hidden" class="populatedLookupData" name="1" value="<?php echo htmlspecialchars($FilterValue[1]); ?>" >
			<input type="hidden" name="FilterAnd[1]" value="and">
			<input type="hidden" name="FilterField[1]" value="2">  
			<input type="hidden" id="lookupoperator_2" name="FilterOperator[1]" value="equal-to">
			<input type="hidden" id="filterfield_2" name="FilterValue[1]" value="<?php echo htmlspecialchars($FilterValue[1]); ?>" size="3">
		</div>
		
		
		<div class="col-xs-3 col-xs-offset-9 col-md-offset-0 col-md-1">
			<button type="button" class="btn btn-default vspacer-md btn-block" title='Clear fields' onclick="clearFilters($j(this).parent());" ><span class="glyphicon glyphicon-trash text-danger"></button>
		</div>

			</div>

	<script>

		$j(function(){
			/* display a drop-down of categories that populates its content from ajax_combo.php */
			$j("#filter_2").select2({
				ajax: {
					url: "ajax_combo.php",
					dataType: 'json',
					cache: true,
					data: function(term, page){ return { s: term, p:page, t:"depenses", f:"convention" }; },
					results: function (resp, page) { return resp; }
				}
			}).on('change', function(e){
				$j("#filterfield_2").val(e.added.text);
				$j("#lookupoperator_2").val('equal-to');
				if (e.added.id=='{empty_value}'){
					$j("#lookupoperator_2").val('is-empty');
				}
			});


			/* preserve the applied category filter and show it when re-opening the filters page */
			if ($j("#filterfield_2").val().length){
				
				//None case 
				if ($j("#filterfield_2").val() == '<None>'){
					$j("#filter_2").select2( 'data' , {
						id: '{empty-value}',
						text: '<None>'
					});
					$j("#lookupoperator_2").val('is-empty');
					return;
				}
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: {
						s: $j("#filterfield_2").val(),  //search term
						p: 1,                                         //page number
						t: "depenses",                //table name
						f: "convention"               //field name
					}
				}).done(function(response){
					if (response.results.length){
						$j("#filter_2").select2('data' , {
							id: response.results[0].id,
							text: response.results[0].text
						});
					}
				});
			}

		});
	</script>

		
			<!-- ########################################################## -->
					

	<div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;">
		
		<div class="hidden-xs hidden-sm col-md-3 vspacer-lg text-right"><label for="">Ligne Budgétaire</label></div>
		<div class="hidden-md hidden-lg col-xs-12 vspacer-lg"><label for="">Ligne Budgétaire</label></div>
		
		
		<div class="col-md-8 col-lg-6 vspacer-md">
			<div id="filter_3" class="vspacer-lg"><span></span></div>

			<input type="hidden" class="populatedLookupData" name="2" value="<?php echo htmlspecialchars($FilterValue[2]); ?>" >
			<input type="hidden" name="FilterAnd[2]" value="and">
			<input type="hidden" name="FilterField[2]" value="3">  
			<input type="hidden" id="lookupoperator_3" name="FilterOperator[2]" value="equal-to">
			<input type="hidden" id="filterfield_3" name="FilterValue[2]" value="<?php echo htmlspecialchars($FilterValue[2]); ?>" size="3">
		</div>
		
		
		<div class="col-xs-3 col-xs-offset-9 col-md-offset-0 col-md-1">
			<button type="button" class="btn btn-default vspacer-md btn-block" title='Clear fields' onclick="clearFilters($j(this).parent());" ><span class="glyphicon glyphicon-trash text-danger"></button>
		</div>

			</div>

	<script>

		$j(function(){
			/* display a drop-down of categories that populates its content from ajax_combo.php */
			$j("#filter_3").select2({
				ajax: {
					url: "ajax_combo.php",
					dataType: 'json',
					cache: true,
					data: function(term, page){ return { s: term, p:page, t:"depenses", f:"ligne_budgetaire" }; },
					results: function (resp, page) { return resp; }
				}
			}).on('change', function(e){
				$j("#filterfield_3").val(e.added.text);
				$j("#lookupoperator_3").val('equal-to');
				if (e.added.id=='{empty_value}'){
					$j("#lookupoperator_3").val('is-empty');
				}
			});


			/* preserve the applied category filter and show it when re-opening the filters page */
			if ($j("#filterfield_3").val().length){
				
				//None case 
				if ($j("#filterfield_3").val() == '<None>'){
					$j("#filter_3").select2( 'data' , {
						id: '{empty-value}',
						text: '<None>'
					});
					$j("#lookupoperator_3").val('is-empty');
					return;
				}
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: {
						s: $j("#filterfield_3").val(),  //search term
						p: 1,                                         //page number
						t: "depenses",                //table name
						f: "ligne_budgetaire"               //field name
					}
				}).done(function(response){
					if (response.results.length){
						$j("#filter_3").select2('data' , {
							id: response.results[1].id,
							text: response.results[1].text
						});
					}
				});
			}

		});
	</script>

		
			<!-- ########################################################## -->
					

	<div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;">
		
		<div class="hidden-xs hidden-sm col-md-3 vspacer-lg text-right"><label for="">Ligne de crédit (CFI) - Exercice</label></div>
		<div class="hidden-md hidden-lg col-xs-12 vspacer-lg"><label for="">Ligne de crédit (CFI) - Exercice</label></div>
		
		
		<div class="col-md-8 col-lg-6 vspacer-md">
			<div id="filter_4" class="vspacer-lg"><span></span></div>

			<input type="hidden" class="populatedLookupData" name="3" value="<?php echo htmlspecialchars($FilterValue[3]); ?>" >
			<input type="hidden" name="FilterAnd[3]" value="and">
			<input type="hidden" name="FilterField[3]" value="4">  
			<input type="hidden" id="lookupoperator_4" name="FilterOperator[3]" value="equal-to">
			<input type="hidden" id="filterfield_4" name="FilterValue[3]" value="<?php echo htmlspecialchars($FilterValue[3]); ?>" size="3">
		</div>
		
		
		<div class="col-xs-3 col-xs-offset-9 col-md-offset-0 col-md-1">
			<button type="button" class="btn btn-default vspacer-md btn-block" title='Clear fields' onclick="clearFilters($j(this).parent());" ><span class="glyphicon glyphicon-trash text-danger"></button>
		</div>

			</div>

	<script>

		$j(function(){
			/* display a drop-down of categories that populates its content from ajax_combo.php */
			$j("#filter_4").select2({
				ajax: {
					url: "ajax_combo.php",
					dataType: 'json',
					cache: true,
					data: function(term, page){ return { s: term, p:page, t:"depenses", f:"ligne_credit" }; },
					results: function (resp, page) { return resp; }
				}
			}).on('change', function(e){
				$j("#filterfield_4").val(e.added.text);
				$j("#lookupoperator_4").val('equal-to');
				if (e.added.id=='{empty_value}'){
					$j("#lookupoperator_4").val('is-empty');
				}
			});


			/* preserve the applied category filter and show it when re-opening the filters page */
			if ($j("#filterfield_4").val().length){
				
				//None case 
				if ($j("#filterfield_4").val() == '<None>'){
					$j("#filter_4").select2( 'data' , {
						id: '{empty-value}',
						text: '<None>'
					});
					$j("#lookupoperator_4").val('is-empty');
					return;
				}
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: {
						s: $j("#filterfield_4").val(),  //search term
						p: 1,                                         //page number
						t: "depenses",                //table name
						f: "ligne_credit"               //field name
					}
				}).done(function(response){
					if (response.results.length){
						$j("#filter_4").select2('data' , {
							id: response.results[0].id,
							text: response.results[0].text
						});
					}
				});
			}

		});
	</script>

		
			<!-- ########################################################## -->
			
	<div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
		
		<div class="hidden-xs hidden-sm col-md-3 vspacer-lg text-right"><label for="">Date</label></div>
		<div class="hidden-md hidden-lg col-xs-12 vspacer-lg"><label for="">Date</label></div>
		
		
		<div class="col-xs-3 col-md-1 vspacer-lg text-center">Between</div>
		
		<input type="hidden" name="FilterAnd[4]" value="and">
		<input type="hidden" name="FilterField[4]" value="5">   
		<input type="hidden" name="FilterOperator[4]" value="greater-than-or-equal-to">
		
		<div class="col-xs-9 col-md-3 col-lg-2 vspacer-md">
			<input type="text"  class="form-control" id="from-date_5"  name="FilterValue[4]" value="<?php echo htmlspecialchars($FilterValue[4]); ?>" size="10">
		</div>

				<div class="col-xs-3 col-md-1 text-center vspacer-lg"> and </div>
		
		<input type="hidden" name="FilterAnd[5]" value="and">
		<input type="hidden" name="FilterField[5]" value="5">  
		<input type="hidden" name="FilterOperator[5]" value="less-than-or-equal-to">
		
		<div class="col-xs-9 col-md-3 col-lg-2 vspacer-md">
			<input type="text" class="form-control" id="to-date_5" name="FilterValue[5]" value="<?php echo htmlspecialchars($FilterValue[5]); ?>" size="10">
		</div>
		
		
		<div class="col-xs-3 col-xs-offset-9 col-md-offset-0 col-md-1">
			<button type="button" class="btn btn-default vspacer-md btn-block" title='Clear fields' onclick="clearFilters($j(this).parent());" ><span class="glyphicon glyphicon-trash text-danger"></button>
		</div>

			</div>

				
	<script>
		$j(function(){
			//date
			$j("#from-date_5 , #to-date_5 ").datetimepicker({
				format: 'DD/MM/YYYY'
			});

			$j("#from-date_5" ).on('dp.change' , function(e){
				date = moment(e.date).add(1, 'month');  
				$j("#to-date_5 ").val(date.format('DD/MM/YYYY')).data("DateTimePicker").minDate(e.date);
			});
		});
	</script>

		
			<!-- ########################################################## -->
					
	<div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
		
		<div class="hidden-xs hidden-sm col-md-3 vspacer-lg text-right"><label for="">Intitulé</label></div>
		<div class="hidden-md hidden-lg col-xs-12 vspacer-lg"><label for="">Intitulé</label></div>
		
				
		<input type="hidden" name="FilterAnd[6]" value="and">
		<input type="hidden" name="FilterField[6]" value="6">  
		<input type="hidden" name="FilterOperator[6]" value="like">
		<div class="col-md-8 col-lg-6 vspacer-md">
			<input type="text" class="form-control" name="FilterValue[6]" value="<?php echo htmlspecialchars($FilterValue[6]); ?>" size="3">
		</div>
		
		
		<div class="col-xs-3 col-xs-offset-9 col-md-offset-0 col-md-1">
			<button type="button" class="btn btn-default vspacer-md btn-block" title='Clear fields' onclick="clearFilters($j(this).parent());" ><span class="glyphicon glyphicon-trash text-danger"></button>
		</div>

			</div>


		
			<!-- ########################################################## -->
					
	<div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
		
		<div class="hidden-xs hidden-sm col-md-3 vspacer-lg text-right"><label for="">Réference</label></div>
		<div class="hidden-md hidden-lg col-xs-12 vspacer-lg"><label for="">Réference</label></div>
		
				
		<input type="hidden" name="FilterAnd[7]" value="and">
		<input type="hidden" name="FilterField[7]" value="7">  
		<input type="hidden" name="FilterOperator[7]" value="like">
		<div class="col-md-8 col-lg-6 vspacer-md">
			<input type="text" class="form-control" name="FilterValue[7]" value="<?php echo htmlspecialchars($FilterValue[7]); ?>" size="3">
		</div>
		
		
		<div class="col-xs-3 col-xs-offset-9 col-md-offset-0 col-md-1">
			<button type="button" class="btn btn-default vspacer-md btn-block" title='Clear fields' onclick="clearFilters($j(this).parent());" ><span class="glyphicon glyphicon-trash text-danger"></button>
		</div>

			</div>


		
			<!-- ########################################################## -->
					

	<div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;">
		
		<div class="hidden-xs hidden-sm col-md-3 vspacer-lg text-right"><label for="">Contrat (si salaire)</label></div>
		<div class="hidden-md hidden-lg col-xs-12 vspacer-lg"><label for="">Contrat (si salaire)</label></div>
		
		
		<div class="col-md-8 col-lg-6 vspacer-md">
			<div id="filter_8" class="vspacer-lg"><span></span></div>

			<input type="hidden" class="populatedLookupData" name="8" value="<?php echo htmlspecialchars($FilterValue[8]); ?>" >
			<input type="hidden" name="FilterAnd[8]" value="and">
			<input type="hidden" name="FilterField[8]" value="8">  
			<input type="hidden" id="lookupoperator_8" name="FilterOperator[8]" value="equal-to">
			<input type="hidden" id="filterfield_8" name="FilterValue[8]" value="<?php echo htmlspecialchars($FilterValue[8]); ?>" size="3">
		</div>
		
		
		<div class="col-xs-3 col-xs-offset-9 col-md-offset-0 col-md-1">
			<button type="button" class="btn btn-default vspacer-md btn-block" title='Clear fields' onclick="clearFilters($j(this).parent());" ><span class="glyphicon glyphicon-trash text-danger"></button>
		</div>

			</div>

	<script>

		$j(function(){
			/* display a drop-down of categories that populates its content from ajax_combo.php */
			$j("#filter_8").select2({
				ajax: {
					url: "ajax_combo.php",
					dataType: 'json',
					cache: true,
					data: function(term, page){ return { s: term, p:page, t:"depenses", f:"contrat" }; },
					results: function (resp, page) { return resp; }
				}
			}).on('change', function(e){
				$j("#filterfield_8").val(e.added.text);
				$j("#lookupoperator_8").val('equal-to');
				if (e.added.id=='{empty_value}'){
					$j("#lookupoperator_8").val('is-empty');
				}
			});


			/* preserve the applied category filter and show it when re-opening the filters page */
			if ($j("#filterfield_8").val().length){
				
				//None case 
				if ($j("#filterfield_8").val() == '<None>'){
					$j("#filter_8").select2( 'data' , {
						id: '{empty-value}',
						text: '<None>'
					});
					$j("#lookupoperator_8").val('is-empty');
					return;
				}
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: {
						s: $j("#filterfield_8").val(),  //search term
						p: 1,                                         //page number
						t: "depenses",                //table name
						f: "contrat"               //field name
					}
				}).done(function(response){
					if (response.results.length){
						$j("#filter_8").select2('data' , {
							id: response.results[1].id,
							text: response.results[1].text
						});
					}
				});
			}

		});
	</script>

		
			<!-- ########################################################## -->
					

	<div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;">
		
		<div class="hidden-xs hidden-sm col-md-3 vspacer-lg text-right"><label for="">Bénéficiaire</label></div>
		<div class="hidden-md hidden-lg col-xs-12 vspacer-lg"><label for="">Bénéficiaire</label></div>
		
		
		<div class="col-md-8 col-lg-6 vspacer-md">
			<div id="filter_9" class="vspacer-lg"><span></span></div>

			<input type="hidden" class="populatedLookupData" name="9" value="<?php echo htmlspecialchars($FilterValue[9]); ?>" >
			<input type="hidden" name="FilterAnd[9]" value="and">
			<input type="hidden" name="FilterField[9]" value="9">  
			<input type="hidden" id="lookupoperator_9" name="FilterOperator[9]" value="equal-to">
			<input type="hidden" id="filterfield_9" name="FilterValue[9]" value="<?php echo htmlspecialchars($FilterValue[9]); ?>" size="3">
		</div>
		
		
		<div class="col-xs-3 col-xs-offset-9 col-md-offset-0 col-md-1">
			<button type="button" class="btn btn-default vspacer-md btn-block" title='Clear fields' onclick="clearFilters($j(this).parent());" ><span class="glyphicon glyphicon-trash text-danger"></button>
		</div>

			</div>

	<script>

		$j(function(){
			/* display a drop-down of categories that populates its content from ajax_combo.php */
			$j("#filter_9").select2({
				ajax: {
					url: "ajax_combo.php",
					dataType: 'json',
					cache: true,
					data: function(term, page){ return { s: term, p:page, t:"depenses", f:"beneficiaire" }; },
					results: function (resp, page) { return resp; }
				}
			}).on('change', function(e){
				$j("#filterfield_9").val(e.added.text);
				$j("#lookupoperator_9").val('equal-to');
				if (e.added.id=='{empty_value}'){
					$j("#lookupoperator_9").val('is-empty');
				}
			});


			/* preserve the applied category filter and show it when re-opening the filters page */
			if ($j("#filterfield_9").val().length){
				
				//None case 
				if ($j("#filterfield_9").val() == '<None>'){
					$j("#filter_9").select2( 'data' , {
						id: '{empty-value}',
						text: '<None>'
					});
					$j("#lookupoperator_9").val('is-empty');
					return;
				}
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: {
						s: $j("#filterfield_9").val(),  //search term
						p: 1,                                         //page number
						t: "depenses",                //table name
						f: "beneficiaire"               //field name
					}
				}).done(function(response){
					if (response.results.length){
						$j("#filter_9").select2('data' , {
							id: response.results[1].id,
							text: response.results[1].text
						});
					}
				});
			}

		});
	</script>

		
			<!-- ########################################################## -->
			
	<div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
		
		<div class="hidden-xs hidden-sm col-md-3 vspacer-lg text-right"><label for="">Montant</label></div>
		<div class="hidden-md hidden-lg col-xs-12 vspacer-lg"><label for="">Montant</label></div>
		
					
		<div class="col-xs-3 col-md-1 vspacer-lg text-center">Between</div>
		<input type="hidden" name="FilterAnd[10]" value="and">
		<input type="hidden" name="FilterField[10]" value="10">   
		<input type="hidden" name="FilterOperator[10]" value="greater-than-or-equal-to">
		<div class="col-xs-9 col-md-3 col-lg-2 vspacer-md">
			<input type="text" class="numeric form-control" name="FilterValue[10]" value="<?php echo htmlspecialchars($FilterValue[10]); ?>" size="3">
		</div>

				<div class="col-xs-3 col-md-1 text-center vspacer-lg and"> and </div>
		<input type="hidden" name="FilterAnd[11]" value="and">
		<input type="hidden" name="FilterField[11]" value="10">  
		<input type="hidden" name="FilterOperator[11]" value="less-than-or-equal-to">
		<div class="col-xs-9 col-md-3 col-lg-2 vspacer-md">
			<input type="text" class="numeric form-control" name="FilterValue[11]" value="<?php echo htmlspecialchars($FilterValue[11]); ?>" size="3">
		</div>

		
		<div class="col-xs-3 col-xs-offset-9 col-md-offset-0 col-md-1">
			<button type="button" class="btn btn-default vspacer-md btn-block" title='Clear fields' onclick="clearFilters($j(this).parent());" ><span class="glyphicon glyphicon-trash text-danger"></button>
		</div>

			</div>

		
			<!-- ########################################################## -->
			
	<div class="row" style="border-bottom: dotted 2px #DDD;">
		
		<div class="hidden-xs hidden-sm col-md-3 vspacer-lg text-right"><label for="">Liquidée ?</label></div>
		<div class="hidden-md hidden-lg col-xs-12 vspacer-lg"><label for="">Liquidée ?</label></div>
		
				
		<div class="col-xs-10 col-sm-11 col-md-8 col-lg-6">
			<div class="radio">
				<label><input type="radio" name="FilterValue[13]" class="filter_11" onclick="checkboxFilter(this)" value="1" > Checked</label>
			</div>
			<div class="radio">
				<label><input type="radio" name="FilterValue[13]" class="filter_11" onclick="checkboxFilter(this)" value="null"> Unchecked</label>
			</div>
			<div class="radio">
				<label><input type="radio" name="FilterValue[13]" class="filter_11" onclick="checkboxFilter(this)" value="" checked> Any</label>
			</div>
		</div>
		<input type="hidden" name="FilterAnd[13]" value="and">
		<input type="hidden" class='checkboxData' name="FilterField[13]" value="11">   
		<input type="hidden" name="FilterOperator[13]" id="filter_11" value="equal-to">

		
		<div class="col-xs-3 col-xs-offset-9 col-md-offset-0 col-md-1">
			<button type="button" class="btn btn-default vspacer-md btn-block" title='Clear fields' onclick="clearFilters($j(this).parent());" ><span class="glyphicon glyphicon-trash text-danger"></button>
		</div>

			</div>

	<script>
		//for population
		var filterValue_11 = '<?php echo htmlspecialchars($FilterValue[13]); ?>';
		$j(function () {
			if (filterValue_11) {
				$j("input[class =filter_11][value =" + filterValue_11 + "]").attr("checked", "checked").click();
			}
		})
	</script>
		
			<!-- ########################################################## -->
					

	<div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;">
		
		<div class="hidden-xs hidden-sm col-md-3 vspacer-lg text-right"><label for="">Ventilation Budgétaire</label></div>
		<div class="hidden-md hidden-lg col-xs-12 vspacer-lg"><label for="">Ventilation Budgétaire</label></div>
		
		
		<div class="col-md-8 col-lg-6 vspacer-md">
			<div id="filter_12" class="vspacer-lg"><span></span></div>

			<input type="hidden" class="populatedLookupData" name="14" value="<?php echo htmlspecialchars($FilterValue[14]); ?>" >
			<input type="hidden" name="FilterAnd[14]" value="and">
			<input type="hidden" name="FilterField[14]" value="12">  
			<input type="hidden" id="lookupoperator_12" name="FilterOperator[14]" value="equal-to">
			<input type="hidden" id="filterfield_12" name="FilterValue[14]" value="<?php echo htmlspecialchars($FilterValue[14]); ?>" size="3">
		</div>
		
		
		<div class="col-xs-3 col-xs-offset-9 col-md-offset-0 col-md-1">
			<button type="button" class="btn btn-default vspacer-md btn-block" title='Clear fields' onclick="clearFilters($j(this).parent());" ><span class="glyphicon glyphicon-trash text-danger"></button>
		</div>

			</div>

	<script>

		$j(function(){
			/* display a drop-down of categories that populates its content from ajax_combo.php */
			$j("#filter_12").select2({
				ajax: {
					url: "ajax_combo.php",
					dataType: 'json',
					cache: true,
					data: function(term, page){ return { s: term, p:page, t:"depenses", f:"ventilation" }; },
					results: function (resp, page) { return resp; }
				}
			}).on('change', function(e){
				$j("#filterfield_12").val(e.added.text);
				$j("#lookupoperator_12").val('equal-to');
				if (e.added.id=='{empty_value}'){
					$j("#lookupoperator_12").val('is-empty');
				}
			});


			/* preserve the applied category filter and show it when re-opening the filters page */
			if ($j("#filterfield_12").val().length){
				
				//None case 
				if ($j("#filterfield_12").val() == '<None>'){
					$j("#filter_12").select2( 'data' , {
						id: '{empty-value}',
						text: '<None>'
					});
					$j("#lookupoperator_12").val('is-empty');
					return;
				}
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: {
						s: $j("#filterfield_12").val(),  //search term
						p: 1,                                         //page number
						t: "depenses",                //table name
						f: "ventilation"               //field name
					}
				}).done(function(response){
					if (response.results.length){
						$j("#filter_12").select2('data' , {
							id: response.results[1].id,
							text: response.results[1].text
						});
					}
				});
			}

		});
	</script>

		
			<!-- ########################################################## -->
			
	<div class="row" style="border-bottom: dotted 2px #DDD;">
		
		<div class="hidden-xs hidden-sm col-md-3 vspacer-lg text-right"><label for="">Vérifiée ?</label></div>
		<div class="hidden-md hidden-lg col-xs-12 vspacer-lg"><label for="">Vérifiée ?</label></div>
		
				
		<div class="col-xs-10 col-sm-11 col-md-8 col-lg-6">
			<div class="radio">
				<label><input type="radio" name="FilterValue[15]" class="filter_14" onclick="checkboxFilter(this)" value="1" > Checked</label>
			</div>
			<div class="radio">
				<label><input type="radio" name="FilterValue[15]" class="filter_14" onclick="checkboxFilter(this)" value="null"> Unchecked</label>
			</div>
			<div class="radio">
				<label><input type="radio" name="FilterValue[15]" class="filter_14" onclick="checkboxFilter(this)" value="" checked> Any</label>
			</div>
		</div>
		<input type="hidden" name="FilterAnd[15]" value="and">
		<input type="hidden" class='checkboxData' name="FilterField[15]" value="14">   
		<input type="hidden" name="FilterOperator[15]" id="filter_14" value="equal-to">

		
		<div class="col-xs-3 col-xs-offset-9 col-md-offset-0 col-md-1">
			<button type="button" class="btn btn-default vspacer-md btn-block" title='Clear fields' onclick="clearFilters($j(this).parent());" ><span class="glyphicon glyphicon-trash text-danger"></button>
		</div>

			</div>

	<script>
		//for population
		var filterValue_14 = '<?php echo htmlspecialchars($FilterValue[15]); ?>';
		$j(function () {
			if (filterValue_14) {
				$j("input[class =filter_14][value =" + filterValue_14 + "]").attr("checked", "checked").click();
			}
		})
	</script>
		
			<!-- ########################################################## -->
					
	<div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
		
		<div class="hidden-xs hidden-sm col-md-3 vspacer-lg text-right"><label for="">Notes</label></div>
		<div class="hidden-md hidden-lg col-xs-12 vspacer-lg"><label for="">Notes</label></div>
		
				
		<input type="hidden" name="FilterAnd[16]" value="and">
		<input type="hidden" name="FilterField[16]" value="13">  
		<input type="hidden" name="FilterOperator[16]" value="like">
		<div class="col-md-8 col-lg-6 vspacer-md">
			<input type="text" class="form-control" name="FilterValue[16]" value="<?php echo htmlspecialchars($FilterValue[16]); ?>" size="3">
		</div>
		
		
		<div class="col-xs-3 col-xs-offset-9 col-md-offset-0 col-md-1">
			<button type="button" class="btn btn-default vspacer-md btn-block" title='Clear fields' onclick="clearFilters($j(this).parent());" ><span class="glyphicon glyphicon-trash text-danger"></button>
		</div>

			</div>


		
			<!-- ########################################################## -->
			    

			<!-- sorting header  -->   
			<div class="row" style="border-bottom: solid 2px #DDD;">
				<div class="col-md-offset-2 col-md-8 vspacer-lg"><strong>Order by</strong></div>
			</div>
			
			<!-- sorting rules -->
			<?php
			// Fields list
			$sortFields = new Combo;
			$sortFields->ListItem = $this->ColCaption;
			$sortFields->ListData = $this->ColNumber;

			// sort direction
			$sortDirs = new Combo;
			$sortDirs->ListItem = array("ascending" , "descending" );
			$sortDirs->ListData = array("asc", "desc");
			$num_rules = min(maxSortBy, count($this->ColCaption));

			for($i = 0; $i < $num_rules; $i++){
				$sfi = $sd = "";
				if(isset($orderBy[$i])) foreach($orderBy[$i] as $sfi => $sd);

				$sortFields->SelectName = "OrderByField$i";
				$sortFields->SelectID = "OrderByField$i";
				$sortFields->SelectedData = $sfi;
				$sortFields->SelectedText = "";
				$sortFields->Render();

				$sortDirs->SelectName = "OrderDir$i";
				$sortDirs->SelectID = "OrderDir$i";
				$sortDirs->SelectedData = $sd;
				$sortDirs->SelectedText = "";
				$sortDirs->Render();

				$border_style = ($i == $num_rules - 1 ? "solid 2px #DDD" : "dotted 1px #DDD");
				?>
				
				<!-- sorting rule -->
				<div class="row" style="border-bottom: <?php echo $border_style; ?>;">
					<div class="col-xs-2 vspacer-md hidden-md hidden-lg"><strong><?php echo ($i ? "then by" : "order by"); ?></strong></div>
					<div class="col-md-2 col-md-offset-2 vspacer-md hidden-xs hidden-sm text-right"><strong><?php echo ($i ? "then by" : "order by"); ?></strong></div>
					<div class="col-xs-6 col-md-4 vspacer-md"><?php echo $sortFields->HTML; ?></div>
					<div class="col-xs-4 col-md-2 vspacer-md"><?php echo $sortDirs->HTML; ?></div>
				</div>
				<?php
			}
			?>			<!-- filter actions -->
			<div class="row">
				<div class="col-md-3 col-md-offset-3 col-lg-offset-4 col-lg-2 vspacer-lg">
					<input type="hidden" name="apply_sorting" value="1">
					<button type="submit" id="applyFilters" onclick="beforeApplyFilters(event);return true;" class="btn btn-success btn-block btn-lg"><i class="glyphicon glyphicon-ok"></i> Apply filters</button>
				</div>
									<div class="col-md-3 col-lg-2 vspacer-lg">
						<button type="submit" onclick="beforeApplyFilters(event);return true;" class="btn btn-default btn-block btn-lg" id="SaveFilter" name="SaveFilter_x" value="1"><i class="glyphicon glyphicon-align-left"></i> Save &amp; apply filters</button>
					</div>
								<div class="col-md-3 col-lg-2 vspacer-lg">
					<button onclick="beforeCancelFilters();" type="submit" id="cancelFilters" class="btn btn-warning btn-block btn-lg"><i class="glyphicon glyphicon-remove"></i> Cancel</button>
				</div>
			</div>

			<script>
				$j(function(){
					//stop event if it is already bound
					$j(".numeric").off("keydown").on("keydown", function (e) {
						// Allow: backspace, delete, tab, escape, enter and .
						if ($j.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
							// Allow: Ctrl+A, Command+A
							(e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
							// Allow: home, end, left, right, down, up
							(e.keyCode >= 35 && e.keyCode <= 40)) {
								// let it happen, don't do anything
								return;
						}
						// Ensure that it is a number and stop the keypress
						if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
							e.preventDefault();
						}
					});                
				});
				
				/* function to handle the action of the clear field button */
				function clearFilters(elm){
					var parentDiv = $j(elm).parent(".row ");
					//get all input nodes
					inputValueChildren = parentDiv.find("input[type!=radio][name^=FilterValue]");
					inputRadioClildren = parentDiv.find("input[type=radio][name^=FilterValue]");
					
					//default input nodes ( text, hidden )
					inputValueChildren.each(function( index ) {
						$j( this ).val('');
					});
					
					//radio buttons
					inputRadioClildren.each(function( index ) {
						$j( this ).removeAttr('checked');

						//checkbox case
						if ($j( this ).val()=='') $j(this).attr("checked", "checked").click();
					});
					
					//lookup and select dropdown
					parentDiv.find("div[id$=DropDown],div[id^=filter_]").select2("val", "");

					//for lookup
					parentDiv.find("input[id^=lookupoperator_]").val('equal-to');

				}
				
				function checkboxFilter(elm) {
					if (elm.value == "null") {
						$j("#" + elm.className).val("is-empty");
					} else {
						$j("#" + elm.className).val("equal-to");
					}
				}
				
				/* funtion to remove unsupplied fields */
				function beforeApplyFilters(event){
				
					//get all field submitted values
					$j(":input[type=text][name^=FilterValue],:input[type=hidden][name^=FilterValue],:input[type=radio][name^=FilterValue]:checked").each(function( index ) {
						  
						//if type=hidden  and options radio fields with the same name are checked, supply its value
						if ( $j( this ).attr('type')=='hidden' &&  $j(":input[type=radio][name='"+$j( this ).attr('name')+"']:checked").length >0 ){
							return;
						}
						  
						  //do not submit fields with empty values
						if ( !$j( this ).val()){
						  var fieldNum =  $j(this).attr('name').match(/(\d+)/)[0];
						  $j(":input[name='FilterField["+fieldNum+"]']").val('');
						 
						  };
					});

				}
				
				function beforeCancelFilters(){
					

					//other fields
					$j('form')[0].reset();

					//lookup case ( populate with initial data)
					$j(":input[class='populatedLookupData']").each(function(){
					  

						$j(":input[name='FilterValue["+$j(this).attr('name')+"]']").val($j(this).val());
						if ($j(this).val()== '<None>'){
							$j(this).parent(".row ").find('input[id^="lookupoperator"]').val('is-empty');
						}else{
							$j(this).parent(".row ").find('input[id^="lookupoperator"]').val('equal-to');
						}
							
					})

					//options case ( populate with initial data)
					$j(":input[class='populatedOptionsData']").each(function(){
					   
						$j(":input[name='FilterValue["+$j(this).attr('name')+"]']").val($j(this).val());
					})


					//checkbox, radio options case
					$j(":input[class='checkboxData'],:input[class='optionsData'] ").each(function(){
						var filterNum = $j(this).val();
						var populatedValue = eval("filterValue_"+filterNum);                  
						var parentDiv = $j(this).parent(".row ");

						//check old value
						parentDiv.find("input[type=radio][value='"+populatedValue+"']").attr('checked', 'checked').click();
					
					})

					//remove unsuplied fields
					beforeApplyFilters();

					return true;
				}
			</script>
			
			<style>
				.form-control{ width: 100% !important; }
				.select2-container, .select2-container.vspacer-lg{ max-width: unset !important; width: 100%; margin-top: 0 !important; }
			</style>


		

<?php } ?>