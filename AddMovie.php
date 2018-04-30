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
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="MovieActorRelation.html">
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
          <a class="nav-link" href="ShowMovie.html">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Show Movie Information</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="tables.html">
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
         <h1>Add Movie </h1>
          <FORM METHOD = "POST" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" >
                  
              <h4>Title </h4>
              <input type="textInput" name="movieName">
              <h4> Company</h4>
              <input type="textInput" name="company">
              <h4>Year </h4>
              <input type="textInput" name="year">
              <br />
              <h4> Rating </h4>
              <select name="rating">
                <option value="G">G</option>
                <option value="PG">PG</option>
                <option value="PG-13">PG-13</option>
                <option value="R">R</option>
              </select>
              <h4> Genre </h4>
              <select multiple='multiple' name="genre[]">
                <option value="Action">Action</option>
                <option value="Adventure">Adventure</option>
                <option value="Adult">Adult</option>
                <option value="Animation">Animation</option>
                <option value="Comedy">Comedy</option>
                <option value="Crime">Crime</option>
                <option value="Documentary">Documentary</option>
                <option value="Drama">Drama</option>
                <option value="Family">Family</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Horror">Horror</option>
                <option value="Musical">Musical</option>
                <option value="Mystery">Mystery</option>
                <option value="Romance">Romance</option>
                <option value="Sci-Fi">Sci-Fi</option>
                <option value="Short">Short</option>
                <option value="Thriller">Thriller</option>
                <option value="War">War</option>
                <option value="Western">Western</option>
              </select>
              <p> Hold Command on Mac or CTRL on Windows</p>
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
                      
                     $movieName = $_POST['movieName'];
                     $company = $_POST['company'];
                     $year = $_POST['year'];
                     $rating = $_POST['rating'];
                     $genre = $_POST['genre'];
                     $query2 = "SELECT * FROM MaxMovieID";
                     $result = $mysqli->query($query2);
                     $assoc = $result->fetch_assoc();
                     $id = $assoc['id'] + 1;
                     $updateStr = "UPDATE MaxMovieID SET id = id + 1;";
                     $updateRes = $mysqli->query($updateStr);
                     $queryStr = "INSERT INTO Movie (id, title, year, rating, company) VALUES (" . $id . ", '" . $movieName . "', " . $year . ", '" . $rating . "', '" . $company . "');";          
                     echo $queryStr;
                     $result2 = $mysqli->query($queryStr);
                     foreach ($genre as $selectedOption) {
                        $insertion = "INSERT INTO MovieGenre (mid, genre) VALUES (" . $id . ", '" . $selectedOption . "');";
                          $mysqli->query($insertion);    
                      }
                     if ($result === FALSE) {
                        echo "ruh roh";
                      }
                     } 

                     
                     
               
        ?>

</body>
</html>



