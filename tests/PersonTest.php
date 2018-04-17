<?php

class PersonTest extends \PHPUnit\Framework\TestCase {

	/** @test
	*/
	public function check_type_of_data() {

		$person = new \App\Models\Person;

		$person->setColumnCount("./groups.csv");

		$this->assertEquals($person->getColumnCount(),2);
	}
}
