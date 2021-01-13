
<?php # Review Bets

$page_title = 'Review Exotic Bets';
include ('../includes/header_bets.html');
require_once ('../../mysql_connect_bets.php');

$link1 = "{$_SERVER['PHP_SELF']}?sort=datea";
$link2 = "{$_SERVER['PHP_SELF']}?sort=tracka&submit=submit";
$link3 = "{$_SERVER['PHP_SELF']}?sort=horsea";
$link4 = "{$_SERVER['PHP_SELF']}?sort=finisha";

if (isset($_GET['sort']) ) {
	switch ($_GET['sort']) {
		case 'datea':
		$order_by = 'date ASC';
		$link1="{$_SERVER['PHP_SELF']}?sort=dated";
		break;

		case 'dated':
		$order_by = 'date DESC';
		$link1="{$_SERVER['PHP_SELF']}?sort=datea";
		break;

		case 'tracka':
		$order_by = 'track ASC';
		$link2="{$_SERVER['PHP_SELF']}?sort=trackd";
		break;

		case 'trackd':
		$order_by = 'track DESC';
		$link2="{$_SERVER['PHP_SELF']}?sort=tracka";
		break;

		case 'horsea':
		$order_by = 'horse ASC';
		$link3="{$_SERVER['PHP_SELF']}?sort=horsed";
		break;

		case 'horsed':
		$order_by = 'horse DESC';
		$link3="{$_SERVER['PHP_SELF']}?sort=horsea";
		break;


		case 'finisha':
		$order_by = 'finish ASC';
		$link4="{$_SERVER['PHP_SELF']}?sort=finishd";
		break;

		case 'finish':
		$order_by = 'finish DESC';
		$link4="{$_SERVER['PHP_SELF']}?sort=finisha";
		break;


		default :
		$order_by = 'date ASC';
		break;

		}

	$sort = $_GET['sort'];
} else {
	$order_by = 'date DESC';
	$sort = "dated";
}
// Dates will be badly sorted until we copy the technique used in review_bets, then use it above.

  $query1 = "SELECT bet_id,date,track,race_no,distance,surface,race_type,odds,play_type,horse,horse2,finish,finish2 from wagers,tracks,race_types,odds,plays WHERE (wagers.play_id=5 OR wagers.play_id=6 OR wagers.play_id=7) AND wagers.track_id=tracks.track_id AND wagers.type=race_types.race_type_id AND wagers.odds_id=odds.odds_id AND wagers.play_id=plays.play_id ORDER BY $order_by";

$result = @mysqli_query($GLOBALS["___mysqli_ston"], $query1);
if ($result) {
  echo "<h1 align=\"center\">All Results</h1>";
  echo "<h3 align=\"center\">Finish Order (Zero indicates unknown value)</h3>";
//  echo "<h3 align=\"center\">Sort is $sort and Order By is $order_by</h3>";
  echo '<table align="center" cellspacing="0" cellpadding="5"><tr>
  <td align="left"><b>Delete</b></td>
  <td align="left"><b><a href="' . $link1 . '">Date</b></td>
  <td align="left"><b><a href="' . $link2 . '">Track</b></td>
  <td align="left"><b>Race</b></td>
  <td align="left"><b>Distance</b></td>
  <td align="left"><b>Surface</b></td>
  <td align="left"><b>Type</b></td>
  <td align="left"><b>Odds</b></td>
  <td align="left"><b>Wager</b></td>
  <td align="left"><b><a href="' . $link3 . '">Horse #1</b></td>
  <td align="left"><b>Horse #2</b></td>
  <td align="left"><b><a href="' . $link4 . '">Finish</b></td>
</tr>';

$bg = '#eeeeee';

  while ($row = mysqli_fetch_array($result,  MYSQLI_ASSOC)) {

    $bg = ($bg=='#eeeeee') ? '#ffffff' : '#eeeeee';
  echo '<tr bgcolor="' . $bg . '">

  <td align="left"><a href="delete_wager.php?id=' . $row['bet_id'] . ' ">Delete</a></td>


  <td align="left">' . $row['date'] . '</td>
  <td align="left" nowrap="nowrap">' . $row['track'] . '</td>
  <td align="left">' . $row['race_no'] . '</td>
  <td align="left" nowrap="nowrap">' . $row['distance'] . '</td>
  <td align="left">' . $row['surface'] . '</td>
  <td align="left" nowrap="nowrap">' . $row['race_type'] . '</td>
  <td align="left">' . $row['odds'] . '</td>
  <td align="left" nowrap="nowrap">' . $row['play_type'] . '</td>
  <td align="left" nowrap="nowrap">' . $row['horse'] . '</td>
  <td align="left" nowrap="nowrap">' . $row['horse2'] . '</td>
  <td align="left">' . $row['finish'] .'-' . $row['finish2'] . '</td>

</tr>';

}
  echo '</table>';

((mysqli_free_result($result) || (is_object($result) && (get_class($result) == "mysqli_result"))) ? true : false);
} 
 else {
  echo '<h1 id="mainhead">System Error</h1>
  <p class="error">Results could not be returned due to a system error. We apologize for any inconvenience.</p>';

  echo '<p>' . mysqli_error($GLOBALS["___mysqli_ston"]) . '<br /><br />Query: ' . $query1 . '</p></body></html>';

 
  exit();
}

((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);

?>

</body>
</html>

