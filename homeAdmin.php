<!DOCTYPE html>
<html>
<head>
<script src="js/jquery-1.11.0.min.js"></script>
<?php
session_start();
if(!isset($_SESSION['username'])){
	header('location:login.html');
}

if(isset($_GET['certificate'])){
  echo '<script type="text/javascript">
        $(document).ready(function(){
        $("#tab-2").prop("checked", true);
          });
     </script>';
     
}else if(isset($_GET['student'])){
  echo '<script type="text/javascript">
        $(document).ready(function(){
        $("#tab-3").prop("checked", true);
        });
     </script>';
     
}
  
?> 
	<title> Home Page</title>
  <link rel="stylesheet" href="css/homeAdmin.css">
</head>
<body>
<div class="home-wrap">

  <div class="home-html">
  <div class="signout"><a  href=changePassword.php><button>Change Password</button>&nbsp;&nbsp;</a><a  href=logout.php><button>Sign Out</button></a></div><br>
    <input id="tab-1" type="radio" name="tab" class="events" checked><label for="tab-1" class="tab">Events</label>
    <input id="tab-2" type="radio" name="tab" class="certificates"><label for="tab-2" class="tab">Certificates</label>
    <input id="tab-3" type="radio" name="tab" class="students"><label for="tab-3" class="tab">Students</label>
    
    
    <div class="home-form">

      <div class="events-htm">

      <form action="addEvent.php" method="post">
                <input type="date" placeholder="date" name="date" class="form-control" required>
                <input type="time" placeholder="time" name="time" class="form-control" required>
                <input type="text" placeholder="Title" name="title" class="form-control" required>
                <input type="text" placeholder="Resource Person" name="person" class="form-control" required>

                <button type="submit" class="btn btn-primary" id="registerButton"> Add Event </button>
      </form>
      <br>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "eventinfo";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM eventtable";
            $result = $conn->query($sql);

            if ($result!==false && $result->num_rows > 0) {
            echo "<table width='100%'><tr><th>Date</th><th>Time</th><th>Title</th><th>Resource Person</th></tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["date"]."</td><td>".$row["time"]."</td><td>".$row["title"]."</td><td>".$row["person"]."</td><td><a href='deleteEvent.php?id=".$row['id']."'>Delete</a></td></tr>";
            }
            echo "</table>";
            } else {

            echo "0 results";
            }
            $conn->close();
        ?> 

        <div class="hr"></div>
      </div>


      <div class="certificates-htm">

      <form method='post' id='userform' action='addCertificate.php'>

      <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "eventinfo";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT title,date FROM eventtable";
        $result = $conn->query($sql);

        if ($result!==false && $result->num_rows > 0) {

          echo'<br><br><fieldset>
          <legend>Please select the event</legend>';
        echo'<select name="event" required>';

        while($row = $result->fetch_assoc()) {
          echo' <option value="'.$row["title"].'|'.$row["date"].'">'.$row["title"].'</option>';
        }

        echo'</select>';
        echo'</fieldset>';
        }
        else
        {
          echo "0 results";
        }

        $sql = "SELECT * FROM usertable";
        $result = $conn->query($sql);
        echo'<br><fieldset>
        <legend>Please select the students</legend>';
        if ($result!==false && $result->num_rows > 0) {

       

        while($row = $result->fetch_assoc()) {
         if($row["regnumber"]!="admin")
            echo ' <input type="checkbox" name="students[]" value="'.$row["fullname"].'|'.$row["regnumber"].'">'.$row["regnumber"].'<br>';
        }
     


        }
        else
        {
          echo "0 results";
        }

        echo'</fieldset>';
        
        ?> 
        <br>
        <button type="submit" class="btn btn-primary" id="registerButton"> Add Certificates </button>

        </form>
        <br>
        <hr>
        <br>
       
        <?php
        $sql = "SELECT * FROM certificate";
        $result = $conn->query($sql);

        if ($result!==false && $result->num_rows > 0) {

          echo "<table width='100%'><tr><th>Name</th><th>Registration Number</th><th>Event</th><th>Date</th></tr>";

          while($row = $result->fetch_assoc()) {
              echo "<tr><td>".$row["name"]."</td><td>".$row["regnumber"]."</td><td>".$row["event"]."</td><td>".$row["date"]."</td><td><a href='deleteCertificate.php?id=".$row['id']."'>Delete</a></td></tr>";
          }
          echo "</table>";
      }else
      {
        echo "0 results";
      }
      $conn->close();
      ?>
        <div class="hr"></div>

      </div>

      <div class="students-htm">


  <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "eventinfo";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT * FROM usertable";
      $result = $conn->query($sql);

      if ($result!==false && $result->num_rows > 0) {
      echo "<table width='100%'><tr><th>Full Name</th><th>Registration Number</th><th>E-mail</th><th>Contact Number</th></tr>";

      while($row = $result->fetch_assoc()) {
        if($row["regnumber"]!="admin")
          echo "<tr><td>".$row["fullname"]."</td><td>".$row["regnumber"]."</td><td>".$row["email"]."</td><td>".$row["contact"]."</td><td><a href='resetPassword.php?id=".$row['id']."'>Reset</a></td><td><a href='deleteStudent.php?id=".$row['id']."'>Delete</a></td></tr>";
      }
      echo "</table>";
      } else {
       
      echo "0 results";
      }
      $conn->close();
  ?> 

  <div class="hr"></div>
</div>

    </div>
  </div>
</div>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "homeAdmin.php");
    }
</script>
</body>
</html>
