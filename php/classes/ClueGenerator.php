<?php
// Includes. ///////////////////////////////////////////////////////////////////////////////////////

require_once dirname(__FILE__) . '/../database.php';

// Functions. //////////////////////////////////////////////////////////////////////////////////////

/*
 *
 */
class ClueGenerator
{
   // Public functions. ////////////////////////////////////////////////////////////////////////

   /*
    *
    */
   public function __construct()
   {
      throw new Exception('This class is not intended to be instantiated.');
   }

   /*
    *
    */
   public static function getCluesAndAnswerAndOptions($dbc, $n_cluesRequired, $n_options)
   {
      $cluesFound    = array();
      $maxN_attempts = 100;
      $n_attempts    =   0;

      while ($n_attempts <= $maxN_attempts && count($cluesFound) < $n_cluesRequired)
      {
         $suburbName = strtolower(self::_getRandomSuburbName($dbc));
         $cluesFound = self::_getCluesForSuburb($dbc, $suburbName, $n_cluesRequired);
         ++$n_attempts;
      }

      if ($n_attempts > $maxN_attempts)
      {
         throw new Exception('Attempts limit exceeded.');
      }

      return array
      (
         'clues'          => $cluesFound,
         'answer'         => $suburbName,
         'n_suburbsTried' => $n_attempts,
         'options'        => self::_getOptions($dbc, $suburbName, $n_options)
      );
   }

   // Private functions. ///////////////////////////////////////////////////////////////////////

   /*
    *
    */
   private static function _getPostcodeForSuburb($dbc, $suburb)
   {
      $rows = $dbc->query
      (
         'SELECT postcode
          FROM postcode_db
          WHERE suburb=?
          LIMIT 1', array($suburb)
      );
   }

   /*
    *
    */
   private static function _getRandomSuburbName($dbc)
   {
/*
      $rows = $dbc->query(
         'SELECT TRIM(suburb) AS suburb
          FROM postcode_db
          WHERE selectable="1"
          ORDER BY RAND()
          LIMIT 1'
      );

      return $rows[0]['suburb'];
*/

      $goodSuburbs = array
      (
         'altona',
         'ararat',
         'ascotvale',
         'ashburton',
         'ashwood',
         'ballarat',
         'beechworth',
         'bendigo',
         'box hill',
         'carlton',
         'croydon',
         'fitzroy',
         'melbourne',
         'richmond'
      );

      $suburbIndex = rand(0, count($goodSuburbs) - 1);

      return $goodSuburbs[$suburbIndex];
   }

   /*
    *
    */
   private static function _getCluesForSuburb($dbc, $suburbName, $n_cluesRequired)
   {
      $cluesFoundAsKeys = array();
      $usableTableNames = array_keys(self::$clueSqlByTableName);

      for ($i = 0; $i < $n_cluesRequired; ++$i)
      {
         $randomTableIndex = rand(0, count($usableTableNames) - 1);
         $tableName        = $usableTableNames[$randomTableIndex];

         $clue = self::_getClueForSuburbForTable($dbc, $suburbName, $tableName);

         if ($clue !== false)
         {
            if (strpos(strtolower($clue), strtolower($suburbName)) !== false)
            {
               $clue = str_replace(strtolower($suburbName), '?????', $clue);
               $clue = str_replace(ucwords(strtolower($suburbName)), '?????', $clue);
            }

            $cluesFoundAsKeys[$clue] = null;
         }
      }

      return array_keys($cluesFoundAsKeys);
   }

   /*
    *
    */
   private static function _getClueForSuburbForTable($dbc, $suburbName, $tableName)
   {
      if (!array_key_exists($tableName, self::$clueSqlByTableName))
      {
         throw new Exception("Unknown table name '$tableName'.");
      }

      $sql  = self::$clueSqlByTableName[$tableName] . " ORDER BY RAND() LIMIT 1";
      $rows = $dbc->query($sql, array($suburbName));

      if (count($rows) != 1)
      {
         return false;
      }

      $clue = $rows[0]['clue'];
/*
      if (in_array($tableName, self::$tableNamesCluesForWhichNeedNumbersRemoved))
      {
         $clue = self::_removeNo($clue);
      }
*/

      return $clue;
   }

   /*
    *
    */
   private static function _getOptions($dbc, $answerSuburbName, $n_options)
   {
      $options = $dbc->query
      (
         'SELECT longtitude, latitude, suburb, postcode
          FROM postcode_db
          WHERE state="vic"
          AND suburb<>?
          ORDER BY RAND()
          LIMIT ?',
         array($answerSuburbName, $n_options - 1)
      );

      $answerOptions = $dbc->query
      (
         'SELECT longtitude, latitude, suburb, postcode
          FROM postcode_db
          WHERE suburb=?
          AND state="vic"
          LIMIT 1',
         array($answerSuburbName)
      );

      $options = array_merge($options, $answerOptions);

      foreach ($options as $key => $option)
      {
         $options[$key]['suburb'] = ucwords(strtolower(($option['suburb'])));
      }

      usort($options, array('ClueGenerator', 'compareRandom'));

      return $options;
   }

   /*
    *
    */
   private static function _removeNo($strAddress)
   {
      // find the position of the first space
      $pos = strpos($strAddress," ",0);

      // grab the first part of the string
      $strNumber = substr($strAddress, 0,$pos);

      if (is_numeric($strNumber))
      {
         $pos = strpos($strAddress," ",0);
         $vright = substr($strAddress, $pos,strlen($strAddress));
         return $vright;
      }
      else
      {
         return $strAddress;
      }
   }

   /*
    *
    */
   private static function compareRandom($a, $b)
   {
      return rand(0, 1);
   }

   // Private variables. ///////////////////////////////////////////////////////////////////////

   private static $tableNamesCluesForWhichNeedNumbersRemoved = array
   (
      'racecourses',
      'tafe_schools'
   );

   private static $clueSqlByTableName = array(
      'art_spaces' =>
         'SELECT CONCAT("I am near a place called \'", TRIM(Organisation), "\'.") AS clue
          FROM art_spaces
          WHERE Suburb_Town=?',
      'collecting_institutions' =>
         'SELECT CONCAT("I am near a place called \'", TRIM(Organisation), "\'.") AS clue
          FROM collecting_institutions
          WHERE Suburb_Town=?',
      'schools' =>
         'SELECT CONCAT("I am near a school called \'", TRIM(School_Name), "\'.") AS clue
          FROM schools
          WHERE Address_Town=?',
      'universities' =>
         'SELECT CONCAT("I am near a university called \'", TRIM(Institute), "\'.") AS clue
          FROM universities
          WHERE Suburb=?',
      'racecourses' =>
         'SELECT CONCAT("I am near a racecourse on \'", TRIM(Address), "\'.") AS clue
          FROM racecourses
          WHERE Town=?',
      'lifesaving' =>
         'SELECT CONCAT("I am near a Life Saving Club.") AS clue
          FROM lifesaving
          WHERE Suburb=?',
      'tafe_schools' =>
         'SELECT CONCAT("I am near a Tafe school on \'", TRIM(Address), "\'.") AS clue
          FROM tafe_schools
          WHERE Suburb=?',
      'skate_parks' =>
         'SELECT CONCAT("I am near a really cool skate park.") AS clue
          FROM skating
          WHERE Suburb=?',
      'organisations' =>
         'SELECT CONCAT("I am near a \'", TRIM(type), "\'.") AS clue
          FROM organisationlist
          WHERE Suburb=?'
   );
}
?>
