<DOCTYPE html!>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>CS 143 Project 1C</title>
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
          <a class="nav-link" href="AddActor.html">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Add Actor/Director</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="AddMovie.html">
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
          <a class="nav-link" href="MovieReview.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Add Movie Review</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="#">
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
          <h1>Find an Actor</h1>
          <FORM METHOD = "GET" ACTION="<?php $_SERVER["PHP_SELF"];?>" >
            <h4>Actor Name</h4>
            <select name="name">
                  <?php


   


                      $mysqli = new mysqli('localhost', 'cs143', '', 'CS143');

                     if ($mysqli->connect_error) {
                      die('Unable to connect to database');
                     }
   
                     $queryStr = "SELECT last, first, id FROM Actor";
                     $result = $mysqli->query($queryStr);

                     if ($result === FALSE) {
                        printf("Error: %s\n", $mysqli->error);
                     }
        
                     while ($assoc = $result->fetch_assoc()) {
                        $keys = array_keys($assoc);
                            echo "<option value=\"" .$assoc['id'] . "\">" . $assoc['last'] . ", "  . $assoc['first'] . "</option>";

                     }
   
    
      
        
                     $result->free();
                     $mysqli->close(); 

                     ?>
            </select>
            <br />
            <br />
            <input type="submit" class="button" id="submit" value="Find Them!">

          </FORM>
          <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Actor's Movies</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Movie Name</th>
                  <th>Release Year</th>
                  <th>Company</th>
                  <th>Rating</th>
                  <th>Link</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Movie Name</th>
                  <th>Release Year</th>
                  <th>Company</th>
                  <th>Rating</th>
                  <th>Link</th>
                </tr>
              </tfoot>
              <tbody>
              <?php 
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                      $mysqli = new mysqli('localhost', 'cs143', '', 'CS143');

                      if ($mysqli->connect_error) {
                       die('Unable to connect to database');
                      }
   
                      $queryStr = "SELECT id, title, year, rating, company FROM Movie WHERE id IN (SELECT mid FROM MovieActor WHERE aid=" . $_GET['name'] . ");";

                      if ($result === FALSE) {
                          echo "Error. Couldn't find";
                      }
                      $result = $mysqli->query($queryStr);
                      while ($assoc = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $assoc['title'] . "</td>";
                        echo "<td>" . $assoc['year'] . "</td>";
                        echo "<td>" . $assoc['company'] . "</td>";
                        echo "<td>" . $assoc['rating'] . "</td>";
                        echo "<td> <a href=\"ShowMovie.php?name=" . $assoc['id'] . "\">Click</a> </td>";

                        echo "</tr>";
                      }
                      echo "</tbody>";
                      echo "</table>";
                      echo "</div>";
                      echo "</div>";
                      $queryStr2 = "SELECT * FROM Actor WHERE id=" . $_GET['name'] . ";";
                      $result2 = $mysqli->query($queryStr2);
                      $assoc2 = $result2->fetch_assoc();
                      echo "<h4><b>Name: </b> " . $assoc2['first'] . " " . $assoc2['last'];
                      echo "<br />";
                      echo "<h4><b>Gender: </b> " . $assoc2['sex'];
                      echo "<br />";
                      echo "<h4><b>DOB: </b> " . $assoc2['dob'];
                      echo "<br />";
                      if ($assoc2['dod'] == NULL) {
                        echo "<h4><b>DOD:</b> Still Alive</h4>";


                      } else {
                        echo "<h4>DOD: </h4> " . $assoc2['dod']; 
                      }
                }
              ?>  
             
          
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
  </div>
</body>

</html>

