<?php
 $host = 'localhost';
 $user = 'root';
 $pass = '';
 $db = 'semanticmovie';
 $conn = mysqli_connect($host, $user, $pass);
 mysqli_select_db($conn, $db);
 error_reporting(0);
 ?>