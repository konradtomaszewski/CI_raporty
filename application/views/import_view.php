<main class="mdl-layout__content">

        <div class="mdl-grid mdl-grid--no-spacing">

            <div class="mdl-grid mdl-cell mdl-cell--9-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">
                <!-- Table-->
                <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone ">
                    <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp projects-table">
                        <thead>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">Data importu</th>
                            <th class="mdl-data-table__cell--non-numeric">Zaimportowany pliki</th>
                            <th class="mdl-data-table__cell--non-numeric">Ilość rekordów</th>
                        </tr>
                        </thead>
                        <tbody>
							<div id="result"></div>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mdl-grid mdl-cell mdl-cell--3-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">
			
                <!-- Robot card-->
				<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--6-col-tablet mdl-cell--2-col-phone">
                    <div class="mdl-card mdl-shadow--2dp robot1">
                        <div class="mdl-card__title mdl-card--expand">
                            <h2 class="mdl-card__title-text">Import danych</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <div>
                               Naciśnięcie przycisku spowoduje uruchomienie procesu odpwoedzialnego za import danych z katalogu files/xml do bazy danych
                            </div>
                            <button id="run_import">Uruchom proces importu</button>
                        </div>
                    </div>
                </div>
				<!-- ToDo_widget-->
                <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--6-col-tablet mdl-cell--2-col-phone">
                    <div class="mdl-card mdl-shadow--2dp todo">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">To-do list</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <ul class="mdl-list">

                            </ul>
                        </div>
                        <div class="mdl-card__actions">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect">remove selected</button>
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--fab mdl-shadow--8dp mdl-button--colored ">
                                <i class="material-icons mdl-js-ripple-effect">add</i>
                            </button>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </main>
<title><?php echo $title ?></title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	imported_files();
    $('button#run_import').click(function(){
        jQuery.ajax({
                    type: "GET",
                    url: "import/run_import",
                    success: function(res) {
                        console.log('Zakończono import danych');
                    }
        });
    });

    function imported_files(){
        jQuery.ajax({
                    type: "POST",
                    url: "import/import_result_details",
                    dataType: 'json',
                    success: function(result) {
                        var x = JSON.stringify(result);
						console.log(x);
                    }
        });
    };

    $(function(){
        setInterval(imported_files,3000);
    });

});
</script>
