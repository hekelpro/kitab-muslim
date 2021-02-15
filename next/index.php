<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Al-Qur'an App By Rizky</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="https://i.ibb.co/YRkmZyF/50d79e5ed8fc.jpg">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  </head>
<body>
  <div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <img src="https://cdn.qurancdn.com/assets/logo-lg-w-10a76950b6fdf68f9bf6abdde65eec2553f6f6d97837b65d8836d1a0c39a01c9.png" alt="Al-Quran" style="display: block; margin: auto; width: 200px; height: 100px;"/>
          </div>
          <?php
          include("../config.php");
          include("../simple_html_dom.php");
          
          if(empty($_GET["count"])){
            echo '<meta http-equiv="refresh" content="0;url=..">';
          }
          
          $ayt = array();
          $bca = array();
          $art = array();
          
          $sa = strval($_GET["count"]);
          $hitung = $sa-1;
          $html = str_get_html(file_get_contents($surah[$hitung]));
          foreach ($html->find("article[class=surat]") as $a){
            foreach ($a->find("h1") as $title){
              ?>
              <center><h6 class="m-0 font-weight-bold text-dark"><?= $title; ?></h6></center>
              <?php
            }
            ?>
            <audio src="<?= $embed[$hitung]; ?>" controls></audio>
            <center><h6>Klik Play Untuk Mendengarkan Bacaan Surahnya</h6></center><br>
            <?php
            foreach ($a->find("span[class=ayat]") as $ayat){
              array_push($ayt,trim($ayat->plaintext));
            }
            foreach ($a->find("span[class=bacaan]") as $baca){
              array_push($bca,trim($baca->plaintext));
            }
            foreach ($a->find("span[class=arti]") as $arti){
              array_push($art,trim($arti->plaintext));
            }
            
            $no = 0;
            $oprek = array_map(null,$ayt,$bca,$art);
            foreach ($oprek as $z){
              $ez = $no += 1;
              ?>
              <div class="col-lg-6">
                <div class="card mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark"><?= $ez; ?></h6>
                  </div>
                  <div class="card-body">
                    <div class="h4 mb-0 font-weight-bold text-gray-800" style="text-align: right;"><?= $z[0]; ?><br><hr></div>
                    <h5><?= $z[1]; ?></h5>
                    <hr>
                    <h6><?= $z[2]; ?></h6>
                  </div>
                </div>
              </div>
              <?php
            }
          }
          ?>
        </div>
      </div>
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - made by
              <b><a href="https://github.com/hekelpro" target="_blank">hekelpro</a></b>
            </span>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.bundle.js"></script>
  <script src="../js/jquery.easing.min.js"></script>
</body>
</html>