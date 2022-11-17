<?php 
error_reporting(E_ALL);
include "dbjointableconnection.php";

  session_start();
//if session started then load the html stuff else go back to the login screen
  if(isset($_SESSION['id']) && isset($_SESSION['fname'])) {
    $id = $_SESSION['id'];
    $fname = $_SESSION['fname']; 
    $welcome = 'Welcome: ' . ucwords($fname); 
  } else {
     header("Location: login.php");
  }
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        /* Float four columns side by side */
        .column {
            margin-left: 25px;
            float: center;
            width: 25%;
            padding: 100px 10px;
        }

        /* Remove extra left and right margins, due to padding */
        .row {
            margin: 0 105px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive columns */
        @media screen and (max-width: 1200px) {
            .column {
                width: 100%;
                display: block;
                margin-bottom: 20px;
            }
        }

        /* Style the counter cards */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            text-align: center;
        }
    </style>
    <title>RedQueenGaming-SoftwareDeveloper</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Teko:wght@300;400&amp;display=swap'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../images/titleimagetelsa.png" width=32px>
    <!--this styles the pickme button and it doesnt make it move becuase i need to add the javascript file to this-->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!--this sets the nav bar and positon of the page but when mbile view the nav bar doesnt show-->
    <link rel="stylesheet" href="../assets/css/main.css" />
    <!--this styles the butttons and turns background black, inlarges font for the portfolio projects but not the main words like welcome-->
    <link rel="stylesheet" href="../assets/css/testmaincolor.css" />
    <link rel="stylesheet" href="../assets/css/testtextstuff.css" />
</head>
<body class="is-preload">
    <!-- Header -->
    <div id="header">
        <div class="top">
            <!-- Logo -->
            <div id="logo">
                <img src="../images/updatedme.jpg" width="58" height="58" class="image">
                <h1 id="title">Zina Vixen</h1>
                <p>Software Developer</p>
            </div>
            <!-- Nav -->
                <ul>
                    <a href="../index.html" id="contact-link"><span class="icon solid fa-envelope">Red Queen Gaming Home</span></a>
                    <br>
                    <a href="logout.php" id="contact-link"><span class="icon solid fa-envelope">Logout</span></a>
                    <br>
                    <a href="home.php" id="contact-link"><span class="icon solid fa-envelope">home</span></a>
                </ul>
        </div>
        <!--this the end of the top-->
        <div class="bottom">
            <!-- Social Icons -->
            <ul class="icons">
                <li><a href="https://twitter.com/RedQueenGaming6" class="icon brands fa-twitter"><span
                            class="label">Twitter</span></a></li>
                <li><a href="https://www.facebook.com/Red-Queen-Gaming-107600505421584"
                        class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                <li><a href="https://github.com/9916631" class="icon brands fa-github"><span
                            class="label">Github</span></a></li>
            </ul>
        </div>
    </div>
    <!--this the end of the header-->
    <!-- Main -->
    <div id="main">
        <!-- Intro -->
                    <img src="../images/wholelogo.gif" alt="Red" width="100%" height="auto">
                     <div class="educationelementstextcolor">
                <h1><?php if(isset($welcome)) : ?>
          <h3><?php echo $welcome; ?></h3>
       <?php endif; ?></h1>
            </div>
            
            <!--this is start  nice card style div-->
        <div class="col-md-4">
        <div class="card">
            <a href='addchild.php?id={$id}' class='btn ctaT'>Create New Kid</a>
                <?php //database connection
    include "dbjointableconnection.php";
    //select record from database
    $query = "select testmyownparent.,myownstudent. 
    from testmyownparent
    left join myownstudent 
    on myownstudent.parentchild = testmyownparent.id
    ";
    $statement = $conn->prepare($query);
    $statement->execute();
    //write line to return number of records in database
    $rows = $statement->rowCount();
    //if there is more then 1 row in the databse then display it first echo displays headings
    if($rows > 0){
        echo '
        ';
        //loop threw table to retrieve each record and display in bootstrap grid
        while($record = $statement->fetch(PDO::FETCH_ASSOC)){
            extract($record);
            echo "
             <div class='collegecontainertestformyself1 collegesubcontainertestmyself'>
            <div class='col-12'><p class='displaystarwarscolorcard'><span style='color: yellow'>Parent name:</span></p></div>
            <div class='educationelements'>
                  {$id} 
            </div>
        <div class='row'>
        <div class='col-12'><p class='displaystarwarscolorcard'><span style='color: yellow'>work place:</span></p></div>
        </div>
        <div><p><span style='color: white'>{$parentchild}</span></p></div>
        <a href='viewjoinedtables.php?id={$id}' class='btn ctaT'>View</a>
        </div>        
        
            ";
        }
    }else{
        echo "<div class='alert alert-danger'>Please add a child...</div>";
    }
    ?>
        </div>
    </p>
    </div><!--this is end  nice card style div-->
            
            
            
             <br>
    <!--this is start  nice card style div-->
        <div class="col-md-4">
        <div class="card">
            <a href='addchild.php?id={$id}' class='btn ctaT'>Create New Kid</a>
                <?php //database connection
    include "dbjointableconnection.php";
    //select record from database
    $query = "select id,
    parent_name, work_place, tel_number
from parents
    
order by parent_name desc";
    $statement = $conn->prepare($query);
    $statement->execute();
    //write line to return number of records in database
    $rows = $statement->rowCount();
    //if there is more then 1 row in the databse then display it first echo displays headings
    if($rows > 0){
        echo '
        ';
        //loop threw table to retrieve each record and display in bootstrap grid
        while($record = $statement->fetch(PDO::FETCH_ASSOC)){
            extract($record);
            echo "
            <div class='collegecontainertestformyself1 collegesubcontainertestmyself'>
            <div class='col-12'><p class='displaystarwarscolorcard'><span style='color: yellow'>Parent name:</span></p></div>
            <div class='educationelements'>
                  {$parent_name} 
            </div>
        <div class='row'>
        <div class='col-12'><p class='displaystarwarscolorcard'><span style='color: yellow'>work place:</span></p></div>
        </div>
        <div><p><span style='color: white'>{$work_place}</span></p></div>
        <div class='col-12'><p class='displaystarwarscolorcard'><span style='color: yellow'>phone number:</span></p></div>
        <div><p><span style='color: white'>{$tel_number}</span></p></div>
        
        <a href='viewjoinedtables.php?id={$id}' class='btn ctaT'>View</a>
        </div>
        
            ";
        }
    }else{
        echo "<div class='alert alert-danger'>Please add a child...</div>";
    }
    ?>
        </div>
    </p>
    </div><!--this is end  nice card style div-->
    
    <!--this is start  nice card style div-->
        <div class="col-md-4">
        <div class="card">
            <a href='addchild.php?id={$id}' class='btn ctaT'>Create New Kid</a>
                <?php //database connection
    include "dbjointableconnection.php";
    //select record from database
    $query = "select
    parent_name, work_place, tel_number, student_name, home_adress, id_group, room_number
from parents
    join student on parents.student_id = student.id
    join group_t on student.group_id = group_t.id
    join rooms on student.room_id = rooms.id
order by student_name desc;";
    $statement = $conn->prepare($query);
    $statement->execute();
    //write line to return number of records in database
    $rows = $statement->rowCount();
    //if there is more then 1 row in the databse then display it first echo displays headings
    if($rows > 0){
        echo '
        ';
        //loop threw table to retrieve each record and display in bootstrap grid
        while($record = $statement->fetch(PDO::FETCH_ASSOC)){
            extract($record);
            echo "
            <div class='collegecontainertestformyself1 collegesubcontainertestmyself'>
            <div class='col-12'><p class='displaystarwarscolorcard'><span style='color: yellow'>Parent name:</span></p></div>
            <div class='educationelements'>
                  {$parent_name} 
            </div>
        <div class='row'>
        <div class='col-12'><p class='displaystarwarscolorcard'><span style='color: yellow'>work place:</span></p></div>
        </div>
        <div><p><span style='color: white'>{$work_place}</span></p></div>
        <div class='col-12'><p class='displaystarwarscolorcard'><span style='color: yellow'>phone number:</span></p></div>
        <div><p><span style='color: white'>{$tel_number}</span></p></div>
        <div class='col-12'><p class='displaystarwarscolorcard'><span style='color: yellow'>student name:</span></p></div>
        <div><p><span style='color: white'>{$student_name}</span></p></div>
        <div class='col-12'><p class='displaystarwarscolorcard'><span style='color: yellow'>home address:</span></p></div>
        <div><p><span style='color: white'>{$home_adress}</span></p></div>
        <div class='col-12'><p class='displaystarwarscolorcard'><span style='color: yellow'>group id:</span></p></div>
        <div><p><span style='color: white'>{$id_group}</span></p></div>
        <div class='col-12'><p class='displaystarwarscolorcard'><span style='color: yellow'>room number:</span></p></div>
        <div><p><span style='color: white'>{$room_number}</span></p></div>
        <a href='viewjoinedtables.php?id={$id}' class='btn ctaT'>View</a>
        </div>
        
            ";
        }
    }else{
        echo "<div class='alert alert-danger'>Please add a child...</div>";
    }
    ?>
        </div>
    </p>
    </div><!--this is end  nice card style div-->
    
    
    
    
    <!-- Footer -->
    <div id="footer" class="educationelements">
        <!-- Copyright -->
        <ul class="copyright">
            <li>&copy; Red Queen Gaming. All rights reserved.</li>
            <li>Design: RedQueenGaming-SoftwareDeveloper</li>
        </ul>
    </div>
        </div>
    </div>
    <!--this is the main end div-->
    <!-- Scripts -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery.scrolly.min.js"></script>
    <script src="../assets/js/jquery.scrollex.min.js"></script>
    <script src="../assets/js/browser.min.js"></script>
    <script src="../assets/js/breakpoints.min.js"></script>
    <script src="../assets/js/util.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>