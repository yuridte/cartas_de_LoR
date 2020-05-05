<?php 
require_once("cfg.php");

//urls das api
$url_base = ".api.riotgames.com/lor/ranked/v1/leaderboards?api_key=".$api_key;
$url_server = array("americas", "asia", "europe");

echo "<table><tr>";

foreach ($url_server as $url_server) {
	echo "<td style='vertical-align: top; padding-right:100px'>";
	$url = "https://" . $url_server . $url_base;
	$leaderboard = json_decode(file_get_contents($url));

	switch ($url_server) {
		case 'americas':
			echo "<h1>AMÉRICAS</h1>";
			break;
		
		case 'asia':
			echo "<h1>ÁSIA</h1>";
			break;

		case 'europe':
			echo "<h1>EUROPA</h1>";
			break;
	}

	foreach ($leaderboard->players as $player) {
		echo $player->rank . " - " . $player->name . "<br/>";
	}
	echo "</td>";
}

?>

	</tr>
</table>