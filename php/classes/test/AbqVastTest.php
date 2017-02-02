<?php
namespace Edu\Cnm\AbqVast\Test;

// grab the encrypted properties file
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

/**
 * Abstract class containing universal and project specific mySQL parameters
 *
 * This class is designed to lay the foundation of the unit tests per project. It loads all the database parameters about the project so that table specific tests can share the parameters in one place.
 **/
