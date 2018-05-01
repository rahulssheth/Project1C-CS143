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
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="MovieReview">
            <i class="fa fa-fw fa-dashboard"></i>
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
          <h1>Show Movie</h1>
            <FORM METHOD = "GET" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" >
           	<h4>Movie Name</h4>
            	<select name="name">
               
                  <?php


   


                      $mysqli = new mysqli('localhost', 'cs143', '', 'CS143');

                     if ($mysqli->connect_error) {
                      die('Unable to connect to database');
                     }
   
                     $queryStr = "SELECT id, title, year, rating, company FROM Movie";
                     $result = $mysqli->query($queryStr);

                     if ($result === FALSE) {
                        printf("Error: %s\n", $mysqli->error);
                     }
        
                     while ($assoc = $result->fetch_assoc()) {
                        $keys = array_keys($assoc);
                            echo "<option value=\"" .$assoc['id'] . "\">" . $assoc['title'] . ", "  . $assoc['year'] . "</option>";

                     }
   
    
      
        
                     $result->free();
                     $mysqli->close(); 

                     ?>
            	</select>
            	<input type="submit" class="button" id="submit" value="Find Them!">
            </FORM>
            <div class="card-header">
          <i class="fa fa-table"></i> Movie Info</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Movie Title</th>
                  <th>Year</th>
                  <th>Rating</th>
                  <th>Company</th>
                  <th>Director</th>
                  <th>Genres</th>
                </tr>
              </thead>
              
              <tbody>
            <?php 
               if ($_SERVER["REQUEST_METHOD"] == "GET") {
                     $mysqli = new mysqli('localhost', 'cs143', '', 'CS143');

                     if ($mysqli->connect_error) {
                      die('Unable to connect to database');
                     }
   
                     $MovieInfo = "SELECT * FROM Movie WHERE id=". $_GET['name'] . ";";

                     $Director = "SELECT * FROM Director WHERE id = (SELECT did FROM MovieDirector WHERE mid=" . $_GET['name'] . " LIMIT 1);";
                     
                     $Genre = "SELECT genre FROM MovieGenre WHERE mid=" . $_GET['name'] . ";";

                     $movResult = $mysqli->query($MovieInfo);
                     $dirResult = $mysqli->query($Director);
                     $genResult = $mysqli->query($Genre);
                     if ($movResult === FALSE) {
                        echo "Error!";
                     }

                     $MovieAssoc = $movResult->fetch_assoc();
                     echo "<tr>";
                     echo "<td>" . $MovieAssoc['title'] . "</td>";
                     echo "<td>" . $MovieAssoc['year'] . "</td>";  
                     echo "<td>" . $MovieAssoc['rating'] . "</td>";
                     echo "<td>" . $MovieAssoc['company'] . "</td>";
                     $DirAssoc = $dirResult->fetch_assoc();
                     echo "<td>";
                     echo $DirAssoc['last'];
                     echo ", ";
                     echo $DirAssoc['first'];
                     echo "</td>";
                     echo "<td>";
                     while ($GenAssoc = $genResult->fetch_assoc()) {
                     	echo $GenAssoc['genre'];
                     	echo ", ";
                     }
                     $actorStr = "SELECT id, last, first FROM Actor WHERE id in (SELECT aid FROM MovieActor WHERE mid=" . $_GET['name'] . ");";
                     $actorRes = $mysqli->query($actorStr);

                     echo "</td>";
                     echo "</tr>";
                     echo "</tbody>";
                     echo "</table>";
                     echo "</div>";
                     echo "</div>";


                     echo "<div class=\"card-body\">"; 
          			     echo "<div class=\"table-responsive\">";
            		     echo "<table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">";
              		   echo "<thead>";
                	   echo "<tr>";
                  	 echo "<th>Actor Name</th>";
                  	 echo "<th>Link</th>";
                	   echo "</tr>";
              		   echo "</thead>";
              		   echo "<tfoot>";
              		   echo "</tfoot>";
              		   echo "<tbody>";
              		 	while ($actorAssoc = $actorRes->fetch_assoc()) {
              		 		echo "<tr>";
              		 		echo "<td>" . $actorAssoc['first'] . " " . $actorAssoc['last'] . "</td>";
              		 		echo "<td><a href=\"ShowActor.php?name=" . $actorAssoc['id'] . "\">Click Me </a></td>";
              		 		echo "</tr>";
              		 	}

              		 echo "</tbody>";
              		 echo "</table>";
              		 echo "</div>";
              		 echo "</div>";
              		 echo "<h3>Average Rating</h3>";

              		 $reviewStr = "SELECT avg(rating) as Average FROM Review WHERE mid=" . $_GET['name'] . " GROUP BY mid;";
              		 $reviewRes = $mysqli->query($reviewStr);
              		 $reviewAssoc = $reviewRes->fetch_assoc();
              		 echo $reviewAssoc['Average'];

              		 $allReviewStr = "SELECT * FROM Review WHERE mid=" . $_GET['name'] .";";
              		 $allReviews = $mysqli->query($allReviewStr);
              		 echo "<div class=\"card-body\">"; 
          			 echo "<div class=\"table-responsive\">";
            		 echo "<table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">";
              		 echo "<thead>";
                	 echo "<tr>";
                  	 echo "<th>Review Title</th>";
                  	 echo "<th>Rating</th>";
                  	 echo "<th>Comment</th>";
                	 echo "</tr>";
              		 echo "</thead>";
              
              		 echo "<tbody>";
              		 while ($allAssoc = $allReviews->fetch_assoc()) {
              		 	echo "<tr>";
              		 	echo "<td>"  . $allAssoc['name'] . "</td>";
              		 	echo "<td>" . $allAssoc['rating'] . "</td>";
              		 	echo "<td>" . $allAssoc['comment'] . "</td>";
              		 	echo "</tr>";
              		 }
              		 echo "</tbody>";
              		 echo "</table>";
              		 echo "</div>";
              		 echo "</div>";



                     



               }
            ?> 
              <a href="MovieReview.php">
            <input type="button" class="button" id="submit" value="Add Review!">
            <br />
            </a>
        </div>
      </div>
    </div>


</body>
</html>



