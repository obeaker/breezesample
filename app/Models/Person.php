<?php
use App\Models\Util;
namespace App\Models;

class Person {

  public $message;

  public function dataSaveOrUpdate($file, $db) {
    $util = new \App\Models\Util;
		$arrays = fgetcsv($file);

    $person_id = $util->getColumnLocation($arrays, "person_id");
    $first_name = $util->getColumnLocation($arrays, "first_name");
    $last_name = $util->getColumnLocation($arrays, "last_name");
    $email_address = $util->getColumnLocation($arrays, "email_address");
    $group_id = $util->getColumnLocation($arrays, "group_id");
    $state = $util->getColumnLocation($arrays, "state");
		while(($getData = fgetcsv($file, 10000, ",")) !== FALSE){
			$sql = "SELECT first_name, last_name FROM persons WHERE person_id = '".$getData[$person_id]."'";
            $result = mysqli_query($db, $sql);
            //echo $result->num_rows;
            if($result->num_rows > 0){
				$sql1 = "UPDATE persons SET first_name = '".$getData[$first_name]."', last_name = '".$getData[$last_name]."',
				email_address = '".$getData[$email_address]."', group_id = '".$getData[$group_id]."', state = '".$getData[$state]."'
				WHERE person_id = '".$getData[$person_id]."'";

				$result1 = mysqli_query($db, $sql1);
				if(!isset($result1))
				{
					$message =  false;

				}
				else
				{
					$message =  True;
				}
			}
			else {
				$sql2 = "INSERT INTO persons (person_id,first_name,last_name,email_address,group_id,state)
				VALUES ('".$getData[$person_id]."','".$getData[$first_name]."','".$getData[$last_name]."','".$getData[$email_address]."','".$getData[$group_id].
					"','".$getData[$state]."')";

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
