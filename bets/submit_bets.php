
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


if (empty($_POST["horse"])) { 
   $errors[] = 'You forgot to enter the horse.';
} else {  
$horse = ($_POST["horse"]);
}

if ($_POST["wager"] == 5 || $_POST["wager"] == 6 || $_POST["wager"] == 7) {
	$errors[] = 'Please use Exotic Wagers form.';
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

// Fix any horse name with apostrophe

function escape_data ($data) {
	global $dbc;	// DB connection needed
	if (ini_get('magic_quotes_gpc')) {	// if MQ turned on for 
		$data = stripslashes($data);
	}
	return mysqli_real_escape_string( $dbc, trim($data));
}

$horse = escape_data($horse);



  $query = "INSERT INTO wagers (date,race_no,track_id,distance,surface,type,horse,odds_id,play_id,finish) VALUES ('$date','$race_no','$track','$distance','$surface', '$type', '$horse',
  '$odds','$wager','$finish')";

$result = mysqli_query($GLOBALS["___mysqli_ston"], $query);


if ($result) {
  echo '<h1 id="mainhead">Thank you!</h1>
  <p>All your data was submitted</p><p>
  <br /></p>';

 echo"</body></html>";
  exit();
} else {
  echo '<h1 id="mainhead">System Error</h1>
  <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';

  echo '<p>' . mysqli_error($GLOBALS["___mysqli_ston"]) . '<br /><br />Query: ' . $query . '</p></body></html>';

 
  exit();
}

((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);

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
	for ($year=2024 ; $year <= 2026 ; $year++) {
	
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
<option value=85>Aintree</option>
<option value=1>Aqueduct</option>
<option value=13>Arlington</option>
<option value=21>Ascot</option>
<option value=54>Ayr</option>
<option value=80>Bath</option>
<option value=28>Bellewstown</option>
<option value=2>Belmont</option>
<option value=75>Brighton</option>
<option value=47>Beverley</option>
<option value=71>Carlisle</option>
<option value=68>Catterick</option>
<option value=89>Chantilly</option>
<option value=62>Chelmsford</option>
<option value=77>Cheltenham</option>
<option value=72>Chepstow</option>
<option value=53>Chester</option>
<option value=3>Churchill Downs</option>
<option value=82>Clonmel</option>
<option value=91>Colonial Downs</option>
<option value=42>Cork</option>
<option value=22>Curragh</option>
<option value=4>Del Mar</option>
<option value=15>Delaware Park</option>
<option value=39>Deauville</option>
<option value=52>Doncaster</option>
<option value=67>Down Royal</option>
<option value=59>Dundalk</option>
<option value=92>Ellis Park</option>
<option value=30>Epsom</option>
<option value=5>Fair Grounds</option>
<option value=57>Fairyhouse</option>
<option value=76>Flemington</option>
<option value=83>Fontainebleau</option>
<option value=81>Ffos Las</option>
<option value=37>Galway</option>
<option value=19>Goodwood</option>
<option value=55>Gowran</option>
<option value=6>Gulfstream</option>
<option value=56>Hamilton</option>
<option value=25>Haydock</option>
<option value=90>Horseshoe Indianapolis</option>
<option value=7>Keenland</option>
<option value=44>Kempton</option>
<option value=17>Kentucky Downs</option>
<option value=79>Killarney</option>
<option value=51>Laurel</option>
<option value=50>Leicester</option>
<option value=40>Leopardstown</option>
<option value=32>Limerick</option>
<option value=49>Lingfield</option>
<option value=58>Listowel</option>
<option value=60>Longchamp</option>
<option value=64>Meydan</option>
<option value=8>Monmouth</option>
<option value=46>Musselburgh</option>
<option value=24>Naas</option>
<option value=29>Navan</option>
<option value=23>Newbury</option>
<option value=78>Newcastle</option>
<option value=20>Newmarket</option>
<option value=61>Nottingham</option>
<option value=9>Oaklawn</option>
<option value=73>Parx</option>
<option value=10>Pimlico</option>
<option value=35>Pontefract</option>
<option value=26>Redcar</option>
<option value=36>Ripon</option>
<option value=63>Riyadh</option>
<option value=45>Roscommon</option>
<option value=88>Saint-Cloud</option>
<option value=43>Salisbury</option>
<option value=41>Sandown</option>
<option value=11>Santa Anita</option>
<option value=16>Saratoga</option>
<option value=69>Sligo</option>
<option value=87>Southwell</option>
<option value=12>Tampa Bay</option>
<option value=38>Thirsk</option>
<option value=27>Thistledown</option>
<option value=74>Thurles</option>
<option value=66>Tipperary</option>
<option value=70>Tramore</option>
<option value=14>Turfway Park</option>
<option value=65>Wetherby</option>
<option value=31>Windsor</option>
<option value=84>Wolverhampton</option>
<option value=18>Woodbine</option>
<option value=34>Yarmouth</option>
<option value=33>York</option>




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
<option value="1-3/16 Mile">1-3/16 Mile</option>
<option value="1-1/4 Mile">1-1/4 Mile</option>
<option value="1-3/8 Mile">1-3/8 Mile</option>
<option value="1-1/2 Mile">1-1/2 Mile</option>
<option value="1-5/8 Mile">1-5/8 Mile</option>
<option value="1-3/4 Mile">1-3/4 Mile</option>
<option value="2 Miles">2 Miles</option>
<option value="2-plus Miles">2-plus Miles</option>
</select></p>


</p>
<p>Surface: <select name="surface">
<option value="Dirt">Dirt</option>
<option value="Turf">Turf</option>
<option value="Synthetic">Synthetic</option>
<option value="Jumps">Jumps</option>
</select></p>


<p>Type: 
<?php

//PICK RACE TYPE

$type = array(1 => 'MSW', 'NW1','NW2','NW3','Minor Stake','Grade 3 Stakes','Grade 2 Stakes',
'Grade 1 Stakes','Handicap','Handicap Class 2','Handicap Class 3','Handicap Class 4','Handicap Class 5','Handicap Class 6','Other','Novice');

echo '<select name="type">';
	foreach ($type as $key => $value) {
		echo "<option value=\"$key\">
		$value</option>\n";
		//"<option value=\$value\"</option>";
		}
echo '</select>';
?>
</p>


<p>Wager: <select name="wager">
<option value=8>$2 Win</option>
<option value=10>$2 Place</option>
<option value=1>$5 Win</option>
<option value=9>$5 Place</option>
<option value=2>$10 Win</option>
<option value=11>$2 Win/Place</option>
<option value=3>$5 Win/Place</option>
<option value=4>$10 Win/Place</option>
//<option value=5>$2 Exacta</option>
//<option value=6>$2 Exacta Box</option>
//<option value=7>$2 Daily Double</option>
</select></p>

<?php



echo '<p>Horse: <input type="text" name="horse" size="18" maxlength="20" />
</p>';


?>

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



<p>Finish: 
<?php

echo "<select name=\"finish\">";
	for ($finish = 1 ; $finish <= 30; $finish++) {
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

