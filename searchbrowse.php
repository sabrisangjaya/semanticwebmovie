<h4>Search</h4>
<form action="search.php" method="GET">
  <div class="input-group mb-3">
    <input type="text" name="q" class="form-control" placeholder="Type a title or actor or director of movie">
    <div class="input-group-append">
      <button class="btn btn-success" type="submit">Go</button>
    </div>
  </div>
</form>
<h4>Browse by Category</h4>
<?php
include("proses/connect.php");
$sql="SELECT * FROM `genre` WHERE 1";
//echo $sql;
$badge=["badge-primary","badge-secondary","badge-success","badge-danger","badge-warning","badge-info","badge-dark"];
$it = 0;
$query = mysqli_query($conn, $sql);
if($query!=null&&mysqli_num_rows($query)>0){
while($data = mysqli_fetch_array($query)) {
echo "<a href='search.php?cat=".$data["genre"]."' class='badge ".$badge[$it]."'>".$data["genre"]."</a> ";
$it++;
if($it==count($badge)){
$it=0;
}
?>
<?php
}
}
?>