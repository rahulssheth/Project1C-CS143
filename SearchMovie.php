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
         <h1>Search Actor/Movie </h1>
          <FORM METHOD = "POST" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" >
                  
              <h3>Search Input</h3>
              <input type="textInput" name="searchInput">
              <br />
              <br />
              <input type="submit" class="button" value="Submit">

          </FORM>
        </div>
      </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Actor's Movies</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Link</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Link</th>
                </tr>
              </tfoot>
              <tbody>
    <?php 

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                     $mysqli = new mysqli('localhost', 'cs143', '', 'CS143');
                     if ($mysqli->connect_error) {
                      die('Unable to connect to database');
                     }
                      
                  	$string = $_POST['searchInput'];
                  	$queryStrActors = "SELECT * FROM Actor WHERE "; 
                  	$queryStrMovies = "SELECT * FROM Movie WHERE title LIKE ";

                 	$spacedOut = explode(" ", $string);
					if (count($spacedOut) > 1) {
   						$queryStrActors = $queryStrActors . "first LIKE '%". $spacedOut[0] . "%' AND last LIKE '%" . $spacedOut[1] . "%';";
  
					}	else {
  						$queryStrActors = $queryStrActors . " first LIKE '%" . $spacedOut[0] . "%' OR last LIKE '%" . $spacedOut[0] . "%';";
					}
					$queryStrMovies = $queryStrMovies . "'%" . $string . "%';";
                  	$resultActors = $mysqli->query($queryStrActors); 
                  	$resultMovies = $mysqli->query($queryStrMovies);

                  	while ($resultAssoc = $resultActors->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>";
                  		echo $resultAssoc['first'];
                  		echo ", ";
                  		echo $resultAssoc['last'];
                  		echo "</td>";
                  		echo "<td><a href=\"ShowActor.php?name=" . $resultAssoc['id'] . "\">Click Me </a></td>";

                  		echo "</tr>";
                  	}
                  	echo "</tbody>";
                     echo "</table>";
                     echo "</div>";
                     echo "</div>";
 		
 					echo "<div class=\"card-body\">"; 
          			     echo "<div class=\"table-responsive\">";
            		     echo "<table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">";
              		   echo "<thead>";
                	   echo "<tr>";
                  	 echo "<th>Title</th>";
                  	 echo "<th>Year</th>";
                  	 echo "<th>Company</th>";
                  	 echo "<th>Rating</th>";
                  	 echo "<th>Link</th>";
                	   echo "</tr>";
              		   echo "</thead>";
              		   echo "<tfoot>";
              		   echo "</tfoot>";
              		   echo "<tbody>";
                  	while ($resultAssoc = $resultMovies->fetch_assoc()) {
                  		echo "<tr>";
                  		echo "<td>";
                  		echo $resultAssoc['title'];
                  		echo "</td>";
                  		echo "<td>";
                  		echo $resultAssoc['year'];
                  		echo "</td>";
                  		echo "<td>";
                  		echo $resultAssoc['company'];
                  		echo "</td>";
                  		echo "<td>";
                  		echo $resultAssoc['rating'];
                  		echo "</td>";
                  		echo "<td><a href=\"ShowMovie.php?name=" . $resultAssoc['id'] . "\">Click Me </a></td>";

                  		echo "</tr>";

                  	}
                  	echo "</tbody>";
                     echo "</table>";
                     echo "</div>";
                     echo "</div>";
                  } 

                     
                     
               
        ?>

</body>
</html>



