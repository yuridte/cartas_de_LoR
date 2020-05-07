<?php
require_once("cfg.php");
require_once("class/db-class.php");

$db = new DB($cfgHost, $cfgPort, $cfgDbName, $cfgUser, $cfgPassword);
$dbConn = $db->getConnection();