<DOCTYPE html!>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
<title>CS143 Project 1C</title>
  <!-- Bootstrap core CSS-->
  <link href="template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="template/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="template/css/sb-admin.css" rel="stylesheet">
  <link href="template/css/myStyles.css" rel="stylesheet">
</head>


<body class="fixed-nav sticky-footer bg-dark" id="page-top">



  <!-- Navigation-->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Movie Database</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="AddActor.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Add Actor/Director</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="AddMovie.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Add Movie Information</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="MovieActorRelation.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Add Movie Actor Relation</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="MovieDirectorRelation.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Add Director to Movie Relation</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="MovieReview.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Add Movie Review</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="ShowActor.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Show Actor Information</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="ShowMovie.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Show Movie Information</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="SearchMovie.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Search Actor/Movie</span>
          </a>
        </li>

        
        
      </ul>
      
      
    </div>
  </nav>
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <div class="row">
        <div class="col-12">
          <h1>Add Actor or Director</h1>
              <FORM METHOD='POST' ACTION="<?php echo $_SERVER["PHP_SELF"];?>" >
              <input type="checkbox" name="actorCheckbox"> Actor </input>
                  
              <input type="checkbox" name="dirCheckbox"> Director </input>
              <br />
              <br />
              <input type="radio" id="contactChoice1" name="gender" value="Male">
              <label for="contactChoice1">Male</label>

              <input type="radio" id="contactChoice2" name="gender" value="female">
              <label for="contactChoice2">Female</label>
              <h4>First Name </h4>
              <input type="textInput" name="firstName" >
              <h4>Last Name </h4>
              <input type="textInput" name="secondName">
              <h4>DOB </h4>
              <input type="date" name="DOB">
              <h4>DOD</h4>
              <input type="date" name="DOD">
              <input type="checkbox" name="DODCheckbox"> Check here if actor/actress alive </input>
              <br />
              <br />
              <a class="nav-link" href="AddedActor.html">
              <input type="submit" class="button" value="Submit">
              </a>
              </FORM>
        </div>
      </div>
    </div>
    <?php 

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                     $mysqli = new mysqli('localhost', 'cs143', '', 'CS143');
                     if ($mysqli->connect_error) {
                      die('Unable to connect to database');
                     }
                      
                     $fName = $_POST['firstName'];
                     $lName = $_POST['secondName'];
                     $gender = $_POST['gender'];
                     $DOB = $_POST['DOB'];
                     $DOD = $_POST['DOD'];
                     $isAlive = "";
                     if ($DOD == '') {
                        $isAlive = "Still Alive!";
                     } 
                     $queryStr = "";
                     if ($_POST['actorCheckbox'] == 'on') {
                        $query2 = "SELECT * FROM MaxPersonID";
                        $result = $mysqli->query($query2);
                        $assoc = $result->fetch_assoc();
                        $id = $assoc['id'] + 1;
                        $updateStr = "UPDATE MaxPersonID SET id = id + 1;";
                        $updateRes = $mysqli->query($updateStr);
                        if ($DOD == '') {
                          $queryStr = "INSERT INTO Actor (id, last, first, sex, dob) VALUES (". $id .  ", '"  . $lName . "', '" . $fName . "', '" . $gender . "', STR_TO_DATE('" . $DOB . "', '%Y-%m-%d'));";
                        } else {
                          $queryStr = "INSERT INTO Actor (id, last, first, sex, dob, dod) VALUES (". $id .  ", '"  . $lName . "', '" . $fName . "', '" . $gender . "', STR_TO_DATE('" . $DOB . "', '%Y-%m-%d'), STR_TO_DATE('" . $DOD . "', '%Y-%m-%d'));";          
                        }
                        
                        $result2 = $mysqli->query($queryStr);

                         if ($result === FALSE) {
                            echo "ruh roh";
                         }
                     } else {
                      $query2 = "SELECT * FROM MaxPersonID";
                      $result = $mysqli -> query($query2);
                      $assoc = $result->fetch_assoc();
                      $id = $assoc['id'] + 1;
                      $updateStr = "UPDATE MaxPersonID SET id = id + 1;";
                      $updateRes = $mysqli->query($updateStr);   
                      if ($DOD == '') {                   
                        $queryStr = "INSERT INTO Director (id, last, first, dob) VALUES (". $id .  ", '"  . $lName . "', '" . $fName . "', STR_TO_DATE('" . $DOB . "', '%Y-%m-%d'))";   
                      } else {
                        $queryStr = "INSERT INTO Director (id, last, first, dob, dod) VALUES (". $id .  ", '"  . $lName . "', '" . $fName . "', STR_TO_DATE('" . $DOB . "', '%Y-%m-%d'), STR_TO_DATE('" . $DOD . "', '%Y-%m-%d'));";   
                      }
                      $result2 = $mysqli->query($queryStr);

                        if ($result === FALSE) {
                          echo "Error!";
                        }
                      }

                     
                     
               }
        ?>

</body>
</html>



