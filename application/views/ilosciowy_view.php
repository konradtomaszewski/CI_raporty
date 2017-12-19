<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://pivottable.js.org/dist/pivot.css">
<script type="text/javascript" src="https://pivottable.js.org/dist/pivot.js"></script>
<script type="text/javascript" src="https://pivottable.js.org/dist/d3_renderers.js"></script>
<style>
.pvtUi{
	margin-top:10px;
	margin-left:5px;
	border: 1px solid #666 !important;
    border-collapse: collapse;
	margin-bottom:20px;
}
.pvtRendererArea, .pvtTable{
	border: 0px !important;
    border-collapse: collapse;
	height:100%;
	width:100%;
}
.pvtRenderer{
	height:100%;
	width:100%;
}
.pvtAxisContainer, .pvtRows, .pvtVals, .ui-sortable{
	//background:transparent;
	background:#444;
	border: 1px solid #666 !important;
}
.pvtVals{
	width:100px !important;
}
</style>
<script>
    $(function(){
		$("#run_ilosciowy").click(function(){
			var data_od = $("#data_od").val();
			var data_do = $("#data_do").val();

			/*jQuery.ajax({
                    type: "GET",
                    url: "<?php echo base_url();?>raport/ilosciowy_generate?data_od"+data_od+"&data_do="+data_do,
                    success: function(res) {
						var tpl = $.pivotUtilities.aggregatorTemplates;
						$.getJSON("<?php echo base_url();?>raport/ilosciowy_json?data_od="+data_od+"&data_do="+data_do, function(mps) {
							$("#output").pivotUI(mps, {
								rows: ["data"], 
								cols: ["miasto"],
								aggregators: {
									"Count":      function() { return tpl.count()() }
								}
							});
						});
						console.log("pobrano dane");
                    }
      		});*/
			var tpl = $.pivotUtilities.aggregatorTemplates;
			
			$.getJSON("<?php echo base_url();?>raport/ilosciowy_json?data_od="+data_od+"&data_do="+data_do, function(mps) {
				$("#output").pivotUI(mps, {
					rows: ["data"], 
					cols: ["miasto"],
					aggregators: {
						"Count": function(){ return tpl.count()()}
					}
				});
			});
			console.log("pobrano dane");
			
		})
		
    });
</script>


<main class="mdl-layout__content">
    <div class="mdl-grid mdl-grid--no-spacing" >
        <div class="mdl-grid mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--8-col-phone mdl-cell--top">
            
			<div class="mdl-cell mdl-cell--9-col-desktop mdl-cell--9-col-tablet mdl-cell--4-col-phone">
					<div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">Dynamiczny Raport ilościowy</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
							<div id="output" style="overflow-x:auto; overflow-y:hidden; background:#; height:auto"></div>
                        </div>
						<div class="mdl-card__actions">
							<p>&nbsp;</p>
						</div>
                    </div>
			</div>

            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--4-col-phone style="zoom:0.9"">
                <div id="sidebar">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">Wybierz zakres dat</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <p>Dane zostaną automatycznie załadowane po wprowadzeniu zakresu dat</p>
                            <div class="mdl-grid">
								<table>
									<td><div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="data_od" value="<?php echo date("Y-m-d")?>"/>
										<label class="mdl-textfield__label" for="data_od">Data początkowa</label>
									</div></td>
									<td><div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="data_do" value="<?php echo date("Y-m-d")?>"/>
										<label class="mdl-textfield__label" for="data_do">Data końcowa</label>
									</div></td>
								</table>
							</div>
                        </div>
						<div class="mdl-card__actions">
						<button id="run_ilosciowy" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored-blue" style="float:right">
							Pobierz dane
						</button>
						</div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</main>

