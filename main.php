<?php
ini_set('display_errors'        , '1');
ini_set('display_startup_errors', '1');

error_reporting(-1);

// Includes. ///////////////////////////////////////////////////////////////////////////////////////

require_once 'php/classes/ClueGenerator.php';

// Globally executed code. /////////////////////////////////////////////////////////////////////////

try {
    $filesJs = array();
    $filesCss = array();

    $dbc = DatabaseManager::get('root');

    $cluesAndAnswerAndOptions = ClueGenerator::getCluesAndAnswerAndOptions($dbc, 5, 10);
    /*
      echo "Clues:<br/>\n";
      foreach ($cluesAndAnswer['clues'] as $clue)
      {
      echo " * $clue<br/>\n";
      }

      echo "Answer: '{$cluesAndAnswer['answer']}'<br/>\n";
      echo "n_suburbsTried: '{$cluesAndAnswer['n_suburbsTried']}'<br/>\n";
     */
} catch (Exception $e) {
    echo $e;
}

// HTML. ///////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Where in Victoria is Wazza?</title>
        <link href="styles/reset.css" rel="stylesheet" type="text/css" media="all" />
        <link href="styles/main.css" rel="stylesheet" type="text/css" media="all" />
        <link href="styles/tabs.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/whereis.js"></script>
        <script type="text/javascript" src="js/mapcontrol.js"></script>
        <script type="text/javascript" src="js/tabs.js"></script>
    </head>
    <body>
        <div id="page-wrap">
            <div id="header">
            </div>
            <div id="content-wrap">
                <div id="content">
<!--                    <h1 class="wrong_guess">No! Wazza is not in Ringwood!</h1>
                    <h1>You have 5 chances left to find Wazza!</h1>-->
                    <!-- Tabs -->
                    <ul class="tabs">
                        <li id="one"><a href="#tab-one">Clue 1</a></li>
                        <li id="two"><a href="#tab-two">Clue 2</a></li>
                        <li id="three"><a href="#tab-three">Clue 3</a></li>
                        <li id="four"><a href="#tab-four">Clue 4</a></li>
                        <li id="five"><a href="#tab-five">Clue 5</a></li>
                    </ul>

                    <div class="tab_container">
                        <div id="tab-one" class="tab_content">
                            <p><?php echo $cluesAndAnswerAndOptions['clues'][0]; ?></p>
                        </div>
                        <div id="tab-two" class="tab_content">
                            <p><?php echo $cluesAndAnswerAndOptions['clues'][1]; ?></p>
                        </div>
                        <div id="tab-three" class="tab_content">
                            <p><?php echo $cluesAndAnswerAndOptions['clues'][2]; ?></p>
                        </div>
                        <div id="tab-four" class="tab_content">
                            <p><?php echo $cluesAndAnswerAndOptions['clues'][3]; ?></p>
                        </div>
                        <div id="tab-five" class="tab_content">
                            <p><?php echo $cluesAndAnswerAndOptions['clues'][4]; ?></p>
                        </div>
                    </div>

                    <div style="clear: both"></div>

                    <div id="guess">
                        <div id="guess_form">
                            <h1>I Guess that Wazza is in:</h1>
                            <form>
                                <select id="suburbSelect">
                                    <?php
                                    foreach ($cluesAndAnswerAndOptions['options'] as $option) {
                                        extract($option);

                                        echo "<option value='$latitude,$longtitude,$postcode,$suburb'>$suburb</option>\n";
                                    }
                                    ?>
                                </select>
                                <input id="suburbGuessBtn" type="button" value="Guess!" />

                                <input type="hidden" id="correctSuburb" value="<?php echo $cluesAndAnswerAndOptions['answer']; ?>" />
                            </form>
                        </div>
                        <div id="previous_guesses">
                            <h1>Previous Guesses:</h1>
                            <ol id="incorrect_guess_list">
                            </ol>
                        </div>
                    </div>

                </div>
                <div id="sidebar">
                    <img id="guess_map" src="http://maps.google.com/maps/api/staticmap?center=3000,VIC&zoom=6&size=400x400&sensor=false" />
                </div>
            </div>
        </div>
    </body>
</html>
