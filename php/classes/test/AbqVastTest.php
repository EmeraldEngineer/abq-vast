<?php
namespace Edu\Cnm\AbqVast\Test;

// grab the encrypted properties file
require_once("/etc/apache2/abqvast-mysql/encrypted-config.php");

/**
 * Abstract class containing universal and project specific mySQL parameters
 *
 * This class is designed to lay the foundation of the unit tests per project. It loads all the database parameters about the project so that table specific tests can share the parameters in one place.
 *
 * @suthor Sarah Ruth Finkel <sfinkel@cnm.edu>
 **/
abstract class AbqVastTest extends \ PHPUnit_Extensions_Database_Testcase {
	/**
	 * invalid id to use for INT UNSIGNED field (maximum allowed INT UNSIGNED in mySQL) + 1
	 * @see https://dev.mysql.com/doc/refman/5.6/en/integer-types.html mySQL Integer Types
	 * @var int INVALID_KEY
	 **/
	const INVALID_KEY = 4294967296;

	/**
	 * PHPUnit database connection interface
	 * @var \
	 * PHPUnit_Extensions_Database_DB_IDatabaseConnection $connection
	 **/
	protected $connection = null;

	/**
	 * assembles the table from the schema and provides it to PHPUnit
	 *
	 * @return \PHPUnit_Extensions_Database_Dataset_QueryDataSet assembled schema for PHPunit
	 **/
		public final function getDataSet() {
			$dataset = new \PHPUnit_Extensions_Database_Dataset_QueryDataSet($this->getConnection());

			// add all the tables for the project here
			$dataset->addTable("checkbook");
			$dataset->addTable("field");
			$dataset->addTable("criteria");
			$dataset->addTable("share");
			return ($dataset);
		}

	/**
	 * templates the setUp method that runs before each test; this method expunges the database before each run
	 *
	 * @see https://phpunit.de/manual/current/en/fixtures.html#fictures.more-setup-than-teardown PHPUNIT Fictures: setUp and tearDown
	 * @see https://github.com/sebastianbergmann/dbunit/issues/37 TRUNCATE fails on tables which have foreign key constraints
	 * @return \PHPUnit_Extensions_Database_Operation_Composite array containing delete and insert commands
	 **/
	public final function getSetUpOperation() {
		return new \PHPUnit_Extension_Database_Operation_Composite(array(PHPUnit_Extension_Database_Operation_Factory::DELETE_ALL(), \PHPUnit_Extensions_Database_Operation_Factory::INSERT()));
	}

	/**
	 * templates the tearDown method that runs after each test; this method expunges the database after each run
	 *
	 * @return \PHPUnit_Extensions_Database_Operation_IDatabaseOperation delete command for the database
	 **/
	public final function getTearDownOperation() {
		return(\PHPUnit_Extensions_Database_Operation_Factory::DELETE_ALL());
	}

	/**
	 * sets up the database connection and provides it to PHPUnit
	 *
	 * @see <https://phpunit.de/manual/current/en/database.html#database.configuration-of-a-phpunit-database-testcase>
	 * @return \PHPUnit_Extensions_Database_DB_IDatabaseConnection PHPUnit database connection interface
	 **/
	public final function getConnection () {
		// if the connection hasn't been established, create it
		if($this->connection === null) {
			// connect to mySQL and provide the interface to PHPUnit
				$config = readConfig("/etc/apache2/capstone-mysql/abqvast.ini");
				$pdo =  connectToEncryptedMySQL("/etc/apache2/capstone-mysql/abqvast.ini");
				$this->connection = $this->createDefaultDBConnection($pdo, $config["database"]);
		}
		return($this->connection);
	}

	/**
	 * returns the actual PDO object; this is a convenience method
	 *
	 * @return \PDO active PDO object
	 **/
	public final function getPDO() {
		return($this->getConnection()->getConnection());
	}
}