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
    <script type="text/javascript" src="sumjs/underscore-min.js"></script>
    <script type="text/javascript" src="sumjs/summarizer.js"></script>
    <script type="text/javascript" src="sumjs/driver.js"></script>
  </head>
  <body>
    <br/><br/>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card border-dark">
            <div class="card-body">
              <?php include 'header.php'; ?>
              <p>Original code by <a href="https://github.com/arnavroy/text-summarizer">Arnav Roy</a> Client side extractive text summarization using JavaScript, based on TextRank Algorithm <a href="https://www.aclweb.org/anthology/W04-3252/">TextRank: Bringing Order into Text</a> by Rada Mihalcea, Paul Tarau . There's no network IO involved, all computations happen on the local machine.</p>
              <div class="form-group">
                <label for="input">Paragraf yang ingin diringkas</label>
                <textarea rows="5" class="form-control" id="input">Insert the text to be summarized here...</textarea>
              </div>
              <div class="form-group">
                <button id="summarizeButton" class="btn btn-primary">Summarize</button>
              </div>
              <div class="form-group">
                <label for="input">Hasil</label>
                <textarea rows="20" class="form-control" id="output">Expect the generated summary here...</textarea>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>