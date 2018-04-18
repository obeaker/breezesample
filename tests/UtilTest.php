<?php

class UtilTest extends \PHPUnit\Framework\TestCase {

	/** @test
	*/
	public function check_type_of_data() {

		$util = new \App\Models\Util;

		$util->setColumnCount("./groups.csv");

		$this->assertEquals($util->getColumnCount(),2);
	}

	/** @test
	*/
	public function check_order_of_columns() {

		$util = new \App\Models\Util;

		$arrays = $util->setColumnCount("./persons.csv");

		$this->assertEquals($util->getColumnLocation($arrays, "last_name"),2);
	}
}
