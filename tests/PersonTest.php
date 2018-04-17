<?php

class PersonTest extends \PHPUnit\Framework\TestCase {

	public function getDB() {
		$dbHost = 'localhost';
		$dbUsername = 'root';
		$dbPassword = '';
		$dbName = 'breeze';

		//Create connection and select DB
		$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

		if ($db->connect_error) {
		    die("Unable to connect database: " . $db->connect_error);
		}
		else
			return $db;
	}

	/** @test
	*/
	public function check_if_data_exists_then_save_or_update() {
		$person = new \App\Models\Person;
		$personTest = new PersonTest();
		$file = fopen("./persons.csv", "r");

		$this->assertEquals($person->dataSaveOrUpdate($file, $personTest->getDB()),True);
	}
}
