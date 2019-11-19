<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tugas Semantik Web">
    <meta name="keywords" content="Movie Database IMDB" />
    <meta name="author" content="Sabri Sangjaya">
    <title>Dokumentasi - Movie Database</title>
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
          <div class="card">
            <div class="card-body">
              <?php include 'header.php'; ?>
              <p>
                RDF Schema<br/>
                <img src="img/doc/schema.jpg" alt="schema"><br/><br/>
                Tabel<br/>
                <img src="img/doc/tablerelation.png" alt="tabel"><br/><br/>
                Cara kerja :<br/>
                User memasukan query pencarian ke dalam sistem, kemudian sistem akan menampilkan hasil dengan urutan
                <ol>
                  <li>Judul/Deskripsi mengandung kata kunci</li>
                  <li>Dimainkan oleh actor yang sesuai kata kunci</li>
                  <li>Disutradarai oleh director yang sesuai kata kunci</li>
                </ol>

                <img src="img/doc/Screenshot_2.png" alt="image">
                <img src="img/doc/Screenshot_3.png" alt="image">
                <img src="img/doc/Screenshot_5.png" alt="image">
                <img src="img/doc/Screenshot_6.png" alt="image">

                Ketika user memilih tombol download maka sistem mengarahkan user ke situs download film <a href="https://pahe.in/" target="_blank">Pahe.in</a><br/>
                Ketika user memilih tombol view maka akan menampilkan detail dari film tersebut<br/>

                Detail dari film didapat dari database lokal dan API request menggunakan <a href="http://www.omdbapi.com/" target="_blank">OMDb API</a>.
                Dari OMBd API didapat alamat <a href="https://www.rottentomatoes.com/" target="_blank">Rotten Tomatoes</a> yang digunakan untuk menampilkan review film menggunakan <a href="https://simplehtmldom.sourceforge.io/index.htm" target="_blank">HTML DOM</a>. Selain menampilkan detail film sistem juga menampilkan gambar gif yang terkait dari situs <a href="https://giphy.com/" target="_blank">giphy</a><br/>

                <br/>Referensi<br/>
                <ul>           
                <li><a href="https://www.kaggle.com/PromptCloudHQ/imdb-data" target="_blank">https://www.kaggle.com/PromptCloudHQ/imdb-data</a><br/> IMDB data from 2006 to 2016 data set of 1,000 popular movies on IMDB in the last 10 years</li>
                <li><a href="https://www.kaggle.com/orgesleka/imdbmovies" target="_blank">https://www.kaggle.com/orgesleka/imdbmovies</a></li>
                <li><a href="https://simplehtmldom.sourceforge.io/index.htm" target="_blank">https://simplehtmldom.sourceforge.io/index.htm</a></li>
                <li><a href="https://github.com/bereznd1/Movie-GIF-Retrieval" target="_blank">https://github.com/bereznd1/Movie-GIF-Retrieval</a></li>
                <li><a href="https://github.com/bayusujatmoko/MovieSearchWeb" target="_blank">https://github.com/bayusujatmoko/MovieSearchWeb</a></li>
                <li><a href="https://github.com/RasmusLindroth/OMDb-PHP-API" target="_blank">https://github.com/RasmusLindroth/OMDb-PHP-API</a></li>
                <li><a href="https://github.com/bereznd1/Movie-GIF-Retrieval" target="_blank">https://github.com/bereznd1/Movie-GIF-Retrieval</a></li>
                </ul>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>