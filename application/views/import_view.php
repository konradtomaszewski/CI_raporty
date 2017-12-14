<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	imported_files();
    $('button#run_import').click(function(){
        jQuery.ajax({
                    type: "GET",
                    url: "<?php echo base_url();?>import/run_import",
                    success: function(res) {
                        console.log('Zakończono import danych');
                    }
        });
    });

    function imported_files(){
        jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>import/import_result_details",
                    success: function(result) {
                        $('div#imported_files').html(result);
                    }
        });
    };

    $(function(){
        setInterval(imported_files,3000);
    });

});
</script>

<main class="mdl-layout__content">

        <div class="mdl-grid mdl-grid--no-spacing">
           
            <div class="mdl-grid mdl-cell mdl-cell--9-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">
                <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone ">
                     <div id="imported_files"></div>
                </div>
            </div>

            <div class="mdl-grid mdl-cell mdl-cell--3-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">
			
                <div style="position:fixed">
                    <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--6-col-tablet mdl-cell--2-col-phone">
                        <div class="mdl-card mdl-shadow--2dp excel_to_db">
                            <div class="mdl-card__title mdl-card--expand">
                                <h2 class="mdl-card__title-text">Import danych</h2>
                            </div>
                            <div class="mdl-card__supporting-text">
                                <div>
                                Naciśnięcie przycisku spowoduje uruchomienie procesu odpwoedzialnego za import danych z katalogu files/xml do bazy danych
                                </div>
                            </div>
                            <div class="mdl-card__actions">
                                <button id="run_import" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored-blue" style="float:right">
                                    Uruchom proces importu
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- ToDo_widget-->
                    <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--6-col-tablet mdl-cell--2-col-phone">
                        <div class="mdl-card mdl-shadow--2dp">
                            <div class="mdl-card__title">
                                <h2 class="mdl-card__title-text">Wyświetl dane archiwalne</h2>
                            </div>
                            <div class="mdl-card__supporting-text">
                                <div>
                                asd
                                </div>
                            </div>
                            <div class="mdl-card__actions">
                                <button id="show_archive" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored-blue" style="float:right">
                                    Pokaż dane
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>

