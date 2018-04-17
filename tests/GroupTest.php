<?php

class GroupTest extends \PHPUnit\Framework\TestCase {

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
		$group = new \App\Models\Group;
		$groupTest = new GroupTest();
		$file = fopen("./groups.csv", "r");

		$this->assertEquals($group->dataSaveOrUpdate($file, $groupTest->getDB()),True);
	}
}
