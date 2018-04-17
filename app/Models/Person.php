<?php

namespace App\Models;

class Person {

  public function dataSaveOrUpdate($file, $db) {
		fgetcsv($file);
		while(($getData = fgetcsv($file, 10000, ",")) !== FALSE){
			$sql = "SELECT first_name, last_name FROM persons WHERE person_id = '".$getData[0]."'";
            $result = mysqli_query($db, $sql);
            //echo $result->num_rows;
            if($result->num_rows > 0){
				$sql1 = "UPDATE persons SET first_name = '".$getData[1]."', last_name = '".$getData[2]."',
				email_address = '".$getData[3]."', group_id = '".$getData[4]."', state = '".$getData[5]."'
				WHERE person_id = '".$getData[0]."'";
				echo "Does Exist";
				$result1 = mysqli_query($db, $sql1);
				if(!isset($result1))
				{
					return false;

				}
				else
				{
					return True;
				}
			}
			else {
				$sql2 = "INSERT INTO persons (person_id,first_name,last_name,email_address,group_id,state)
				VALUES ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4].
					"','".$getData[5]."')";
				echo "Does Not Exist";
				$result2 = mysqli_query($db, $sql2);
				if(!isset($result2))
				{
					return false;

				}
				else
				{
					return True;
				}
			}
		}
	}
}
