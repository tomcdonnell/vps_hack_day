<?php
/**************************************************************************************************\
*
* vim: ts=3 sw=3 et wrap co=100 go -=b
*
* Filename: "index.php"
*
* Project: VPS Hack Day September 2010.
*
* Purpose: Introduction and link to the page produced at the VPS Hack Day held in September 2010.
*
* Author: Tom McDonnell 2010-11-21.
*
\**************************************************************************************************/

// Settings. ///////////////////////////////////////////////////////////////////////////////////////

error_reporting(-1);

session_start();

// Defines. ////////////////////////////////////////////////////////////////////////////////////////

define
(
   'VPS_HACK_DAY_URL',
   'http://www.egov.vic.gov.au/victorian-government-resources/' .
   'government-2-0-action-plan/vps-hack-day-gov-2-0-action-plan.html'
);

// HTML code. //////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html PUBLIC
 "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
 <head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
  <title>VPS Hack Day 2010-11-18</title>
 </head>
 <body>
  <a class='backLink' href='http://www.tomcdonnell.net'>Back to tomcdonnell.net</a>
  <h1>VPS Hack Day 2010-11-18</h1>
  <P>
   On the eighteenth of September 2010, a team of web developers/designers consisting of myself
   and workmates Paul Muratore, Prathe Kuhanesan, Scott Muller, Stephen Ottaviano, and Vu Do,
   participated in the <a href='<?php echo VPS_HACK_DAY_URL; ?>'>VPS Hack Day</a>.
  </p>
  <p>
   We battled unfamiliar equipment and surroundings, intermittent internet connection dropouts, and
   the lure of delicious cakes and pastries to create from scratch a website that made use of
   government supplied data.
  </p>
  <p>Our website went from pre-conception to completion and presentation in six hours.</p>
  <p>Here it is, in all its quickly-hacked-up glory.</p>
  <p><a href='main.php'>Where in Victoria is Wazza</a></p>
 </body>
</html>
<?php
/*******************************************END*OF*FILE********************************************/
?>
