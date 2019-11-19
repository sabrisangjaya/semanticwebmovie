<!doctype html>
<?php
include 'omdb.class.php';
include 'simple_html_dom.php';
?>
<?php
include("proses/connect.php");
if(isset($_GET['id'])){
$q=$_GET['id'];
$sql="SELECT film.*, group_concat(DISTINCT genre.genre) as genre, group_concat(DISTINCT person_name,person.person_role) as actor FROM `film` JOIN moviehasgenre on film.film_id=moviehasgenre.movieid JOIN moviehasperson on film.film_id=moviehasperson.movieid JOIN person on person.person_id=moviehasperson.personid join genre on genre.genre_id=moviehasgenre.genreid WHERE film_id=".$q." group by film_id";
//echo $sql;
$query = mysqli_query($conn, $sql);
if($query!=null&&mysqli_num_rows($query)>0){
while($data = mysqli_fetch_array($query)) {
$judul=$data['film_title'];
?>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tugas Semantik Web">
    <meta name="keywords" content="Movie Database IMDB" />
    <meta name="author" content="Sabri Sangjaya">
    <title><?php echo $judul." - Movie Database"?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/index.js" type="text/javascript"></script>
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
              
              <hr/>
              <div class="row">
                <div class="col-md-9" style="margin-bottom: 10px;">
                  <div class="card border-dark">
                    <div class="card-body">
                      <div class="row">
                        
                        <img class="img-fluid col-sm-4" src="
                        <?php
                        echo $data['film_image']!=""?$data['film_image']:"img/noimage.jpg";
                        // $data['film_image']=="";
                        ?>" alt="poster">
                        
                        <div class="col-sm-8">
                          <h3 class="card-title" id="judul"><?php echo $data['film_title']?>
                          </h3><h3><?php echo "(".$data['film_year'].")";?></h3>
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
                          <a href="https://pahe.in/?s=<?php echo $data['film_title'].' '.$data['film_year'].''?>" target="_blank" class="btn btn-success btn-sm">Download</a>
                        </div>
                      </div>
                      <br/>
                      <div class="rows">
                        <div class="col-md-12">
                          <h4>IMDB & Rotten Tomatoes Data</h4>
                          <hr/>
                          <?php
                          try {
                          $omdb = new OMDb();
                          $omdb->setParams( ['tomatoes' => TRUE, 'plot' => 'full', 'apikey' => 'trilogy'] );
                          $omdb->setParam( 'y', $data['film_year'] );
                          $movie = $omdb->get_by_title( $data['film_title'] );
                          foreach ($movie as $key => $value) {
                          if(is_array($value)){
                          echo "<b>".$key."</b> : ";
                          foreach ($value as $key2 => $value2) {
                          if(is_array($value2)){
                          echo "<br/>";
                          foreach ($value2 as $key3 => $value3) {
                          echo "<b>".$key3."</b> : ".$value3."<br/>";
                          }
                          }else{
                          echo $value2.", ";
                          }
                          }
                          echo "<br/>";
                          }else{
                          if(is_null($value)){
                          }
                          else if($key=="Response"){
                          }
                          else if($key=="Poster"||$key=="tomatoURL"){
                          $alamattomato=$movie["tomatoURL"];
                          echo "<b>".$key."</b> : <a target='_blank' href='".$value."'>".$value."</a><br/>";
                          if($key=="Poster"){
                          echo "<br/><img src='".$value."' alt='poster' class='img-fluid img-thumbnail'><br/>";
                          }
                          }
                          else{
                          echo "<b>".$key."</b> : ".$value."<br/>";
                          }
                          }
                          }
                          }catch(Exception $e) {
                          echo $e->getMessage();
                          }
                          ?>
                          <br/>
                          <h5>Rotten Tomatoes Reviews</h5>
                          <hr/>
                          <div class="review_table">
                          <?php
                          // Create DOM from URL or file
                          $alamattomato.="reviews?type=top_critics";
                          $html = file_get_html($alamattomato);
                          try {
                          foreach($html->find('div[class="row review_table_row"]') as $element){
                          $tmt_gambar=$element->find('img.critic_thumb', 0)->src;
                          $tmt_nama= $element->find('div.critic_name', 0)->find('a', 0)->innertext;
                          $tmt_namaurl= $element->find('div.critic_name', 0)->find('a', 0)->href;
                          $tmt_nama1= $element->find('div.critic_name', 0)->find('a', 1)->innertext;
                          $tmt_nama1url= $element->find('div.critic_name', 0)->find('a', 1)->href;
                          $tmt_review= $element->find('div.the_review', 0)->innertext;
                          $tmt_reviewlink=$element->find('div.review-link', 0)->innertext;
                          $tmt_reviewtgl= $element->find('div.review-date', 0)->innertext;
                          ?>
                          <div class="row">
                            <div class="col-md-2"><img src="<?php echo $tmt_gambar;?>" alt="review" class="img-thumbnail img-fluid" style="width:100%"></div>
                            <div class="col-md-10">
                              <a href="<?php echo "https://www.rottentomatoes.com".$tmt_namaurl;?>" target="_blank"><?php echo $tmt_nama;?></a> from 
                              <a href="<?php echo "https://www.rottentomatoes.com".$tmt_nama1url;?>" target="_blank"><?php echo $tmt_nama1;?></a><br/>
                              <small><?php echo $tmt_reviewtgl;?></small>
                              <p><?php echo $tmt_review;?><br/><?php echo $tmt_reviewlink;?></p>
                            </div>
                          </div>
                          <hr/>
                          <?php
                          }
                          }catch(Exception $e) {
                          echo $e->getMessage();
                          }
                          ?>
                          </div>
                        </div>
                      </div>
                      <br/><br/>
                      <button id="loadmore" class="btn btn-primary btn-sm">Load More GIF Image</button>
                      <br/><br/>
                      <div class="row" id="gifs">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <?php include 'searchbrowse.php'; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<?php
}
}else{
echo"Not found";
}
}
?>