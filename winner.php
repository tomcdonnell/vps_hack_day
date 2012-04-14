<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Where in Victoria is Wazza?</title>
        <link href="styles/reset.css" rel="stylesheet" type="text/css" media="all" />
        <link href="styles/main.css" rel="stylesheet" type="text/css" media="all" />
        <link href="styles/tabs.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/whereis.js"></script>
    </head>
    <body>
        <div id="page-wrap">
            <div id="header">
            </div>
            <div id="content-wrap">
                <div id="content">
                    <h1 class="right_guess">Congratulations! You Found Wazza!</h1>
                    <h1>Wazza was in <?php echo $_GET['suburb'] ?></h1>
                    <h1>You scored <?php echo $_GET['gcount'] ?> points!</h1>
                    <img src="images/winner.gif" />
                </div>
                <div id="sidebar">
                    <img id="guess_map" src="http://maps.google.com/maps/api/staticmap?center=<?php echo $_GET['pcode'] ?>,VIC&zoom=11&size=400x400&sensor=false" />
                </div>
                <p><a href="main.php">Play Again</a></p>
            </div>
        </div>
    </body>
</html>
