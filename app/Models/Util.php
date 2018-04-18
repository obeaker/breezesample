<?php

namespace App\Models;

class Util
{
  public $column_count;

	public function setColumnCount($filename) 	{
  		$file = fopen($filename, "r");
  		$getData = fgetcsv($file);
  		for ($a =0; $a<1; $a++){
  			$this->column_count = count($getData);
  		}
      fclose($file);

      return $getData;
	}

	public function getColumnCount() {
		return $this->column_count;
	}

  public function getColumnLocation($arrays, $column){
    return array_search($column,$arrays);
  }
}
