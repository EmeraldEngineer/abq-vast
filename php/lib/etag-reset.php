<?php
require_once("/etc/apache2/data-design/encrypted-config.php");

$config = readConfig("/etc/apache2/capstone-mysql/abqvast.ini");

$etags = new stdClass();
$etags->checkBook = 0;

$config["etags"] = json_encode($etags);

writeConfig($config, "/etc/apache2/capstone-mysql/abqvast.ini");