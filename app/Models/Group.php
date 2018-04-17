<?php

namespace App\Models;

class Group {

  public function dataSaveOrUpdate($file, $db) {
		fgetcsv($file);
		while(($getData = fgetcsv($file, 10000, ",")) !== FALSE){
			$sql = "SELECT group_id, group_name FROM groups WHERE group_id = '".$getData[0]."'";
      $result = mysqli_query($db, $sql);

      if($result->num_rows > 0){
				$sql1 = "UPDATE groups SET group_name = '".$getData[1]."'
        WHERE group_id = '".$getData[0]."'";
				//echo "Does Exist";
				$result1 = mysqli_query($db, $sql1);
				if(!isset($result1))
				{
					echo false;

				}
				else
				{
					echo True;
				}
			}
			else {
				$sql2 = "INSERT INTO groups (group_id,group_name)
				VALUES ('".$getData[0]."','".$getData[1]."')";
				//echo "Does Not Exist";
				$result2 = mysqli_query($db, $sql2);
				if(!isset($result2))
				{
					echo false;

				}
				else
				{
					echo True;
				}
			}
		}
	}
}
