<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	imported_files();
    if(screen.height>768){
        $('div#sidebar').css("position", "fixed");
        $('div#sidebar').css("margin-right","2%;");
    }
    
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
        var data_od = $('input#data_od').val();
        var data_do = $('input#data_do').val();

        jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>import/import_result_details",
                    data: {
                        data_od: data_od,
                        data_do: data_do
                    },
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
        <div class="mdl-grid mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--6-col-phone mdl-cell--top">
            <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone ">
                    <div id="imported_files" ></div>
            </div>

            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--4-col-phone ">
                <div id="sidebar">
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
                    <br /><br />
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">Wyświetl dane archiwalne</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <p>Dane zostaną automatycznie załadowane po wprowadzeniu zakresu dat</p>
                            <div class="mdl-grid"><table>
                                <td><div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" type="text" id="data_od" value="<?php echo date("Y-m-d")?>"/>
                                    <label class="mdl-textfield__label" for="data_od">Data początkowa</label>
                                </div></td>
                                <td><div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" type="text" id="data_do" value="<?php echo date("Y-m-d")?>"/>
                                    <label class="mdl-textfield__label" for="data_do">Data końcowa</label>
                                </div></td>
                                <!--<input type="text" id="data_od" placeholder="od"/>
                                <input type="text" id="data_do" placeholder="do"/>-->
                            </table></div>
                        </div>
                        <div style="background:#575757">
                            <div class="mdl-card__supporting-text" style="color:#fff; text-align:center">Automatyczne odświeżanie danych...</div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</main>

