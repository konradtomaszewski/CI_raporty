<!--jQuery.js-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<!--pivot.js-->
<link rel="stylesheet" type="text/css" href="https://pivottable.js.org/dist/pivot.css">
<script type="text/javascript" src="https://pivottable.js.org/dist/pivot.js"></script>
<!--plotly.js-->
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script type="text/javascript" src="https://pivottable.js.org/dist/plotly_renderers.js"></script>

<style>
	.pvtUi{
		margin-top:10px;
		margin-left:5px;
		border: 1px solid #666 !important;
		border-collapse: collapse;
		margin-bottom:20px;
		padding: 20px 20px 20px 20px;
	}
	.pvtTable td{
		background:#444 !important;
		color:#fff !important;
		text-align:center !important;
		border-color:#666 !important;
	}
	.pvtVals{
		width:100px !important;
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
</style>
<script>
    $(function(){
		$("#run_ilosciowy").click(function(){
			var data_od = $("#data_od").val();
			var data_do = $("#data_do").val();

			var tpl = $.pivotUtilities.aggregatorTemplates;
			var derivers = $.pivotUtilities.derivers;
       		var renderers = $.extend($.pivotUtilities.renderers,$.pivotUtilities.plotly_renderers);
			
			$.getJSON("<?php echo base_url();?>raport/cok/ilosciowy_json?data_od="+data_od+"&data_do="+data_do, function(mps) {
				var functionsConfig = {
					aggregators: $.pivotUtilities.aggregators,
					renderers:   $.pivotUtilities.renderers,
					
				};
				var serializedConfig = '{"rows":["Agent"], "cols":["Data"],'+
								'"vals":["Połączenia odebrane"],"aggregatorName":"Integer Sum"}';
				var deserializedConfig = JSON.parse(serializedConfig)
				var mergedConfig = $.extend({}, functionsConfig, deserializedConfig);
				$("#output").pivotUI(mps, mergedConfig);
			});
			console.log("pobrano dane");
		});

		
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
							<div id="output" style="overflow-x:auto; overflow-y:hidden; background:#; height:auto; min-height: 410px;">
								<p style="text-align:center; font-size:14pt">Wprowadź datę początkową i końcową, następnie kliknij przycisk "Pobierz dane" aby móc operować na rekordach</p>
							</div>
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
										<input class="mdl-textfield__input" type="text" id="data_od" value="<?php echo date("Y-m-d", strtotime("-1 day"))?>"/>
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
							<button id="export" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored-blue">Exportuj</button>
							<button id="run_ilosciowy" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored-blue" style="float:right">Pobierz dane</button>
						</div>
                    </div>
                </div>    
            </div>
			
        </div>
    </div>
</main>