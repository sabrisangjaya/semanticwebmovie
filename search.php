<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tugas Semantik Web">
    <meta name="keywords" content="Movie Database IMDB" />
    <meta name="author" content="Sabri Sangjaya">
    <title>Movie Database</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/popper.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/font-awesome.css">
  </head>
  <body>
    <br/><br/>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card border-dark">
            <div class="card-body">
              <?php include 'header.php'; ?>
              <br/>
              <?php include 'searchbrowse.php'; ?>
              <br/><br/>
                <?php
                if(isset($_GET['q'])){
                $q=$_GET['q'];
                echo "<h3>Search Result for : ";
                echo $q;
                echo "</h3>";
                }?>         
              <hr/>
              <div class="row">
                <?php
                include("proses/connect.php");
                if(isset($_GET['q'])){
                $q=$_GET['q'];
                $sql="SELECT 1 as resultquery,film.*, group_concat(DISTINCT genre.genre) as genre, group_concat(DISTINCT person_name) as actor FROM `film` JOIN moviehasgenre on film.film_id=moviehasgenre.movieid JOIN moviehasperson on film.film_id=moviehasperson.movieid JOIN person on person.person_id=moviehasperson.personid join genre on genre.genre_id=moviehasgenre.genreid WHERE film_title LIKE '%".$q."%' OR film_desc LIKE '%".$q."%' AND person.person_role=2 group by film_id UNION SELECT 2 as resultquery,film.*, group_concat(DISTINCT genre.genre) as genre, group_concat(DISTINCT person_name) as actor FROM `film` JOIN moviehasgenre on film.film_id=moviehasgenre.movieid JOIN moviehasperson on film.film_id=moviehasperson.movieid JOIN person on person.person_id=moviehasperson.personid join genre on genre.genre_id=moviehasgenre.genreid WHERE person_name LIKE '%".$q."%' and person.person_role=2 group by film_id UNION SELECT 3 as resultquery,film.*, group_concat(DISTINCT genre.genre) as genre, group_concat(DISTINCT person_name) as actor FROM `film` JOIN moviehasgenre on film.film_id=moviehasgenre.movieid JOIN moviehasperson on film.film_id=moviehasperson.movieid JOIN person on person.person_id=moviehasperson.personid join genre on genre.genre_id=moviehasgenre.genreid WHERE person_name LIKE '%".$q."%' and person.person_role=1 group by film_id order by (case when film_title LIKE '%".$q."%' then 1 when film_desc LIKE '%".$q."%' then 2 else 3 end)";
                $query = mysqli_query($conn, $sql);
                if($query!=null&&mysqli_num_rows($query)>0){
                while($data = mysqli_fetch_array($query)) {
                ?>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="card border-dark">
                    <div class="card-body">
                      <div class="row">
                          <img class="img-fluid col-sm-4" src="
                          <?php 
                          echo $data['film_image']!=""?$data['film_image']:"img/noimage.jpg";
                          // $data['film_image']=="";
                          ?>" alt="poster">
                        
                        <div class="col-sm-8">
                          <h5 class="card-title"><?php echo $data['film_title']." (".$data['film_year'].")";?></h5>
                          <?php
                          $array=explode(",",$data['genre']);
                          foreach ($array as $item) {
                          echo "<a href='#' class='badge badge-secondary'>$item</a> ";
                          }
                          ?>
                          <p class="card-text" style="font-size: 0.8em"><?php echo $data['film_desc'];?>
                            
                            <?php
                          if($data['resultquery']==2){
                          echo "<br/>Actor by : ";
                          $array=explode(",",$data['actor']);
                          foreach ($array as $item) {
                          echo "<a href='#' class='badge badge-danger'>$item</a> ";
                          }
                          }
                          else if($data['resultquery']==3){
                          echo "<br/>Directed by : ";
                          $array=explode(",",$data['actor']);
                          foreach ($array as $item) {
                          echo "<a href='#' class='badge badge-danger'>$item</a> ";
                          }
                          }
                           else if($data['resultquery']==1){
                          echo "<br/>Contain Keyword : ";  
                          echo "<a href='#' class='badge badge-danger'>$q</a> ";
                          }
                          ?>
                          </p>
                          <a href="detail.php?id=<?php echo $data['film_id']?>" class="btn btn-primary btn-sm">View</a>
                          <a href="https://pahe.in/?s=<?php echo $data['film_title'].' '.$data['film_year'].''?>" target="_blank" class="btn btn-success btn-sm">Download</a>
                        </div> 
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                }
                }else{
                echo"Not found";
                }
                }
                ?>
                <?php
                include("proses/connect.php");
                if(isset($_GET['cat'])){
                $q=$_GET['cat'];
                $sql="SELECT film.*, group_concat(DISTINCT genre.genre) as genre, group_concat(DISTINCT person_name,person.person_role) as actor FROM `film` JOIN moviehasgenre on film.film_id=moviehasgenre.movieid JOIN moviehasperson on film.film_id=moviehasperson.movieid JOIN person on person.person_id=moviehasperson.personid join genre on genre.genre_id=moviehasgenre.genreid WHERE genre.genre='".$q."' group by film_id order by film.film_score DESC";
                //echo $sql;
                $query = mysqli_query($conn, $sql);
                if($query!=null&&mysqli_num_rows($query)>0){
                while($data = mysqli_fetch_array($query)) {
                ?>
                <div class="col-md-6" style="margin-bottom: 10px;">
                  <div class="card border-dark">
                    <div class="card-body">
                      <div class="row">            
                          <img class="img-fluid col-sm-4" src="
                          <?php 
                          echo $data['film_image']!=""?$data['film_image']:"img/noimage.jpg";
                          ?>" alt="poster"> 
                        <div class="col-sm-8">
                          <h5 class="card-title"><?php echo $data['film_title']." (".$data['film_year'].")";?></h5>
                          <?php
                          $array=explode(",",$data['genre']);
                          foreach ($array as $item) {
                          echo "<a href='#' class='badge badge-secondary'>$item</a> ";
                          }
                          ?>
                          <p class="card-text" style="font-size: 0.8em"><?php echo $data['film_desc'];?>  
                          <?php
                            $arrayactor=[];
                            $arraydirector=[];
                            $array=explode(",",$data['actor']);
                            foreach ($array as $key => $item) {
                            if (substr($item, -1)==2){
                            array_push($arrayactor,substr($item,0,-1));
                            }
                            if (substr($item, -1)==1){
                            array_push($arraydirector,substr($item,0,-1));
                            }
                            }
                            echo "<br/><b>Actor : </b>";
                            foreach ($arrayactor as $key => $item) {
                            echo "<a href='#' class='badge badge-success'>$item</a> ";
                            }
                            echo "<br/><b>Director : </b>";
                            foreach ($arraydirector as $key => $item) {
                            echo "<a href='#' class='badge badge-warning'>$item</a>";
                            }
                            ?>
                          </p>
                          <a href="detail.php?id=<?php echo $data['film_id']?>" class="btn btn-primary btn-sm">View</a>
                          <a href="https://pahe.in/?s=<?php echo $data['film_title'].' '.$data['film_year'].''?>" target="_blank" class="btn btn-success btn-sm">Download</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                }
                }else{
                echo"Not found";
                }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>