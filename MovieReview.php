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
  <style> 
   .slidecontainer {
    width: 100%;
  }

  .slider {
    -webkit-appearance: none;
    width: 100%;
    height: 25px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider:hover {
    opacity: 1;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    background: #3498DB;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    background: #3498DB;
    cursor: pointer;
}
  </style>
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
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Add Review</span>
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
         <h1>Add Review </h1>
         <?php
         $mysqli = new mysqli('localhost', 'cs143', '', 'CS143');
         if ($mysqli->connect_error) {
          die('Unable to connect to database');
         }

          if (!empty($_GET['name'])){
            $queryStr = "SELECT title FROM Movie WHERE id = " . $_GET['name'];
            $result = $mysqli->query($queryStr);
            $assoc = $result->fetch_assoc();

            echo "<h3>Reviewing: " . $assoc['title'] . "</h3>";

            $result->free();
         }

        $mysqli->close(); 

         ?>
          <FORM METHOD = "POST" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" >
                  
              <h3>Review Name </h3>
              <input type="textInput" name="reviewTitle">
              <h3>Movie Name </h3>
              <select name="movie">
               <?php


                      $mysqli = new mysqli('localhost', 'cs143', '', 'CS143');

                     if ($mysqli->connect_error) {
                      die('Unable to connect to database');
                     }

                    if (!empty($_GET['name'])){   
                      $queryStr = "SELECT title, id FROM Movie WHERE id = " . $_GET['name'] . ";";
                    }
                    else{
                      $queryStr = "SELECT title, id FROM Movie;";

                    }

                     $result = $mysqli->query($queryStr);

                     if ($result == FALSE) {
                        printf("Error: %s\n", $mysqli->error);
                     }
        
                     while ($assoc = $result->fetch_assoc()) {
                        $keys = array_keys($assoc);
                        echo "<option value=\"" .$assoc['id'] . "\">" . $assoc['title'] . "</option>";
                     }
   
    
      
        
                     $result->free();
                     $mysqli->close(); 

                     ?>
             </select>
             <br />
             <br />
             <br />
                 <input type="range" min="1" max="5" value="2.5" class="slider" name="rating" id="myRange">
                 <p >Value: <span id="demo"></span></p>

              <script>
                var slider = document.getElementById("myRange");
                var output = document.getElementById("demo");
                output.innerHTML = slider.value;

                slider.oninput = function() {
                  output.innerHTML = this.value;
                }
              </script>
            <br />
            <br />
             <textarea name="comment"></textarea>
             <br />
             <br />
              <input type="submit" class="button" value="Submit">

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
                      
                     $reviewTitle = $_POST['reviewTitle'];
                     $mid = $_POST['movie'];
                     $rating = $_POST['rating'];
                     $comment = $_POST['comment'];
                     $queryStr = "INSERT INTO Review (name, time, mid, rating, comment) VALUES ('" . $reviewTitle . "', CURRENT_TIMESTAMP(), " . $mid . ", " . $rating . ", '" . $comment ."');";
                     $result = $mysqli->query($queryStr);
                     if ($result === FALSE) {
                        echo "ruh roh";
                      }
                     } 

                     
                     
               
        ?>

</body>
</html>



