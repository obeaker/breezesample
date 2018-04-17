<?php
include 'dbConfig.php';
$q = intval($_GET['q']);

$sql="SELECT * FROM persons WHERE person_id = '".$q."'";
$result = mysqli_query($db,$sql);

echo "<table class='breeze'>
<tr>
<th>Person ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email Address</th>
<th>Group ID</th>
<th>State</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['person_id'] . "</td>";
    echo "<td>" . $row['first_name'] . "</td>";
    echo "<td>" . $row['last_name'] . "</td>";
    echo "<td>" . $row['email_address'] . "</td>";
    echo "<td>" . $row['group_id'] . "</td>";
    echo "<td>" . $row['state'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($db);
?>
