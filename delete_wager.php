<?php #  -delete_wager.php

//accessed from review_bets.php

$page_title = 'Delete Wager';
include ('../includes/header_bets.html');

// GET the wager ID to delete


if (  (isset($_GET['id']))  && (is_numeric($_GET['id'])) )  {		//CHECK FOR CORRECT INPUT
	$id=$_GET['id'] ; 
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) {
	$id=$_POST['id'] ;
} else {
	echo '<h1 id="mainhead">
	Page Error</h1>
	<p class="error">This here page has been accessed in error.</p><p><br /><br /></p>';
include ('../includes/footer.html');
exit();
}


require_once ('../../mysql_connect_bets.php');


$query = "DELETE FROM wagers where bet_id=$id";
$result = @mysql_query($query);

if (mysql_affected_rows() == 1) {		//START CONDITION 
	echo '<h1 id="mainhead">Delete a Single Wager Record</h1>
	<p>The wager with bet ID number ' . $id . ' has been deleted.</p>
	<p><br /><br /></p>';
	} else  {
	echo '<h1 id="mainhead">System Error</h1>
	<p class="error">The wager could not be deleted due to a system error.</p>';
	echo '<p>' . mysql_error() . '<br /><br />Query: ' . $query . '</p>';
}
									
mysql_close();
include ('../includes/footer.html');

?>	
				

			


