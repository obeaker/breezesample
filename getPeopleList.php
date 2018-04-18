<!DOCTYPE html>
<html>
<head>
<style>
.breeze {
  margin: 0 auto;
  font-size: 1.2em;
  margin-bottom: 15px;
}

.breeze thead {
  cursor: pointer;
  background: #c9dff0;
}

.breeze thead tr th {
  font-weight: bold;
  padding: 12px 30px;
  padding-left: 42px;
}

.breeze thead tr th span {
  padding-right: 20px;
  background-repeat: no-repeat;
  background-position: 100% 100%;
}

.breeze thead tr th.headerSortUp, #persons thead tr th.headerSortDown {
  background: #acc8dd;
}

.breeze thead tr th.headerSortUp span {
  background-image: url('up-arrow.png');
}

.breeze thead tr th.headerSortDown span {
  background-image: url('down-arrow.png');
}

.breeze tbody tr {
  color: #555;
}

.breeze tbody tr td {
  text-align: center;
  padding: 15px 10px;
}

.breeze tbody tr td.lalign {
  text-align: left;
}

</style>
</head>
<body>
<?php
include 'dbConfig.php';
$q = intval($_GET['q']);

$sql="SELECT * FROM persons WHERE state = 'active' and group_id = '".$q."'";
$result = mysqli_query($db,$sql);

echo "<table class='breeze table table-bordered'>
<tr>
<th>Person ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email Address</th>
<th>Group ID</th>
<th>State</th>
</tr>";
if($result->num_rows > 0){
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['person_id'] . "</td>";
    echo "<td>" . $row['first_name'] . "</td>";
    echo "<td>" . $row['last_name'] . "</td>";
    echo "<td>" . $row['email_address'] . "</td>";
    echo "<td>" . $row['group_id'] . "</td>";
    echo "<td>" . $row['state'] . "</td>";
    echo "</tr>";
} }else{
  echo "<tr>";
  echo "<td colspan='6'>There are no active persons for this group</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($db);
?>
</body>
</html>
