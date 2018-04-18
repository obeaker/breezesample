<?php
require "app/Models/Util.php";
require "app/Models/Person.php";
require "app/Models/Group.php";
include 'dbConfig.php';

use App\Models\Util;
use App\Models\Person;
use App\Models\Group;

if(isset($_POST['Import'])){
  $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values',
  'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv',
  'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

  if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
    if(is_uploaded_file($_FILES['file']['tmp_name'])){
      $filename=$_FILES["file"]["tmp_name"];

      $util = new Util();

      $util->setColumnCount($filename);
      $count = $util->getColumnCount();

      $file = fopen($filename, "r");

      if($count === 2) {
        $group = new Group();
        $group->dataSaveOrUpdate($file, $db);
      }
      else if ($count === 6) {
        $person = new Person();
        $person->dataSaveOrUpdate($file, $db);
      }
      else {
        echo "<script type=\"text/javascript\">
        alert(\"Invalid File:Please Upload either a Person or Group CSV File.\");
        window.location = \"index.php\"
        </script>";
      }



    }
  }
}

header("Location: index.php");
