<?php

namespace App\Models;


class Person implements Util {

	public $column_count;

	public function setColumnCount($filename) 	{
  		$file = fopen($filename, "r");
  		$getData = fgetcsv($file);
  		for ($a =0; $a<1; $a++){
  			$this->column_count = count($getData);
  		}

        fclose($file);
	}

	public function getColumnCount() {
		return $this->column_count;
	}
}
