 <?php

session_start();
if(!isset($_SESSION['username'])){
	header('location:login.html');
}
?> 

<!DOCTYPE html>
<html>
<head>
	<title> Home Page</title>
  <link rel="stylesheet" href="css/homeStudent.css">
</head>
<body>
<div class="home-wrap">
  <div class="home-html">
  <div class="signout"><a href=profileStudent.php><button>Profile</button></a>
  <a href=logout.php><button>Sign Out</button></a></div><br>
    <input id="tab-1" type="radio" name="tab" class="events" checked><label for="tab-1" class="tab">Events</label>
    <input id="tab-2" type="radio" name="tab" class="certificates"><label for="tab-2" class="tab">Certificates</label>
   

    <div class="home-form">

      <div class="events-htm">
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

            $sql = "SELECT date, time,title,person FROM eventtable";
            $result = $conn->query($sql);

            if ($result!==false && $result->num_rows > 0) {
            echo "<table width='100%'><tr><th>Date</th><th>Time</th><th>Title</th><th>Resource Person</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["date"]."</td><td>".$row["time"]."</td><td>".$row["title"]."</td><td>".$row["person"]."</td></tr>";
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

        $sql = "SELECT * FROM certificate";
        $result = $conn->query($sql);

        if ($result!==false && $result->num_rows > 0) {
          echo "<table width='75%'><tr><th>Date</th><th>Title</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
          if($row["regnumber"]==$_SESSION['username'])
          {
           
            $img = imagecreatefromjpeg('images/certificate.jpg');
            $my_img = imagescale( $img, 600, 450 );
            $text_colour = imagecolorallocate( $my_img, 0, 0, 0 );
            imagestring( $my_img, 5, 260, 195, $row["name"], $text_colour );
            imagestring( $my_img, 5, 260, 265, $row["event"], $text_colour );
            imagestring( $my_img, 5, 335, 305, $row["date"].".", $text_colour );
            imagesetthickness ( $my_img, 3 );
           

            if ($my_img ) {
                ob_start();
                imagepng($my_img);
                $imgData=ob_get_clean();
                imagedestroy($my_img);
            
                echo "<tr><td>".$row["date"]."</td><td>".$row["event"]."</td><td>".'<a  class="down" href="data:image/png;base64,'.base64_encode($imgData).'">Preview</a>'."</td><td>".'<a  download="certificate.png" href="data:image/png;base64,'.base64_encode($imgData).'">Download</a>'."</tr>";
                
            }
        }
      }
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
</body>
<script src="js/jquery-1.11.0.min.js"></script>
<script>
$(document).ready(function(){
  $(".down").click(function(){
    var url =this.href;
    var image = new Image();
    image.src = url;
    var w = window.open();
        w.document.write('<p><center>'+image.outerHTML);
  });      
});
</script>
</html>
