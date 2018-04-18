<?php

use App\Models\Util;

namespace App\Models;

class Group {

  public $message;
  public function dataSaveOrUpdate($file, $db) {
    $util = new \App\Models\Util;
		$arrays = fgetcsv($file);
    $group_id = $util->getColumnLocation($arrays, "group_id");
    $group_name = $util->getColumnLocation($arrays, "group_name");

		fgetcsv($file);
		while(($getData = fgetcsv($file, 10000, ",")) !== FALSE){
			$sql = "SELECT group_id, group_name FROM groups WHERE group_id = '".$getData[$group_id]."'";
      $result = mysqli_query($db, $sql);

      if($result->num_rows > 0){
				$sql1 = "UPDATE groups SET group_name = '".$getData[$group_name]."'
        WHERE group_id = '".$getData[$group_id]."'";
				//echo "Does Exist";
				$result1 = mysqli_query($db, $sql1);
				if(!isset($result1))
				{
					$message = false;
				}
				else
				{
					$message =  True;
				}
			}
			else {
				$sql2 = "INSERT INTO groups (group_id,group_name)
				VALUES ('".$getData[$group_id]."','".$getData[$group_name]."')";
				//echo "Does Not Exist";
				$result2 = mysqli_query($db, $sql2);
				if(!isset($result2))
				{
					$message =  false;
				}
				else
				{
					$message =  True;
				}
			}
		}
    return $message;
	}
}
