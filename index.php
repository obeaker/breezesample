<?php
//load the database configuration file
include 'dbConfig.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.30.1/js/jquery.tablesorter.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/table.css">
  <script type="text/javascript">
  $(document).ready(function() {
    $("#persons").tablesorter({widthFixed: true});
  });

  function showPersonsInGroup(str) {
    if (str == "") {
      document.getElementById("personList").innerHTML = "";
      return;
    } else {
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("personList").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET","getPeopleList.php?q="+str,true);
      xmlhttp.send();
    }
  }
  </script>

</head>

<body>
  <div id="wrap">
    <div class="container">
      <div class="row">
        <p>
          <h1>Person or Group Import Utility </h1>
        </p>
      </div>
      <div class="row">

        <form class="form-horizontal" action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
          <table id="import" cellspacing="0" style="width: 50%;margin: 0px;" cellpadding="0" class="breeze table table-bordered">
            <thead>
              <tr>
                <th>Select File</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input type="file" name="file" id="file" class="input-large">
                </td>
                <td> <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button> </td>
              </tbody>
            </table>
          </form>

        </div>
        <div class="row">
          <p>
            <h4>Imported Persons Table </h4>
          </p>
          <table id="persons" cellspacing="0" cellpadding="0" class="breeze table table-bordered">
            <thead>
              <tr>
                <th>Person ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Group ID</th>
                <th>State</th>
              </tr>
            </thead>
            <tbody>
              <?php
              //get records from database
              $query = $db->query("SELECT * FROM persons ORDER BY person_id ASC");
              if($query->num_rows > 0){
                while($row = $query->fetch_assoc()){ ?>
                  <tr>
                    <td><?php echo $row['person_id']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['email_address']; ?></td>
                    <td><?php echo $row['group_id']; ?></td>
                    <td><?php echo $row['state']; ?></td>
                  </tr>
                  <?php } }else{ ?>
                    <tr><td colspan="6">No person(s) found.....</td></tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="row">
                <p>
                  <h4>Imported Groups Table </h4>
                </p>
                <table id="Groups" cellspacing="0" style="width: 50%;margin: 0px;" cellpadding="0" class="breeze table table-bordered">
                  <thead>
                    <tr>
                      <th>Group ID</th>
                      <th>Group Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    //get records from database
                    $query = $db->query("SELECT * FROM groups ORDER BY group_id ASC");
                    if($query->num_rows > 0){
                      while($row = $query->fetch_assoc()){ ?>
                        <tr>
                          <td><?php echo $row['group_id']; ?></td>
                          <td><?php echo $row['group_name']; ?></td>
                        </tr>
                        <?php } }else{ ?>
                          <tr><td colspan="2">No group(s) found.....</td></tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <br>
                    <div class="row">
                      <p>
                        <h4>Get List of Persons by Group Table </h4>
                      </p>
                      <form>
                        <select name="personslists" onchange="showPersonsInGroup(this.value)">
                          <option value="">Select a person:</option>
                          <?php
                          //get records from database
                          $query = $db->query("SELECT * FROM groups ORDER BY group_id ASC");
                          if($query->num_rows > 0){
                            while($row = $query->fetch_assoc()){ ?>

                              <option value="<?php echo $row['group_id']; ?>"><?php echo $row['group_name']; ?></option>
                              <?php }} ?></select>

                            </form>


                            <br>
                            <div id="personList"><b>Person info will be listed here...</b></div>
                          </div>
                          <div class="row">
                            <br><br>
                          </div>
                        </div>
                      </body>

                      </html>
