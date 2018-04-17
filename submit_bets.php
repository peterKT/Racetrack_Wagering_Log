<?php # Script 73. - register.php

$page_title = 'Submit Bets';
include ('../includes/header_bets.html');

if (isset($_POST['submit']) ) {
  $errors = array();

if (empty($_POST['month'])) {
  $errors[] = 'You forgot to enter the month.';
} else {
  $month = ($_POST['month']);
}

if (empty($_POST['day'])) {
  $errors[] = 'You forgot to enter the day.';
} else {
  $day = ($_POST['day']);
}

if (empty($_POST['year'])) {
  $errors[] = 'You forgot to enter the year.';
} else {
  $year = ($_POST['year']);
}

$date = "$year-$month-$day";

if (empty($_POST['race_no'])) { 
   $errors[] = 'You forgot to enter the race number.';
} else {
  $race_no = ($_POST['race_no']);
}

if (empty($_POST['track'])) { 
   $errors[] = 'You forgot to enter the track.';
} else {
  $track = ($_POST['track']);
}

if (empty($_POST['distance'])) { 
   $errors[] = 'You forgot to enter the distance.';
} else {
  $distance = ($_POST['distance']);
}

if (empty($_POST['surface'])) { 
   $errors[] = 'You forgot to enter the surface.';
} else {  
$surface = ($_POST['surface']);
}

if (empty($_POST['type'])) { 
   $errors[] = 'You forgot to enter the type of race.';
} else {  
$type = ($_POST['type']);
}


if (empty($_POST["horse"])) { 
   $errors[] = 'You forgot to enter the horse.';
} else {  
$horse = ($_POST["horse"]);
}

if (empty($_POST['odds'])) { 
   $errors[] = 'You forgot to enter the odds.';
} else {  
$odds = ($_POST['odds']);
}


if (empty($_POST['wager'])) { 
   $errors[] = 'You forgot to enter the wager.';
} else { 
 $wager = ($_POST['wager']);
}

if (empty($_POST['finish'])) { 
   $errors[] = 'You forgot to enter the finishing order.';
} else {  
$finish = ($_POST['finish']);
}

echo "<p>Here are the values: $date, $race_no, $track, $distance, $surface, $type, $horse,
$odds, $wager, $finish</p>";

if (empty($errors)) {
  require_once ('../../mysql_connect_bets.php');

  $query = "INSERT INTO wagers (date,race_no,track_id,distance,surface,type,horse,odds_id,play_id,finish) VALUES ('$date','$race_no','$track','$distance','$surface', '$type', '$horse',
  '$odds','$wager','$finish')";

$result = mysql_query($query);

if ($result) {
  echo '<h1 id="mainhead">Thank you!</h1>
  <p>All your data was submitted</p><p>
  <br /></p>';

 echo"</body></html>";
  exit();
} else {
  echo '<h1 id="mainhead">System Error</h1>
  <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';

  echo '<p>' . mysql_error() . '<br /><br />Query: ' . $query . '</p></body></html>';

 
  exit();
}

mysql_close();

} else { 
  echo '<h1 id="mainhead">Error!</h1>
  <p class="error">The following error(s) occurred:<br />';
  foreach ($errors as $msg) {
  	echo " -$msg<br />\n";
  }
  echo '</p><p>Please try again.</p><p><br /></p>';
}
}

?>

<h2>Submit Wager Info</h2>
<form action="submit_bets.php" method="post">

<p>Date: 
<?php

//PICK MONTH

$months = array(1 => 'January', 'February','March','April','May','June',
'July','August','September','October','November','December');

echo '<select name="month">';
	foreach ($months as $key => $value) {
		echo "<option value=\"$key\">
		$value</option>\n";
		//"<option value=\$value\"</option>";
		}
echo '</select>';

//PICK DAY

echo "<select name=\"day\">";
	for ($day = 1 ; $day <= 31; $day++) {
	echo "<option value=\"$day\">$day<br></option>\n";
	}
	echo "</select>";

//PICK YEAR

echo "<select name=\"year\">";
	for ($year=2015 ; $year <= 2018 ; $year++) {
	
	echo "<option value=\"$year\">$year<br></option>\n";
	}
	echo "</select>";
?>

<p>Race Number: <select name="race_no">
<option value=1>1</option>
<option value=2>2</option>
<option value=3>3</option>
<option value=4>4</option>
<option value=5>5</option>
<option value=6>6</option>
<option value=7>7</option>
<option value=8>8</option>
<option value=9>9</option>
<option value=10>10</option>
<option value=11>11</option>
<option value=12>12</option>
<option value=13>13</option>
<option value=14>14</option>

</select></p>



  
<p>Track: <select name="track">
<option value=1>Aqueduct</option>
<option value=2>Belmont</option>
<option value=3>Gulfstream</option>
<option value=4>Keenland</option>
<option value=5>Santa Anita</option>
<option value=6>Oaklawn</option>
<option value=7>Turfway Park</option>
<option value=8>Tampa Bay</option>
<option value=9>Pimlico</option>
<option value=10>Churchill Downs</option>
<option value-11>Fair Grounds</option>
<option value-11>Del Mar</option>
</select></p>

</p>
<p>Distance: <select name="distance">
<option value="4 Furlongs">4 Furlongs</option>
<option value="4.5 Furlongs">4.5 Furlongs</option>
<option value="5 Furlongs">5 Furlongs</option>
<option value="5.5 Furlongs">5.5 Furlongs</option>
<option value="6 Furlongs">6 Furlongs</option>
<option value="6.5 Furlongs">6.5 Furlongs</option>
<option value="7 Furlongs">7 Furlongs</option>
<option value="7.5 Furlongs">7.5 Furlongs</option>
<option value="1 Mile">1 Mile</option>
<option value="1-1/16 Mile">1-1/16 Mile</option>
<option value="1-1/8 Mile">1-1/8 Mile</option>
<option value="1-1/4 Mile">1-1/4 Mile</option>
<option value="1-3/8 Mile">1-3/8 Mile</option>
<option value="1-1/2 Mile">1-1/2 Mile</option>
<option value="1-3/4 Mile">1-3/4 Mile</option>
<option value="2 Miles">2 Miles</option>
</select></p>


</p>
<p>Surface: <select name="surface">
<option value="Dirt">Dirt</option>
<option value="Turf">Turf</option>
<option value="Synthetic">Synthetic</option>
</select></p>


<p>Type: 
<?php

//PICK RACE TYPE

$type = array(1 => 'MSW', 'NW1','NW2','Minor Stake','Grade 3 Stakes','Grade 2 Stakes',
'Grade 1 Stakes','Handicap','Other');

echo '<select name="type">';
	foreach ($type as $key => $value) {
		echo "<option value=\"$key\">
		$value</option>\n";
		//"<option value=\$value\"</option>";
		}
echo '</select>';
?>
</p>


<p>Horse: <input type="text" name="horse" size="18" maxlength="20" />
</p>


<p>Odds: <select name="odds">
<option value=1>2:1</option>
<option value=2>5:2</option>
<option value=3>3:1</option>
<option value=4>7:2</option>
<option value=5>4:1</option>
<option value=6>9:2</option>
<option value=7>5:1</option>
<option value=8>6:1</option>
<option value=9>7:1</option>
<option value=10>8:1</option>
<option value=11>9:1</option>
<option value=12>10:1</option>
<option value=13>12:1</option>
<option value=14>15:1</option>
<option value=15>18:1</option>
<option value=16>20:1</option>
<option value=17>25:1</option>
<option value=18>30:1</option>
<option value=19>40:1</option>
<option value=20>50:1</option>
<option value=21>60:1</option>
<option value=22>Higher</option>

</select></p>

<p>Wager: <select name="wager">
<option value=1>$5 Win</option>
<option value=2>$10 Win</option>
<option value=3>$5 Win/Place</option>
<option value=4>$10 Win/Place</option>
<option value=5>$2 Exacta</option>
<option value=6>$2 Exacta Box</option>
</select></p>



<p>Finish: 
<?php

echo "<select name=\"finish\">";
	for ($finish = 1 ; $finish <= 20; $finish++) {
	echo "<option value=\"$finish\">$finish<br></option>\n";
	}
	echo "</select>";
?>

</p>

<input type="submit" name="submit" value="Submit"
/></p>
</form>

</body>
</html>

